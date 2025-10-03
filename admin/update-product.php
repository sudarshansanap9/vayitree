<?php
include __DIR__ . '/../inc/config.php';

$allowed_tables = [
    'new_arrival' => 'New Arrival',
    'sarees' => 'Sarees',
    'dress_material' => 'Dress Material',
    'ready_mades' => 'Ready Mades',
    'customizable' => 'Customizable',
    'contact_us' => 'Contact Us'
];

// Validate inputs
$id = $_GET['id'] ?? 0;
$table = $_GET['table'] ?? '';
if(!array_key_exists($table, $allowed_tables) || !$id){
    die("Invalid request.");
}

// Fetch current product data
$row = $conn->query("SELECT * FROM `$table` WHERE id = $id")->fetch_assoc();
if(!$row){
    die("Product not found.");
}

// Handle form submission
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    // Handle main image upload
    $main_image = $row['main_image'];
    if(!empty($_FILES['main_image']['name'])){
        if($main_image && file_exists(__DIR__.'/../uploads/'.$main_image)){
            unlink(__DIR__.'/../uploads/'.$main_image);
        }
        $main_image = time().'_'.basename($_FILES['main_image']['name']);
        move_uploaded_file($_FILES['main_image']['tmp_name'], __DIR__.'/../uploads/'.$main_image);
    }

    // Handle gallery images upload
    $gallery = json_decode($row['gallery'], true) ?? [];
    if(!empty($_FILES['gallery']['name'][0])){
        // Optionally remove old gallery
        foreach($gallery as $img){
            if(file_exists(__DIR__.'/../uploads/'.$img)) unlink(__DIR__.'/../uploads/'.$img);
        }
        $gallery = [];
        foreach($_FILES['gallery']['tmp_name'] as $key => $tmp){
            $filename = time().'_'.$key.'_'.basename($_FILES['gallery']['name'][$key]);
            move_uploaded_file($tmp, __DIR__.'/../uploads/'.$filename);
            $gallery[] = $filename;
        }
    }

    // Update DB
    $gallery_json = json_encode($gallery, JSON_HEX_APOS | JSON_HEX_QUOT);
    $stmt = $conn->prepare("UPDATE `$table` SET name=?, price=?, stock=?, main_image=?, gallery=? WHERE id=?");
    $stmt->bind_param("sisssi", $name, $price, $stock, $main_image, $gallery_json, $id);
    $stmt->execute();

    echo "<p style='color:green;'>Product updated successfully!</p>";
    // Refresh data
    $row = $conn->query("SELECT * FROM `$table` WHERE id = $id")->fetch_assoc();
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Product — <?= $allowed_tables[$table] ?></title>
<style>
body{font-family:sans-serif;padding:20px;}
form{max-width:600px;}
input[type=text], input[type=number], input[type=file]{width:100%;padding:6px;margin:6px 0;}
button{padding:8px 16px;margin-top:10px;}
img{margin:4px;border-radius:4px;}
</style>
</head>
<body>
<h2>Update Product — <?= $allowed_tables[$table] ?></h2>
<form method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required>

    <label>Stock:</label>
    <input type="number" name="stock" value="<?= $row['stock'] ?>" required>

    <label>Main Image:</label>
    <?php if($row['main_image']): ?>
        <img src="../uploads/<?= $row['main_image'] ?>" width="80">
    <?php endif; ?>
    <input type="file" name="main_image">

    <label>Gallery Images:</label>
    <?php 
    $gallery = json_decode($row['gallery'], true) ?? [];
    foreach($gallery as $img){
        echo '<img src="../uploads/'.$img.'" width="50">';
    }
    ?>
    <input type="file" name="gallery[]" multiple>

    <button type="submit">Update Product</button>
</form>

<p><a href="list-products.php?table=<?= $table ?>">Back to List</a></p>
</body>
</html>

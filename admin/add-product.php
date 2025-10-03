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

if($_SERVER['REQUEST_METHOD']=='POST'){
    $table = $_POST['table'];
    if(!array_key_exists($table, $allowed_tables)){
        die("Invalid category");
    }

    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    // Main image
    $main_image = '';
    if(!empty($_FILES['main_image']['name'])){
        $main_image = time().'_'.basename($_FILES['main_image']['name']);
        move_uploaded_file($_FILES['main_image']['tmp_name'], __DIR__.'/uploads/'.$main_image);
    }

    // Gallery images
    $gallery = [];
    if(!empty($_FILES['gallery']['name'][0])){
        foreach($_FILES['gallery']['tmp_name'] as $key => $tmp){
            $filename = time().'_'.$key.'_'.basename($_FILES['gallery']['name'][$key]);
            move_uploaded_file($tmp, __DIR__.'/uploads/'.$filename);
            $gallery[] = $filename;
        }
    }
    $gallery_json = json_encode($gallery, JSON_HEX_APOS | JSON_HEX_QUOT);

    $stmt = $conn->prepare("INSERT INTO `$table` (name, price, stock, main_image, gallery) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $price, $stock, $main_image, $gallery_json);
    $stmt->execute();

    echo "<p style='color:green;'>Product added successfully!</p>";
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product</title>
</head>
<body>
<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Category:</label>
    <select name="table" required>
        <?php foreach($allowed_tables as $key => $label): ?>
        <option value="<?= $key ?>"><?= $label ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required><br>

    <label>Stock:</label>
    <input type="number" name="stock" required><br>

    <label>Main Image:</label>
    <input type="file" name="main_image" required><br>

    <label>Gallery Images:</label>
    <input type="file" name="gallery[]" multiple><br>

    <button type="submit">Add Product</button>
</form>
<p><a href="list-products.php">View Products</a></p>
</body>
</html>

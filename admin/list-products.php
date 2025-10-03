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

// Selected table
$table = $_GET['table'] ?? 'sarees';
if(!array_key_exists($table, $allowed_tables)){
    $table = 'sarees';
}

// Fetch rows from selected table
$result = $conn->query("SELECT * FROM `$table` ORDER BY id DESC");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin — <?= $allowed_tables[$table] ?> Listing</title>
<style>
body{font-family:sans-serif;padding:20px;}
select, button{padding:6px 12px;margin:5px;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th, td{border:1px solid #ddd;padding:8px;text-align:left;}
th{background:#3949ab;color:#fff;}
img{border-radius:4px;}
a.delete{color:#d32f2f;text-decoration:none;}
a.update{color:#1976d2;text-decoration:none;}
a.delete:hover{text-decoration:underline;}
a.update:hover{text-decoration:underline;}
</style>
</head>
<body>

<h2>Admin — Product Listing</h2>

<form method="GET">
    <label>Select Category: </label>
    <select name="table" onchange="this.form.submit()">
        <?php foreach($allowed_tables as $key => $label): ?>
            <option value="<?= $key ?>" <?= $key==$table?'selected':'' ?>><?= $label ?></option>
        <?php endforeach; ?>
    </select>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Main Image</th>
    <th>Gallery</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td>₹<?= $row['price'] ?></td>
    <td><?= $row['stock'] ?></td>
    <td>
        <?php if($row['main_image']): ?>
        <img src="../uploads/<?= $row['main_image'] ?>" width="50">
        <?php endif; ?>
    </td>
    <td>
        <?php 
        $gallery = json_decode($row['gallery'], true);
        if(is_array($gallery)){
            foreach($gallery as $img) echo '<img src="../uploads/'.$img.'" width="30"> ';
        }
        ?>
    </td>
    <td>
        <a class="update" href="update-product.php?id=<?= $row['id'] ?>&table=<?= $table ?>">Update</a> | 
        <a class="delete" href="delete-saree.php?id=<?= $row['id'] ?>&table=<?= $table ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>

<?php
include __DIR__ . '/../inc/config.php';

// Which table to show? (You can change this to 'new_arrival', 'ready_mades', etc.)
$table = 'sarees';

$result = $conn->query("SELECT * FROM `$table` ORDER BY id DESC");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin — List Sarees</title>
<style>
table{width:100%;border-collapse:collapse;margin-top:20px;}
th, td{border:1px solid #ddd;padding:8px;text-align:left;}
th{background:#3949ab;color:#fff;}
a.delete{color:#d32f2f;text-decoration:none;}
a.delete:hover{text-decoration:underline;}
</style>
</head>
<body>
<h2>Admin — List of Sarees (<?= $table ?>)</h2>
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
        if(is_array($gallery)) {
          foreach($gallery as $img) echo '<img src="../uploads/'.$img.'" width="30"> ';
        }
      ?>
    </td>
    <td>
      <a class="delete" href="delete-saree.php?id=<?= $row['id'] ?>&table=<?= $table ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
  </tr>
<?php endwhile; ?>
</table>
</body>
</html>

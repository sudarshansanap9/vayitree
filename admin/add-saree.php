<?php
// admin/add-saree.php
include __DIR__ . '/../inc/config.php';

$allowed_tables = [
  'new_arrival'   => 'New Arrival',
  'sarees'        => 'Sarees',
  'dress_material'=> 'Dress Material',
  'ready_mades'   => 'Ready Mades',
  'customizable'  => 'Customizable',
  'contact_us'    => 'Contact Us'
];

$err = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '0';
    $stock = $_POST['stock'] ?? '0';
    $category = $_POST['category'] ?? '';

    // Main image + gallery variables
    $mainImage = '';
    $galleryArray = [];

    if ($name === '' || $category === '' || !array_key_exists($category, $allowed_tables)) {
        $err = 'Please enter product name and choose a valid category.';
    } else {
        // ---- Handle Main Image Upload ----
        if (!empty($_FILES['main_image']['name'])) {
            $targetDir = __DIR__ . '/../uploads/';
            $filename = time() . '_' . basename($_FILES['main_image']['name']);
            $targetFile = $targetDir . $filename;

            if (move_uploaded_file($_FILES['main_image']['tmp_name'], $targetFile)) {
                $mainImage = $filename;
            } else {
                $err = "Failed to upload main image.";
            }
        }

        // ---- Handle Sub Images Upload (gallery) ----
        if (!empty($_FILES['sub_images']['name'][0])) {
            $targetDir = __DIR__ . '/../uploads/';
            foreach ($_FILES['sub_images']['name'] as $key => $subFile) {
                if ($_FILES['sub_images']['error'][$key] === UPLOAD_ERR_OK) {
                    $subFilename = time() . '_' . basename($subFile);
                    $targetFile = $targetDir . $subFilename;
                    if (move_uploaded_file($_FILES['sub_images']['tmp_name'][$key], $targetFile)) {
                        $galleryArray[] = $subFilename;
                    }
                }
            }
        }

        if ($err === '') {
            $price = floatval($price);
            $stock = intval($stock);
            $galleryJson = json_encode($galleryArray);

            // Add main_image & gallery to table
            $sql = "INSERT INTO `{$category}` (name, price, stock, main_image, gallery) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                $err = "Database error (prepare): " . $conn->error;
            } else {
                $stmt->bind_param('sdiss', $name, $price, $stock, $mainImage, $galleryJson);
                if ($stmt->execute()) {
                    $success = "Added successfully to '{$allowed_tables[$category]}' with images.";
                    $_POST = [];
                } else {
                    $err = "Insert failed: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Admin — Add Saree</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;padding:24px;background:#f5f6fb}
    .box{max-width:720px;margin:auto;background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,.06)}
    label{display:block;margin:10px 0 6px;font-weight:600}
    input, select{width:100%;padding:10px;border:1px solid #ddd;border-radius:6px}
    .row{display:flex;gap:12px}
    .row > *{flex:1}
    .msg{padding:10px;border-radius:6px;margin-bottom:12px}
    .err{background:#ffecec;color:#a33;border:1px solid #f5c6c6}
    .ok{background:#e8fff0;color:#116;border:1px solid #c6f5d3}
    button{margin-top:12px;padding:10px 14px;border:none;border-radius:6px;background:#3949ab;color:#fff;cursor:pointer}
  </style>
</head>
<body>
  <div class="box">
    <h2>Admin Panel — Add Saree (with Images)</h2>

    <?php if($err): ?><div class="msg err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
    <?php if($success): ?><div class="msg ok"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data">
      <label for="name">Saree Name *</label>
      <input id="name" name="name" type="text" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>

      <div class="row">
        <div>
          <label for="price">Price (₹)</label>
          <input id="price" name="price" type="number" step="0.01" min="0" value="<?= htmlspecialchars($_POST['price'] ?? '0.00') ?>">
        </div>
        <div>
          <label for="stock">Stock (quantity)</label>
          <input id="stock" name="stock" type="number" min="0" value="<?= htmlspecialchars($_POST['stock'] ?? '0') ?>">
        </div>
      </div>

      <label for="category">Choose Page / Category *</label>
      <select id="category" name="category" required>
        <option value="">-- Select --</option>
        <?php foreach($allowed_tables as $k => $label): ?>
          <option value="<?= $k ?>" <?= (($_POST['category'] ?? '') === $k) ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
        <?php endforeach; ?>
      </select>

      <label for="main_image">Main Image *</label>
      <input type="file" id="main_image" name="main_image" accept="image/*" required>

      <label for="sub_images">Sub Images (gallery, multiple)</label>
      <input type="file" id="sub_images" name="sub_images[]" accept="image/*" multiple>

      <button type="submit">Save to Selected Page</button>
    </form>
  </div>
</body>
</html>

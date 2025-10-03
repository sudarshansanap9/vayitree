<?php
include __DIR__ . '/../inc/config.php';

$allowed_tables = [
  'new_arrival', 'sarees', 'dress_material', 'ready_mades', 'customizable', 'contact_us'
];

if(isset($_GET['id'], $_GET['table']) && in_array($_GET['table'], $allowed_tables)) {
    $id = intval($_GET['id']);
    $table = $_GET['table'];

    // Get row to delete images
    $row = $conn->query("SELECT main_image, gallery FROM `$table` WHERE id = $id")->fetch_assoc();

    if($row){
        if(!empty($row['main_image']) && file_exists(__DIR__.'/uploads/'.$row['main_image'])){
            unlink(__DIR__.'/uploads/'.$row['main_image']);
        }
        $gallery = json_decode($row['gallery'], true);
        if(is_array($gallery)){
            foreach($gallery as $img){
                if(file_exists(__DIR__.'/uploads/'.$img)) unlink(__DIR__.'/uploads/'.$img);
            }
        }
        $conn->query("DELETE FROM `$table` WHERE id = $id");
    }
}

header("Location: list-products.php?table=".$table);
exit;

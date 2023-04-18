<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

if (!is_logged_in()) {
    header('Location: /');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_file = $_FILES["file"];

    if (!isset($image_file)) {
        die('No file uploaded.');
    }
    
    $image_type = exif_imagetype($image_file["tmp_name"]);
    if (!$image_type) {
        die('Uploaded file is not an image.');
    }

    $uniqueID = uniqid();

    move_uploaded_file($image_file["tmp_name"], __DIR__ . "/../public/img/uploads/" . $uniqueID . ".png");

    print_r($uniqueID);
} else {
    header('Location: /');
}

?>
<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

//If user is not logged in prevent them from accessing the page
if (!is_logged_in()) {
    header('Location: /');
}

//Code will take the file from a POST request, assign it a random ID and save it into the public assets folder for later use
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

    // Will get the unique ID used and return it back to the user so that they know what to reference as their image URL
    print_r($uniqueID);
} else {
    header('Location: /');
}

?>
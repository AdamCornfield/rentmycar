<?php 
session_start(); 

include('./functions/conn.php');
include('./functions/is_logged_in.php');

if (is_logged_in()) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);

    $user_id = $_SESSION['user_id'];

    $stmt->execute();

    $userdata = $stmt->get_result();
}
?>

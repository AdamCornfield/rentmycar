<?php 
//Starts the page session and will save the user's data if they are logged in to local storage each time the user changes pages
session_start(); 

if (is_logged_in()) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);

    $user_id = $_SESSION['user_id'];

    $stmt->execute();

    $result = $stmt->get_result();
    $userdata = $result->fetch_assoc();
}
?>

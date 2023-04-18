<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

if (!is_logged_in()) {
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $value = $data['value'];
    $vehicle_id = $data['vehicle_id'];
    
    $stmt = $conn->prepare("UPDATE vehicle_details SET ".$name." = ? WHERE vehicle_id = ?");
    $stmt->bind_param("ss", $value, $vehicle_id);

    $stmt->execute();

    $result = $stmt->get_result();
} else {
    header('Location: /');
}

?>
<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

if (!is_logged_in()) {
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $_SESSION['user_id'];
    $vehicle_make = $data['vehicle_make'];
    $vehicle_model = $data['vehicle_model'];
    $vehicle_bodytype = $data['vehicle_bodytype'];
    $fuel_type = $data['fuel_type'];
    $mileage = $data['mileage'];
    $location = $data['location'];
    $year = $data['year'];
    $num_doors = $data['num_doors'];
    $image_url = $data['image_url'];
    
    $stmt = $conn->prepare("INSERT INTO vehicle_details (user_id, vehicle_make, vehicle_model, vehicle_bodytype, fuel_type, mileage, location, year, num_doors, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $user_id, $vehicle_make, $vehicle_model, $vehicle_bodytype, $fuel_type, $mileage, $location, $year, $num_doors, $image_url);

    $stmt->execute();

    $result = $stmt->get_result();

    var_dump($result);
} else {
    header('Location: /');
}

?>
test
<?php
// API Endpoint to add a vehicle to the database
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

//If user is not logged in prevent them from accessing the page
if (!is_logged_in()) {
    header('Location: /');
}

//Server will only execute code if it is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Decode the data, nessecary because data is being sent using JSON and not form-data objects
    $data = json_decode(file_get_contents('php://input'), true);

    // Convert all of the values coming from the post request into local variables
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
    
    //Use prepared statement queries to add the data to the database
    $stmt = $conn->prepare("INSERT INTO vehicle_details (user_id, vehicle_make, vehicle_model, vehicle_bodytype, fuel_type, mileage, location, year, num_doors, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $user_id, $vehicle_make, $vehicle_model, $vehicle_bodytype, $fuel_type, $mileage, $location, $year, $num_doors, $image_url);

    $stmt->execute();

    $result = $stmt->get_result();

} else {
    header('Location: /');
}

?>
test
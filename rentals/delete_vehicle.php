<?php
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
    $vehicle_id = $data['vehicle_id'];
    
    //Use prepared statement queries to add the data to the database
    $stmt = $conn->prepare("DELETE FROM vehicle_details WHERE vehicle_id = ?");
    $stmt->bind_param("s", $vehicle_id);

    $stmt->execute();

    $result = $stmt->get_result();
} else {
    header('Location: /');
}

?>
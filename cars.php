<?php
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php'); 

// Creates an sql query using prepared statements and saves the result as variable $row
$stmt = $conn->prepare("SELECT * FROM vehicle_details LEFT JOIN users ON vehicle_details.user_id = users.user_id WHERE vehicle_id = ?");
$stmt->bind_param("s", $vehicle_id);

$vehicle_id = $_GET['vehicle_id'];

$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/styles.css" rel="stylesheet">
    <link href="/public/css/bootstrap.css" rel="stylesheet">
    <link href="/public/css/bootstrap-utilities.css" rel="stylesheet">
    <link href="/public/css/bootstrap-grid.css" rel="stylesheet">
    <title>RentMyCar.io</title>
</head>
<body>
    <div>
        <!-- Navbar content -->
        <?php include('./partials/navbar.php') ?>
    </div>
    <div id="main">
        <div class="d-flex justify-content-center">
            <div class="container m-5">
                <div class="row">
                    <div class="col-6">
                        <img src="<?php echo $row['image_url'] ?>" class="img-full mt-0">
                    </div>
                    <div class="col-6">
                        <h2 class="mt-0"><?php echo $row['year']." ".$row['vehicle_make']." ".$row['vehicle_model'] ?></h2>
                        <div class="line-divider-full"></div>
                        <p>Make: <?php echo $row['vehicle_make'] ?></p>
                        <p>Model: <?php echo $row['vehicle_model'] ?></p>
                        <p>Body Type: <?php echo $row['vehicle_bodytype'] ?></p>
                        <p>Year: <?php echo $row['year'] ?></p>
                        <p>Fuel Type: <?php echo $row['fuel_type'] ?></p>
                        <p>Mileage: <?php echo $row['mileage'] ?></p>
                        <p>Location: <?php echo $row['location'] ?></p>
                        <div class="line-divider-full"></div>
                        <h5 class="mb-0">Owned By: <?php echo $row['first_name']." ".$row['last_name'] ?></h5>
                        <p>Owner Email: <?php echo $row['email'] ?></p>
                        <p>Owner Phone Number: <?php echo $row['telephone'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/app.js"></script>
</body>
</html>
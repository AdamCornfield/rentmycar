<?php
//Default imports to set up the page correctly
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php'); 

//Get all vehicle details from the database to display to the user
$stmt = $conn->prepare("SELECT * FROM vehicle_details ORDER BY vehicle_id DESC");

$stmt->execute();

$result = $stmt->get_result();

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
        <div class="container">
            <div class="row">
                <?php
                    // Loop through every entry in the database and display them on the page
                    while($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-4 p-4">
                            <div class="card w-full">
                                <img src="<?php echo $row['image_url'] ?>" class="img-previews mt-0">
                                <h4 class="mt-0"><?php echo $row['year']." ".$row['vehicle_make']." ".$row['vehicle_model'] ?></h4>
                                <a class="btn btn-info" href="/cars?vehicle_id=<?php echo $row['vehicle_id'] ?>">See More</a>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/app.js"></script>
</body>
</html>
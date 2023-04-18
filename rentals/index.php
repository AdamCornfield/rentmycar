<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

//If user is not logged in prevent them from accessing the page
if (!is_logged_in()) {
    header('Location: /');
}
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
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <input type="file" id="img-upload" accept="image/png">
            <label for="img-upload">Choose a file</label>
            <img src="" id="img-preview">
            <button type="button" class="btn btn-success w-full d-none" id="img-upload-btn">Upload Image</button>
            <button type="button" class="btn btn-warning mt-4" id="img-upload-cancel">Cancel Upload</button>
        </div>

    </div>
    <div>
        <!-- Navbar content -->
        <?php include('../partials/navbar.php') ?>
    </div>
    <div id="main">
        <h2 class="text-center">View and Edit Vehicle Information</h2>
        <p class="text-center">Here you can edit, add and delte any vehicle you have uploaded to the database, simply click on any of the entries in the table to begin editing!</p>
        <div class="d-flex justify-content-center">
            <div class="card w-75">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-start p-2">Vehicle ID</th>
                            <th class="text-start p-2">Vehicle Make</th>
                            <th class="text-start p-2">Vehicle Model</th>
                            <th class="text-start p-2">Vehicle Body Type</th>
                            <th class="text-start p-2">Fuel Type</th>
                            <th class="text-start p-2">Mileage</th>
                            <th class="text-start p-2">Location</th>
                            <th class="text-start p-2">Year</th>
                            <th class="text-start p-2">Number of Doors</th>
                            <th class="text-start p-2">Image URL</th>
                            <th class="text-start p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/rentals.js"></script>
<script src="/public/js/app.js"></script>
</body>
</html>
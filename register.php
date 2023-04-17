
<?php include('./functions/init.php') ?>
<?php

// Will get the constraints
$constraints = json_decode(file_get_contents("./json/constraints.json"), true);

if (is_logged_in()) {
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
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
    <div>
        <!-- Navbar content -->
        <?php include('./partials/navbar.php') ?>
    </div>
    <div id="main">
        <div class="d-flex justify-content-center">
            <div class="card">
                    <form action="/register" method="POST" style="margin: 20px;">
                        <p class="text-center">Login Credentials</p>
                        <div class="input-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Password Confirmation</label>
                            <input type="password" id="password-confirm" name="password-confirm">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Personal Information</p>
                        <div class="input-group">
                            <label>Title</label>
                            <input list="titles" id="title" name="title">
                            <p class="is-invalid d-none"></p>
                            <datalist id="titles">
                                <option value="Mr">
                                <option value="Mrs">
                                <option value="Ms">
                                <option value="Miss">
                                <option value="Dr">
                                <option value="Mx">
                            </datalist>
                        </div>
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" id="fname" name="fname">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" id="sname" name="sname">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Gender</label>
                            <select>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Address</p>
                        <div class="input-group">
                            <label>Address Line 1</label>
                            <input type="text" id="address1" name="address1">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Address Line 2</label>
                            <input type="text" id="address2" name="address2">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Address Line 3</label>
                            <input type="text" id="address3" name="address3">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Post Code</label>
                            <input type="text" id="postcode" name="postcode">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Contact Information</p>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" id="email" name="email">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Telephone Number</label>
                            <input type="tel" id="telephone" name="telephone">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <button type="submit" class="btn btn-primary" id="register-submit">Submit</button>
                    </form>
            </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/register.js"></script>
</body>
</html>
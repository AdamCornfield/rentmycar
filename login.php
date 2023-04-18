<?php
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php');

//Prevents people already logged in from logging in again
if (is_logged_in()) {
    header('Location: /');
}

$request_invalid = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Get any userdata who has the same username as what is entered
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    //Bind the params
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt->execute();

    //Save the resulting data to a row variable
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    //Using the password_verify function it will check the entered password again the encrypted password to ensure security
    if (password_verify($password, $row['PASSWORD'])) {
        // User is verified, set the user_id session variable and redirect to the home page
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: /');
    } else {
        //User entered incorrect details, get them to re-enter details
        $request_invalid = true;
    }
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
            <div class="card text-center">
                <h2>Login to rentmycar.io</h2>
                <form action="/login" method="POST">
                    <div class="input-group-login">
                        <label>Username</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" id="username" name="username" required="required">
                        </div>
                    </div>
                    <div class="input-group-login">
                        <label>Password</label>
                        <div class="d-flex justify-content-center">
                        <input type="password" id="password" name="password" required="required">
                        </div>
                    </div>
                    <?php if ($request_invalid) { ?>
                        <p class="text-danger">Username or Password is incorrect</p>
                    <?php } ?>
                    <p>Not already a user? Sign up <a href="/register">here!</a></p>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/app.js"></script>
</body>
</html>
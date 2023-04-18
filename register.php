<?php
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php');

// Will get the constraints
$constraints = json_decode(file_get_contents("./json/constraints.json"), true);

$nameError = false;

if (is_logged_in()) {
    header('Location: /');
}
function validateField ($value, $local_constraints, $id) {
    if ($local_constraints['confirm'] && !($value == $_POST[$local_constraints['confirm']])) {
        return false;
    } else if (strlen($value) < $local_constraints['min']) {
        return false;
    } else if (strlen($value) > $local_constraints['max']) {
        return false;
    } else {
        return true;
    }
}

$username = '';
$password = '';
$password_confirm = '';
$title = '';
$first_name = '';
$last_name = '';
$gender = '';
$address1 = '';
$address2 = '';
$address3 = '';
$postcode = '';
$email = '';
$telephone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($constraints);
    $allDataValid = true;

    $stmt = $conn->prepare("SELECT Count(*) As Count FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    $username = $_POST['username'];
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['Count'] == 1) {
        $nameError = true;
    }

    foreach ($_POST as $key => $value) {
        $checkedValue = validateField($value, $constraints[$key], $key);
        if ($checkedValue == false) {
            $allDataValid = false;
        }
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password_confirm = $_POST['password-confirm'];
    $title = $_POST['title'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['sname'];
    $gender = $_POST['gender'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    
    if ($allDataValid && $row['Count'] == 0) {
        $stmt = $conn->prepare("INSERT INTO users SET username = ?, PASSWORD = ?, title = ?, first_name = ?, last_name = ?, gender = ?, address1 = ?, address2 = ?, address3 = ?, postcode = ?, email = ?, telephone = ?");
        $stmt->bind_param("ssssssssssss", $username, $hashed_password, $title, $first_name, $last_name, $gender, $address1, $address2, $address3, $postcode, $email, $telephone);
    
        $stmt->execute();
        $result = $stmt->insert_id;

        var_dump($result);

        $_SESSION['user_id'] = $result;

        header('Location: /');
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
            <div class="card">
                    <form action="/register" method="POST" style="margin: 20px;">
                        <p class="text-center">Login Credentials</p>
                        <div class="input-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                            <p class="is-invalid d-none"></p>
                            <?php if ($nameError) { ?><p class="is-invalid">This name is already taken please try another</p><?php } ?>
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" value="<?php echo $password; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Password Confirmation</label>
                            <input type="password" id="password-confirm" name="password-confirm" value="<?php echo $password_confirm; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Personal Information</p>
                        <div class="input-group">
                            <label>Title</label>
                            <input list="titles" id="title" name="title" value="<?php echo $title; ?>">
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
                            <input type="text" id="fname" name="fname" value="<?php echo $first_name; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" id="sname" name="sname" value="<?php echo $last_name; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Gender</label>
                            <select id="gender" name="gender">
                                <option value="Male" <?php if ($gender == `Male`) { ?> selected='selected' <?php }; ?>>Male</option>
                                <option value="Female" <?php if ($gender == `Female`) { ?> selected='selected' <?php }; ?>>Female</option>
                                <option value="Other" <?php if ($gender == `Other`) { ?> selected='selected' <?php }; ?>>Other</option>
                            </select>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Address</p>
                        <div class="input-group">
                            <label>Address Line 1</label>
                            <input type="text" id="address1" name="address1" value="<?php echo $address1; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Address Line 2</label>
                            <input type="text" id="address2" name="address2" value="<?php echo $address2; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Address Line 3</label>
                            <input type="text" id="address3" name="address3" value="<?php echo $address3; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Post Code</label>
                            <input type="text" id="postcode" name="postcode" value="<?php echo $postcode; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="line-divider-full"></div>
                        <p class="text-center">Contact Information</p>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                            <p class="is-invalid d-none"></p>
                        </div>
                        <div class="input-group">
                            <label>Telephone Number</label>
                            <input type="tel" id="telephone" name="telephone" value="<?php echo $telephone; ?>">
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
<script src="/public/js/app.js"></script>
</body>
</html>
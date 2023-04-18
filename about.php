<?php
//Default imports to set up the page correctly
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php'); 

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
        <div class="text-center w-75">
            <h1>About rentmycar.io</h1>
            <div class="line-divider"></div>
            <p>Rentmycar.io is a website created as part of a university project built by Adam Cornfield.</p>
            <p>I have a history in webdevelopment creating projects such as <a href="https://binarygame.cornfield.dev">binarygame</a> as well as several other projects, however this is my first project using PHP as the server language as all previous projects were developed using Node.JS.</p>
            <p>It is built fully using a PHP backend along with a mysql database.</p>
            <p>The source code for this website is fully open sourced on github and can be viewed <a href="https://github.com/AdamCornfield/rentmycar">here</a>.</p>
            <p>This website is made in conjunction with custom css data found in styles.css but also used some bootstrap css utilities along side it, such as the buttons, positioning and sizing utilities as well as bootstrap grid.</p>
            <p>Images used for the vehicles are provided by <a href="https://www.pexels.com">pexels</a> and used in full compliance of their <a href="https://www.pexels.com/license/">licensing terms</a>.</p>
            <div class="line-divider"></div>
            <h2>Website Features</h2>
            <p>This website features fully encrypted passwords when using login and registration fields meaning even if you have access to the database you still are not able to get access to the stored passwords, couple this with using the https protocol exclusively in production makes it quite difficult to gain unauthorised access to the website.</p>
            <p>
                The login and application forms both use default HTML forms to store and transmit data however one caveat of using forms is that the page must reload when making a request, for login and registration this is fine, however for modern websites when doing things such as modifying tables having to refresh the page every time an edit is made can slow down the end user experience.
                This is why I made use of something known as the JS fetch API which is a mode modern version of AJAX enabling me to make requests to the web server directlytrough the javascript.
            </p>
            <p>As a result of this the table shown on the edit vehicles page is fully dynamic and live, meaning that every time a change is made to a single entry that is sent to the database, as well as updates and adding new handled all seamlessly from this same table without having to use any dated html forms.</p>
            <p>Image uploading is also handled in a similar way but uses a more unique approach to how HTMl implements image uploading by default, in my case there is a custom CSS button which allows you to upload an image to the browser where you will also be provided with a preview of the image, you can then get the choice to upload the image to the actual server or cancel, once the image is sent to the server it is saved and given a randomised unique identifier which is sent back to the user and placed into the table so that the user can save that entry to the database with an image.</p>
            <p>The homepage is made using CSS grid implemented through the bootstrap CSS library, this is also made in a rule of thirds configuration.</p>
        </div>
        </div>
    </div>
    <div>
        <!-- Footer content -->
    </div>
<script src="/public/js/app.js"></script>
</body>
</html>
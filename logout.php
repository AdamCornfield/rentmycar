<?php
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php');

//Simple function which will destroy the session if a user is redirected to it

if (is_logged_in()) {
    session_destroy();
}
header('Location: /');

?>
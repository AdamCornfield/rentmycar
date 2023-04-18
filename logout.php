<?php
include('./functions/conn.php');
include('./functions/is_logged_in.php');
include('./functions/init.php');

if (is_logged_in()) {
    session_destroy();
}
header('Location: /');

?>
<?php
include('./functions/init.php');
if (is_logged_in()) {
    session_destroy();
}
header('Location: /');

?>
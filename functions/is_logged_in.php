<?php
//Will run a check to see if the user is logged in and return true or false depending on that
function is_logged_in () {
    if (array_key_exists('user_id', $_SESSION)) {
        return true;
    } else {
        return false;
    }
}

?>
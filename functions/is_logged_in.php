<?php

function is_logged_in () {
    if (array_key_exists('user_id', $_SESSION)) {
        return true;
    } else {
        return false;
    }
}

?>
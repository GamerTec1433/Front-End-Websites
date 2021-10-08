<?php
    include_once('services/alertbox.php');
    if (session_status() == PHP_SESSION_NONE)
        session_start();
    session_destroy();
    AlertBox::SetSessionAlertBox(AlertBox::$info, "You Have Logged Out");
    header('location: index.php');
?>
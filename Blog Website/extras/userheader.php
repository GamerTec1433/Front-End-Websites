<?php
    include_once('services/dbcon.php');
    include_once('services/utilities.php');
    include_once('services/alertbox.php');
    
    if (session_status() == PHP_SESSION_NONE)
        session_start();
     
    if (isset($_SESSION['userID']))
    {
        if ($_SESSION['user-type'] == 'admin')
        {
            HeaderLocation('admin/dashboard.php');
            exit();
        }
    }
        
    if (isset($_SESSION['userID']))
    {
        include_once('extras/userheaderuserlogin.php');
    }
    else
    {
        include_once('extras/userheaderuser.php');
    }
?>
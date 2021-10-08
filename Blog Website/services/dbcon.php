<?php 
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'blogger';

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (mysqli_error($conn))
        echo "Error Happened! " . mysqli_error($conn);
?>
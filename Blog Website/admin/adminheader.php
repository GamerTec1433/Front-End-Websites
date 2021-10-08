<?php
    include_once('../services/utilities.php');
    if (session_status() == PHP_SESSION_NONE)
        session_start();
        
    if (isset($_SESSION['userID']))
    {
        if ($_SESSION['user-type'] != 'admin')
        {
            HeaderLocation('../index.php');
            exit();
        }
    }
    else
    {
        HeaderLocation('../index.php');
        exit();
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- FontAwsome -->
    <script src="https://kit.fontawesome.com/f838843bb1.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/admin/mainstyle.css?">
    <link rel="stylesheet" href="../css/mainstyle.css?ver=1">
    <link rel="stylesheet" href="../css/admin/addarticle.css?ver=1">
    <link rel="stylesheet" href="../css/admin/dashboard.css?ver=1">
    <link rel="stylesheet" href="../css/articlepage.css?ver=1">
    <link rel="stylesheet" href="../css/errors.css">

</head>

<body>
    <div class="admin d-flex">
        <div class="side-bar">
            <a class="navbar-brand d-block text-center" href="dashboard.php">Logo.</a>
            <div class="d-flex flex-column">
                <a href="dashboard.php" class="d-flex"><i class="fas fa-columns"></i>Dashboard</a>
                <a href="addarticle.php" class="d-flex"><i class="fas fa-folder-plus"></i>AddArticle</a>
                <a href="showarticles.php" class="d-flex"><i class="fas fa-folder-open"></i>ShowArticle</a>
                <a href="showcomments.php" class="d-flex"><i class="fas fa-users"></i>ShowComments</a>
                <a href="users.php" class="d-flex"><i class="fas fa-users"></i>ShowUsers</a>
                <a href="../logout.php" class="d-flex"><i class="fas fa-sign-out-alt"></i>LogOut</a>
            </div>
        </div>
        <div class="main flex-grow-1">
            <nav class="navbar navbar-expand-sm px-sm-5 py-sm-1">
                <div class="container-fluid">
                    <a class="navbar-brand" href="dashboard.php">Logo.</a>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon d-flex justify-content-center align-content-center">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
                        <ul class="navbar-nav mt-2 mt-lg-0">
                            <li>
                                <a href="dashboard.php" class="d-flex"><i class="fas fa-columns"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="addarticle.php" class="d-flex"><i class="fas fa-folder-plus"></i>AddArticle</a>
                            </li>
                            <li>
                                <a href="showarticles.php" class="d-flex"><i
                                        class="fas fa-folder-open"></i>ShowArticle</a>
                            </li>
                            <li>
                                <a href="showcomments.php" class="d-flex"><i class="fas fa-users"></i>ShowComments</a>
                            </li>
                            <li>
                                <a href="users.php" class="d-flex"><i class="fas fa-users"></i>ShowUsers</a>
                            </li>
                            <li>
                                <a href="../logout.php" class="d-flex"><i class="fas fa-sign-out-alt"></i>LogOut</a>
                            </li>
                    </div>
                </div>
            </nav>
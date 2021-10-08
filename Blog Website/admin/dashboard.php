<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    $countComments = GetCount($conn, 'comment');
    $countUsers = GetCount($conn, 'user');
    $countArticles = GetCount($conn, 'article');
    $countFavArticles = GetCount($conn, 'favourite_article');
?>

<?php include_once('adminheader.php') ?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML());
    AlertBox::DestroySessionAlertBox();
?>

<h6 class="container py-5">DASHBOARD</h6>
<div class="dashboard container">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-6">
            <div class="item">
                <h1><i class="far fa-comment"></i>Comments</h1>
                <p><?php echo $countComments ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item">
                <h1><i class="far fa-user"></i>Users</h1>
                <p><?php echo $countUsers ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item">
                <h1><i class="far fa-address-card"></i>Posts</h1>
                <p><?php echo $countArticles ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item">
                <h1><i class="far fa-heart"></i></i>Favourite Posts</h1>
                <p><?php echo $countFavArticles ?></p>
            </div>
        </div>

    </div>
</div>

<?php include_once('adminfooter.php') ?>
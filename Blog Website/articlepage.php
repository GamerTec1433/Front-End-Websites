<?php include_once('extras/userheader2.php') ?>

<?php

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if (isset($_SESSION['userID']))
        $userID = $_SESSION['userID'];

    $states = '';
    if (isset($_POST['submit-comment']))
    {
        $comment_user = ClearData($_POST['content']);

        if (isset($_SESSION['userID']) && isset($_GET['id']))
        {
            $articleID = $_GET['id'];
            $query = "INSERT INTO comment(content, user_ID, article_ID) VALUES ('{$comment_user}', {$_SESSION['userID']}, {$_GET['id']})";

            $result = mysqli_query($conn, $query);

            if ($result)
            {
                $alertBox = new AlertBox(AlertBox::$success, 'Your Comment Has Been Sent!');
                $states .= $alertBox->GetAlertBoxHTML();
                $comment_user = '';
            }
            else
            {
                $alertBox = new AlertBox(AlertBox::$error, 'Error Happened!');
                $states .= $alertBox->GetAlertBoxHTML();
            }
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$warning, 'You Have To Log In!');
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }
?>

<?php
    if (isset($_GET['id']))
    {
        $query = "SELECT * FROM article WHERE ID = {$_GET['id']}";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result))
        {
            $data = mysqli_fetch_assoc($result);
            $id = $data['ID'];
            $header = $data['header'];
            $img = GetImageFromServer($data['image']);
            $content = $data['content'];
            $date = $data['date'];
            $countComments = GetCountWhere($conn, 'comment', 'article_ID', $id);
        }
        else
        {
            AlertBox::SetSessionAlertBox(AlertBox::$warning, 'Article Not Found!');
            HeaderLocation('articles.php');
            exit();
        }
    }
    else
    {
        AlertBox::SetSessionAlertBox(AlertBox::$warning, 'Article Not Found!');
        HeaderLocation('articles.php');
        exit();
    }
?>

<?php
    if (isset($_POST['fav']) && isset($userID))
    {
        $query = "INSERT INTO favourite_article(user_ID, article_ID) VALUES({$userID}, {$_GET['id']})";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alertBox = new AlertBox(AlertBox::$success, "Added To Favourite Articles");
            $states .= $alertBox->GetAlertBoxHTML();
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, "Error Happened!");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }
    if (isset($_POST['del-fav']) && isset($userID))
    {
        $query = "DELETE FROM favourite_article WHERE user_ID = {$userID} AND article_ID = {$_GET['id']}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alertBox = new AlertBox(AlertBox::$success, "Article Has Been Deleted From Favourite Articles");
            $states .= $alertBox->GetAlertBoxHTML();
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, "Error Happened!");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }
?>


<?php
    echo AlertBox::SetStackAlertBox($states);
?>

    <section class="article-page py-5">
        <div class="container">
            <h1 class="header"><?php echo $header ?></h1>
            <img src="<?php echo $img ?>">
            <div class="d-flex reactions pt-3">
                <div class="item">
                    <p class="default"><i class="far fa-calendar-minus mr-1"></i> <?php echo $date ?></p>
                </div>
                <div class="item">
                    <p class="default"><i class="far fa-comment mr-2"></i><?php echo $countComments ?></p>
                </div>
                <?php
                    if (isset($userID))
                    {
                        
                        $query = "SELECT * FROM favourite_article WHERE article_ID = {$_GET['id']} AND user_ID = {$userID}";

                        $res = mysqli_query($conn, $query);
                        
                        if (mysqli_num_rows($res) == 0)
                        {
                ?>
                        <form action="articlepage.php?id=<?php echo $_GET['id']; ?>" method="POST" class="item m-0 ml-auto">
                            <button type="submit" name="fav" class="btn">Add To Favourite Articles</button>    
                        </form>
                <?php 
                        }
                        else
                        {
                ?>
                        <form action="articlepage.php?id=<?php echo $_GET['id']; ?>" method="POST" class="item m-0 ml-auto">
                            <button type="submit" name="del-fav" class="btn">Delete From Favourite Articles</button>    
                        </form>
                <?php
                        }
                    }
                    else
                    {
                ?>
                    <a href="login.php" class="btn m-0 ml-auto">Sign In To Save Article</a>
                <?php
                    }
                ?>
            </div>
            <h1 class="header">Content</h1>
            <p><?php echo $content ?></p>
            <div class="line my-5"></div>
            <div class="comments-review">
                <p class="comments-count"><?php echo $countComments ?> Comments</p>
                <?php
                    $query = "SELECT * FROM comment WHERE article_ID = {$_GET['id']}";

                    $result = mysqli_query($conn, $query);

                    if ($result)
                    {
                        while ($data = mysqli_fetch_assoc($result))
                        {
                            $commentID = $data['ID'];
                            $content = FormatData($data['content']);
                            $userID = $data['user_ID'];
                            $commentDate = $data['date'];

                            $queryFindUser = "SELECT * FROM user WHERE ID = {$userID}";
                            $userResult = mysqli_query($conn, $queryFindUser);
                            
                            $userData = mysqli_fetch_assoc($userResult);
                            $userCommentedName = $userData['username'];
                            $userImage = GetImageFromServer($userData['image']);
                ?>

                <form class="item" action="article">
                    <div class="d-flex">
                        <img src="<?php echo $userImage ?>">
                        <div class="comment-content pl-4">
                            <div class="comment-user d-flex justify-content-between">
                                    <h4 class="m-0"><?php echo $userCommentedName ?></h4>
                                    <p class="m-0 pl-2"><?php echo $commentDate ?></p>
                            </div>
                            <p><?php echo $content ?></p>
                                <!-- <button type="submit" class="btn btn-primary">REPLY</button> -->
                        </div>
                    </div>
                    <div class="line my-3"></div>
                </form>

                <?php
                        }
                    }
                ?>
                
                
            </div>
            <form action="articlepage.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="content">Write your own comment</label>
                    <textarea type="text" class="form-control my-2" name="content" id="content" aria-describedby="helpId"
                        placeholder="Enter comment"><?php if (isset($comment_user)) echo $comment_user; ?></textarea>
                    <button type="submit" name="submit-comment" class="btn btn-primary">SEND</button>
                </div>
            </form>
        </div>

        </div>
    </section>

<?php include_once('extras/userfooter.php'); ?>
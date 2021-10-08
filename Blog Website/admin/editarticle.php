<?php include_once('adminheader.php') ?>

<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    $states = '';
    if (isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);

        if (!IsArticle($conn, $id))
        {
            AlertBox::SetSessionAlertBox(AlertBox::$warning, "ID Not Found!");
            HeaderLocation('showarticles.php');
            exit();
        }
    }

    if (isset($_POST['delete']))
    {
        $query = "DELETE FROM article WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            AlertBox::SetSessionAlertBox(AlertBox::$error, "ID:{$id} Article Has Been Deleted");
            HeaderLocation('showarticles.php');
            exit();
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, 'Error has Happened!');
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }

    if (isset($_POST['apply']))
    {
        $header = ClearData($_POST['header']);
        $content = ClearData($_POST['content']);
        $errorState = false;

        if (isset($_FILES['file']) && !empty($_FILES['file']['name']))
        {
            $image = SetImageInServer($_FILES['file'], '../');
            if (!UpdateArticle($conn, 'image', $image, $id))
            {
                $alertBox = new AlertBox(AlertBox::$error, "Can't Update The Content");
                $states .= $alertBox->GetAlertBoxHTML();
                $errorState = true;
            }
        }

        if (!UpdateArticle($conn, 'header', $header, $id))
        {
            $alertBox = new AlertBox(AlertBox::$error, "Can't Update Header");
            $states .= $alertBox->GetAlertBoxHTML();
            $errorState = true;
        }
        if (!UpdateArticle($conn, 'content', $content, $id))
        {
            $alertBox = new AlertBox(AlertBox::$error, "Can't Update Content");
            $states .= $alertBox->GetAlertBoxHTML();
            $errorState = true;
        }
        
        if (!$errorState)
        {
            $alertBox = new AlertBox(AlertBox::$success, "Data Has Been Updated");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }

    if (isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);

        if (!IsArticle($conn, $id))
        {
            AlertBox::SetSessionAlertBox(AlertBox::$error, "ID:{$id} Article Has Been Deleted");
            HeaderLocation('showarticles.php');
        }

        $query = "SELECT * FROM article WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0)
        {
            $data = mysqli_fetch_assoc($result);

            $header = FormatData($data['header']);
            $content = FormatData($data['content']);
            $image = GetImageFromServer($data['image'], '../');
        }
    }

    function UpdateArticle($conn, $column, $data, $id)
    {
        $query = "UPDATE article SET {$column} = '{$data}' WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        return $result;
    }
?>

<?php
    if (isset($_POST['delete-comment']))
    {
        $commentID = $_POST['comment-id'];

        $query = "DELETE FROM comment WHERE ID = {$commentID}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
           AlertBox::SetSessionAlertBox(AlertBox::$success, "ID:{$commentID} Comment Has Been Deleted");
            HeaderLocation($_POST['url']);
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, "Error Has Happened!");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }
?>

<?php
    $states .= AlertBox::GetSessionAlertBoxHTML();
    AlertBox::DestroySessionAlertBox();
    echo AlertBox::SetStackAlertBox($states);
?>

<h6 class="container py-5">DASHBOARD > EDIT ARTICLE</h6>
<div class="content container p-5" id="edit-article">
    <form action="editarticle.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group py-2">
            <label for="header">Article's Header</label>
            <input type="text" class="form-control" name="header" id="header" placeholder="Enter header" required
                value="<?php echo $header ?>">
        </div>
        <div class="form-group py-2">
            <label for="content">Article's Content</label>
            <textarea type="text" class="form-control" name="content" id="content" placeholder="Enter content"
                required><?php echo $content ?></textarea>
        </div>
        <div class="form-group py-2">
            <label for="file">Article's Image</label>
            <input type="file" class="form-control-file border rounded p-2" name="file" id="file">
        </div>
        <div class="form-group d-flex flex-column py-2">
            <label>Image Preview</label>
            <img src="<?php echo $image ?>" height="300px" style="object-fit: contain;" id="preview">
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" name="apply" class="btn btn-primary">Apply Edit</button>
            <button type="submit" name="delete" class="btn btn-primary">Delete</button>
        </div>
    </form>
    <div class="comments-review pt-5">
        <?php
                        $countComments = GetCountWhere($conn, 'comment', 'article_ID', $id);
                    ?>
        <p class="comments-count"><?php echo $countComments; ?> Comments</p>

        <?php
                        $query = "SELECT * FROM comment WHERE article_ID = {$id}";

                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0)
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
                                $userImage = GetImageFromServer($userData['image'], '../');
                    ?>

        <form class="item" action="editarticle.php?id=<?php echo $id ?>" method="POST">
            <div class="d-flex">
                <img src="<?php echo $userImage ?>">
                <div class="comment-content pl-4">
                    <div class="comment-user d-flex justify-content-between">
                        <h4 class="m-0"><?php echo $userCommentedName ?></h4>
                        <p class="m-0 pl-2"><?php echo $commentDate ?></p>
                    </div>
                    <p><?php echo $content ?></p>

                </div>
            </div>
            <input type="hidden" name="comment-id" value="<?php echo $commentID ?>">
            <input type="hidden" name="url" value="editarticle.php?id=<?php echo $id ?>">
            <button type="submit" class="btn btn-primary" name="delete-comment">Delete</button>
            <div class="line my-3"></div>
        </form>

        <?php 
                            }
                        }
                    ?>

    </div>
</div>

<script>
    let form = document.querySelector('#edit-article');
    let fileImage = form.querySelector('#file');
    let imagePreview = form.querySelector('#preview');

    fileImage.addEventListener('change', () => {
        let reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        }

        reader.readAsDataURL(fileImage.files[0]);
    })
</script>


<?php include_once('adminfooter.php') ?>

<?php
    mysqli_close($conn);
?>
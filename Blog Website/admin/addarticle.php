<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    $stateErrors = '';
    if (isset($_POST['submit']))
    {
        $header = ClearData($_POST['header']);
        $content = ClearData($_POST['content']);
        $image = SetImageInServer($_FILES['file'], '../');
        
        $query = "INSERT INTO article(header, content, image, date) VALUES ('{$header}', '{$content}', '{$image}', CURRENT_TIMESTAMP)";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alertBox = new AlertBox(AlertBox::$success, "Article Has Been Added To Database");
            $stateErrors .= $alertBox->GetAlertBoxHTML();
        }
        else
        {
            $error = mysqli_error($conn);
            $alertBox = new AlertBox(AlertBox::$error, "Error Happened, Please Try Again " .$error);
            $stateErrors .= $alertBox->GetAlertBoxHTML();
        }

        mysqli_close($conn);
    }
?>

<?php include_once('adminheader.php') ?>

<?php
    echo AlertBox::SetStackAlertBox($stateErrors);
?>

<h6 class="container py-5">DASHBOARD > ADD ARTICLE</h6>
<form id="add-article" accept="addarticle.php" method="POST" class="content container p-5"
    enctype="multipart/form-data">
    <div class="form-group py-2">
        <label for="header">Article's Header</label>
        <input type="text" class="form-control" name="header" id="header" placeholder="Enter header" required>
    </div>
    <div class="form-group py-2">
        <label for="content">Article's Content</label>
        <textarea type="text" class="form-control" name="content" id="content" placeholder="Enter content"
            required></textarea>
    </div>
    <div class="form-group py-2">
        <label for="file">Article's Image</label>
        <input type="file" class="form-control-file border rounded p-2" name="file" id="file" required>
    </div>
    <div class="form-group d-flex flex-column py-2">
        <label>Image Preview</label>
        <img src="../imgs/uploads/Placeholder.jpg" height="300px" style="object-fit: contain;" id="preview">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Article</button>
</form>

<script>
    let form = document.querySelector('#add-article');
    let fileImage = form.querySelector('#file');
    let imagePreview = form.querySelector('#preview');

    console.log(fileImage);

    fileImage.addEventListener('change', () => {
        let reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        }

        reader.readAsDataURL(fileImage.files[0]);
    })
</script>


<?php include_once('adminfooter.php') ?>
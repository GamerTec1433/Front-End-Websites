<?php
    include_once('services/dbcon.php');
    include_once('services/utilities.php');
    include_once('services/alertbox.php');
    
    if (session_status() == PHP_SESSION_NONE)
        session_start();
    
        if (!isset($_SESSION['userID']))
    {
        header('location: index.php');
        exit();
    }
    else
    {
        $id = $_SESSION['userID'];
    }
?>

<?php
    $states = '';
    if (isset($_POST['submit']))
    {
        if (isset($_POST['username']))
        {
            $username = TrimSlashData($_POST['username']);

            $query = "UPDATE user SET username = '{$username}' WHERE ID = {$id}";

            $result = mysqli_query($conn, $query);

            if ($result)
            {
                $alertBox = new AlertBox(AlertBox::$success, "Username Has Been Updated");
                $states .= $alertBox->GetAlertBoxHTML();
            }
            else
            {
                $alertBox = new AlertBox(AlertBox::$error, "Error Happened");
                $states .= $alertBox->GetAlertBoxHTML();
            }
        }
        if (isset($_POST['password']))
        {
            $password = TrimSlashData($_POST['password']);
            $conPassword = TrimSlashData($_POST['con-password']);

            if ($password != $conPassword)
            {
                $alertBox = new AlertBox(AlertBox::$error, "Make Sure That Confirm Password Same As Password Fields!");
                $states .= $alertBox->GetAlertBoxHTML();
            }
            else
            {
                $query = "UPDATE user SET password = '{$password}' WHERE ID = {$id}";

                $result = mysqli_query($conn, $query);

                if ($result)
                {
                    $alertBox = new AlertBox(AlertBox::$success, "Password Has Been Updated");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
                else
                {
                    $alertBox = new AlertBox(AlertBox::$error, "Error Happened");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
            }
            
        }
        if (isset($_POST['email']))
        {
            $email = htmlspecialchars($_POST['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $alertBox = new AlertBox(AlertBox::$error, "Enter A Valid Email Please");
                $states .= $alertBox->GetAlertBoxHTML();
            }
            else
            {
                $query = "UPDATE user SET email = '{$email}' WHERE ID = {$id}";

                $result = mysqli_query($conn, $query);

                if ($result)
                {
                    $alertBox = new AlertBox(AlertBox::$success, "email Has Been Updated");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
                else
                {
                    $alertBox = new AlertBox(AlertBox::$error, "Error Happened");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
            }
            
        }
        if (isset($_FILES['file']))
        {
            $image = SetImageInServer($_FILES['file']);

            if ($image == null)
            {
                $alertBox = new AlertBox(AlertBox::$warning, "Enter A Valid Image");
                $states .= $alertBox->GetAlertBoxHTML();
            }
            else
            {
                $query = "UPDATE user SET image = '{$image}' WHERE ID = {$id}";

                $result = mysqli_query($conn, $query);

                if ($result)
                {
                    $alertBox = new AlertBox(AlertBox::$success, "Image Has Been Updated");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
                else
                {
                    $alertBox = new AlertBox(AlertBox::$error, "Error Happened");
                    $states .= $alertBox->GetAlertBoxHTML();
                }
            }
            
        }
    }
?>

<?php include_once('extras/userheader2.php') ?>

<?php
    echo AlertBox::SetStackAlertBox($states);
?>

    <section class="update-page py-5">
        <div class="container">
            <h1 class="text-center">PROFILE PAGE</h1>
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username"
                        required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Username</button>
            </form>
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"
                        required>
                </div>
                <div class="form-group">
                    <label for="con-password">Confirm Password</label>
                    <input type="password" class="form-control" name="con-password" id="con-password" placeholder="Enter password"
                        required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Password</button>
            </form>
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Email</button>
            </form>
            <form action="profile.php" method="POST" enctype="multipart/form-data">
                <div class="form-group py-2">
                    <label for="file">Profile Picture</label>
                    <input type="file" class="form-control-file border rounded p-2" name="file" id="file">
                </div>
                <div class="form-group d-flex flex-column py-2">
                    <label>Image Preview</label>
                    <img src="imgs/uploads/Placeholder.jpg" height="300px" width="300px" class="m-auto" style="object-fit: cover; border-radius: 50%;" id="preview">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Profile Picture</button>
            </form>
        </div>
    </section>

    <script>
        let form = document.querySelector('.update-page');
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

<?php include_once('extras/userfooter.php') ?>
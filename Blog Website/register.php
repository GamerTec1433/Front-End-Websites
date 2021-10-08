<?php include_once('extras/userheader2.php') ?>

<?php
    include_once('services/userschecker.php');

    if (isset($_SESSION['userID']))
    {
        if ($_SESSION['user-type'] == 'admin')
        {
            header('location: admin/dashboard.php');
            exit();
        }
        else
        {
            header('location: index.php');
            exit();
        }
    }

    $states = '';
    if (isset($_POST['submit']))
    {
        $username = TrimSlashData($_POST['username']);
        $password = TrimSlashData($_POST['password']);
        $conPassword = TrimSlashData($_POST['password-confirm']);
        $email = TrimSlashData($_POST['email']);
        $errorState = '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errorState .= 'Please Enter A Valid Email.\n';
        }

        if ($conPassword != $password)
        {
            $errorState .= 'Please Make Sure From The Confirm Password Same As Password.\n';
        }
        if (!empty($_FILES['file']['name']))
        {
            $image = SetImageInServer($_FILES['file']);
        }
        else
        {
            $image = "Placeholder.jpg";
        }

        if (empty($errorState))
        {
            $query = "INSERT INTO user(username, password, email, image) VALUES ('{$username}', '{$password}', '{$email}', '{$image}')";

            $results = mysqli_query($conn, $query);
   
            if ($results)
            {
                AlertBox::SetSessionAlertBox(AlertBox::$success, 'Account Has Been Registered');
                header('location: login.php');
            }
            else
            {
                $alertBox = new AlertBox(AlertBox::$error, "Error Happen, Please Try Again");
                $states .= $alertBox->GetAlertBoxHTML();
            }
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, $errorState);
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }
         
?>

<?php
    echo AlertBox::SetStackAlertBox($states);
?>

<section class="login register py-5">
    <div class="container">
        <form action="register.php" method="POST"
            class="d-flex flex-column justify-content-center align-content-center" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" name="password-confirm" id="password"
                    placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group py-2">
                <label for="file">Profile Picture</label>
                <input type="file" class="form-control-file border rounded p-2" name="file" id="file">
            </div>
            <div class="form-group d-flex flex-column py-2">
                <label>Image Preview</label>
                <img src="imgs/uploads/Placeholder.jpg" height="300px" width="300px" class="m-auto" style="object-fit: cover; border-radius: 50%;" id="preview">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            <a href="login.php" class="mt-2">Have An Account?</a>
        </form>
    </div>
</section>

<script>
    let form = document.querySelector('.register');
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
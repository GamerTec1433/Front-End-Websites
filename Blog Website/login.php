<?php include_once('extras/userheader2.php') ?>

<?php
    include_once('services/userschecker.php');
    include_once('services/utilities.php');

    if (isset($_SESSION['userID']))
    {
        if ($_SESSION['user-type'] == 'admin')
        {
            HeaderLocation('admin/dashboard.php');
            exit();
        }
        else
        {
            HeaderLocation('index.php');
            exit();
        }
    }

    $states = '';
    if (isset($_POST['submit']))
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $admin = IsAdmin($conn, $email, $password);

        if ($admin)
        {
            $_SESSION['userID'] = $admin;
            $_SESSION['user-type'] = 'admin';
            AlertBox::SetSessionAlertBox(AlertBox::$info, "Welcome Admin, You Have Logged In");
            HeaderLocation('admin/dashboard.php');
            exit();
        }
        else
        {
            $user = IsUser($conn, $email, $password);
            if ($user == -1)
            {
                $alertBox = new AlertBox(AlertBox::$error, 'Please Enter A Valid Email!');
                $states .= $alertBox->GetAlertBoxHTML();
            }
            else if ($user)
            {
                if (session_status() == PHP_SESSION_NONE)
                    session_start();

                $_SESSION['userID'] = $user;
                $_SESSION['user-type'] = 'user';
                AlertBox::SetSessionAlertBox(AlertBox::$info, "Welcome User, You Have Logged In");
                HeaderLocation('index.php');
                exit();
            }
            else
            {
                $alertBox = new AlertBox(AlertBox::$error, 'Email or password are inncorrect!');
                $states .= $alertBox->GetAlertBoxHTML();
            }
        }
    }
?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML() . $states);
    AlertBox::DestroySessionAlertBox();
?>

<section class="login">
        <div class="container">
            <form action="login.php" method="POST" class="d-flex flex-column justify-content-center align-content-center">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                      class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Enter password" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Login</button>
                  <a href="#" class="mt-2">Forgot Password?</a>
                  <a href="register.php" class="mt-2">Don't Have An Account?</a>
            </form>
        </div>
    </section>

<?php include_once('extras/userfooter.php') ?>
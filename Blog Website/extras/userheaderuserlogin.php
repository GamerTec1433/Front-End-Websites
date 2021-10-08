<?php
    if (isset($_SESSION['userID']))
    {
        $id = $_SESSION['userID'];

        $query = "SELECT * FROM user WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $data = mysqli_fetch_assoc($result);
            $img = GetImageFromServer($data['image']);
        }
        else
        {
            echo mysqli_error($conn);
        }
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

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="stylesheet" href="css/mainstyle.css?">
    <link rel="stylesheet" href="css/home.css?ver=1">
    <link rel="stylesheet" href="css/footer.css?ver=1">
    <link rel="stylesheet" href="css/contact.css?ver=1">
    <link rel="stylesheet" href="css/articles.css?">
    <link rel="stylesheet" href="css/contact.css?">
    <link rel="stylesheet" href="css/about.css?">
    <link rel="stylesheet" href="css/errors.css">

</head>

<body>
    <nav class="navbar signin navbar-expand-lg px-lg-5 py-lg-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Logo.</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-center align-content-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
                <ul class="navbar-nav mt-2 mt-lg-0 align-items-center content">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favourites.php">Favourite Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item profile pl-lg-4">
                        <a href="profile.php"><img src="<?php echo $img ?>"></a>
                        <a class="btn" href="logout.php">Logout</a>
                    </li>
            </div>
        </div>
    </nav>
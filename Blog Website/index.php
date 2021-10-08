<?php
    include_once('extras/userheader.php');
?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML());
    AlertBox::DestroySessionAlertBox();
?>

    <section class="intro-page">
        <div class="container d-flex flex-column justify-content-center align-content-center h-100">
            <p class="">Hello! Welcome to</p>
            <h1>Articles blog</h1>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
                blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
                ocean.</p>
        </div>
    </section>

    <section class="intro-content p-5">
        <div class="container">
            <?php
                $query = 'SELECT * FROM article ORDER BY date LIMIT 3';

                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0)
                {
                    while ($data = mysqli_fetch_assoc($result))
                    {
                        $id = $data['ID'];
                        $img = GetImageFromServer($data['image']);
                        $str = str_split(FormatData($data['content']), 70)[0];
            ?>
            <div class="row item p-3">
                <div class="col-md-8 p-1">
                    <img src="<?php echo $img ?>">
                </div>
                <div class="col-md-4 p-1 pl-md-5 d-flex flex-column justify-content-between">
                    <div>
                        <p class="default"><?php echo $data['header'] ?></p>
                        <a href="articlepage.php?id=<?php echo $id; ?>" class="main-header"><?php echo $str ?>...</a>
                    </div>
                    <p class="default"><?php echo $data['date'] ?></p>
                </div>
            </div>
            <?php 
                    }
                }
            ?>
            

            <a class="btn p-3" href="articles.php" role="button">Show More Articles</a>
        </div>
    </section>

    <?php include_once('extras/userfooter.php') ?>
<?php
    include_once('services/dbcon.php');
    include_once('extras/userheader.php');

    if (!isset($_GET['page']))
    {
        $_GET['page'] = 1;
    }
    
    $page = $_GET['page'] - 1;
?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML());
    AlertBox::DestroySessionAlertBox();
?>

    <section class="intro-page">
        <div class="container d-flex flex-column justify-content-center align-content-center h-100">
            <h1>Articles</h1>
            <p>HOME > ARTICLES</p>
        </div>
    </section>

    <section class="article p-5">
        <div class="container">
            <div class="row">
                <?php
                    $start = 0 + $page * 6;

                    $query = "SELECT * FROM article ORDER BY date LIMIT {$start}, 6";

                    $result = mysqli_query($conn, $query);
                    

                    if(mysqli_num_rows($result) > 0)
                    {
                        while ($data = mysqli_fetch_assoc($result))
                        {
                            $id = $data['ID'];
                            $img = GetImageFromServer($data['image']);
                            $hdr = str_split(FormatData($data['header']), 40)[0] . "...";
                            $content = str_split(FormatData($data['content']), 244)[0] . "...";
                ?>
                <div class="item col-lg-4 col-md-6 col-sm-12 p-2">
                    <div class="p-1">
                        <img src="<?php echo $img ?>">
                    </div>
                    <div class="p-1">
                        <p class="default m-0"><?php echo $data['date'] ?></p>
                        <a href="articlepage.php?id=<?php echo $id; ?>" class="main-header"><?php echo $hdr ?></a>
                        <p><?php echo $content; ?>
                        </p>
                        <a class="btn px-3" href="articlepage.php?id=<?php echo $id; ?>" role="button">Read More</a>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                
                
            </div>

            
            <ul class="pages-number mt-3 d-flex justify-content-center text-center">
            <?php
                $countPages = ceil(GetCount($conn, 'article') / 6);

                for ($i = 1; $i <= $countPages; $i++)
                {
            ?>
                <li class="mx-1 <?php if ($page + 1 == $i) echo 'active'; ?>"><a href="articles.php?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
            <?php
                }
            ?>
            </ul>
        </div>
    </section>

    <script>
        var obj = document.querySelector('.article');
        
        obj.scrollIntoView({behavior: 'smooth'})
    </script>
    
    <?php include_once('extras/userfooter.php') ?>
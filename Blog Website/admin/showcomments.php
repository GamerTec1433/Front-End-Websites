<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    if (isset($_GET['id']))
    {
        $user_id = $_GET['id'];
    }

    $states = '';
    if (isset($_POST['delete']))
    {
        $id = htmlspecialchars($_POST['id']);

            $query = "DELETE FROM comment WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alertBox = new AlertBox(AlertBox::$success, "ID:{$id} Comment Has Been Deleted");
            $states .= $alertBox->GetAlertBoxHTML();
            echo ShowAlertBox("ID:{$id} Article Has Been Deleted");
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, "Error Has Happened!");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }

    if (isset($user_id))
        $query = "SELECT * FROM comment WHERE user_ID = {$user_id}";
    else
        $query = "SELECT * FROM comment";

    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
?>

<?php include_once('adminheader.php') ?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML());
    AlertBox::DestroySessionAlertBox();
?>

<h6 class="container py-5">DASHBOARD > COMMENTS</h6>
<div class="content container p-5">
    <a href="showcomments.php" class="btn mb-3">Show All Comments</a>
    <table class="table table-hover table-responsive-md text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>USER_ID</th>
                <th>COMMENT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                            if ($result)
                            {
                                while ($data = mysqli_fetch_array($result))
                                {
                                    echo 
                                    "<tr>
                                        <td scope='row'>{$data['ID']}</td>
                                        <td>{$data['user_ID']}</td>
                                        <td>{$data['content']}</td>
                                        <td>
                                            <form action='showarticles.php' method='POST' class='d-flex justify-content-center align-items-center'>
                                                <a href='editarticle.php?id={$data['article_ID']}' class='btn w-50 mx-1'>OPEN ARTICLE</a>
                                                <input type='submit' name='delete' class='btn w-50 mx-1' value='DELETE'>
                                                <input type='hidden' name='id' value='{$data['article_ID']}'>
                                            </form>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                        ?>

        </tbody>
    </table>
</div>

<?php include_once('adminfooter.php') ?>
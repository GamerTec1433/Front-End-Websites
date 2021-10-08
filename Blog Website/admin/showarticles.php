<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    $states = '';
    if (isset($_POST['delete']))
    {
        $id = htmlspecialchars($_POST['id']);

        $query = "DELETE FROM article WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alertBox = new AlertBox(AlertBox::$success, "ID:{$id} Article Has Been Deleted");
            $states .= $alertBox->GetAlertBoxHTML();
        }
        else
        {
            $alertBox = new AlertBox(AlertBox::$error, "Error Has Happened!");
            $states .= $alertBox->GetAlertBoxHTML();
        }
    }

    $query = "SELECT * FROM article";

    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
?>

<?php include_once('adminheader.php') ?>

<?php
    echo AlertBox::SetStackAlertBox($states);
?>

<?php
    echo AlertBox::SetStackAlertBox(AlertBox::GetSessionAlertBoxHTML());
    AlertBox::DestroySessionAlertBox();
?>
            
            <h6 class="container py-5">DASHBOARD > ARTICLES</h6>
            <div class="content container p-5">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>HEADER</th>
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
                                        <td>{$data['header']}</td>
                                        <td>
                                            <form action='showarticles.php' method='POST' class='d-flex justify-content-center align-items-center'>
                                                <a href='editarticle.php?id={$data['ID']}' class='btn w-50 mx-1'>EDIT</a>
                                                <input type='submit' name='delete' class='btn w-50 mx-1' value='DELETE'>
                                                <input type='hidden' name='id' value='{$data['ID']}'>
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
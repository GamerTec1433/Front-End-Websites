<?php
    include_once('../services/dbcon.php');
    include_once('../services/utilities.php');
    include_once('../services/alertbox.php');

    $states = '';
    if (isset($_POST['delete']))
    {
        $id = htmlspecialchars($_POST['id']);

        $query = "DELETE FROM user WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);

        if ($result)
        {
            $alert = new AlertBox(AlertBox::$success, "ID:{$id} User Has Been Deleted");
            $states .= $alert->GetAlertBoxHTML();
        }
        else
        {
            $alert = new AlertBox(AlertBox::$error, "Error Has Happened!");
            $states .= $alert->GetAlertBoxHTML();
        }
    }

    $query = "SELECT * FROM user";

    $result = mysqli_query($conn, $query);
?>

<?php include_once('adminheader.php') ?>


<?php
    echo AlertBox::SetStackAlertBox($states);
?>
            
            <h6 class="container py-5">DASHBOARD > USERS</h6>
            <div class="content container p-5">
                <table class="table table-responsive-xl table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>EMAIL</th>
                            <th>FAVOURITES</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if (mysqli_num_rows($result) > 0)
                                while($data = mysqli_fetch_assoc($result))
                                {
                                    $countFav = GetCountWhere($conn, 'favourite_article', 'user_ID', $data['ID']);

                        ?>
                        <tr>
                            <td scope="row"><?php echo $data['ID'] ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['password'] ?></td>
                            <td><?php echo $data['email'] ?></td>
                            <td><?php echo $countFav ?></td>
                            <td>
                                <form action="users.php" method="POST">
                                    <a href="showcomments.php?id=<?php echo $data['ID']; ?>" class="btn mx-1">COMMENTS</a>
                                    <input type="submit" class="btn mx-1" name="delete" value="DELETE">
                                    <input type="hidden" name="id" value="<?php echo $data['ID'] ?>">
                                </form>
                            </td>
                        </tr>
                        <?php
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        
<?php include_once('adminfooter.php') ?> 
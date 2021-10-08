<?php
    function IsAdmin($conn, $username, $password) {
        $email = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $query = "SELECT * FROM admin WHERE username = '{$email}' and password = '{$password}'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0)
        {
            $data = mysqli_fetch_assoc($result);
            $id = $data['ID'];

            return $id;
        }

        return null;
    }

    function IsUser($conn, $email, $password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);
    
            $query = "SELECT * FROM user WHERE email = '{$email}' and password = '{$password}'";
    
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0)
            {
                $data = mysqli_fetch_assoc($result);
                $id = $data['ID'];

                return $id;
            }
    
            return null;
        }
        else
        {
            return -1;
        }
    }
?>
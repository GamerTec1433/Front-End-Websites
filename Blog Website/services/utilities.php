<?php
    function GetCount($conn, $table){
        $query = "SELECT * FROM {$table}";

        $result = mysqli_query($conn, $query);
        
        return mysqli_num_rows($result);

        mysqli_close($conn);
    }

    function GetCountWhere($conn, $table, $WHERE, $VALUE){
        $query = "SELECT * FROM {$table} WHERE {$WHERE} = '{$VALUE}'";

        $result = mysqli_query($conn, $query);
        
        return mysqli_num_rows($result);

        mysqli_close($conn);
    }

    function SetImageInServer($file, $root = ''){
        $targetDir = $root."imgs/uploads/";
        $fileName = basename($file['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $fileName;
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if (!empty($file))
        {
            if (in_array($fileType, $allowTypes))
            {
                $imageOldPath = $file['tmp_name'];
                if (move_uploaded_file($imageOldPath, $targetFilePath))
                {
                    return $fileName;
                }

                return null;
            }
            
            return null;
        }
        
        return null;
    }

    function GetImageFromServer($image, $root = ''){
        $targetDir = $root."imgs/uploads/";
        return $targetDir . $image;
    }

    function ShowAlertBox($string){
        echo '<script>alert("'."{$string}".'");</script>';
    }

    function ClearData($str) {
        $str = str_replace('"', '\"', $str); 
        $str = str_replace("'", "\'", $str);
        $str = htmlspecialchars($str);
        return $str;
    }

    function FormatData($str){
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    function TrimSlashData($str){
        $str = stripslashes($str);
        $str = trim($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    function IsArticle($conn, $id){
        $id = htmlspecialchars($id);

        $query = "SELECT * FROM article WHERE ID = {$id}";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0)
        {
            return true;
        }

        return false;
    }

    function HeaderLocation($url) {
        echo "<script>window.location.href='{$url}'</script>";
    }
?>
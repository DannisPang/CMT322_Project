<?php
    include_once "dbh.inc.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Test dbh.inc.php</title>
    </head>
    <body>

    <?php
        $sql = "SELECT * from user;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo $row['UserName'] . "<br>";
            }
        }
    
    ?>


    </body>

</html>
<?php
include_once "dbh2.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodMarket - Edit Restaurant Description</title>
</head>
<body>
    
    <?php
        $ResID = $_POST['ResID'];
        $query = "SELECT * from restaurant WHERE RestaurantID='" . $ResID . "'";
        $result = mysqli_query($conn, $query);
        $conn->close();
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo "<p>Edit the description of the Restaurant?</p>";
                echo "<form action='editResDesc-manager.php' method='post' enctype='multipart/form-data'>";
                echo "<label for='RestaurantName'>Restaurant Name:</label><input type='text' name='RestaurantName' value='".$row['RestaurantName']."'><br>";
                echo "<label for='RestaurantDesc'>Restaurant Description:</label><input type='text' name='ResDescription' value='".$row['Description']."'><br>";
                echo "<input type='hidden' name='ResID' value='".$row['RestaurantID']."'><input type='submit' name='action' value='Yes'><input type='submit' name='action' value='No'></form>";
            }
        }else{
            echo "No Product with the ID: " . $ResID;
        }    
    ?>


</body>
</html>
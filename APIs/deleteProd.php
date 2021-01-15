<?php
include_once "dbh2.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodMarket - Delete Product</title>
</head>
<body>
    
    <?php
        $prodID = $_POST['ProdId'];
        $query = "SELECT * from product WHERE ProductID=" . $prodID;
        $result = mysqli_query($conn, $query);
        $conn->close();
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo "<p>Are you sure you want to delete the following Product?</p>";
                echo "Product Name: " . $row['ProductName'] . "<br>";
                echo "Product Price: " . $row['ProductPrice'] . "<br>";
                echo "<form action='deleteProd-manager.php' method='post'> <input type='hidden' name='ProdId' value='".$row['ProductID']."'><input type='hidden' name='ImgPath' value='".$row['ProductPic']."'><input type='submit' name='action' value='Yes'><input type='submit' name='action' value='No'></form>";
            }
        }else{
            echo "No Product with the ID: " . $prodID;
        }    
    ?>


</body>
</html>
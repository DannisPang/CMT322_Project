<?php
include_once "dbh2.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodMarket - Update Existing Product</title>
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
                echo "<p>Update the details of the following Product?</p>";
                echo "<form action='updateProd-manager.php' method='post' enctype='multipart/form-data'>";
                echo "<label for='ProductName'>Product Name:</label><input type='text' name='ProductName' value='".$row['ProductName']."'><br>";
                echo "<label for='ProductName'>Product Price:</label><input type='text' name='ProductPrice' value='".$row['ProductPrice']."'><br>";
                echo "<input type='hidden' name='ProdId' value='".$row['ProductID']."'><input type='hidden' name='ImgPath' value='".$row['ProductPic']."'><input type='submit' name='action' value='Yes'><input type='submit' name='action' value='No'></form>";
            }
        }else{
            echo "No Product with the ID: " . $prodID;
        }    
    ?>


</body>
</html>
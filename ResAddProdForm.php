<?php
    include_once "dbh.inc.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FoodMarket - Add New Product</title>
</head>
<body>
    <?php    
        if(isset($_SESSION["upload_success"]) && $_SESSION["upload_success"]){
            echo "File uploaded successfully";
        }
    ?>

    <form action="upload-newProd-manager.php" method="post" enctype="multipart/form-data">
        <h2>New Product Info</h2>
        <label for="ProductName">Product Name:</label>
        <input tyoe="text" name="ProductName" id="ProdName"><br>
        <label for="ProductPrice">Product Price:</label>
        <input tyoe="text" name="ProductPrice" id="ProdPrice"><br>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5MB.</p>
    </form>
</body>
</html>

<?php

include_once "dbh.inc.php";

if($_POST['action']== 'Remove User'){
    
    $stmt = $conn->prepare("DELETE from user WHERE UserID=?");
    $stmt->bind_param("s", $UsrID);
   
    $UsrID = $_POST['UsrID'];

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/AdminMainPage.php");
    exit();


}else if($_POST['action']== 'Remove Restaurant'){
    
    $stmt = $conn->prepare("DELETE from restaurant WHERE RestaurantID=?");
    $stmt->bind_param("s", $ResID);
    
    $ResID = $_POST['ResID'];
    
    $stmt->execute();
    

    $stmt = $conn->prepare("DELETE from user WHERE UserID=?");
    $stmt->bind_param("s", $UsrID);
    $UsrID = $_POST['UsrID'];
    
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/AdminMainPage.php");
    exit();


}else if($_POST['action']== 'Remove Rider'){
    
    $stmt = $conn->prepare("DELETE from user WHERE UserID=?");
    $stmt->bind_param("s", $UsrID);
    
    $UsrID = $_POST['UsrID'];
    
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/AdminMainPage.php");
    exit();


}else {
    echo "An Error has occured.";
}

?>
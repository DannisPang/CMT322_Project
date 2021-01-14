<?php

include_once "dbh.inc.php";

if($_POST['action'] == 'Yes'){
    
    $stmt = $conn->prepare("UPDATE restaurant SET RestaurantName=?, ResDescription=? WHERE RestaurantID=?");
    $stmt->bind_param("sss", $ResName, $ResDesc, $ResID);
    
    $ResID = $_POST['ResID'];
    $ResDesc = $_POST['ResDescription'];
    $ResName = $_POST['RestaurantName'];
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    header("Location: http://localhost:10080/322/ResMainPage.php");
    exit();

}else if ($_POST['action'] == 'No'){
    
    header("Location: http://localhost:10080/322/ResMainPage.php");
    exit();
    

}else{
    echo "Invalid Option";
}

?>
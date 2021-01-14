<?php

include_once "dbh.inc.php";

if($_POST['action']== 'Accept'){
    $stmt = $conn->prepare("UPDATE orderitem SET Status=? WHERE OrderID=?");
    $stmt->bind_param("ss", $status, $OrderID);
    // status 0 1 2 3 4
    // status 0 is pending
    //        1 is accepted
    //        2 is declined
    //        3 is pickedUp/delivering
    //        4 is completed
    $status = '1';
    $OrderID = $_POST['OrdID'];

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/ResOrderPage.php");
    exit();


}else if ($_POST['action'] == 'Decline'){

    $stmt = $conn->prepare("UPDATE orderitem SET Status=? WHERE OrderID=?");
    $stmt->bind_param("ss", $status, $OrderID);

    $status = '2';
    $OrderID = $_POST['OrdID'];

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/ResOrderPage.php");
    exit();


}else if ($_POST['action'] == 'Picked Up'){

    $stmt = $conn->prepare("UPDATE orderitem SET Status=? WHERE OrderID=?");
    $stmt->bind_param("ss", $status, $OrderID);

    $status = '3';
    $OrderID = $_POST['OrdID'];

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: http://localhost:10080/322/ResOrderPage.php");
    exit();


}else{
    echo "An Error has occured.";
}

?>
<?php

include_once "dbh2.inc.php";

$query = "SELECT * from restaurant";
$result = mysqli_query($conn, $query);

$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo $row['RestaurantName'] . "<br>";    }
}else{
    echo "Empty return.";
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>table testing</title>
</head>
<body>
    <table>
        <tr>
            <th>UserName</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "322", 3322);
        if ($conn-> connect_error){
            die("Connection failed:". $conn-> connect_error);
        }

        $sql = "SELECT * from user";
        $result = $conn-> query($sql);

        if ($result-> num_rows > 0){
            while ($row = $result-> fetch_assoc()) {
                echo "<tr><td>" . $row["UserName"] ."</td><td>". $row["Email"] ."</td><td>". $row["UserType"] ."</td>";
            }
            echo "</table>";
        }
        else {
            echo "0 result";
        }

        $conn-> close();
        ?>
</table>
</body>
</html>
<?php
    require "./db.php";

    $sql = "SELECT hours FROM `employee_tbl` WHERE employee_id = ". $_POST["id"];        

    $query = $conn->query($sql);


    while($row = mysqli_fetch_array($query)) {
        echo $row["hours"];
    }           
?>  
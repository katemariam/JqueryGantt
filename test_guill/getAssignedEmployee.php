<?php
    require "./db.php";

    $chart_id = $_POST["id"];

    $sql = "SELECT emp_id FROM `emp_task` WHERE chart_id = $chart_id";        

    $query = $conn->query($sql);
    $records = array();

    while($row = mysqli_fetch_array($query)) {
        array_push($records, $row["emp_id"]);
    } 
    echo json_encode($records, JSON_PRETTY_PRINT);          
?>  
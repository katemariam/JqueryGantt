<?php
    require "db.php";
    
    $id = $_POST["id"];
    $sql = "SELECT * FROM chart_task WHERE id = ". $id;

    $query = $conn->query($sql);
    $records = array();

    while($row = mysqli_fetch_array($query)) {
        array_push($records, $row);
    }

    echo json_encode($records, JSON_PRETTY_PRINT);
?>
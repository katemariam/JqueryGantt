<?php
    require "./db.php";

    $id = $_GET["id"];
    $duration = $_GET["duration"];
    $start_date = $_GET["start_date"];
    $end_date = $_GET["end_date"];
    $sql = "UPDATE `chart_task` SET `start`= '$start_date',`end`= '$end_date' WHERE `id` = '$id' ORDER BY `start`";

    if($query = $conn->query($sql)){
        echo $sql;
    }
    else {

    }

?>
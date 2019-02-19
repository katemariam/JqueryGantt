<?php
require "db.php";

//STORE IN DB

$chart_id = $_POST["chart_id"];
$start = $_POST["start"];
$end = $_POST["end"];

//CHECK IF RECORD in Database

    $sql = "DELETE FROM emp_task WHERE chart_id = $chart_id; UPDATE `jquery_gantt`.`chart_task` SET `end` = '$end', `start` = '$start' WHERE `chart_task`.`id` = $chart_id;"; 

    $query = $conn->multi_query($sql);

    if($query) {
        echo "Success";
    }
    else {
        echo "Failed";
    }

?>
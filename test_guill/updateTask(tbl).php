<?php
    require "db.php";

    //STORE IN DB
    $chart_id = $_POST["id"];

    if(isset($_POST['start'])) {
        $start = $_POST["start"];
        $sql = "UPDATE `jquery_gantt`.`chart_task` SET `start` = '$start' WHERE `chart_task`.`id` = $chart_id;";
        
    }
    else if(isset($_POST['end'])) {
        $end = $_POST["end"];
        $sql = "UPDATE `jquery_gantt`.`chart_task` SET `end` = '$end' WHERE `chart_task`.`id` = $chart_id;";
        
    }    
    else if(isset($_POST['dur'])) {
        $dur = $_POST["dur"];
        $sql = "UPDATE chart_task SET end = DATE_ADD(start, INTERVAL $dur DAY) WHERE id = $chart_id ;";
        
    }

    $query = $conn->query($sql);

    if($query) {
        echo "Success";
    }
    else {
        echo "Failed";
    }

?>
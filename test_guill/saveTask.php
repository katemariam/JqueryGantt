<?php
require "db.php";

//STORE IN DB

$emp_id = $_POST["emp_id"];
$chart_id = $_POST["chart_id"];
$emp_hours = $_POST["emp_hours"];

//CHECK IF RECORD in Database
    $sql = "SELECT * FROM emp_task WHERE emp_id = $emp_id AND chart_id = $chart_id";
    $query = $conn->query($sql);

    if(!mysqli_num_rows($query) > 0) {
        $sql = "INSERT INTO `jquery_gantt`.`emp_task` (`id`, `chart_id`, `emp_id`, `emp_hours`) VALUES (NULL, '$chart_id', '$emp_id', '$emp_hours');"; 

        $query = $conn->query($sql);

        if($query) {
            echo "Success";
        }
        else {
            //
        }
    }
    else {
        echo "Existing";
    }

?>
<?php
require "db.php";

$array = [];


$query = "SELECT chart_task.id as id, project_id, name, start, end, progress FROM emp_task INNER JOIN chart_task ON emp_task.chart_id = chart_task.id WHERE emp_id = '".$_GET['emp_id']."' ORDER BY `start`";
$fetchTasks = mysqli_query($conn, $query);

$tasksCnt = 0;
if($fetchTasks){

	$tasksCnt = mysqli_num_rows($fetchTasks);
		if($tasksCnt != 0) {
			while($row = mysqli_fetch_assoc($fetchTasks)) {
			    array_push($array, $row);
			}
		} else {
			echo "No result found.";
		}
} else {
	echo mysqli_error($conn);
}

echo json_encode($array);

?>
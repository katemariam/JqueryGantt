<?php
require "db.php";

$array = [];


$query = "SELECT project_id, name, start, end, progress FROM `chart_task` WHERE project_id = '".$_GET['pr_id']."'";
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
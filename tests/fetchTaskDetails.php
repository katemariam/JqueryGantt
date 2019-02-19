<?php 
    require "./db.php";

$projectName = $_POST['task']['name'];
$projectId = $_POST['task']['project_id'];

$fetchTaskDetails = mysqli_query($conn, "SELECT * FROM chart_task WHERE project_id = $projectId AND `name` = '$projectName' ");

$row = mysqli_fetch_assoc($fetchTaskDetails);

echo json_encode($row);


?>
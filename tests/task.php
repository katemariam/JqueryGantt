<?php
    require "./db.php";
    
    $project_id = $_GET["project_id"];
    $sql = "SELECT * FROM chart_task JOIN project_tbl ON chart_task.project_id = project_tbl.project_id WHERE chart_task.project_id = $project_id";
    
    $all_tasks = $conn->query($sql);
    $output = "";
    $key = array(
        'id', 'name', 'start', 'end', 'progress', 'dependencies'
    );
    $combined_array = array();

    while($row = mysqli_fetch_assoc($all_tasks)){
        
        $duration=date_diff(date_create($row["start"]),date_create($row["end"]))->format('%d');
        
        $output .= "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["name"]."</td>
            <td><input type='text' id='duration".$row["id"]."' class='duration' value='".$duration." days' onchange='updateTask(".$row["id"].",true)'></td>
            <td><input type='date' id='start_date".$row["id"]."' class='date' value='".$row["start"]."' onchange='updateTask(".$row["id"].")'></td>
            <td><input type='date' id='end_date".$row["id"]."' class='date' value='".$row["end"]."' onchange='updateTask(".$row["id"].")'></td>
        </tr>";

        $project_name = $row['project_name'];
        $taskid = $row['id'];
        $taskname = $row['name'];
        $start = $row['start'];
        $end = $row['end'];
        $percentage = $row['progress'];
        $dependencies = null;

        $values = array($taskid, $taskname, $start, $end, $percentage, $dependencies);
        $combined_array[] = array_combine($key, $values);
    }
    echo json_encode(array($output,$combined_array,$project_name));
?>

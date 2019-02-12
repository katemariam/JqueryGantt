<?php
require "db.php";
?>

<!doctype html>
<html lang="en-au">
    <head>
        <title>Gantt Chart</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
        <link rel="stylesheet" href="../css/style.css" />
      <!--   <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/frappe-gantt.css">
		<link rel="stylesheet" href="../bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/jquery.webui-popover.css">
		<link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
		<style type="text/css">
			body {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 13px;
				padding: 0 0 50px 0;
			}
			.contain {
				width: 800px;
				margin: 0 auto;
			}
			h1 {
				margin: 40px 0 20px 0;
			}
			h2 {
				font-size: 1.5em;
				padding-bottom: 3px;
				border-bottom: 1px solid #DDD;
				margin-top: 50px;
				margin-bottom: 25px;
			}
			table th:first-child {
				width: 150px;
			}
		</style>
    </head>
    <body>

    <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-5"><nr>

    			<form >
    				<label style="position:relative; top:10px;"><b> Select Project</b> 
 				 	<select name="project_name" id="project_name" onchange="changeProjectName()">
   				 	<option value=""> - - - Select Project Name - - - </option>

   				 	<?php

						$query = "SELECT project_id, project_name FROM `project_tbl`";
						$fetchProj = mysqli_query($conn, $query);


						$PrjCnt = 0;
						if($fetchProj){

						$ProjCnt = mysqli_num_rows($fetchProj);
						if($ProjCnt != 0) {

						while($row = mysqli_fetch_array($fetchProj)){
						echo "<option value='".$row['project_id']."'>" . $row['project_name']. "</option>";
						}

						} else {
						echo "No result found.";
						}
						} else {
						echo mysqli_error($conn);
						}
						

					?>
	  				</select>
  					</label>
					</form>

					<div style= "position: relative; top:-25px; left:380px;">  			
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
                		<label class="project btn btn-sm btn-info active">
                    		<a href="./test01.php">
                        		<input type="radio" name="options"> Project
                    		</a>
                		</label>
                		<label class="employee btn btn-sm btn-info">
                    		<a href=" ">
                        		<input type="radio" name="options"> Employee
                    		</a>
                		</label>
            			</div>
            		</div>
       			


				<table class="table">
                	<thead>
                    	<tr>
                        	<th scope="col">No.</th>
                        	<th scope="col">Project Breakdown</th>
                        	<th scope="col">Duration</th>
                        	<th scope="col">Date Start</th>
                       	 	<th scope="col">Date End</th>
                    	</tr>
                	</thead>
                		<tbody id="task_list"></tbody>
            </table>
        	</div>
        		<div class="col-md-7">
           	 		<p id="name"></p>
            	<div class="gantt"></div>
        	</div>
    	</div>
	</div>
			
			

    </body>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.fn.gantt.js"></script>
	<script src="../js/moment.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>



    <script>

    function changeProjectName(){
        console.log("IM HERE");
        let project_id = $("#project_name").val();

        $.ajax({
            url: "../tests/task.php",
            method: "GET",
            data: "project_id=" + project_id,
            success:(data)=>{
                var result = $.parseJSON(data);
                let html = "<b>"+result[2]+"- GANTT CHART</b>";
                $("#name").html(html);
                $("#task_list").html(result[0]);

				var project_id = document.getElementById('project_name').value;

				generateGanttChart(project_id);
            }
        });
    }

    function updateTask(id,isChange){
		console.log("UPDATING");
        var duration = $("#duration"+id).val();
        var number = Number(duration);
		console.log(number);

        var start_date = $("#start_date"+id).val();
        var end_date = $("#end_date"+id).val();

        if(isChange){
            Date.prototype.addDays = function(days) {
                var date = new Date(start_date);

                date.setDate(date.getDate() + days);
                return date.toString('yyyy-MM-dd');;
            }

            var date = new Date();
            var new_date = date.addDays(number);

			var end_date = moment(new_date).format('YYYY-MM-DD');
        }

        if (duration == "" || start_date == "" || end_date == ""){
            alert("All fields are required!");
            return;
        }       

        $.ajax({
            url: "../tests/update-task.php",
            method: "GET",
            data: "id="+ id+ "&duration=" + duration + "&start_date=" +start_date + "&end_date=" + end_date,
            success:(data)=>{
               changeProjectName();
            }
        });  
    }



		function generateGanttChart(project_id){
		"use strict";
			var today = moment();

			$.ajax({
				type: "GET",
				url: "fetchTasks.php?pr_id=" + project_id,
				dataType: "json",
				success: (resp) => {

					console.log(resp);
					var sc = [];

					for (let i = 0; i < resp.length; i++) {
						var st = new Date(resp[i].start);
						var ed = new Date(resp[i].end);

						sc.push({
							name: resp[i].name,
							desc: "",
							values: [{
								from: `/Date(${st.getTime()})/`,
								to: `/Date(${ed.getTime()})/`,
								label: "",
								desc: resp[i].name,
								customClass: "LEKi",
								dataObj: {myTitle: 'some title', myContent: 'some content' }
							}]
						});

					}
					console.log(sc);
					$(".gantt").gantt({
						source: sc,
						scale: "days",
						minScale: "weeks",
						maxScale: "weeks",
						navigate: "scroll",
						itemsPerPage: resp.length,/* 
						dataObj: {myTitle: 'some title', myContent: 'some content' }, */
						onRender: function(dataObj) {
							console.log("chart rendered");
						}
					});
				},
				error: (function () {
					console.log('error')
				})

			});
/* $('.gantt').popover({
selector: '.bar',
title: function() {
return $(this).data('dataObj').myTitle;
},
content: function() {
return $(this).data('dataObj').myContent;
}
}); */

}

		
    </script>
</html>
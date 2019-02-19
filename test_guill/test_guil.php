<?php
require "db.php";

$update = $_GET["update"];
?>

<!doctype html>
<html lang="en-au">
    <head>
        <title>Gantt Chart</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.css">
        <link rel="stylesheet" href="../css/style.css" />
      <!--   <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
		<link rel="stylesheet" href="../css/frappe-gantt.css">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
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

    			<form method='get' url='test_guil.php'>
    				<label style="position:relative; top:10px;" onchange="this.form.submit()"><b> Select Project</b> 
 				 	<select name="project_name" id="project_name" onchange="changeProjectName()">
   				 	<option value="0"> - - - Select Project Name - - - </option>

   				 	<?php

						$query = "SELECT project_id, project_name FROM `project_tbl`";
						$fetchProj = mysqli_query($conn, $query);


						$PrjCnt = 0;
						if($fetchProj){

						$ProjCnt = mysqli_num_rows($fetchProj);
						if($ProjCnt != 0) {

						while($row = mysqli_fetch_array($fetchProj)){
							if($_GET["project_name"] == $row["project_id"]) {
								echo "<option value='".$row['project_id']."' selected>" . $row['project_name']. "</option>";
							}
							else {
								echo "<option value='".$row['project_id']."'>" . $row['project_name']. "</option>";
							}
							
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
                    		<a href="./test02.php">
                        		<input type="radio" name="options"> Project
                    		</a>
                		</label>
                		<label class="employee btn btn-sm btn-info">
                    		<a href="#"  onclick="window.location.href = 'test_guill_emp.php';">
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
                		<tbody id="task_list">
							<?php
								$project_id = $_GET["project_name"];
								if(!empty($_GET)) {
									$sql = "SELECT * FROM chart_task JOIN project_tbl ON chart_task.project_id = project_tbl.project_id WHERE chart_task.project_id = $project_id ORDER BY `start`";

									$query = $conn->query($sql);
									$output = "";
									while($row = mysqli_fetch_array($query)) {
										$duration=date_diff(date_create($row["start"]),date_create($row["end"]))->format('%d');
										$output .= "<tr>
											<td>".$row["id"]."</td>
											<td>".$row["name"]."</td>
											<td><div class='row'><div class='col-xs-4'><input type='text' onblur=\"changeDetails(this,'duration')\" size='3' class='date' value='".$duration."' onchange='updateTask(".$row["id"].",true)'></div><div class='col-xs-8'>&nbsp;Days</div></div></td>
											<td><input type='date' onblur=\"changeDetails(this,'start')\" class='date' value='".$row["start"]."' onchange='updateTask(".$row["id"].")'></td>
											<td><input type='date' onblur=\"changeDetails(this,'end')\" class='date' value='".$row["end"]."' onchange='updateTask(".$row["id"].")'></td>
										</tr>";
									}
									echo $output;
								}
							?>
						</tbody>
            </table>
        	</div>
        		<div class="col-md-7" style='height: 100%'>
           	 		<p id="name"></p>
            	<div class="gantt"></div>
        	</div>
    	</div>
	</div>
	</div>

    </body>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/moment.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.js"></script>
	<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
	<script src="../js/jquery.fn.gantt.js"></script>
	<script src="../js/bootstrap-notify.min.js"></script>
	<script>
		//FETCH DATA
        window.onload = function () {
			generateGantt();
		}

		function generateGantt(){ 
			$.ajax({
				type: "GET",
				url: "fetchTasks.php?pr_id= <?php echo $_GET['project_name'] ?>" ,
				dataType: "json",
				success: (resp) => {
					//PUSH RESPONSE INTO JSONS
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
								label: resp[i].name,
								desc: resp[i].name,
								dataObj: resp[i]
							}]
						});
					}
					
					//GENERATE GANTT CHART
					$(".gantt").gantt({
						source: sc,
						scale: "days",
						minScale: "weeks",
						maxScale: "weeks",
						navigate: "scroll",
						itemsPerPage: resp.length,
						onItemClick: function(e,elem) {
							//ON CLICK RETRIEVE ITEM INFO
							$.ajax({
								url: 'fetch_item_info.php',
								dataType: 'json',
								method: 'post',
								data: "id=" + e.id,
								success: function (data) {
									$(".webui-popover")					
									$(".popover-id").val(e.id);
									$(".popover-date").val(data[0].start);
									$(".popover-to").val(data[0].end);
									$(".popover-card-header").html(data[0].name + "<button class='btn btn-danger btn-sm float-right'>delete</button><br><p style='font-size: 12px;'>Workforce Detail</p>");
									

									//CHANGE HRS ON EMPLOYEE ADD
									$(".add_employee").on('change', function(evt, params) {
										$.ajax({
											url: 'fetchEmployeehrs.php',
											data: "id=" + params.selected,
											method: 'post',
											success: function (data) {
												$(".popover-tot-hrs").val(parseInt(data));
											}
										});
									});

									//ADD ASIGNED EMPLOYEE
									var select_elem = document.getElementsByClassName("add_employee")[0];			
									$.ajax({
										url: 'getAssignedEmployee.php',
										data: "id=" + e.id,
										dataType: "json",
										method: 'post',
										success: function (data) {
											//GET OPTIONS
											var select_elem_options = select_elem.getElementsByTagName("option");
											var to_be_added = [];
											for (let i = 0; i < select_elem_options.length; i++) {
												//COMPARE
												if(data.indexOf(select_elem_options[i].value) >= 0) {
													to_be_added.push(select_elem_options[i].value);
												}											
											}
											$('.add_employee').val(to_be_added);
											//UPDATE AFTER ADDING
											$('.add_employee').trigger('chosen:updated');
										}
									});
								}
							});
						},
						onRender: function(dataObj) {
							console.log("chart rendered");
							var select_employees = `<?php $query = "SELECT employee_id, employee_name FROM employee_tbl"; $fetchEmp = mysqli_query($conn, $query); $EmpCnt = 0; if($fetchEmp){ $EmpCnt = mysqli_num_rows($fetchEmp); if($EmpCnt != 0) { while($row = mysqli_fetch_array($fetchEmp)){ echo "<option value='".$row['employee_id']."'>" . $row['employee_name']. "</option>"; } } else { echo "No result found."; } } else { echo mysqli_error($conn); } ?>`;
							$(".bar").webuiPopover({
								url: "",
								placement: 'auto-bottom',
								multi: false,
								dismissible: false,
								template: [
								'<div class="popover" >',	
								'<div class="card" style="width: 300px">',
								'<input type="hidden" class="popover-id" />',
								'<h5 class="card-header popover-card-header" style="background-color:#337ab7 !important;color: white;padding-bottom: 0;"></h5>',
								'<div class="card-body">',
								'<div class="input-group input-group-sm mb-3"><select multiple class="custom-select add_employee" >'+select_employees+'</select></div>',
								'<div class="input-group input-group-sm mb-3"> <div class="input-group-prepend"> <span class="input-group-text" id="inputGroup-sizing-sm">Total Hours per day:</span> </div> <input type="number" class="form-control popover-tot-hrs" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> </div>',
								'<div class="input-group input-group-sm mb-3"> <div class="input-group-prepend"> <span class="input-group-text" id="inputGroup-sizing-sm">Date Start:</span> </div> <input type="date" class="form-control popover-date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> </div>',
								'<div class="input-group input-group-sm mb-3"> <div class="input-group-prepend"> <span class="input-group-text" id="inputGroup-sizing-sm">Date End:</span> </div> <input type="date" class="form-control popover-to" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> </div>',
								'<div class="float-right"><button type="button" class="btn btn-success btn-sm" onclick="saveTask()">Save</button><button type="button" class="btn btn-secondary btn-sm ml-2" onclick="WebuiPopovers.hideAll();">Close</button></div>',
								'</div>',
								'</div>',
								'</div>'].join(''),
								html: true,
								onShow: function (elem) {
									$(".add_employee").chosen({
										width: "100%",
										placeholder_text_multiple: "Add Employees",
									});
								}
							}); 
						}
					});
					
				},
				error: (function () {
					console.log('error')
				})
			});
		}

		function saveTask(id) {
			var popover_id = $(".popover-id").val();
			var emp_ids = $('.webui-popover:visible').find(".add_employee").chosen().val();
			var tot_hrs = $(".popover-tot-hrs").val();
			var st_date =  $(".popover-date").val();
			var en_date = $(".popover-to").val();
			
			//UPDATE DATES
			$.ajax({
				url: "updateTask.php",
				method: "post",
				async: false,
				data: "chart_id=" + popover_id + "&start=" + st_date + "&end=" + en_date,
				success: function (data) {
					//IF NO EMPLOYEES UPDATE ONLY
					if(emp_ids == null){
						WebuiPopovers.hideAll();
						location.reload();
						return;
					}
					else {
						//SAVE TASK
						for (let i = 0; i < emp_ids.length; i++) {
							$.ajax({
								url: "saveTask.php",
								method: "post",
								data: "emp_id=" + emp_ids[i] + "&chart_id=" + popover_id + "&emp_hours=" + tot_hrs,
								success: function (data) {		
								}
							});
						}
					}		
				}
			});
			$(document).one("ajaxStop", function() {
				WebuiPopovers.hideAll();
				location.reload();
			});
		}

		function changeDetails(elem,type) {
			//GET VAL
			var val = elem.value;
			//GET ID
			var id = elem.parentNode.parentNode.childNodes[1].innerHTML;
			if(type == "start"){
				var param = "id=" + id + "&start=" + elem.value;
			}
			else if (type == "end") {
				var param = "id=" + id + "&end=" + elem.value;
			}
			else if (type == "duration") {
				var id = elem.parentNode.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
				var param = "id=" + id + "&dur=" + elem.value;
			}

			$.ajax({
				url: "updateTask(tbl).php",
				method: "post",
				data: param,
				success: function (data) {
					updateMessage();
					location.reload();
				},
			})
		}

		function updateMessage() {
			$.notify({
				// options
				message: 'Update success' 
			},{
				// settings
				type: 'success'
			});
		}
	</script>
</html>
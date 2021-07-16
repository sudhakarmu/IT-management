<?php
	require "bugs.php";
	$bugs = new Bugs;
	$id = $_GET['id'] ?? null;
	// need to handel null
	$bug_details = $bugs->get_bug($id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Bug</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<style type="text/css">
		.heading
		{
			font-size: 30px;
			font-weight: bold;
			text-align: left;
			color: white;
			background: black;
		}

		.box
		{
			border: 1px solid black;
		}
		.align_right
		{
			float: right;
		}
		.error 
		{
			color: red;
		}
	</style>
</head>
<body>
	<div class="col-md-12 ">
		<div class="col-md-12 heading">
			<span class="pull-left" >View Bug</span>
		</div>
		<div class="box">
			<div class="container col-md-12" style="margin-top: 1%;">
				<div class="col-md-12" >
					<table class="table">
						<tr>
							<th>Module_id</th>
							<td><?php echo $bug_details['module_name']; ?></td>
						</tr>
						<tr>
							<th>Description</th>
							<td><?php echo $bug_details['description']; ?></td>
						</tr>
						<tr>
							<th>Priority</th>
							<td><?php echo $bug_details['priority']; ?></td>
						</tr>
						<tr>
							<th>Status</th>
							<td><?php echo $bug_details['status']; ?></td>
						</tr>
						<tr>
							<th>Raised By</th>
							<td><?php echo $bug_details['reporter']; ?></td>
						</tr>
						<tr>
							<th>Assigned To</th>
							<td><?php echo $bug_details['assigned']; ?></td>
						</tr>
						<tr>
							<th>Created On</th>
							<td><?php echo $bug_details['created_on']; ?></td>
						</tr>
						<tr>
							<th colspan="2"  style="text-align: center;">
								<a href="index.php">
									 <button class="btn btn-success">Go Back</button>
								</a>
							</th>
						</tr>
					</table>

				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
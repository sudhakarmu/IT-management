<?php
	
	require "bugs.php";
	$bugs = new Bugs;
	// echo "bug_list<pre>";print_r($bugs->list_all());exit;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
	<div class="col-md-12 ">
		<div class="col-md-12 heading">
			<span class="pull-left" >Bug List</span>
			<span class="align_right">
				<a href="add_bug.php" style="color: white;">
					<i class="fa fa-plus-square" aria-hidden="true"></i>
				</a> 
			</span>
		</div>
		<div class="box">
			<div class="container col-md-12" style="margin-top: 1%;">
				<table id="bug_list" class="table" >
					<thead class="thead-dark">
						<th>Module</th>
						<th>Description</th>
						<th>Priority</th>
						<th>Status</th>
						<th>Raised By</th>
						<th>Assigned To</th>
						<th>Reported On</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							foreach ($bugs->list_all() as $index => $bug) 
							{
								?>
									<tr>
										<td><?php echo $bug['module_name'] ; ?></td>
										<td><?php echo $bug['description'] ; ?></td>
										<td><?php echo $bug['priority'] ; ?></td>
										<td><?php echo $bug['status'] ; ?></td>
										<td><?php echo $bug['reporter'] ; ?></td>
										<td><?php echo $bug['assigned'] ; ?></td>
										<td><?php echo $bug['created_on'] ; ?></td>
										<td>
											<a href="view_bug.php?id=<?php echo $bug['id']; ?>" style="color: black;">
												<i title="View" class="fa fa-eye" aria-hidden="true"></i>
											</a> 
											<a href="edit_bug.php?id=<?php echo $bug['id']; ?>" style="color: black;">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>
											<i onclick="delete_bug('<?php echo $bug['id']; ?>');" title="Delete" class="fa fa-trash" aria-hidden="true"></i>
										</td>
									</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
	$(document).ready(function()
	{
	  $('#bug_list').dataTable({
	              'order' : [],
	              dom: 'Bfrtip',
	              buttons: [
	                          'excel', 'pdf', 'print'
	                        ]
	            });
	});

	function delete_bug(bug_id)
	{
		$.ajax(
		{
			url: "delete_bug.php",
			type: 'post',
			data:{'bug_id':bug_id},
			beforeSend:function()
			{
			},
			success: function(response)
			{
			  if(response)
			  {
			  	alert("Bug deleted successfully.");
			  	location.reload();
			  }
			  else
			  {
			  	alert("Bug could not be deleted. Something went wrong.");
			  	location.reload();
			  }
			}
		});
	}
</script>
</html>
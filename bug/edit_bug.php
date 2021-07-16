<?php
	require "bugs.php";
	$bugs = new Bugs;
	$modules = $bugs->get_all_modules();
	$user_list = $bugs->get_all_users();
	$id = $_GET['id'] ?? null;
	// need to handel null
	$bug_details = $bugs->get_bug($id);
	$priority_list = array(
						'1' => 'Low',
						'2' => 'Medium',
						'3' => 'High'
					);

	$status_list = array(
						'Active' => 'Active',
						'Inactive' => 'Inactive'
					);
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
			<span class="pull-left" >Edit Bug</span>
			<span class="align_right">
				<a href="index.php" style="color: white;">
					<i title="Go Back" class="fa fa-arrow-left" aria-hidden="true"></i>
				</a> 
			</span>
		</div>
		<div class="box">
			<div class="container col-md-12" style="margin-top: 1%;">
				<div class="col-md-8" style="margin-left: 15%;">
					<form id="edit_bug_form" method="post" action="edit.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="form-group">
					      <label for="module">Module</label>
					      <select id="module" name="module" class="form-control">
					      	<option value="" selected="selected">Select a module</option>
					        <?php
					        	foreach ($modules as $index => $module) 
					        	{
					        		$selected = "";
					        		if($module['id'] == $bug_details['module_id'])
					        		{
					        			$selected = 'selected = "selected"';
					        		}
					        		echo "<option $selected value='".$module['id']."' >".$module['name']."</option>";
					        	}
					        ?>
					      </select>
					    </div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea type="textarea" class="form-control" id="description" name="description" placeholder="Enter description..."> <?php echo $bug_details['description']; ?></textarea>
						</div>

					    <div class="form-group">
					      <label for="priority">Priority</label>
					      <select id="priority" name="priority" class="form-control">
					        <?php
					        	foreach ($priority_list as $index => $priority) 
					        	{
					        		$selected = "";
					        		if($priority == $bug_details['priority'])
					        		{
					        			$selected = 'selected = "selected"';
					        		}
					        		echo "<option $selected value='".$index."' >".$priority."</option>";
					        	}
					        ?>
					      </select>
					    </div>

					    <div class="form-group">
					      <label for="raised_by">Raised By</label>
					      <select id="raised_by" name="raised_by" class="form-control">
					      	<option value="" selected="selected">Select a user</option>
					        <?php
					        	foreach ($user_list as $index => $user) 
					        	{
					        		$selected = "";
					        		if($user['id'] == $bug_details['raised_by'])
					        		{
					        			$selected = 'selected = "selected"';
					        		}
					        		echo "<option $selected value='".$user['id']."' >".$user['name']."</option>";
					        	}
					        ?>
					      </select>
					    </div>

					    <div class="form-group">
					      <label for="assigned_to">Assigned To</label>
					      <select id="assigned_to" name="assigned_to" class="form-control">
					        <option value="" selected="selected">Select a user</option>
					        <?php
					        	foreach ($user_list as $index => $user) 
					        	{
					        		$selected = "";
					        		if($user['id'] == $bug_details['assigned_to'])
					        		{
					        			$selected = 'selected = "selected"';
					        		}
					        		echo "<option $selected value='".$user['id']."' >".$user['name']."</option>";
					        	}
					        ?>
					      </select>
					    </div>

					    <div class="form-group">
					      <label for="status">Status</label>
					      <select id="status" name="status" class="form-control">
					        <?php
					        	foreach ($status_list as $index => $status) 
					        	{
					        		$selected = "";
					        		if($status == $bug_details['status'])
					        		{
					        			$selected = 'selected = "selected"';
					        		}
					        		echo "<option $selected value='".$index."' >".$status."</option>";
					        	}
					        ?>
					      </select>
					    </div>

					    <div class="form-group" style="display: none;">
							<label for="screenshot">Upload Screenshot(Optional)</label>
							<input type="file" class="form-control-file" id="screenshot" name="screenshot">
						</div>

					    <div class="form-group" style="text-align: center; ">
					      <button class="btn btn-success">Submit</button>
					      <button type="reset" class="btn btn-dark">Reset</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit_bug_form").validate(
	{
	    ignore: "",
	    onkeyup:false,
		rules: 
		{ 
			module: 
			{
				required:true
			},

			description: 
			{
				required:true,
				minlength:2,
				maxlength:500,
			},

			priority: 
			{
				required:true,
			},

			raised_by: 
			{
				required:true,
			},

			assigned_to: 
			{
				required:true,
			},

			status: 
			{
				required:true,
			},

			screenshot: 
			{
				required:false,
			}
		},

		messages: 
		{
			module: 
			{
				required: "Please select a module."
			},

			description: 
			{
				required: "Please Enter description.",
				minlength: "Name must not be less than 2 characters.",
				maxlength: "Name must not be more than 500 characters."
			},

			priority: 
			{
				required: "Please select priority."
			},

			raised_by: 
			{
				required: "Please select a user."
			},

			assigned_to: 
			{
				required: "Please select a user."
			},

			status: 
			{
				required: "Please select status."
			},
		},

		onfocusout: function(element) 
		{
			$(element).valid();
		},

		submitHandler: function(form) 
		{
			form.submit();
			$('button[type="submit"]').attr('disabled','disabled');
		}
		});


</script>

</html>
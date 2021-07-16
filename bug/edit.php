<?php
	
	// echo "post data: <pre>";print_r($_POST);//exit;
	// echo "post data: <pre>";print_r($_FILES);exit;
	
	$id = $_POST['id'] ?? null;
	$module = $_POST['module'] ?? null;
	$description = $_POST['description'] ?? null;
	$priority = $_POST['priority'] ?? null;
	$raised_by = $_POST['raised_by'] ?? null;
	$assigned_to = $_POST['assigned_to'] ?? null;
	$status = $_POST['status'] ?? null;

	if( $module == null || $description == null || $priority == null || $raised_by == null || $assigned_to == null || $status == null )
	{
		$_SESSION['error']['status'] = 1;
		$_SESSION['error']['msg'] = "Mandatory parameters not recieved.";
		header('Location: add_bug.php');
		exit;
	}
	
	require "bugs.php";
	$bugs = new Bugs;
	$result = $bugs->edit_bug($module, $description, $priority, $raised_by, $assigned_to, $status, $id);
	if($result)
	{
		$_SESSION['error']['status'] = 0;
		$_SESSION['error']['msg'] = "Bug updated successfully.";
		header('Location: index.php');
		exit;
	}
	else
	{
		$_SESSION['error']['status'] = 1;
		$_SESSION['error']['msg'] = "Something went wrong, unable to update.";
		header("Location: edit_bug.php?id=$id");
		exit;
	}



?>
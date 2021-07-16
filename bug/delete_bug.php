<?php
	$bug_id = $_POST['bug_id'] ?? null;
	if($bug_id == null)
	{
		$_SESSION['error']['status'] = 1;
		$_SESSION['error']['msg'] = "Mandatory parameters not recieved.";
		header('Location: index.php');
		exit;
	}

	require "bugs.php";
	$bugs = new Bugs;
	$result = $bugs->delete_bug($bug_id);
	if($result)
	{
		return true;
	}
	else
	{
		return false;
	}
?>
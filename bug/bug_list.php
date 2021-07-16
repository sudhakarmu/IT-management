<?php
	require "db_connect.php";
	// echo "here";
	// $query = "SELECT * FROM bugs WHERE status NOT IN  (:Deleted, :Resolved, :Ignored) ORDER BY id DESC";

	// $stmt = $conn->prepare($query);
	// $stmt->execute(
	// 				array(
	// 					    ':Deleted' => 'Deleted', 
	// 					    ':Resolved' => 'Resolved', 
	// 					    ':Ignored' => 'Ignored'
	// 				)
	// 		);

	// $bug_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// echo "bug_list<pre>";print_r($bug_list);exit;
?>
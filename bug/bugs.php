<?php

	class Bugs
	{
		protected $conn;
		function __construct() 
		{
		    $servername = "localhost";
			$username = "root";
			$password = "";

			try 
			{
			  $this->conn = new PDO("mysql:host=$servername;dbname=bug_tracking", $username, $password);
			  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  // echo "Connected successfully";
			} 
			catch(PDOException $e) 
			{
			  echo "Connection failed: " . $e->getMessage();
			}
		}

		public function list_all()
		{
			$query = "SELECT bugs.* , reporter.name as reporter, assigned.name AS assigned, 
							 modules.name AS module_name
					  FROM bugs
					  JOIN users reporter ON bugs.raised_by = reporter.id
					  JOIN users assigned ON bugs.assigned_to = assigned.id
					  JOIN modules ON bugs.module_id = modules.id
					  WHERE bugs.status NOT IN  (:Deleted, :Resolved, :Ignored) 
					  ORDER BY bugs.id DESC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute(
							array(
								    ':Deleted' => 'Deleted', 
								    ':Resolved' => 'Resolved', 
								    ':Ignored' => 'Ignored'
							)
					);

			$bug_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "bug_list1<pre>";print_r($bug_list);exit;

			return $bug_list;
		}

		public function get_all_modules()
		{
			$query = "SELECT id, name FROM modules WHERE status IN  (:Active) ORDER BY id ASC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute(
							array(
								    ':Active' => 'Active'
							)
					);

			$module_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "module_list<pre>";print_r($module_list);exit;

			return $module_list;
		}

		public function get_all_users()
		{
			$query = "SELECT id, name FROM users WHERE status IN  (:Active) ORDER BY id ASC";
			$stmt = $this->conn->prepare($query);
			$stmt->execute(
							array(
								    ':Active' => 'Active'
							)
					);

			$user_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "user_list<pre>";print_r($user_list);exit;

			return $user_list;
		}

		public function add_bug($module, $description, $priority, $raised_by, $assigned_to, $status)
		{
			try 
			{
				$sql_query = "INSERT INTO bugs (description, module_id, priority, status, raised_by, assigned_to) VALUES (:description, :module_id, :priority, :status, :raised_by, :assigned_to );";
				$stmt = $this->conn->prepare($sql_query);
				$stmt->bindParam(':module_id', $module);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':priority', $priority);
				$stmt->bindParam(':raised_by', $raised_by);
				$stmt->bindParam(':assigned_to', $assigned_to);
				$stmt->bindParam(':status', $status);
				$stmt->execute();
				return true;
			} 
			catch(PDOException $e) 
			{
				echo $sql_query . "<br>" . $e->getMessage();
				// exit;
				return false;
			}
		}

		public function delete_bug($id)
		{
			$status = "Deleted";
			$stmt = $this->conn->prepare("UPDATE bugs SET status = :status WHERE id = :id");
			$stmt->bindParam(':status', $status);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			// echo "Count :".$stmt->rowCount();exit; 
			if($stmt->rowCount())
			{
				echo true;
			}
			else
			{
				echo false;
			}
		}

		public function get_bug($id)
		{
			$query = "SELECT bugs.* , reporter.name as reporter, assigned.name AS assigned, 
							 modules.name AS module_name
					  FROM bugs
					  JOIN users reporter ON bugs.raised_by = reporter.id
					  JOIN users assigned ON bugs.assigned_to = assigned.id
					  JOIN modules ON bugs.module_id = modules.id
					  WHERE bugs.id = :id 
					  ";
			$stmt = $this->conn->prepare($query);
			$stmt->execute(
							array(
								    ':id' => $id
							)
					);

			$bug_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// echo "bug_details<pre>";print_r(reset($bug_details));exit;

			return reset($bug_details);
		}

		public function edit_bug($module, $description, $priority, $raised_by, $assigned_to, $status, $id)
		{
			try 
			{
				$sql_query = "UPDATE bugs SET description = :description,  module_id = :module_id,  priority = :priority,  status = :status,  raised_by = :raised_by,  assigned_to = :assigned_to WHERE id = :id; ";
				$stmt = $this->conn->prepare($sql_query);
				$stmt->bindParam(':module_id', $module);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':priority', $priority);
				$stmt->bindParam(':raised_by', $raised_by);
				$stmt->bindParam(':assigned_to', $assigned_to);
				$stmt->bindParam(':status', $status);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				if($stmt->rowCount())
				{
					return true;
				}
				else
				{
					return false;
				}
			} 
			catch(PDOException $e) 
			{
				echo $sql_query . "<br>" . $e->getMessage();
				// exit;
				return false;
			}
		}
	}
?>

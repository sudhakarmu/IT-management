<?php

include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="tester" || $_SESSION['ROLE']=="planning")
{

?>
<?php
$date = date("Y-m-d");

require 'database/dbconfig.php';
error_reporting(0);
if($_SESSION['ROLE']=="admin")
$query = "SELECT * FROM project WHERE status=1";
$result = mysqli_query($con,$query);

?>
 
<div class="container-fluid">
<?php 
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_assoc($result))
        {
         
?>

<div class="card text-white bg-info mb-3" style="max-width: 100rem;">
  <div class="card-header text-info"><?php echo $row['deadline']; ?></div>
  <div class="card-body">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <p class="card-text"><?php echo $row['state']; ?></p>
    </div>
    <div class="col-lg-2">
    <form action="view_current_project.php" method="post">
       <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
       <button type="submit" name="view_project" class="form-control text-info bg-outline-info">View</button></td>
    </form> 
   </div>
    <?php 
    if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin")
    { ?>
    <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </div>
  </div>
  <?php }}
  error_reporting(0);
  $name = $_SESSION['name'];
  if($_SESSION['ROLE']=="developer admin")
  {
    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `team_head`='$name' AND status=1";
  }
  if($_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="planning" || $_SESSION['ROLE']=="testing")
  {
    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `member_name`='$name' AND status=1";
  }

  $re = mysqli_query($con,$sql);

    if(mysqli_num_rows($re)>0)
    {
        while($rows = mysqli_fetch_assoc($re))
        {
          $team_name = $rows['team_name'];
    $query = "SELECT * FROM project WHERE status=1 AND `assigned_to`='$team_name'";
 

  $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
          
    ?>
    <tr>
    <div class="card text-white bg-info mb-3" style="max-width: 100rem;">
  <div class="card-header text-info"><?php echo $row['deadline']; ?></div>
  <div class="card-body">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <p class="card-text"><?php echo $row['state']; ?></p>
    </div>
    <div class="col-lg-2">
    <form action="view_current_project.php" method="post">
       <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
       <button type="submit" name="view_project" class="form-control text-info bg-outline-info">View</button></td>
    </form> 
   </div>
    <?php 
    if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin")
    { ?>
    <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </div>
  </div>
    <?php 
        }
    }
  }}
  error_reporting(0);
  $name = $_SESSION['name'];
  if($_SESSION['ROLE']=="developer admin")
  {
    $sql = "SELECT DISTINCT `member_name` FROM teams WHERE `team_head`='$name' AND status=1";
  }
  error_reporting(0);

  $re = mysqli_query($con,$sql);

    if(mysqli_num_rows($re)>0)
    {
        while($rows = mysqli_fetch_assoc($re))
        {
          $team_member = $rows['member_name'];
    $query = "SELECT * FROM project WHERE status=1 AND `assigned_to`='$team_member'";
 

  $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
          
    ?>
   <div class="card text-white bg-info mb-3" style="max-width: 100rem;">
  <div class="card-header text-info"><?php echo $row['deadline']; ?></div>
  <div class="card-body">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <p class="card-text"><?php echo $row['state']; ?></p>
    </div>
    <div class="col-lg-2">
    <form action="view_current_project.php" method="post">
       <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
       <button type="submit" name="view_project" class="form-control text-info bg-outline-info">View</button></td>
    </form> 
   </div>
    <?php 
    if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin")
    { ?>
    <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </div>
  </div>
    <?php 
        }
    }
  }}
  
    ?>

    </div>
    </div>
<?php
}
else
{
    echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
}
include('includes/scripts.php');
include('includes/footer.php');

?>
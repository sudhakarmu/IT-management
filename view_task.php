<?php

include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="sale admin" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="digital marketer" || $_SESSION['ROLE']=="digital marketer admin" )
{

?>
<?php
$date = date("Y-m-d");

require 'database/dbconfig.php';
$query = "SELECT * FROM task WHERE status=1 AND task_status!='Completed' AND task_type='High'";
$result = mysqli_query($con,$query);
?>
 
<div class="container-fluid">
<?php 
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_assoc($result))
        {
         
?>
<?php 
if($row['task_type']=='High')
{
  if($_SESSION['username']==$row['assigned_to'] || $_SESSION['ROLE']=="admin" )
{?>
<div class="card text-white bg-danger mb-3" style="max-width: 100rem;">
  <div class="card-header text-danger"><?php echo $row['finishing_date']; ?></div>
  <div class="card-body">
  <form action="code.php" method="post">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <select class="form-control" name="task_status">
    <option value="Not Started">Not Started</option>
    <option value="Started">Started</option>
    <option value="25 % Complete">25 % Complete</option>
    <option value="50 % Complete">50 % Complete</option>
    <option value="75 % Complete">75 % Complete</option>
    <option value="Completed">Completed</option>
    <?php echo "<option value='" . $row['task_status']."' style='color:black;' selected hidden>" . $row['task_status']. "</option>";?>
    </select>
    </div>
    <div class="col-lg-2">
    <button class="form-control text-danger bg-outline-danger" name="update_task_button">Update</button>
    </div>
    <?php 
    if($_SESSION['ROLE']=="admin")
    { ?>
    <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </form>
  </div>
  </div>
  <?php }}}}
  $query1 = "SELECT * FROM task WHERE status=1 AND task_status!='Completed' AND task_type='Medium'";
  $result1 = mysqli_query($con,$query1);
  if(mysqli_num_rows($result1)>0)
{
    while($row = mysqli_fetch_assoc($result1))
        {
if($row['task_type']=='Medium')
{ 
  if($_SESSION['username']==$row['assigned_to'] || $_SESSION['ROLE']=="admin")
  {?>
<div class="card text-dark bg-warning mb-3" style="max-width: 100rem;">
  <div class="card-header text-warning"><?php  echo $row['finishing_date']; ?></div>
  <div class="card-body">
  <form action="code.php" method="post">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <select class="form-control" name="task_status">
    <option value="Not Started">Not Started</option>
    <option value="Started">Started</option>
    <option value="25 % Complete">25 % Complete</option>
    <option value="50 % Complete">50 % Complete</option>
    <option value="75 % Complete">75 % Complete</option>
    <option value="Completed">Completed</option>
    <?php echo "<option value='" . $row['task_status']."' style='color:black;' selected hidden>" . $row['task_status']. "</option>";?>
    </select>
    </div>
    <div class="col-lg-2">
    <button class="form-control text-warning bg-outline-warning" name="update_task_button">Update</button>
    </div>
    <?php 
    if($_SESSION['ROLE']=="admin")
    { ?>
     <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </form>
  </div>
  </div>
<?php } } }}
  $query2 = "SELECT * FROM task WHERE status=1 AND task_status!='Completed' AND task_type='Normal'";
  $result2 = mysqli_query($con,$query2);
  if(mysqli_num_rows($result2)>0)
{
    while($row = mysqli_fetch_assoc($result2))
        {
          if($row['task_type']=='Normal') 
           {   if($_SESSION['username']==$row['assigned_to'] || $_SESSION['ROLE']=="admin")
            {?>
<div class="card text-white bg-primary mb-3" style="max-width: 100rem;">
  <div class="card-header text-primary"><?php echo $row['finishing_date']; ?></div>
  <div class="card-body">
  <form action="code.php" method="post">
  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <p class="card-text"><?php echo $row['description']; ?></p>
    <div class="row">
    <div class="col-lg-3">
    <select class="form-control" name="task_status">
    <option value="Not Started">Not Started</option>
    <option value="Started">Started</option>
    <option value="25 % Complete">25 % Complete</option>
    <option value="50 % Complete">50 % Complete</option>
    <option value="75 % Complete">75 % Complete</option>
    <option value="Completed">Completed</option>
    <?php echo "<option value='" . $row['task_status']."' style='color:black;' selected hidden>" . $row['task_status']. "</option>";?>
    </select>
    </div>
    <div class="col-lg-2">
    <button class="form-control text-primary bg-outline-primary" name="update_task_button">Update</button>
    </div>
    <?php 
    if($_SESSION['ROLE']=="admin")
    { ?>
     <div class="col-lg-6">
    <p class="card-text"><?php echo "Assigned to: ".$row['assigned_to']; ?></p>
    </div>
    <?php } ?>
    </div>
  </form>
  </div>
</div>
<?php
}}}} ?>
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
<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale" || $_SESSION['ROLE']=="sale admin" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="digital marketer" || $_SESSION['ROLE']=="digital marketer admin"){

?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <?php   if($_SESSION['ROLE']=="admin"){  ?>
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> 
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a><?php } ?>
          </div>

          <!-- Content Row -->
          <div class="row">
<?php   if($_SESSION['ROLE']=="admin"){  ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                      <?php 

                      require 'database/dbconfig.php';

                      $query = "SELECT id FROM users WHERE status=1";

                      $result = mysqli_query($con, $query); 

                      $row = mysqli_num_rows($result);

                      echo "<h3>$row</h3>";
                      ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                 <!-- Earnings (Monthly) Card Example -->
<?php } ?> 

          <h2 class="text-danger">Pending Tasks</h2>
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
  if($_SESSION['username']==$row['assigned_to'] || $_SESSION['ROLE']=="admin")
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
  $query1 = "SELECT * FROM task WHERE status=1 AND task_status!='Completed' AND task_type='Medium' AND finishing_date<='$date'";
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
  $query2 = "SELECT * FROM task WHERE status=1 AND task_status!='Completed' AND task_type='Normal' AND finishing_date<='$date'";
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php } ?>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
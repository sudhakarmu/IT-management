<?php

include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin")
{

?>
<?php
error_reporting(0);
$id = $_GET['remove'];
if(isset($_GET['remove']))
{

    $query = "UPDATE teams SET status=0 WHERE id='$id'";

    $result = mysqli_query($con, $query);

}


?>
<div class="container">
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Team</h1>
</div>
<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">View Team &nbsp;
                  <!-- Button trigger modal -->

                </h6>
            </div>
            <div class="card-body">
            <?php
            if(isset($_SESSION['success']) && ($_SESSION['success'])!='')
            {
                echo '<h2 class="bg-success" style="color:white;">'.$_SESSION['success'].'</h2>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['status']) && ($_SESSION['status'])!='')
            {
                echo '<h2 class="bg-danger" style="color:white;">'.$_SESSION['status'].'</h2>';
                unset($_SESSION['status']);
            }
            ?>
<div>
<?php
require 'database/dbconfig.php';
$team_name = $_GET['team_name'];
$sql = "SELECT * FROM teams WHERE team_name='$team_name' AND status=1";
$result = mysqli_query($con,$sql);
$sqls = "SELECT * FROM teams WHERE team_name='$team_name' AND status=1";
$results = mysqli_query($con,$sqls);
$rows = mysqli_fetch_array($result);
?>
<div class="row">
    <div class="col-lg-3">
    Team Name
    </div>
    <div class="col-lg-9">
    <?php echo ": ".$rows['team_name']; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
    Team Head
    </div>
    <div class="col-lg-9">
    <?php echo ": ".$rows['team_head']; ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-3">
    Member Name:
    </div>
    <div class="col-lg-9">
    </div>
</div>
<?php
 if(mysqli_num_rows($results)>0)
{
    while($row = mysqli_fetch_assoc($results))
    {
?>


<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-8">
    <?php echo " &nbsp; ".$row['member_name']; ?>
    </div>
    <div class="col-lg-1">
    <a href="team_view.php?team_name=<?php echo $row['team_name']; ?>&remove=<?php echo $row['id']; ?>">Remove</a>
    </div>
</div>

<?php
    }}
?>
</div>
</div>
            </div>
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
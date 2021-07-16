<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>
<?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin"){

?>
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Projects</h1>
</div>

<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">Projects &nbsp;

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

              <div class="table-responsive">
              <?php
                require 'database/dbconfig.php';
                if($_SESSION['ROLE']=="admin")
                {
                  $query = "SELECT * FROM project WHERE status=1 AND `state`='Testing'";
                }
                error_reporting(0);
                $result = mysqli_query($con,$query);
              ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Assigned To</th>
                      <th>Deadline</th>
                      <th>Project Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if(mysqli_num_rows($result)>0)
                  {
                      while($row = mysqli_fetch_assoc($result))
                      {
                        
                   ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['assigned_to']; ?></td>
                      <td><?php echo $row['deadline']; ?></td>
                      <td><?php echo $row['state']; ?></td>
                      <td>
                      <form action="project_edit.php" method="post">
                      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_btn_project" class="btn btn-success">Edit</button></td>
                      </form>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn_project" class="btn btn-danger">Delete</button>
                      </form>
                      </td>
                    </tr>
                  <?php 
                      }
                  }
                  error_reporting(0);

                  $name = $_SESSION['name'];
                  if($_SESSION['ROLE']=="developer admin")
                  {
                    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `team_head`='$name' AND status=1 AND `state`='Testing'";
                  }
                  if($_SESSION['ROLE']=="developer")
                  {
                    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `member_name`='$name' AND status=1 AND `state`='Testing'";
                  }

                  $re = mysqli_query($con,$sql);

                    if(mysqli_num_rows($re)>0)
                    {
                        while($rows = mysqli_fetch_assoc($re))
                        {
                          $team_name = $rows['team_name'];
                    $query = "SELECT * FROM project WHERE status=1 AND `assigned_to`='$team_name' AND `state`='Testing'";
                 

                  $result = mysqli_query($con,$query);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                          
                    ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['assigned_to']; ?></td>
                      <td><?php echo $row['deadline']; ?></td>
                      <td><?php echo $row['state']; ?></td>
                      <td>
                      <form action="project_edit.php" method="post">
                      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_btn_project" class="btn btn-success">Edit</button></td>
                      </form>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn_project" class="btn btn-danger">Delete</button>
                      </form>
                      </td>
                    </tr>
                    <?php 
                        }
                    }
                  }}
                  error_reporting(0);
                  $name = $_SESSION['name'];
                  if($_SESSION['ROLE']=="developer admin")
                  {
                    $sql = "SELECT DISTINCT `member_name` FROM teams WHERE `team_head`='$name' AND status=1 AND `state`='Testing'";
                  }
                  error_reporting(0);

                  $re = mysqli_query($con,$sql);

                    if(mysqli_num_rows($re)>0)
                    {
                        while($rows = mysqli_fetch_assoc($re))
                        {
                          $team_member = $rows['member_name'];
                    $query = "SELECT * FROM project WHERE status=1 AND `assigned_to`='$team_member' AND `state`='Testing'";
                 

                  $result = mysqli_query($con,$query);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                          
                    ?>
                      <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['assigned_to']; ?></td>
                      <td><?php echo $row['deadline']; ?></td>
                      <td><?php echo $row['state']; ?></td>
                      <td>
                      <form action="project_edit.php" method="post">
                      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_btn_project" class="btn btn-success">Edit</button></td>
                      </form>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn_project" class="btn btn-danger">Delete</button>
                      </form>
                      </td>
                    </tr>
                    <?php 
                        }
                    }
                  }}
                  
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


<?php
}
else{
echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
}
include('includes/scripts.php');
include('includes/footer.php');

?>
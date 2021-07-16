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
<!-- Modal -->
<div class="modal fade" id="addadminModal" tabindex="-1" role="dialog" aria-labelledby="addadminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addadminModalLabel">Add Project data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="code.php" method="POST">
        <div class="form-group">
    <label for="InputName">Name</label>
    <input type="text" class="form-control" name="name" id="InputName" aria-describedby="NameHelp" placeholder="Enter Name" required minlength="3">
    <p class="text-danger">Project name once given cannot be changed</p>
  </div>
  <div class="form-group">
    <label for="InputDescription">Description</label>
    <textarea class="form-control" name="description" rows="5" required minlength="5"></textarea>
  </div>
  <div class="form-group">
    <label for="InputNotes">Customer Notes</label>
    <textarea class="form-control" name="notes" rows="5" required minlength="5"></textarea>
  </div>

  <div class="form-group">
    <label for="InputAssignedTo">Assigned To</label>
       <?php $sql1 = "SELECT `email` FROM users WHERE usertype!='admin' AND (usertype='developer' OR usertype='developer admin')";
        $result1 = mysqli_query($con,$sql1);

        echo "<select style='color:black;' class='form-control' name='assigned_to' required>";
        echo "<option value=''>Choose any option</option>";
        while ($row = mysqli_fetch_array($result1)) 
        {
        echo "<option value='" . $row['email'] ."' style='color:black;'>" . $row['email'] ."</option>";
        }
        echo "<option value='' disabled>--Teams--</option>";
        if($_SESSION['ROLE']=="admin"){
            $sql13 = "SELECT DISTINCT team_name FROM teams WHERE status=1";
        }
        if($_SESSION['ROLE']=="developer admin"){
            $name = $_SESSION['name'];
            $sql13 = "SELECT DISTINCT team_name FROM teams WHERE status=1 AND `team_head`='$name'";
        }
        $result13 = mysqli_query($con,$sql13);
        while ($row3 = mysqli_fetch_array($result13)) 
        {
        echo "<option value='" . $row3['team_name'] ."' style='color:black;'>" . $row3['team_name'] ."</option>";
        }
        echo "</select>";?>
  </div>
  <div class="form-group">
    <label for="InputDeadline">Deadline</label>
    <input type="date" class="form-control" name="deadline" required>
  </div>

  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit_project" class="btn btn-primary">Add Project</button>
      </div>
</form>
        </div>
    
    </div>
  </div>
</div>
<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">Projects &nbsp;
                  <!-- Button trigger modal -->
             <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin"){ ?> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminModal">
                    Add Project
             </button><?php } ?>
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
                  $query = "SELECT * FROM project WHERE status=1";
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
                    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `team_head`='$name' AND status=1";
                  }
                  if($_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="tester" || $_SESSION['ROLE']=="planning")
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
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['assigned_to']; ?></td>
                      <td><?php echo $row['deadline']; ?></td>
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
                      <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['assigned_to']; ?></td>
                      <td><?php echo $row['deadline']; ?></td>
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
          <script>
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );</script>

<?php
}
else{
echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
}
include('includes/scripts.php');
include('includes/footer.php');

?>
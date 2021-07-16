<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer admin")
{
?>
    <div class="container-fluid">
        <!-- Container fluid starts -->
        <!--Page Heading ends-->
        <div class="card shadow mb-6">
            <!--Card shadow starts -->
            <div class="card-header py-3 col-lg-12">
                <!-- Card header starts -->
              <h6 class="m-1 font-weight-bold text-primary"> Edit Project </h6>
            </div>
            <!-- Card header ends -->
            <div class="card-body">
                <!-- Card body starts -->
                <?php
                 if(isset($_POST['edit_btn_project']))
                 {
                    require 'database/dbconfig.php';

                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM project WHERE id = '$id'";
             
                    $result = mysqli_query($con, $query);

                    foreach ($result as $row)
                    {
                    ?>
                      <form action="code.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      <div class="form-group">
                      <label for="InputName">Name</label>
                      <input type="text" disabled class="form-control" name="edit_name" id="InputName" value="<?php echo $row['name']; ?>" aria-describedby="NameHelp" placeholder="Enter Name" required minlength="3">
                      <p class="text-danger">Project name once given cannot be changed</p>
                      </div>
                      <div class="form-group">
                        <label for="InputDescription">Description</label>
                        <textarea class="form-control" name="edit_description" rows="5" required minlength="5"><?php echo $row['description']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="InputNotes">Customer Notes</label>
                        <textarea class="form-control" name="edit_notes" rows="5" required minlength="5"><?php echo $row['notes']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="InputAssignedTo">Assigned To</label>
                        <?php $sql1 = "SELECT `email` FROM users WHERE usertype!='admin' AND (usertype='developer' OR usertype='developer admin')";
                        $result1 = mysqli_query($con,$sql1);

                        echo "<select style='color:black;' class='form-control' name='edit_assigned_to' required>";
                        echo "<option value=''>Choose any option</option>";
                        while ($row2 = mysqli_fetch_array($result1)) 
                        {
                        echo "<option value='" . $row2['email'] ."' style='color:black;'>" . $row2['email'] ."</option>";
                        echo "<option value='" . $row['assigned_to']."' style='color:black;' selected hidden>" . $row['assigned_to']. "</option>";
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
                        <input type="date" class="form-control" name="edit_deadline" value="<?php echo $row['deadline']; ?>">
                      </div>

                        <a href="manage_project.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="update_project" class="btn btn-primary">Update</button>
                      </form>  
                        <?php
                    }
                 }
               
              ?>

            </div>
            <!-- Card body ends -->
        </div>  
        <!-- Card Shadow ends -->    
    </div>
    <!-- Container Fluid ends -->
<?php
}
  else{
    echo "<center><h2 class='text-dark'>Error 404 not found</h2></center>";
    }
include('includes/scripts.php');
include('includes/footer.php');
?>
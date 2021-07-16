<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin")
{
?>
    <div class="container-fluid">
        <!-- Container fluid starts -->
        <!--Page Heading ends-->
        <div class="card shadow mb-6">
            <!--Card shadow starts -->
            <div class="card-header py-3 col-lg-12">
                <!-- Card header starts -->
              <h6 class="m-1 font-weight-bold text-primary"> Edit Task </h6>
            </div>
            <!-- Card header ends -->
            <div class="card-body">
                <!-- Card body starts -->
                <?php
                 if(isset($_POST['edit_btn_task']))
                 {
                    require 'database/dbconfig.php';

                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM task WHERE id = '$id'";
             
                    $result = mysqli_query($con, $query);

                    foreach ($result as $row)
                    {
                    ?>
                      <form action="code.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      <div class="form-group">
                      <label for="InputName">Name</label>
                      <input type="text" class="form-control" name="edit_name" id="InputName" value="<?php echo $row['name']; ?>" aria-describedby="NameHelp" placeholder="Enter Name" required minlength="3">
                      </div>
                      <div class="form-group">
                        <label for="InputDescription">Description</label>
                        <textarea class="form-control" name="edit_description" rows="5" required minlength="5"><?php echo $row['description']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="InputTaskType">Task Type</label>
                        <select class="form-control" style="color:black" name="edit_task_type" required>
                            <option value="">Choose any option</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Normal">Normal</option>
                            <?php echo "<option value='" . $row['task_type']."' style='color:black;' selected hidden>" . $row['task_type']. "</option>";?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="InputAssignedTo">Assigned To</label>
                        <?php $sql1 = "SELECT `email` FROM users WHERE usertype!='admin'";
                        $result1 = mysqli_query($con,$sql1);

                        echo "<select style='color:black;' class='form-control' name='edit_assigned_to' required>";
                        echo "<option value=''>Choose any option</option>";
                        while ($row2 = mysqli_fetch_array($result1)) 
                        {
                        echo "<option value='" . $row2['email'] ."' style='color:black;'>" . $row2['email'] ."</option>";
                        echo "<option value='" . $row['assigned_to']."' style='color:black;' selected hidden>" . $row['assigned_to']. "</option>";
                        }
                        echo "</select>";?>
                      </div>
                      <div class="form-group">
                        <label for="InputFinishingDate">Finishing Date</label>
                        <input type="date" class="form-control" value="<?php echo $row['finishing_date']; ?>" name="edit_finishing_date" requiredß>
                     </div>

                        <a href="manage_task.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="update_task" class="btn btn-primary">Update</button>
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
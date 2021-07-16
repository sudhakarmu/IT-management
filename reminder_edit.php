<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale" || $_SESSION['ROLE']=="sale admin")
{
?>
    <div class="container-fluid">
        <!-- Container fluid starts -->
        <!--Page Heading ends-->
        <div class="card shadow mb-6">
            <!--Card shadow starts -->
            <div class="card-header py-3 col-lg-12">
                <!-- Card header starts -->
              <h6 class="m-1 font-weight-bold text-primary"> Edit Reminder </h6>
            </div>
            <!-- Card header ends -->
            <div class="card-body">
                <!-- Card body starts -->
                <?php
                 if(isset($_POST['edit_btn_reminder']))
                 {
                    require 'database/dbconfig.php';

                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM reminder WHERE id = '$id'";
             
                    $result = mysqli_query($con, $query);

                    foreach ($result as $row)
                    {
                    ?>
                      <form action="code.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      <div class="form-group">
                            <label for="InputTitle">Title</label>
                            <input type="text" class="form-control" name="edit_title" id="InputTitle" value="<?php echo $row['title']; ?>" aria-describedby="TitleHelp" placeholder="Enter Title" required minlength="3">
                      </div>
                      <div class="form-group">
                        <label for="InputDescription">Description</label>
                        <textarea class="form-control" name="edit_description" rows="5" required minlength="5"><?php echo $row['description']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="InputRemindingtime">Reminding time</label>
                        <input type="date" class="form-control" name="edit_reminding_time" required value="<?php echo $row['reminding_time']; ?>">
                      </div>
                      <div class="form-group">
  <label for="InputRemindingtime">Lead</label>

           <?php
                             $name = $_SESSION['name'];
                             if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale admin")
                             {
                               $sql1 = "SELECT * FROM lead WHERE status=1";
                             }
                             else if($_SESSION['ROLE']=="sale")
                             {
                               $sql1 = "SELECT * FROM lead WHERE status=1 AND (`created_by`='$name' OR `assigned_select`='$name')";
                             }
        $result1 = mysqli_query($con,$sql1);

        echo "<select style='color:black;' class='form-control' name='lead'>";
        echo "<option value=''>Choose any option</option>";
        while ($rows = mysqli_fetch_array($result1)) 
        {
        echo "<option value='" . $rows['lead_company_name'] ."' style='color:black;'>" . $rows['lead_company_name'] ."</option>";
        }
        echo "<option value='" . $row['lead']."' style='color:black;' selected hidden>" . $row['lead']. "</option>"; 
        echo "</select>";?>
  </div>
                        <a href="manage_reminder.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="update_reminder" class="btn btn-primary">Update</button>
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
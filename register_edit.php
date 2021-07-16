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
              <h6 class="m-1 font-weight-bold text-primary"> Edit Admin Profiles </h6>
            </div>
            <!-- Card header ends -->
            <div class="card-body">
                <!-- Card body starts -->
                <?php
                 if(isset($_POST['edit_btn']))
                 {
                    require 'database/dbconfig.php';

                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM users WHERE id = '$id'";
             
                    $result = mysqli_query($con, $query);

                    foreach ($result as $row)
                    {
                    ?>
                      <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="InputUsername">Username</label>
                            <input type="username" class="form-control" name="edit_username" value="<?php echo $row['username']; ?>" id="InputUsername" aria-describedby="usernameHelp" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                          <label for="InputEmail">Email address</label>
                          <input type="email" class="form-control" id="InputEmail" name="edit_email" value="<?php echo $row['email']; ?>" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Password</label>
                            <input type="password" class="form-control" id="InputPassword" value="<?php echo $row['password']; ?>" name="edit_password" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="Inputusertype">User Type</label>
                            <select name="update_usertype" class="form-control">
                              <option value="developer admin">Developer Admin</option>
                              <option value="developer">Developer</option>
                              <option value="planning">Planning</option>
                              <option value="testing">Testing</option>
                              <?php echo "<option value='" . $row['usertype']."' style='color:black;' selected hidden>" . $row['usertype']. "</option>"; ?>
                            </select>
                        </div>
                        <a href="register.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
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
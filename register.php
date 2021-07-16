<?php
include('security.php') ;
include('includes/header.php');
include('includes/navbar.php');
?><?php if($_SESSION['ROLE']=="admin")
{
  ?>  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Users</h1>
</div>
<!-- Modal -->
<div class="modal fade" id="addadminModal" tabindex="-1" role="dialog" aria-labelledby="addadminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addadminModalLabel">Add Admin data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="code.php" method="POST">
        <div class="form-group">
    <label for="InputUsername">Username</label>
    <input type="username" class="form-control" name="username" id="InputUsername" aria-describedby="usernameHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="InputEmail">Email address</label>
    <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Enter Password">
  </div>
  <div class="form-group">
    <label for="InputConfirmPassword">Password</label>
    <input type="password" class="form-control" id="InputConfirmPassword" name="confirmpassword" placeholder="Please Confirm Password">
  </div>
  <div class="form-group">
    <label for="Inputusertype">User Type</label>
    <select name="usertype" class="form-control">
      <option value="developer admin">Developer Admin</option>
      <option value="developer">Developer</option>
      <option value="planning">Planning</option>
      <option value="testing">Testing</option>
    </select>
  </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Add User</button>
      </div>
</form>
        </div>
    
    </div>
  </div>
</div>
<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">Admin Profiles  &nbsp;
                  <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminModal">
                    Add admin
                 </button>
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
                $query = "SELECT * FROM users WHERE status=1";
                $result = mysqli_query($con,$query);
              ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>User Type</th>
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
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['usertype']; ?></td>
                      <td>
                      <form action="register_edit.php" method="post">
                      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_btn" class="btn btn-success">Edit</button></td>
                      </form>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                      </form>
                      </td>
                    </tr>
                  <?php 
                      }
                  }
                 
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
?>
 
<?php

include('includes/footer.php');
?>
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

<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">Admin Profiles  &nbsp;
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

              <div class="table-responsive">
              <?php
                require 'database/dbconfig.php';
                $query = "SELECT * FROM users WHERE status=0";
                $result = mysqli_query($con,$query);
              ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>User Type</th>
                      <th>Revieve</th>
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
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['usertype']; ?></td>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="revieve_id" id="edit_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="revieve_btn" class="btn btn-success">Revieve</button>
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

<?php
}
else{
  echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
  }
include('includes/scripts.php');
include('includes/footer.php');
?>
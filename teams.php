<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>
<?php if($_SESSION['ROLE']=="admin"){

?>
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Developer Teams</h1>
</div>
<!-- Modal -->
<div class="modal fade" id="addadminModal" tabindex="-1" role="dialog" aria-labelledby="addadminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addadminModalLabel">Add Developer Teams</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="code.php" method="POST">
        <div class="form-group">
    <label for="InputTeamName">Team Name</label>
    <input type="text" class="form-control" name="team_name" id="InputTeamName" aria-describedby="TeamNameHelp" placeholder="Enter Team Name" required minlength="3">
  </div>
  <div class="form-group">
    <label for="InputHead">Team Head</label>
    <?php $sql1 = "SELECT `username` FROM users WHERE usertype='developer admin' AND `status`=1";
        $result1 = mysqli_query($con,$sql1);

        echo "<select style='color:black;' class='form-control' name='team_head' required>";
        echo "<option value=''>Choose any option</option>";
        while ($row = mysqli_fetch_array($result1)) 
        {
        echo "<option value='" . $row['username'] ."' style='color:black;'>" . $row['username'] ."</option>";
        }
        echo "</select>";?>  
    </div>
    <div class="form-group">
    <label for="InputHead">Team Members</label>
    <?php $sql11 = "SELECT `username` FROM users WHERE `usertype`='developer' AND `status`=1";
        $result11 = mysqli_query($con,$sql11);

        echo "<select style='color:black;' class='form-control' name='team_members[]' multiple='multiple' required>";
        while ($row1 = mysqli_fetch_array($result11)) 
        {
        echo "<option value='" . $row1['username'] ."' style='color:black;'>" . $row1['username'] ."</option>";
        }
        echo "</select>";?>  
    </div>

  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit_teams" class="btn btn-primary">Add Teams</button>
      </div>
</form>
        </div>
    
    </div>
  </div>
</div>
<!--Page Heading ends-->
<div class="card shadow mb-6">
            <div class="card-header py-3 col-lg-12">
              <h6 class="m-1 font-weight-bold text-primary">Developer Teams &nbsp;
                  <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminModal">
                    Add Teams
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
                $query = "SELECT * FROM teams WHERE status=1 GROUP BY team_name";
                $result = mysqli_query($con,$query);
              ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Team Name</th>
                      <th>Team Head</th>
                      <th>View Team</th>
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
                      <td><?php echo $row['team_name']; ?></td>
                      <td><?php echo $row['team_head']; ?></td>
                      <td>
                      <a href="team_view.php?team_name=<?php echo $row['team_name']; ?>" class="btn btn-info">View</a>
                      </td>
                      <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_team_name" id="edit_id" value="<?php echo $row['team_name']; ?>">
                      <button type="submit" name="delete_btn_teams" class="btn btn-danger">Delete</button>
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
include('includes/footer.php');

?>
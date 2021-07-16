<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="tester" || $_SESSION['ROLE']=="planning")
{
  
?>
    <div class="container-fluid">
        <!-- Container fluid starts -->
        <!--Page Heading ends-->
        <div class="card shadow mb-6">
            <!--Card shadow starts -->
            <div class="card-header py-3 col-lg-12">
                <!-- Card header starts -->
              <h6 class="m-1 font-weight-bold text-primary"> View Project </h6>
            </div>
            <!-- Card header ends -->
            <div class="card-body">
                <!-- Card body starts -->
                <?php
                 if(isset($_POST['view_project']))
                 {
                    require 'database/dbconfig.php';

                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM project WHERE id = '$id'";
             
                    $result = mysqli_query($con, $query);


                    foreach ($result as $row)
                    {
                      if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="tester" || $_SESSION['ROLE']=="planning")
                      {

                    ?>  <form action="code.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="edit_name" value="<?php echo $row['name']; ?>">
                      <div class="form-group row">
                            <div class="col-2"><label for="InputName">Name:</label></div>
                            <div><p class="text-dark"><?php echo $row['name']; ?></p></div>
                      </div>
                      <div class="form-group row">
                      <div class="col-2"><label for="InputDescription">Description:</label></div>
                        <div><p class="text-dark"><?php echo $row['description']; ?></p></div>
                      </div>
                      <div class="form-group row">
                      <div class="col-2"><label for="Inputdeadline">Deadline:</label></div>
                      <div><p class="text-danger" style="font-weight:bold;"><?php echo $row['deadline']; ?>
                      </p></div>
                      </div>
                      <div class="form-group row">
                      <div class="col-2"><label for="Inputnotes">Notes:</label></div>
                      <div><p class="text-dark"><?php                         $project_n = $row['name'];
                        $query1= "SELECT * FROM plan WHERE project_name = '$project_n'";
             
                        $result1 = mysqli_query($con, $query1);

                        $query2= "SELECT * FROM current_project WHERE project_name = '$project_n'";
             
                        $result11 = mysqli_query($con, $query2);

                        $query111= "SELECT * FROM test WHERE project_name = '$project_n'";
             
                        $result111 = mysqli_query($con, $query111);

                        echo "Customer Notes: ".$row['notes']."<br>";
                        foreach ($result1 as $rows){
                        echo "<div class='row text-dark'>Planner status Notes:</div>";
                        echo "<div class='row'><div class='col-lg-8 text-dark'>".$rows['notes']."</div>"."<div class='col-lg-4 text-dark'>Updated at: ".$rows['created_at']."</div></div>"; }
                        
                        echo "<div class='row text-dark'>Developer status Notes:</div>";
                        foreach ($result11 as $rows1){
                        echo "<div class='row'><div class='col-lg-8 text-dark'>".$rows1['notes']."</div>"."<div class='col-lg-4 text-dark'>Updated at: ".$rows1['created_at']."</div></div>"; }

                        echo "<div class='row text-dark'>Tester status Notes:</div>";
                        foreach ($result111 as $rows2){
                        echo "<div class='row'><div class='col-lg-8 text-dark'>".$rows2['notes']."</div>"."<div class='col-lg-4 text-dark'>Updated at: ".$rows2['created_at']."</div></div>"; }
                        
                        ?></p></div>
                      </div>
                      <div class="row">
                      <div class="col-2"><label for="InputProjectStatus">Project Status:</label></div>
                      <div >
                      <select class="form-control" name="project_status">
                      <option value="Not Started">Not Started</option>
                      <option value="Started">Started</option>
                      <option value="25 % Complete">25 % Complete</option>
                      <option value="50 % Complete">50 % Complete</option>
                      <option value="75 % Complete">75 % Complete</option>
                      <option value="Completed">Completed</option>
                      </select>
                      </div>
                      </div><br>
                      <?php 
                      if($row['state']=="Planning")
                      {
                      if($_SESSION['ROLE']=="planning"){ ?>
                      <div class="form-group row">
                      <div class="col-lg-2"><label for="Inputaddnotes">Add Notes:</label></div>
                      <div class="col-6"><textarea class="form-control" name="addnotes" rows="5" required <?php if($_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="tester") { echo "disabled"; }?>></textarea></div>
                      </div>
                      <?php }}
                                            if($row['state']=="Development")
                                            { ?>
                      <?php if($_SESSION['ROLE']=="developer"){ ?>
                      <div class="form-group row">
                      <div class="col-lg-2"><label for="Inputaddnotes">Add Notes:</label></div>
                      <div class="col-6"><textarea class="form-control" name="addnotes" rows="5" required <?php if($_SESSION['ROLE']=="planning" || $_SESSION['ROLE']=="tester") { echo "disabled"; }?>></textarea></div>
                      </div>
                      <?php }}
                                            if($row['state']=="Testing")
                                            { ?>
                      <?php if($_SESSION['ROLE']=="tester"){ ?>
                      <div class="form-group row">
                      <div class="col-lg-2"><label for="Inputaddnotes">Add Notes:</label></div>
                      <div class="col-6"><textarea class="form-control" name="addnotes" rows="5" required <?php if($_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="planning") { echo "disabled"; }?>></textarea></div>
                      </div>
                      <?php }} ?>
                      <br>                   
                        <a href="view_project.php" class="btn btn-danger">Cancel</a>
                        <button type="submit" name="update_current_project" class="btn btn-primary">Update</button>
                        </form>
                        <?php
                    }}
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
  <?php

  include('security.php');
  include('includes/header.php');
  include('includes/navbar.php');
  if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale" || $_SESSION['ROLE']=="sale admin")
  {

  ?>

  <div class="container">
  <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Leads</h1>
  </div>
  <!--Page Heading ends-->
  <div class="card shadow mb-6">
              <div class="card-header py-3 col-lg-12">
                <h6 class="m-1 font-weight-bold text-primary">Manage Leads &nbsp;
                    <!-- Button trigger modal -->
                <a class="btn btn-primary" href="lead_create.php">
                      Add Lead
                  </a><?php if($_SESSION['ROLE']=="admin")
  { ?>
                  <a class="btn btn-warning" href="UserReport_Export.php">
                      Download Lead
  </a><?php } ?>
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
                  $name = $_SESSION['name'];
                  if($_SESSION['ROLE']=="admin")
                  {
                    $query = "SELECT * FROM lead WHERE status=1";
                  }
                  else if($_SESSION['ROLE']=="sale" ||  $_SESSION['ROLE']=="sale admin")
                  {
                    $query = "SELECT * FROM lead WHERE status=1 AND (`created_by`='$name' OR `assigned_select`='$name')";
                  }
                  $result = mysqli_query($con,$query);
                ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Source</th>
                        <th>Stage</th>
                        <th>Product</th>
                        <th>Additional Product</th>
                        <th>Created by</th>
                        <th>Assigned to</th>
                        <?php if($_SESSION['ROLE']!="admin")
  { ?>
                        <th>Edit</th>
<?php } ?>
                        <?php if($_SESSION['ROLE']=="admin")
  { ?>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Download</th>
                        <th>Delete</th>
  <?php } ?>
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
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lead_company_name']; ?></td>
                        <td><?php echo $row['source_select']; ?></td>
                        <td><?php if($row['stage_select']=='Closed')
                        {
                          echo '<button class="btn btn-success text-white">'.$row['stage_select'].'</button>';
                        } 
                        else if($row['stage_select']=='Lost')
                        {
                          echo '<button class="btn btn-danger text-white">'.$row['stage_select'].'</button>';
                        }
                        else if($row['stage_select']=='Open')
                        {
                          echo '<button class="btn btn-yellow text-white">'.$row['stage_select'].'</button>';
                        }
                        else
                        {
                          echo $row['stage_select'];
                        } ?>
                        <form action="code.php" method="post">    
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">  
                        <select style='color:black;' class='form-control' name='edit_stage_select' required>
                        <option value=''>Choose any option</option>
                        <option value="Prospect">Prospect</option>
                        <option value="Open">Open</option>
                        <option value="Negotiate">Negotiate</option>
                        <option value="Junk">Junk</option>
                        <option value="Closed">Closed</option>
                        <option value="Lost">Lost</option>
                        <?php echo "<option value='" . $row['stage_select']."' style='color:black;' selected hidden>" . $row['stage_select']. "</option>";?>
                        </select>
                        <br>
                        <button type="submit" class="form-control btn btn-success" name="stage">Change</button>
                        </form>

<br>
                        </td>
                        <td><?php echo $row['lead_product']; ?></td>
                        <td><?php echo $row['additional_product']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td><?php echo $row['assigned_select']; ?></td>
                        <?php if($_SESSION['ROLE']!="admin")
  { ?>
                        <td>
                        <form action="edit_lead.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>

  <?php } ?>
                        <?php if($_SESSION['ROLE']=="admin")
                        { ?>
                        <td>
                        <form action="lead_view.php" method="post">
                        <input type="hidden" name="view_id" id="view_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="view_btn_lead" class="btn btn-success">View</button>
                          </form>
                          </td>
                        <td>
                        <form action="lead_edit.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="download_btn_lead" class="btn btn-success">Download </button>
                        </form></td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_btn_lead" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                        <?php } ?>
                      </tr>
                    <?php 
                        }
                    }
                    error_reporting(0);

                  $name = $_SESSION['name'];
                  if($_SESSION['ROLE']=="sale admin")
                  {
                    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `team_head`='$name' AND status=1";
                  }
                  if($_SESSION['ROLE']=="sale")
                  {
                    $sql = "SELECT DISTINCT `team_name` FROM teams WHERE `member_name`='$name' AND status=1";
                  }

                  $re = mysqli_query($con,$sql);

                    if(mysqli_num_rows($re)>0)
                    {
                        while($rows = mysqli_fetch_assoc($re))
                        {
                          $team_name = $rows['team_name'];
                    $query = "SELECT * FROM lead WHERE status=1 AND `assigned_select`='$team_name'";
                 

                  $result = mysqli_query($con,$query);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                          
                    ?>
                      <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lead_company_name']; ?></td>
                        <td><?php echo $row['source_select']; ?></td>
                        <td><?php if($row['stage_select']=='Closed')
                        {
                          echo '<button class="btn btn-success text-white">'.$row['stage_select'].'</button>';
                        } 
                        else if($row['stage_select']=='Lost')
                        {
                          echo '<button class="btn btn-danger text-white">'.$row['stage_select'].'</button>';
                        }
                        else if($row['stage_select']=='Open')
                        {
                          echo '<button class="btn btn-yellow text-white">'.$row['stage_select'].'</button>';
                        }
                        else
                        {
                          echo $row['stage_select'];
                        } ?>
                        <form action="code.php" method="post">    
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">  
                        <select style='color:black;' class='form-control' name='edit_stage_select' required>
                        <option value=''>Choose any option</option>
                        <option value="Prospect">Prospect</option>
                        <option value="Open">Open</option>
                        <option value="Negotiate">Negotiate</option>
                        <option value="Junk">Junk</option>
                        <option value="Closed">Closed</option>
                        <option value="Lost">Lost</option>
                        <?php echo "<option value='" . $row['stage_select']."' style='color:black;' selected hidden>" . $row['stage_select']. "</option>";?>
                        </select>
                        <br>
                        <button type="submit" class="form-control btn btn-success" name="stage">Change</button>
                        </form>

<br>
                        </td>
                        <td><?php echo $row['lead_product']; ?></td>
                        <td><?php echo $row['additional_product']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td><?php echo $row['assigned_select']; ?></td>
                        <?php if($_SESSION['ROLE']!="admin")
                        { ?>
                        <td>
                        <form action="edit_lead.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>
                        <?php } ?>
                        <?php if($_SESSION['ROLE']=="admin")
                        { ?>
                        <td>
                        <form action="lead_view.php" method="post">
                        <input type="hidden" name="view_id" id="view_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="view_btn_lead" class="btn btn-success">View</button>
                          </form>
                          </td>
                        <td>
                        <form action="lead_edit.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="download_btn_lead" class="btn btn-success">Download </button>
                        </form></td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_btn_lead" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                        <?php } ?>
                      </tr>
                    <?php 
                        }
                    }
                  }}
                  error_reporting(0);
                  $name = $_SESSION['name'];
                  if($_SESSION['ROLE']=="sale admin")
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
                    $query = "SELECT * FROM lead WHERE status=1 AND `assigned_select`='$team_member'";
                 

                  $result = mysqli_query($con,$query);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                          
                    ?>
                      <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lead_company_name']; ?></td>
                        <td><?php echo $row['source_select']; ?></td>
                        <td><?php if($row['stage_select']=='Closed')
                        {
                          echo '<button class="btn btn-success text-white">'.$row['stage_select'].'</button>';
                        } 
                        else if($row['stage_select']=='Lost')
                        {
                          echo '<button class="btn btn-danger text-white">'.$row['stage_select'].'</button>';
                        }
                        else if($row['stage_select']=='Open')
                        {
                          echo '<button class="btn btn-yellow text-white">'.$row['stage_select'].'</button>';
                        }
                        else
                        {
                          echo $row['stage_select'];
                        } ?>
                        <form action="code.php" method="post">    
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">  
                        <select style='color:black;' class='form-control' name='edit_stage_select' required>
                        <option value=''>Choose any option</option>
                        <option value="Prospect">Prospect</option>
                        <option value="Open">Open</option>
                        <option value="Negotiate">Negotiate</option>
                        <option value="Junk">Junk</option>
                        <option value="Closed">Closed</option>
                        <option value="Lost">Lost</option>
                        <?php echo "<option value='" . $row['stage_select']."' style='color:black;' selected hidden>" . $row['stage_select']. "</option>";?>
                        </select>
                        <br>
                        <button type="submit" class="form-control btn btn-success" name="stage">Change</button>
                        </form>

<br>
                        </td>
                        <td><?php echo $row['lead_product']; ?></td>
                        <td><?php echo $row['additional_product']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td><?php echo $row['assigned_select']; ?></td>
                        <?php if($_SESSION['ROLE']!="admin")
                        { ?>
                        <td>
                        <form action="edit_lead.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>
                        <?php } ?>
                        <?php if($_SESSION['ROLE']=="admin")
                        { ?>
                        <td>
                        <form action="lead_view.php" method="post">
                        <input type="hidden" name="view_id" id="view_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="view_btn_lead" class="btn btn-success">View</button>
                          </form>
                          </td>
                        <td>
                        <form action="lead_edit.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="edit_btn_lead" class="btn btn-info">Edit</button>
                          </form>
                          </td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                          <button type="submit" name="download_btn_lead" class="btn btn-success">Download </button>
                        </form></td>
                        <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="delete_id" id="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_btn_lead" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                        <?php } ?>
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
  </div>

  <?php
  }
  else
  {
      echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
  }
  include('includes/scripts.php');
  include('includes/footer.php');

  ?>
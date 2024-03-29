
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

   
  



         <!-- Nav Item - Pages Collapse Menu -->
         <?php
if($_SESSION['ROLE'] == 'admin')
{
?>
         <li class="nav-item">
        <a class="nav-link collapsed" href="register.php" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user fa-cog"></i>
          <span>Users</span>
</a>

      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="teams.php" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users fa-cog"></i>
          <span>Teams</span>
</a>

      </li>
      <?php } ?>

        <?php
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="developer" || $_SESSION['ROLE']=="developer admin" || $_SESSION['ROLE']=="tester" || $_SESSION['ROLE']=="planning")
{
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseprojects" aria-expanded="true" aria-controls="collapseprojects">
          <i class="fas fa-fw fa-desktop"></i>
          <span>Projects</span>
        </a>
        <div id="collapseprojects" class="collapse" aria-labelledby="headingprojects" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Projects:</h6>
            <a class="collapse-item" href="view_project.php">View Project</a>
            <?php
        if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE']=="developer admin")
        {
      ?>
            <a class="collapse-item" href="manage_project.php">Manage Project</a>
            <?php } ?>
          </div>
        </div>
        </li><?php } ?>
        
    
      <!-- Heading -->
      <div class="sidebar-heading">
        Others
      </div>


   <?php   if($_SESSION['ROLE'] == 'admin')
{
?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedeleted" aria-expanded="true" aria-controls="collapsedeleted">
          <i class="fas fa-trash fa-cog"></i>
          <span>View Deleted</span>
        </a>
        <div id="collapsedeleted" class="collapse" aria-labelledby="headingdeleted" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage deleteds:</h6>
            <a class="collapse-item" href="deleted_user.php">User</a> 
            <a class="collapse-item" href="deleted_task.php">Task</a>
            <a class="collapse-item" href="deleted_project.php">Project</a>
          </div>
        </div>
</li><?php } ?>
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetasks" aria-expanded="true" aria-controls="collapsetasks">
          <i class="fas fa-tasks fa-cog"></i>
          <span>Tasks</span>
        </a>
        <div id="collapsetasks" class="collapse" aria-labelledby="headingtasks" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tasks:</h6>
            <a class="collapse-item" href="view_task.php">View</a>
            <?php   if($_SESSION['ROLE'] == 'admin')
{
?>
            <a class="collapse-item" href="manage_task.php">Manage</a>
            <?php } ?>
          </div>
        </div>
</li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="logout.php" method="post">
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div> 

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Nav Item - Alerts -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
        </a>
        <!-- Dropdown - Alerts -->
      
      </li>

      <!-- Nav Item - Messages -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- Counter - Messages -->
        </a>
        <!-- Dropdown - Messages -->
   
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
          <img class="img-profile rounded-circle" src="img/user.png">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
     
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>
  <!-- End of Topbar -->
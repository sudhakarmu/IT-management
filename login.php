<?php 

include('includes/header.php');

?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
<img src="img/sign-in-graphic-image.png" height="360" alt="">
</div></div>
</div>
  <div class="col-xl-4 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                <?php
                if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                {
                  echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
                  unset($_SESSION['status']);
                }
                ?>
              </div>
              <form class="user" action="code.php" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email_login" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password_login" placeholder="Password">
                </div>
                <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block">Login</button>
              </form>
              <hr>         
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-xl-4 col-lg-6 col-md-6">
<div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-10" style="height:360px;">
Welcome to Infosys!
<br>Infosys Limited is an Indian multinational information technology company that provides business consulting, information technology and outsourcing services. The company is headquartered in Bangalore.
</div></div>
</div>
</div>

</div>
</div>
<?php

include('includes/scripts.php');
include('includes/footer.php');

?>
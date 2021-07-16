<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>
<?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="sale" || $_SESSION['ROLE']=="sale admin"){

?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <h4 class="text-dark">&nbsp;Lead&nbsp;&nbsp;</h4>
    <!--Lead Card Link-->
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="lead-card-tab" data-toggle="tab" href="#lead-card" role="tab" aria-controls="lead-card" aria-selected="true">Lead Card</a>
  </li>
   <!--Lead Card Link Ends-->
       <!--Address Card Link-->
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="address-card-tab" data-toggle="tab" href="#address-card" role="tab" aria-controls="address-card" aria-selected="false">Address Card</a>
  </li>
      <!--Address Card Link Ends-->
            <!--Social Media Card Link-->
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="social-media-tab" data-toggle="tab" href="#social-media" role="tab" aria-controls="social-media" aria-selected="false">Social Media Card</a>
  </li>
        <!--Social Media Card Link Ends-->
                    <!--Reminder Card Link-->
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="reminder-tab" data-toggle="tab" href="#reminder" role="tab" aria-controls="social-media" aria-selected="false">Reminder</a>
  </li>
        <!--Reminder Card Link Ends-->
                            <!--Appointment Card Link-->
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab" aria-controls="social-media" aria-selected="false">Appointment</a>
  </li>
        <!--Appointment Card Link Ends-->
</ul>        
<!--Lead Card content-->
<form action="code.php" method="post">
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="lead-card" role="tabpanel" aria-labelledby="lead-card-tab">
      <br>
      <div class="container">
      <div class="row">
      &nbsp;
      <input type="text" hidden value="<?php echo $_SESSION['username']; ?>" name="created_by">
   <div class="col-lg-4">
       <h6 class="text-dark">Source <span style="color:red">*</span></h6>
        <select style='color:black;' class='form-control' name='source_select' required>
        <option value='' disabled selected>Choose any option</option>
        <option value='Facebook'>Facebook</option>
        <option value='Instagram'>Instagram</option>
        <option value='Google'>Google</option>
        <option value='Linkedin'>Linkedin</option>
        <option value='Relation'>Relation</option>
        <option value='Referal'>Referal</option>
        <option value='Website'>Website</option>
        <option value='Organic Search'>Organic Search</option>
        <option value='Newspaper'>Newspaper</option>
        <option value="Ads">Ads</option>
        <option value="Direct Meeting">Direct Meeting</option>
        </select>
   </div>
   <div class="col-lg-4">
       <h6 class="text-dark">Stage <span style="color:red">*</span></h6>
       <select style='color:black;' class='form-control' name='stage_select' required>
       <option value='' disabled selected>Choose any option</option>
       <option value="Prospect">Prospect</option>
       <option value="Open">Open</option>
       <option value="Junk">Junk</option>
       <option value="Negotiate">Negotiate</option>
       <option value="Closed">Closed</option>
       <option value="Lost">Lost</option>
       </select>
   </div>
   <div class="col-lg-3">
       <h6 class="text-dark">Assigned</h6>
       <?php
        if($_SESSION['ROLE']!='sale'){
        $sql1 = "SELECT `username` FROM users WHERE (usertype='sale' OR usertype='sale admin') AND `status`=1";
        $result1 = mysqli_query($con,$sql1);

        echo "<select style='color:black;' class='form-control' name='assigned_select'>";
        echo "<option value='' disabled selected>Choose any option</option>";
        while ($row = mysqli_fetch_array($result1)) 
        {
        echo "<option value='" . $row['username'] ."' style='color:black;'>" . $row['username'] ."</option>";
        }
        echo "<option value='' disabled>--Teams--</option>";
        if($_SESSION['ROLE']=="admin"){
            $sql13 = "SELECT DISTINCT team_name FROM teams WHERE status=1";
        }
        if($_SESSION['ROLE']=="sale admin"){
            $name = $_SESSION['name'];
            $sql13 = "SELECT DISTINCT team_name FROM teams WHERE status=1 AND `team_head`='$name'";
        }
        $result13 = mysqli_query($con,$sql13);
        while ($row3 = mysqli_fetch_array($result13)) 
        {
        echo "<option value='" . $row3['team_name'] ."' style='color:black;'>" . $row3['team_name'] ."</option>";
        }
        echo "</select>";
      }
        else{
        $sql1 = "SELECT `username` FROM users WHERE (usertype='sale' OR usertype='sale admin') AND `status`=1";
        $result1 = mysqli_query($con,$sql1);
        $name = $_SESSION['name'];

        echo "<select style='color:black;' class='form-control' name='assigned_select' disabled>";
        echo "<option value='$name' selected>".$name."</option>";

        echo "</select>";
      }
      ?>

   </div>
   </div>
   <br>
   <div class="row">
  &nbsp; <div class="col-lg-4">
       <h6 class="text-dark">Title/Position <span style="color:red">*</span></h6>
        <select style='color:black;' class='form-control' name='title_select' required>
        <option value='' disabled selected>Choose any option</option>
        <option value='CEO'>CEO</option>
        <option value='Receptionist'>Receptionist</option>
        <option value='Sales Person'>Sales Person</option>
        <option value='Employee'>Employee</option>
        <option value='Manager'>Manager</option>
        <option value='Assistant'>Assistant</option>
        <option value='Customer'>Customer</option>
        <option value='Technical Team'>Technical Team</option>
        <option value='Support Desk'>Support Desk</option>
        </select>
   
   </div>

   <div class="col-lg-7">
       <h6 class="text-dark">Name <span style="color:red">*</span></h6>
       <input type="text" name="lead_first_name" class="form-control" placeholder="Enter lead's Name" required>
   </div>
   </div>
   <br>
   <div class="row">
  &nbsp;   <div class="col-lg-8">
       <h6 class="text-dark">Company name</h6>
       <input type="text" name="lead_company_name" class="form-control" placeholder="Enter lead's company name">
   </div>
   <div class="col-lg-3">
   <h6 class="text-dark">Product</h6>
   <select name="product_addition" class="form-control" id="">
                  <option value="">Choose some product</option>
                  <option value="Website">Website</option>
                  <option value="ERP">ERP</option>
                  <option value="School Management">School Management</option>
                  <option value="Digital Marketing">Digital Marketing</option>
                  <option value="CRM">CRM</option>
                  <option value="Bulk SMS">Bulk SMS</option>
                  <option value="SEO">SEO</option>
                  <option value="Ecommerce">Ecommerce</option>
                  <option value="Mobile Application">Mobile Application</option>
                  <option value="Web Application">Web Application</option>
                  <option value='Renovation'>Renovation</option>
                  <option value="Secondary Sales Management">Secondary Sales Management</option>
            </select>     
   </div>
   </div><br>
   <div class="row">
  &nbsp;   <div class="col-lg-4">
       <h6 class="text-dark">Email</h6>
       <input type="email" name="lead_email" class="form-control" placeholder="Enter lead's Email">
   </div>
   <div class="col-lg-4">
       <h6 class="text-dark">Phone <span style="color:red">*</span></h6>
       <input type="number" name="lead_phone" class="form-control" placeholder="Enter lead's Phone" required>
   </div>
   <div class="col-lg-3">
       <h6 class="text-dark">Additional Product</h6>
       <input type="text" name="lead_product" class="form-control" placeholder="Enter lead's Product">

      </div>
   </div><br>
   <div class="row">
  &nbsp;   <div class="col-lg-4">
       <h6 class="text-dark">Whatsapp Number <span style="color:red">*</span></h6>
       <input type="number" name="lead_whatsapp" class="form-control" required placeholder="Enter lead's Whatsapp number">
   </div>
   <div class="col-lg-4">
       <h6 class="text-dark">Website</h6>
       <input type="text" name="lead_website" class="form-control" placeholder="Enter lead's Website" value="https://">
   </div>
   <div class="col-lg-3">
       <h6 class="text-dark">Industry Type</h6>
       <input type="text" name="lead_industry_type" class="form-control" placeholder="Enter lead's type of industry">
   </div>
   </div><br>
   <div class="row">
  &nbsp;  <br>
   <div class="col-lg-11">
       <h6 class="text-dark">Notes</h6>
       <textarea name="notes" class="form-control" rows="5" placeholder="Enter notes here"></textarea>
   </div>
   </div>
    </div>
   </div>
  <!-- Lead card content ends-->
  <!-- Address card content starts-->
  <div class="tab-pane fade" id="address-card" role="tabpanel" aria-labelledby="address-card-tab">
  <br><div class="container">
  <div class="row">
        &nbsp;<div class="col-lg-6">
        <h6 class="text-dark">&nbsp;Address Line 1</h6>
       <input type="text" name="address_line_1" class="form-control" placeholder="Enter Address Line 1">
        </div>
        <div class="col-lg-5">
        <h6 class="text-dark">&nbsp;Address Line 2</h6>
       <input type="text" name="address_line_2" class="form-control" placeholder="Enter Address Line 2">
        </div>
  </div><br>

  <div class="row">
  &nbsp;

        <div class="col-lg-4">
        <h6 class="text-dark">&nbsp;Email 1</h6>
        <input type="email" class="form-control" name="email_1" placeholder="Email 1">
        </div>
        
        <div class="col-lg-4">
        <h6 class="text-dark">&nbsp;Email 2</h6>
        <input type="email" class="form-control" name="email_2" placeholder="Email 2">
        </div>
        <div class="col-lg-3">
        <h6 class="text-dark">&nbsp;Zip Code</h6>
        <input type="zipcode" class="form-control" name="zip_code" placeholder="Zip code">
        </div>
  </div><br>

  </div>
  </div>
 
    <!-- Address card content ends-->
    <!-- Reminder card content -->
    <div class="tab-pane fade" id="reminder" role="tabpanel" aria-labelledby="reminder-tab">

<br><div class="container">
                  <div class="row">
                        <input type="hidden" name="created_by" value=<?php echo $_SESSION['username']; ?>>
                        <div class="col-lg-3">
                              <label for="InputTitle" class="text-dark">&nbsp;Title</label>
                        </div>
                        <div class="col-lg-3">
                              <input type="text" class="form-control" name="title" id="InputTitle" aria-describedby="TitleHelp" placeholder="Enter Title" minlength="3">
                        </div>
                  </div><br>
                  <div class="row">
                        <div class="col-lg-3">
                              <label for="InputDescription" class="text-dark">&nbsp;Description</label>
                        </div>
                        <div class="col-lg-3">
                              <textarea class="form-control" name="description" rows="5" minlength="5"></textarea>
                        </div>
                  </div><br>
                  <div class="row">          
                        <div class="col-lg-3">
                             <label for="InputRemindingtime" class="text-dark">&nbsp;Reminding time</label>
                        </div>
                        <div class="col-lg-3">
                              <input type="date" class="form-control" name="reminding_time">
                        </div>
                  </div>    <br>                
                  </div>
  </div>
  <!-- Reminder card ends -->
  <!-- Appointment card starts -->

  <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">

<br><div class="container">
                  <div class="row">
                        <input type="hidden" name="created_by_appointment" value=<?php echo $_SESSION['username']; ?>>
                        <div class="col-lg-3">
                              <label for="InputTitle" class="text-dark">&nbsp;Title</label>
                        </div>
                        <div class="col-lg-3">
                              <input type="text" class="form-control" name="title_appointment" id="InputTitle" aria-describedby="TitleHelp" placeholder="Enter Title" minlength="3">
                        </div>
                  </div><br>
                  <div class="row">
                        <div class="col-lg-3">
                              <label for="InputDescription" class="text-dark">&nbsp;Description</label>
                        </div>
                        <div class="col-lg-3">
                              <textarea class="form-control" name="description_appointment" rows="5" minlength="5"></textarea>
                        </div>
                  </div><br>
                  <div class="row">          
                        <div class="col-lg-3">
                             <label for="Inputappointmenttime" class="text-dark">&nbsp;Appointment time</label>
                        </div>
                        <div class="col-lg-3">
                              <input type="date" class="form-control" name="appointment_time">
                        </div>
                  </div>    <br>                
                  </div>
  </div>
  <!-- Appointment card end -->
  <div class="tab-pane fade" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <br><div class="container">
  <div class="row">
        &nbsp;<div class="col-lg-6">
        <h6 class="text-dark">&nbsp;Facebook</h6>
        <input type="text" class="form-control" name="facebook" placeholder="Facebook">
        </div>
        <div class="col-lg-5">
        <h6 class="text-dark">&nbsp;Linkedin</h6>
        <input type="text" class="form-control" name="linkedin" placeholder="Linkedin">
        </div>
  </div>  <br>
  <div class="row">
        &nbsp;<div class="col-lg-6">
        <h6 class="text-dark">&nbsp;Twitter</h6>
        <input type="text" class="form-control" name="twitter" placeholder="Twitter">
        </div>
        <div class="col-lg-5">
        <h6 class="text-dark">&nbsp;Telegram</h6>
        <input type="text" class="form-control" name="telegram" placeholder="Telegram">
        </div>
  </div>  <br>
  <div class="row">
        &nbsp;<div class="col-lg-6">
        <h6 class="text-dark">&nbsp;Instagram</h6>
        <input type="text" class="form-control" name="instagram" placeholder="Instagram">
        </div>

  </div>  <br>


  </div>
  </div>
  <br>
  <div class="row">
    &nbsp;
    <div class="col-lg-11">
      <button class="btn btn-primary btn-block" type="submit" value="submit" name="submit_lead">Save Lead</button>
    </div>
    </div>

</div>
</div>
</form>

<?php
}
else{
echo "<center><h2 class='text-dark'> Error 404 not found</h2></center>";
}
include('includes/scripts.php');
include('includes/footer.php');

?>
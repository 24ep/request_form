<?php
    session_start();
    include_once("get_default_profile_image.php");
   // include_once("https://content-service-gate.cdse-commercecontent.com/base/connect.php");

    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost",cdse_admin,@aA417528639) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query =  "SELECT * FROM all_in_one_project.account where username = '".$_SESSION['username']."'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $nickname = $row["nickname"];
        $work_email = $row["work_email"];
        $office_tell = $row["office_tell"];
        $pf_theam = $row["pf_theam"];
        $department = $row["department"];
        $username = $row["username"];
        $token_line = $row["token_line"];
        $image_profile = profile_image($row['firstname'],$row['department'],150,$row['case_officer'],1);
    }
?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-2"> <?php echo $image_profile; ?></div>
        <div class="col-md-6">
          <h3 class="display-3"><?php echo ucwords($firstname)." ".ucwords($lastname);?></h3>
          <h3 class=""><?php echo ucwords($department);?></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
              <div class="card">
                <div class="card-header">Account Information</div>
                <div class="card-body">
                  <h4 contenteditable="true">General information</h4>
                  <p>Some quick example text to build on the card title .</p>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mx-4 m-3" style=""> <label>Firstname</label> <input disabled type="text" class="form-control" placeholder="First name" name="ac_firstname" id="ac_firstname" value="<?php echo $firstname;?>"> </div>
                        <div class="form-group mx-4 m-3"> <label>Lastname</label> <input disabled type="text" class="form-control" placeholder="Lastname" name="ac_lastname" id="ac_lastname" value="<?php echo $lastname;?>"> </div>
                        <div class="form-group mx-4 m-3"> <label>Nickname</label> <input disabled type="text" class="form-control" placeholder="Nickname" name="ac_nickname" id="ac_nickname" value="<?php echo $nickname;?>">  </div>
                        <div class="form-group mx-4 m-3"> <label>Username</label> <input disabled type="text" disabled class="form-control" placeholder="Username" name="ac_username" id="ac_username" value="<?php echo $username;?>"> </div> 
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mx-4 m-3"> <label>Department</label> <input disabled type="text" class="form-control" placeholder="Department" name="ac_department" value="<?php echo $department;?>" id="ac_department">  </div>
                      <div class="form-group mx-4 m-3"> <label>Work email</label> <input disabled type="email" class="form-control" placeholder="yourusername@central.co.th" value="<?php echo $work_email;?>" name="ac_work_email" id="ac_work_email"> </div>
                      <div class="form-group mx-4 m-3"> <label>Tell</label> <input type="text" disabled class="form-control" placeholder="Tell" name="ac_tell" id="ac_tell" value="<?php echo $office_tell;?>"> </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
      <!-- setting -->
      <div class="row">
        <div class="col-md-12">
              <div class="card">
                <div class="card-header">Setting</div>
                <div class="card-body">
                  <h4 contenteditable="true">Notification & Updateing</h4>
                  <p>Some quick example text to build on the card title .</p>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mx-4 m-3" style=""> <label>Line Notify Token</label> <input type="text" disabled class="form-control" placeholder="token" name="ac_line_token" id="ac_line_token" value="<?php echo $token_line;?>"> </div>
                        <div class="form-group mx-4 m-3"> <label>Email</label> <input type="text" class="form-control" disabled placeholder="Lastname" name="ac_email_update" id="ac_email_update" value="disabled"> </div>
                        <div class="form-group mx-4 m-3"> <label>Microsoft team</label> <input type="text" class="form-control" disabled placeholder="Lastname" name="ac_email_update" id="ac_email_update" value="disabled"> </div>
                    </div>
                  </div>
                  <hr>
                  <h4 contenteditable="true">Role & Permission</h4>
                  <p>Some quick example text to build on the card title .</p>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mx-4 m-3" style=""> <label>Role</label> <input disabled type="text" class="form-control" placeholder="token" name="ac_role" id="ac_role" value="disabled"> </div>
                        <!-- <div class="form-group mx-4 m-3"> <label>Permission</label> 
                            <select class="form-select" multiple aria-label="multiple select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                    </div> -->
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
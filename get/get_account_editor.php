<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
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
    }
?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-2"><img class="img-fluid d-block rounded-circle" src="https://static.pingendo.com/img-placeholder-3.svg" width="300" height="300"></div>
        <div class="col-md-6">
          <h2 class="display-2"><?php echo ucwords($firstname)." ".ucwords($lastname);?></h2>
          <h2 class=""><?php echo ucwords($department);?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills my-2">
            <li class="nav-item"> <a href="" class="active nav-link" data-toggle="pill" data-target="#tabone">Account</a> </li>
            <li class="nav-item"> <a class="nav-link" href="" data-toggle="pill" data-target="#tabtwo">Setting</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="pill" data-target="#tabthree">Preferance</a> </li>
          </ul>
          <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="tabone" role="tabpanel">
              <div class="card">
                <div class="card-header"> Account Information</div>
                <div class="card-body">
                  <h4 contenteditable="true">General information</h4>
                  <p>Some quick example text to build on the card title .</p>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> <label>Firstname</label> <input type="text" class="form-control" placeholder="First name" name="ac_firstname" id="ac_firstname" value="<?php echo $fistname;?>"> </div>
                        <div class="form-group"> <label>Lastname</label> <input type="text" class="form-control" placeholder="Lastname" name="ac_lastname" id="ac_lastname" value="<?php echo $lastname;?>"> </div>
                        <div class="form-group"> <label>Nickname</label> <input type="text" class="form-control" placeholder="Nickname" name="ac_nickname" id="ac_nickname" value="<?php echo $nickname;?>">  </div>
                        <div class="form-group"> <label>Username</label> <input type="text" class="form-control" placeholder="Username" name="ac_username" id="ac_username" value="<?php echo $username;?>"> </div> 
                    </div>
                    <div class="col-md-6">
                      <div class="form-group"> <label>Department</label> <input type="text" class="form-control" placeholder="Department" name="ac_department" value="<?php echo $department;?>" id="ac_department">  </div>
                      <div class="form-group"> <label>Work email</label> <input type="email" class="form-control" placeholder="yourusername@central.co.th" value="<?php echo $work_email;?>" name="ac_work_email" id="ac_work_email"> </div>
                      <div class="form-group"> <label>Tell</label> <input type="text" class="form-control" placeholder="Tell" name="ac_tell" id="ac_tell" value="<?php echo $office_tell;?>"> </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tabtwo" role="tabpanel">
              <h3>Setting</h3>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Role &amp; Permission</h5>
                    <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Role</label>
                      <div class="col-10">
                        <input type="email" class="form-control" id="ac_user_role" placeholder="User Role" name="ac_user_role"> </div>
                    </div>
                    <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">Permission</label>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6"></div>
                          <div class="col-md-6"></div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="card my-2">
                <div class="card-body my-1">
                  <blockquote class="blockquote mb-0">
                    <h5 class="card-title"><b>Line notify</b></h5>
                      <div class="form-group row"> <label for="inputmailh" class="col-form-label col-2">Line notify Token</label>
                        <div class="col-10">
                          <input type="text" class="form-control" id="ac_line_notify_token" value="<?php echo $token_line; ?>"placeholder="Line token ID" name="ac_line_notify_token"> </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Connect</button><button type="submit" class="btn btn-primary mx-2">Save</button>
                  </blockquote>
                </div>
              </div>
              <div class="card my-2">
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <h5 class="card-title"><b>Email update</b></h5>
                    <p></p>
                  </blockquote>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tabthree" role="tabpanel">
              <p class="">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy.</p>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><b>Theam</b></h5>
                    <div class="form-group row">
                      <div class="col-10">
                        <input type="text" class="form-control" id="inputmailh" placeholder="Light" value="<?php echo  $pf_theam ;?>"> </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

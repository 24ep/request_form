<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
    <title>Content and Studio - Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- google fornt Quicksand -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <!-- end google fornt -->
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- end Bootstrap css -->
    <!-- fornt -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: firebrick;
        background-image: linear-gradient(225deg, #960000, #b94a67);

        /* font-family: 'Quicksand', sans-serif!important; */
        font-family: 'Prompt', sans-serif;
    }
    a {
        color: gray;
        text-decoration: auto;
    }
    a:hover {
        color: black;
        text-decoration: auto;
        font-weight: bold;
    }
    .header_form {
        text-align: center;
        margin-bottom: 50px;
        margin-top: 50px;
    }
    .container-sm {
        max-width: 500px;
        margin-top: 4%;
        padding-left: 80px !important;
        padding-right: 80px !important;
        padding-top: 10px !important;
        padding-bottom: 100px !important;
        max-width: 60%;
    }
    .row {
        margin-bottom: 15px;
    }
    </style>
</head>
<?php
      include('get/get_option_function.php');
      $department_op = get_option_attribute_entity("department","account","");
?>
<body>
    <?php
                        if($_GET["reply"]<>""){
                            echo "<div class='alert alert-danger' role='alert'><ion-icon name='alert-circle-outline' style='border-radius: 0px;;margin-right: 10px;
                                    font-size: 25px;
                                    position: absolute;'></ion-icon><strong style='padding-left: 30px;'>".htmlspecialchars($_GET["reply"],  ENT_QUOTES, 'UTF-8')."</div>";
                        }
                        ?>
    <div class="container-sm shadow p p-3 mb-5 bg-white rounded">
        <h2 class="header_form"><strong>Account Register</strong></h2>
        <form>
            <div class="form-group">
                <div class="row">
                    <div class="col-5">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["firstname"],  ENT_QUOTES, 'UTF-8'); ?>" required id="firstname" onchange="Auth('check');"
                            name="firstname" placeholder="">
                        <small id="namehelp" class="form-text text-muted">กรุณาระบุเป็นภาษาอังกฤษ</small>
                    </div>
                    <div class="col-5">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($_GET["lastname"],  ENT_QUOTES, 'UTF-8'); ?>"
                            required id="lastname" onchange="Auth('check');" name="lastname" placeholder="">
                        <small id="namehelp" class="form-text text-muted">กรุณาระบุเป็นภาษาอังกฤษ</small>
                    </div>
                    <div class="col-2">
                        <label for="nickname">Nickname</label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($_GET["nickname"],  ENT_QUOTES, 'UTF-8'); ?>"
                            required id="nickname" onchange="Auth('check');" name="nickname" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="username">Username</label>
                        <input type="username" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["username"],  ENT_QUOTES, 'UTF-8'); ?>" required id="username" onchange="Auth('check');"
                            name="username" placeholder="">
                        <small id="namehelp" class="form-text text-muted">แนะนำให้ใช้ ชื่ออีเมลแบบตัดโดเมนออก เช่น
                            username@central.co.th = username</small>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["password"],  ENT_QUOTES, 'UTF-8'); ?>" required id="password" onchange="Auth('check');"
                            name="password" placeholder="">
                        <small id="passworderror_dont_match" style="visibility:hidden;color: #dc3545!important"
                            class="form-text text-muted">
                            รหัสผ่านต้องตรงกับช่อง Confirm Password
                        </small>
                    </div>
                    <div class="col-6">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["password"],  ENT_QUOTES, 'UTF-8'); ?>" required id="confirm_password"
                            onchange="Auth('check');" name="confirm_password" placeholder="">
                        <small id="passworderror_dont_match" style="visibility:hidden;color: #dc3545!important"
                            class="form-text text-muted">
                            รหัสผ่านต้องตรงกับช่อง Confirm Password
                        </small>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6">
                        <label for="email">E-mail for work</label>
                        <input type="email" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["workemail"],  ENT_QUOTES, 'UTF-8'); ?>" required id="work_email" onchange="check_value();"
                            name="work_email" placeholder="xxxxxxxx@central.co.th">
                    </div>
                    <div class="col-6">
                        <label for="office_tell">Tel.</label>
                        <input type="int" class="form-control form-control-sm"
                            value="<?php echo htmlspecialchars($_GET["office_tell"],  ENT_QUOTES, 'UTF-8'); ?>" required id="office_tell"
                            onchange="check_value();" name="office_tell">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <label for="floatingPassword">Department - Team</label>
                        <select id="department" name="department" required class="form-select">
                            <?php echo  $department_op; ?>
                        </select>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <input class="form-check-input" type="checkbox" required value="yes" id="allow_access_line"
                            name="allow_access_line" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            รับการอัพเดตเกี่ยวกับ Request ของคุณผ่าน Line Notify<br>
                            <small>ระบบจะทำการผูก LINE ของคุณกับบัญชีที่ได้ทำการลงทะเบียนไว้ เพื่อรับการอัพเดตเกี่ยวกับ
                                Ticket ของคุณ</small>
                        </label>
                    </div>
                </div>
            </div>
        </form>
        <!-- <a href ="/Homepage.php">Login with guest</a> -->
        <div class=text-center>
            <button type="submit" class="btn btn-dark" style="width:100%;margin-bottom:15px"
                onclick="Auth('submit');">Confirm</button>
            <a href="login" style="text-align: center!important;">Already have an account? - login</a>
        </div>
    </div>
    </div>
    <div class="container" style="text-align:center">
        <a href="signup" style="font-size:10px">Copyright @ Central Department Store - Digital Content</a>
    </div>
</body>
<!-- bootsrap js -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<!-- end bootsrap js -->
<script>
function Auth(type_action) {
    var allow_line_noti = document.getElementById('allow_access_line').checked;
    var username = document.getElementById('username').value;
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var nickname = document.getElementById('nickname').value;
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;
    var department = document.getElementById('department').value;
    var workemail = document.getElementById('work_email').value;
    var office_tell = document.getElementById('office_tell').value;
    if (username === '') {
        // document.getElementById("username").style.border = "thick solid red";
        document.getElementById("username").classList.remove('is-valid');
        document.getElementById("username").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("username").classList.remove('is-invalid');
        document.getElementById("username").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (firstname === '') {
        document.getElementById("firstname").classList.remove('is-valid');
        document.getElementById("firstname").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("firstname").classList.remove('is-invalid');
        document.getElementById("firstname").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (lastname === '') {
        document.getElementById("lastname").classList.remove('is-valid');
        document.getElementById("lastname").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("lastname").classList.remove('is-invalid');
        document.getElementById("lastname").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (nickname === '') {
        document.getElementById("nickname").classList.remove('is-valid');
        document.getElementById("nickname").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("nickname").classList.remove('is-invalid');
        document.getElementById("nickname").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (password === '') {
        document.getElementById("password").classList.remove('is-valid');
        document.getElementById("password").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("password").classList.remove('is-invalid');
        document.getElementById("password").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (confirm_password === '') {
        document.getElementById("confirm_password").classList.remove('is-valid');
        document.getElementById("confirm_password").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("confirm_password").classList.remove('is-invalid');
        document.getElementById("confirm_password").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (confirm_password !== password) {
        document.getElementById("confirm_password").classList.remove('is-valid');
        document.getElementById("confirm_password").classList.add('is-invalid');
        document.getElementById("passworderror_dont_match").style.visibility = "visible";
        var check_input = false;
    } else {
        document.getElementById("confirm_password").classList.remove('is-invalid');
        document.getElementById("confirm_password").classList.add('is-valid');
        document.getElementById("passworderror_dont_match").style.visibility = "hidden";
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (department === '') {
        document.getElementById("department").classList.remove('is-valid');
        document.getElementById("department").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("department").classList.remove('is-invalid');
        document.getElementById("department").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (workemail === '') {
        document.getElementById("work_email").classList.remove('is-valid');
        document.getElementById("work_email").classList.add('is-invalid');
        var check_input = false;
    } else {
        document.getElementById("work_email").classList.remove('is-invalid');
        document.getElementById("work_email").classList.add('is-valid');
        if (check_input !== false) {
            var check_input = true;
        }
    }
    if (check_input === true) {
        if (type_action === "check") {
            //nothing
        } else {
            if (allow_line_noti === true) {
                var URL = 'https://notify-bot.line.me/oauth/authorize?';
                URL += 'response_type=code';
                URL += '&client_id=XPPcPQZGP76t3eLNrQ944w';
                URL += '&scope=notify';
                URL += '&state=' + firstname + ',' + lastname + ',' + nickname + ',' + username + ',' + password + ',' +
                    department + ',' + workemail + ',' + office_tell;
                URL +=
                    '&redirect_uri=https://phpstack-1223668-4355262.cloudwaysapps.com/action/action_register_account.php';
                window.location.href = URL;
            } else {
                window.location.href =
                    'https://phpstack-1223668-4355262.cloudwaysapps.com/action/action_register_account.php?state=' +
                    firstname + ',' + lastname + ',' + nickname + ',' + username + ',' + password + ',' + department +
                    ',' + workemail + ',' + office_tell;
            }
        }
    }
}
</script>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>

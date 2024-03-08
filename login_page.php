 <?php
     session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
    <title>Content and Studio - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" type="image/ocp" href="/images/24ico.ico" />
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Poppins&display=swap" rel="stylesheet">
    <style>
    body {
        background-image: url(/image/sg_bg.gif);
        font-family: 'Prompt', sans-serif !important;
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
        margin-bottom: 50px;
        margin-top: 50px;
    }
    .container-sm {
        max-width: 500px;
        margin-top: 8%;
        padding: 10px 50px 65px !important;
    }
    .bg-animation{
	@extend %common-style;
	> div{
		@extend %common-style;
		will-change: opacity;
	}
	.bg-1{
		background: linear-gradient(180deg, #f9dea1 60%, #9bdaff 100%);
	}
	.bg-2{
		background: linear-gradient(300deg, #f9c3f5 60%, #9bdaff 100%);
		animation: bg-fade-1 6s linear infinite;
	}
	.bg-3{
		background: linear-gradient(10deg, #bab2fc 60%, #9bdaff 100%);
		animation: bg-fade-2 6s linear infinite;
	}
}
@keyframes bg-fade-1 {
  0% {
    opacity: 1; }
  33% {
    opacity: 1; }
  66% {
    opacity: 0; }
  100% {
    opacity: 0; }
}
@keyframes bg-fade-2 {
  0% {
    opacity: 1; }
  33% {
    opacity: 0; }
  66% {
    opacity: 0; }
  100% {
    opacity: 1; }
}
    </style>
</head>
<body>
    <?php
            if(isset($_GET["respond"])){
                if(isset($_GET["respond"])=="already register ! please login"){
                    echo "<div class='alert alert-success' role='alert'>
                <ion-icon name='checkmark-done-circle-outline' style='border-radius: 0px;;margin-right: 10px;
                font-size: 25px;
                position: absolute;'>
                </ion-icon><strong style='padding-left: 30px;'>".htmlspecialchars($_GET["respond"],  ENT_QUOTES, 'UTF-8')."</strong>
                </div>";
                }else{
                    echo "<div class='alert alert-danger' role='alert'>
                    <ion-icon name='alert-circle-outline' style='border-radius: 0px;;margin-right: 10px;
                    font-size: 25px;
                    position: absolute;'>
                    </ion-icon><strong style='padding-left: 30px;'>".htmlspecialchars($_GET["respond"],  ENT_QUOTES, 'UTF-8')."</strong>
                    </div>";
                }
            }
                ?>
    <div class="container-lg row" style="margin: 0px;padding: 0px;width: 100%;max-width: 100%;">
        <div class="col" style="background-color: firebrick;background-image: linear-gradient(225deg,#960000,#b94a67);">
            <h6 style="margin: 50px;
    /* font-weight: 100; */
    color: #ffffff;
    text-align-last: center;
    margin-top: 40%;
    font-size: 40px;
    font-family: 'Poppins', sans-serif;"
   >Hi!</h6>

            <div class="container-sm"
                style="width: fit-content;margin: initial;margin-left: 50px;height: unset;color: #ffffff;">
                <!-- get from list -->
                <?php //include($_SERVER['DOCUMENT_ROOT']."/get/linesheet_download.php"); ?>
                    <!-- <h3>PRE-RELEASE<br>
                    <h6><strong>New Linesheet | Re-platform</strong></h6><br>
                    <h3><strong>SPEAR 2.0.0</strong></h3>
                    <strong>Feature available</strong>
                    <ul>
                        <li>Dynamic Linesheet</li>
                        <li>Size guide generator</li>
                        <li>Dimension guide generator</li>
                    </ul>
                    <button type="button" disabled class="btn btn-danger btn-sm">Download soon</button> -->
            </div>
        </div>
        <div class="col-4" style="height : 100vh;background-color:white;">
            <div class="container-sm ">
                <h2 class="header_form">
                    <strong>Login</strong>
                </h2>
                <form
                    action="/action/action_login.php?redirect=<?php echo htmlspecialchars($_GET["redirect"],  ENT_QUOTES, 'UTF-8'); ?>&id=<?php echo htmlspecialchars($_GET["id"],  ENT_QUOTES, 'UTF-8'); ?>"
                    method="POST">
                    <div class="form-group">
                        <div class="form-floating">
                            <input type="username" required="required" style="border-radius:10px" class="form-control form-control-sm"
                                id="username" name="username" placeholder="username">
                            <label for="floatingInput">Username</label>
                        </div><br>
                        <div class="form-floating ">
                            <input type="password" required="required" style="border-radius:10px" class="form-control form-control-sm"
                                id="password" name="password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button  type="submit" id="login_bt" class="btn btn-dark"
                            style="width:100%;margin-bottom:20px;margin-top:20px;background: #810000;border: solid 0px;">Login</button>
                        <a href="signup"  style="text-align: left!important;">signup</a>
                        <a href="reset_password"  style="text-align: left!important;">reset_password</a>
                    </div>
                </form>
                <div class="container" style="text-align:center">
                    <a href="signup" style="font-size:10px">Copyright @ Central Department Store - Digital Content</a>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- bootsrap js -->
<script>
function(event) {
    if (event.which == 13 || event.keyCode == 13) {
        $("#login_bt").click()
        return false;
    }
    return true;
};
</script>
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
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
    <title>Content and Studio - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" type="image/ocp" href="https://cdse-commercecontent.com/base/images/24ico.ico" />
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
    <style>
    body {
        background-image: url(base/image/11.jpg);
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
    </style>
</head>
<body>
    <?php
     session_start();
            if($_GET["respond"]<>""){
                if($_GET["respond"]=="already register ! please login"){
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
            <h6 style="margin: 50px;font-weight: 900;color: #f9fafb;">CONTENT SERVICE GATE</h6>
            <div class="container-sm"
                style="width: fit-content;margin: initial;margin-left: 50px;height: unset;color: #ffffff;">
                <!-- get from list -->
                <?php //include("get/linesheet_download.php"); ?>
                <div class="x_elementToProof">Hi All Service-Gate user,&nbsp;</div>
<div class="x_elementToProof">&nbsp;</div>
<div class="x_elementToProof">I'm writing this for notic everyone about the service-gate changing backend environments.</div>
<div class="x_elementToProof">&nbsp;</div>
<div class="x_elementToProof">According to current service will end of service at 23 Jan 2024. we have set up a new environment for the system and already do migrate any sturcture to the new environmnts.&nbsp;<strong><u>So the new service-gate will have the UI , any workflows , any data ticket same as current service-gate.</u></strong></div>
<div id="x_Signature">
<div>&nbsp;</div>
<div>however we have some change a bit on the system due to limitations of capacity of system. so you can find the detail of this at below.</div>
<div>&nbsp;</div>
<div><strong>Service Change :</strong></div>
<ul>
<li>
<div>New Url -&gt;&nbsp;&nbsp;&nbsp;<a id="OWA841cefb3-6506-40d7-3319-cfa9fed1566b" class="x_x_x_OWAAutoLink x_x_x_ContentPasted0 x_x_ContentPasted0" href="https://service-gate.infinityfreeapp.com/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" data-loopstyle="linkonly" data-linkindex="0">https://service-gate.infinityfreeapp.com/</a></div>
</li>
<li>
<div>Dark mode -&gt;&nbsp;&nbsp;<strong>Suspended</strong></div>
</li>
<li>
<div>Attachment files -&gt;&nbsp;<strong>Suspended</strong></div>
</li>
<li>
<div>Attachment images -&gt;&nbsp;<strong>Suspended</strong></div>
</li>
<li>
<div>Speed -&gt;&nbsp;<strong>lower than current</strong></div>
</li>
<li>
<div>Max connection for data query-&gt;<strong>&nbsp;lower than current (impact is dashboard not loading somtime)</strong></div>
</li>
</ul>
<div>So, for smoot transtion we will have the&nbsp;<strong><u>current system</u></strong><u>&nbsp;</u><strong><u>cut-off&nbsp; at 19 Jan 23 , 4:00 PM</u></strong><u>&nbsp;</u>for do some activity such as migrations to current data and change any configulation of 3<sup>rd</sup>&nbsp;party&nbsp;intregrations.</div>
<div>&nbsp;</div>
<div>and the&nbsp;<strong><u>new system will start using at 23 Jan 24 5:00 AM</u></strong></div>
<div><strong>&nbsp;</strong></div>
<div><strong>Concludtion :</strong></div>
<ul data-editing-info="{&quot;orderedStyleType&quot;:1,&quot;unorderedStyleType&quot;:2}">
<li>any data exclude attachments file and image has migration to the new system.</li>
<li>workflows not changing</li>
<li>the ticket that you open still there</li>
<li>any logs of activity still there</li>
<li>your account and line notifiction still there</li>
<li>
<div>you can use the current user and password to login new system</div>
</li>
<li>
<div>auto create ticket from email still there</div>
</li>
</ul>
<div>&nbsp;</div>
<p><strong>Best Regards,</strong><strong>&nbsp;</strong></p>
<div>Jaroonwit poolnai - bos</div>
</div>
            </div>
        </div>
        <div class="col-4" style="height : 100vh;background-color:white;">
            <div class="container-sm ">
                <h2 class="header_form">
                    <strong>Login</strong>
                </h2>
                <form
                    action="https://content-service-gate.cdse-commercecontent.com/base/action/action_login.php?redirect=<?php echo htmlspecialchars($_GET["redirect"],  ENT_QUOTES, 'UTF-8'); ?>&id=<?php echo htmlspecialchars($_GET["id"],  ENT_QUOTES, 'UTF-8'); ?>"
                    method="POST">
                    <div class="form-group">
                        <div class="form-floating">
                            <input type="username" required="required" class="form-control form-control-sm"
                                id="username" name="username" placeholder="username">
                            <label for="floatingInput">Username</label>
                        </div><br>
                        <div class="form-floating ">
                            <input type="password" required="required" class="form-control form-control-sm"
                                id="password" name="password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="login_bt" class="btn btn-dark"
                            style="width:100%;margin-bottom:20px;margin-top:20px;background: #810000;border: solid 0px;">Login</button>
                        <a href="signup" style="text-align: center!important;">Don't have an account - Sign up</a>
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

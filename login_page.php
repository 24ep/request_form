<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Content and Studio - Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="icon" type="image/ocp" href="https://cdse-commercecontent.com/base/images/24ico.ico" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- google fornt Quicksand -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap"
            rel="stylesheet">
        <!-- end google fornt -->
        <!-- Bootstrap css -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous">
        <!-- end Bootstrap css -->
         <!-- fornt -->
         <link rel="preconnect" href="https://fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
        <style>
            body {
                background-image: url(image/11.jpg);
                font-family: 'Prompt', sans-serif!important;
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
                margin-top: 8%;
                padding: 10px 50px 65px!important;
            }
        </style>
    </head>
    <body>
  
    <?php 
                                if($_GET["respond"]<>""){
                                    if($_GET["respond"]=="already register ! please login"){
                                        echo "<div class='alert alert-success' role='alert'>
                                    <ion-icon name='checkmark-done-circle-outline' style='border-radius: 0px;;margin-right: 10px;
                                    font-size: 25px;
                                    position: absolute;'>
                                    </ion-icon><strong style='padding-left: 30px;'>".$_GET["respond"]."</strong>
                                    </div>";
                                    }else{
                                        echo "<div class='alert alert-danger' role='alert'>
                                        <ion-icon name='alert-circle-outline' style='border-radius: 0px;;margin-right: 10px;
                                        font-size: 25px;
                                        position: absolute;'>
                                        </ion-icon><strong style='padding-left: 30px;'>".$_GET["respond"]."</strong>
                                        </div>";
                                    }
                                }
                ?>
        <div class="container-sm shadow p p-3 mb-5 bg-white rounded">
        <div class="row">
       
            <div class="col">
                <!-- get from list -->

                <?php
                   
                // $con= mysqli_connect("localhost","cdse_content","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
                // mysqli_query($con, "SET NAMES 'utf8' ");
            
                //     $id = $_POST["id"];
                //     $sql="SELECT * FROM file_manage WHERE job_number='LACF-INDEX' and file_type='Linesheet' and upload_status='Active'";

                //     $results = mysqli_query($con,$sql);
                //     if(mysqli_num_rows($results)==1){

                //         $row = mysqli_fetch_array($results);
                //     }

                //     echo '
                //     <h3 style="margin-bottom: px; ">'.$row["file_name"].'</h3>
                //     <div class="log_file" style="font-size: 13px!important; width: 300px;">
                //     <p >'.$row["remark"].'</p>
                //     <p style="font-size: 12px;"> <strong>Last Update '.date("Y-m-d H:i:s", strtotime($row["update_at"])).'</strong> </p>
                //     </div>
                //     <a  href="https://cdse-commercecontent.com/base/'.$row["file_path"].$row["file_name"].'" >
                //         <button type="button" class="btn btn-outline-dark">Download</button>
                //     </a>
                //         ';

                ?>
                <!-- end -->
            </div>
            <div class="col">
        <div class="row">
        <div class="col">
                <h2 class="header_form">
                    <strong>Login</strong>
                </h2>
                <form action="https://content-service-gate.cdse-commercecontent.com/base/action/action_login.php" method="POST">
                    <div class="form-group">
                        <div class="form-floating">
                            <input
                                type="username"
                                required="required"
                                class="form-control form-control-sm"
                                id="username"
                                name="username"
                                placeholder="username">
                            <label for="floatingInput">Username</label>
                        </div><br>
                        <div class="form-floating ">
                            <input
                                type="password"
                                required="required"
                                class="form-control form-control-sm"
                                id="password"
                                name="password"
                                placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="login_bt" class="btn btn-dark" style="width:100%;margin-bottom:20px;margin-top:20px">Login</button>
                        <a href="signup" style="text-align: center!important;">Don't have an account - Sign up</a>
                    </div>
                    </form>
            </div>
            </div>
            </div>
            </div>
        </div>
    <div class="container" style="text-align:center">
        <a href="signup" style="font-size:10px">Copyright @ Central Department Store - Digital Content</a>
    </div>
</body>
<!-- bootsrap js -->
<script>
function (event) {
    if (event.which == 13 || event.keyCode == 13) {
        $("#login_bt").click()
        return false;
    }
    return true;
};
</script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<!-- end bootsrap js -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>
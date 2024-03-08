<?php
//check verified_code is exist
 $con= mysqli_connect("service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT verified_code FROM all_in_one_project.account";
$result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch and process the data
  
    $check =  "exist-verify_code";
} else {
    // No data
    $check =  "non-exist-verify_code";
    header("Location: /?");

}

// Close the database connection
mysqli_close($con);

$check =  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>Content and Studio - Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- google font Quicksand -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <!-- end google font -->
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- end Bootstrap css -->
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/action/notiflix/dist/notiflix-3.2.5.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
    
    <style>
    body {
        background-image: url(image/11.jpg);
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
<body>
    <div class="container-sm">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input disable type="text" value="<?php echo $_GET['email']; ?>" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">New password</label>
            <input type="password" class="form-control" id="password" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="confirm_password" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary" onclick="update_new_password()">Submit</button>
    </div>

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-fTnAisiE51sXgj7GBnZaAT0s9IxpZjq5P2LIzSNcFfFA3B3At9U0XJktOM0nF8yA"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <!-- end Bootstrap js -->

    <script>
    function update_new_password() {
        Notiflix.Loading.hourglass('Loading...');
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm_password').value;
        if (confirm_password == password) {
            $.post("/action/action_update_password.php", {
                email:email,
                password: password
            }, function (data) {
                if(data=='password-changed'){
                    Notiflix.Loading.remove();
                    Notiflix.Report.success(
                    'Password changed',
                    'Your password was changed, please try to login again',
                    'Back to login page',
                    function cb() {
                        window.location.href = "/";
                    },
                );
                }else{
                    Notiflix.Loading.remove();
                    Notiflix.Report.failure(
                        'Error',
                        'Something wrong, please contact your administrator',
                        'Okay'
                    );
                }
               
            });
        } else {
            Notiflix.Loading.remove();
            Notiflix.Report.failure(
                'Your password mismatch',
                'Your password mismatch between new password and confirm, please make sure your password is correct',
                'try again',
               
            );
        }
    }
    </script>
</body>
</html>

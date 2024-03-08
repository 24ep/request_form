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
    <link rel="stylesheet" href="/action/notiflix/dist/notiflix-3.2.5.min.css" />

    <script src="/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
    <style>
    body {
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
<div class="container-sm p-5">
  <div class="mb-3">
    <h3>Reset password</h3>
    <hr>
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll send you specific reset password link to you email.</div>
  </div>
  <button type="submit" class="btn btn-primary" onclick="check_exist_email()">Submit</button>
</div>
<body>

</body>
<!-- bootsrap js -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script> -->
<!-- end bootstrap js -->

 <script>
function check_exist_email() {
    Notiflix.Loading.hourglass('Loading...');
    var email = document.getElementById('emailInput').value;
    $.post("/action/action_check_exist_email.php", {
        email: email
    }, function (data) {
        if (data == 'non-exist-email') {
            Notiflix.Loading.remove();
            Notiflix.Report.failure(
                    'not found your email',
                    'not found your email, if you never have an access please register first',
                    'Back to login page'
                );
  
        } else {
            $.post("/action/action_reset_password_send_mail.php", {
                email: email
            }, function (data) {
                Notiflix.Loading.remove();
                Notiflix.Report.success(
                    'Check your inbox',
                    'the email was send , please check on your inbox and click the link to reset password',
                    'Back to login page'
                );
                window.location.href = "/"; // Change to navigate to the login page
            }); // <-- Missing closing parenthesis here
        }
    });
}

 
</script>

</html>

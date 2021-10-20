<?php

// $pictureUrl = $_POST["pictureUrl"];
// $userId = $_POST["userId"];
// $displayName = $_POST["displayName"];

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    <title>Content Service Gate | Profile</title>
    <style>
    /* #pictureUrl { } */
    body {
        font-family: 'Prompt', sans-serif;
    }

    .form-label {
        margin-bottom: .5rem;
        font-weight: 600;
        font-size: smaller;
    }

    .form-floating>.form-control {
        font-weight: 600;
    }

    .form-floating {
        font-size: small;
        ;
        font-weight: 600;
    }
    </style>
</head>

<body id="body">
    <div style="  height: 200px;
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        text-align: center;
        margin-top: -100px;
        margin-left: -200px;">
        <h6><strong>
        <ion-icon name="alert-circle-outline"></ion-icon>คุณยังไม่เคยลงทะเบียน !
            </strong></h6>
        <p>กรุณาลงทะเบียนสำหรับใช้งานในครั้งแรงที่ปุ่มด้านล่างนี้</p>
        <a href="https://content-service-gate.cdsecommercecontent.ga/line_api/register/form/promt_already_user.php" class="btn btn-dark">ลงทะเบียน</a>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
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

<body>
    <div class="container-sm" style="margin-top:5px">
        <!-- <small style="font-size: 12px;color: #a1a1a1;">เก็บข้อมูลเพื่อความความสะดวกในการประสานงาน คุณยังสามารถแก้ไขข้อมูลดังกล่าวได้ภายหลัง</small> -->
        <p id="userId" style="font-size: 10px;color: #a1a1a1;"></p>
        <hr>
        <!-- <img id="pictureUrl" class="rounded-circle shadow p-1 mb-3 bg-body" width="15%" alt="image-profile"> -->
        <!-- <strong id="displayName_show" style="margin-left: 20px;font-size: 35;"></strong> -->
        <!-- <img id="pictureUrl" width="25%"> -->
        <!-- <p id="displayName"></p> -->
        <!-- <p id="statusMessage"></p>
  <p id="getDecodedIDToken"></p> -->
        <!-- confirm input -->
        <div class="d-grid gap-2">
            <a class="btn btn-dark" href="new_confirm_form.php" type="button">ยังไม่เคยมี user content-service-gate</a>
            <a class="btn btn-dark" href="sync_confirm_form.php" type="button">มี user อยู่แล้ว</a>
        </div>
    </div>
    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
    function runApp() {
        liff.getProfile().then(profile => {
            // document.getElementById("pictureUrl").src = profile.pictureUrl;
            document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
            // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
            // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
            // document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
            // document.getElementById("displayName").value = profile.displayName;
            // document.getElementById("displayName_show").innerHTML =  profile.displayName;
        }).catch(err => console.error(err));
    }
    liff.init({
        liffId: "1656539537-YZJQ28wR"
    }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
  <title>Content Service Gate | Profile</title>
  <style>
    /* #pictureUrl { } */
    body{
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
      font-size: small;;
    font-weight: 600;
}
  </style>
</head>
<body id="body">
<div class="container-sm" style="margin-top:5px">
  <small style="font-size: 12px;color: #a1a1a1;">เก็บข้อมูลเพื่อความความสะดวกในการประสานงาน คุณยังสามารถแก้ไขข้อมูลดังกล่าวได้ภายหลัง</small>
  <p id="userId" style="font-size: 10px;color: #a1a1a1;"></p>
  <hr>
  <img id="pictureUrl" class="rounded-circle shadow p-1 mb-3 bg-body" width="15%"  alt="image-profile">
  <!-- <strong id="displayName_show" style="margin-left: 20px;font-size: 35;"></strong> -->
  <!-- <img id="pictureUrl" width="25%"> -->
  <!-- <p id="displayName"></p> -->
  <!-- <p id="statusMessage"></p>
  <p id="getDecodedIDToken"></p> -->
<!-- confirm input -->

  <input type="hidden" id="userId_value" placeholder="Type to search...">
  <input type="hidden" id="pictureUrl" placeholder="Type to search...">
  <div class="form-floating mb-2">
    <input type="text" class="form-control form-control-sm" id="username_create" placeholder="name@example.com">
    <label for="floatingInput">ชื่อที่ใช้ติดต่อ</label>
  </div>
  <div class="form-floating mb-2">
    <input type="text" class="form-control form-control-sm" id="tell_create" placeholder="name@example.com">
    <label for="floatingInput">เบอร์โทรศัพท์ที่สามารถติดต่อได้</label>
  </div>
  <div class="form-floating mb-2">
    <input type="text" class="form-control form-control-sm" id="dept_create" placeholder="name@example.com">
    <label for="floatingInput">แผนก</label>
  </div>
  <div class="d-grid gap-2">
  <button class="btn btn-primary" onclick="account_create()" type="button">ยืนยัน</button>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
  <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
  <script>
    function runApp() {
      liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
        document.getElementById("userId_value").value = profile.userId;
        // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
        // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
        // document.getElementById("tell_create").value = liff.getDecodedIDToken().phone_number;
        document.getElementById("username_create").value =  profile.displayName;
        
        // document.getElementById("displayName_show").innerHTML =  profile.displayName;
      }).catch(err => console.error(err));
    }
    liff.init({ liffId: "1656539537-AvYwK6yR" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


  </script>
  
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<script>
 function account_create() {
    var username = document.getElementById("username_create").value;
    var tell = document.getElementById("tell_create").value;
    var dept = document.getElementById("dept_create").value;
    var user_id = document.getElementById("userId_value").value;
    var pictureUrl = document.getElementById("pictureUrl").value;
        $.post("https://content-service-gate.cdsecommercecontent.ga/line_api/register/action/create_action_csg.php", {
            username: username,
            tell: tell,
            dept: dept,
            user_id: user_id,
            pictureUrl:pictureUrl
        }, function(data) {
            $('#body').html(data);
        });
    
  }
</script>

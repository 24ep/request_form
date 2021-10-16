
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Content Service Gate | Profile</title>
  <style>
    #pictureUrl { display: block; margin: 0 auto }
  </style>
</head>
<body>
  <img id="pictureUrl" class="rounded-circle shadow p-3 mb-5 bg-body" alt="image-profile">
  <!-- <img id="pictureUrl" width="25%"> -->
  <p id="userId"></p>
  <!-- <p id="displayName"></p> -->
  <p id="statusMessage"></p>
  <p id="getDecodedIDToken"></p>
<!-- confirm input -->
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name</label>
    <input type="email" class="form-control" id="displayName" placeholder="" value="">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Tell</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="เบอร์ทรศัพท์ที่สามารถติดต่อได้" value="">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Department</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="" value="">
  </div>
  <button class="btn btn-primary" type="button">Confirm</button>
  <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
  <script>
    function runApp() {
      liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
        document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
        document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
        document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;

        document.getElementById("displayName").value =  profile.displayName;
      }).catch(err => console.error(err));
    }
    liff.init({ liffId: "1656539537-YZJQ28wR" }, () => {
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

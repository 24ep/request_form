<script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
    function runApp() {
        liff.getProfile().then(profile => {
            // document.getElementById("pictureUrl").src = profile.pictureUrl;
            // document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
            // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
            // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
            // document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
            // document.getElementById("displayName").value = profile.displayName;
            // document.getElementById("displayName_show").innerHTML =  profile.displayName;
            // send var -----------------------
            var pictureUrl = document.getElementById("pictureUrl").value;
            var userId = document.getElementById("userId").value;
            var displayName = document.getElementById("displayName").value;
            $.post("https://content-service-gate.cdsecommercecontent.ga/line_api/register/action/check_active_user.php", {
                pictureUrl: pictureUrl,
                userId: userId,
                displayName: displayName
            }, function(data) {
                // $('#body').html(data);
                var response = data;
                if(response=="active"){
                    location.href = 'https://content-service-gate.cdsecommercecontent.ga/line_api/register/form/conent_request_form.php';
                }else{
                    location.href = 'https://content-service-gate.cdsecommercecontent.ga/line_api/register/form/page_inactive_user.php';
                }
            });
        
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
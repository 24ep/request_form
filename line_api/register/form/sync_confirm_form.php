<?php
function getoption_return_filter($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
// split array store
        if($sorm=="multi"){
            if($col=="store" or $col=="itemmize_type" or $col=="product_website"){
            $array_store = explode(', ', $select_option);
            $duplicate_op = false;
            $loop_in_null = false;
            foreach($array_store as $store)
            {
                if($row[$col] <> '' ) {
                if($store==$row[$col]){
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                    $duplicate_op = true;
                }
                }
            }
            if($row[$col] <> ''){
                if($duplicate_op == false){
                $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                }
            }
            }
        }else{
            if($loop_in_null==false){
            $option_set .= '<option value=""></option>';
            $loop_in_null=true;
            }
            if($row[$col] <> '' )
            {

                if($select_option==$row[$col]){
                    if($col=="username"){
                        $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";

                    }else{
                        $op_label = $row[$col];

                    }
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$op_label.'</option>';
                }else{
                    if($col=="username"){
                        $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";

                    }else{
                        $op_label = $row[$col];

                    }
                    $option_set .= '<option value="'.$row[$col].'">'.$op_label.'</option>';
                }
            }
    }
    }
    return $option_set;
    mysqli_close($con);
    }

    $username_op = getoption_return_filter("username","account","","single","all_in_one_project");

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
        <input type="hidden" id="userId_value" placeholder="Type to search...">
        <input type="hidden" id="pictureUrl" placeholder="Type to search...">
        
        <label for="exampleDataList" class="form-label">Username</label>
            <input class="form-control" list="username_list" id="username" placeholder="Type to search...">
            <datalist id="username_list">
                <?php echo  $username_op; ?>
            </datalist>
        <button class="btn btn-success" onclick="account_update_user_id()" type="button"><ion-icon name="checkmark-done-outline"></ion-icon>ยืนยัน</button>
        </div>
    </div>
    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
    function runApp() {
        liff.getProfile().then(profile => {
            // document.getElementById("pictureUrl").src = profile.pictureUrl;
            document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
            document.getElementById("userId_value").value =  profile.userId;
            // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
            // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
            // document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
            document.getElementById("pictureUrl").value = profile.pictureUrl;
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
</body>

</html>
<script>
function account_update_user_id() {
    var username = document.getElementById("username").value;
    var attribute_update_value = document.getElementById("userId_value").value;
    var attribute_update_name = "line_user_id";
    var pictureUrl = document.getElementById("pictureUrl").value;

        $.post("https://content-service-gate.cdsecommercecontent.ga/line_api/register/action/update_account_detail.php", {
            username: username,
            attribute_update_value: attribute_update_value,
            attribute_update_name: attribute_update_name,
            pictureUrl:pictureUrl
            
        }, function(data) {
            $('#body').html(data);
        });
    
}
</script>

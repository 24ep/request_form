


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
    /* input[type="file"] {
    display: none;
} */
    </style>
</head>

<body>
    <div class="container-sm" style="margin-top:5px">
<?php 
$ticket_id=$_GET["id"];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set("Asia/Bangkok");
    $sql = "SELECT id,status,description,create_date,update_date from content_request 
    WHERE id=".$ticket_id;
    $query  = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($query)) {
        $ticket_status = $row["status"];
        $ticket_detail = $row["description"];
        $create_date = $row["create_date"];
        $update_date = $row["update_date"];
    }


?>
        <!-- <p id="userId" style="font-size: 10px;color: #a1a1a1;"></p>
        <hr> -->
        <!-- form start ---------------- -->
        <h5><strong>CR-<?php echo $ticket_id; ?></strong></h5>
        <h6><strong><?php echo $ticket_status; ?></strong></h6>
        <p><?php echo $ticket_detail; ?></p>
        <small>Create date: <?php echo $create_date; ?></small><br>
        <small>Update date: <?php echo $update_date; ?></small><br>

        <?php
        function get_attachment_cr($id){
            $list_attachment ="";
            date_default_timezone_set("Asia/Bangkok");
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image<>1 ORDER BY id ASC" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            $list_attachment .=  '<small style="display:block;margin-bottom:3px"><strong style="color:gray">Attchment</strong></small>
            <ul class="list-group ">';
              while($row = mysqli_fetch_array($result)) {
                $herf = str_replace("../..",'../..',$row['file_path'].$row['file_name']);
                $list_attachment.=  ' <li class="list-group-item d-flex justify-content-between align-items-left">
                <div><ion-icon name="document-attach-outline"></ion-icon>'.$row["file_name"].'</div>
                <a href="'.$herf.'" download="'.$row['file_name'].'"><ion-icon name="cloud-download-outline" style="color:blue"></ion-icon></a>
                </li>';
                $pass = true;
              }
              $list_attachment.= '</ul>';
              if(!isset($pass)){$pass=false;}
              if($pass==true){
                return $list_attachment;
              }else{
                return '<small><strong style="color:gray">No attachment</strong></small>';
              }
          }
        function get_image_cr($id){
            $list_image="";
            date_default_timezone_set("Asia/Bangkok");
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image=1 ORDER BY id ASC" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            if(isset($list_image)){$list_image.= '<div class="row">';}else{$list_image= '<div class="row">';}
            
            while($row = mysqli_fetch_array($result)) {
                $herf = str_replace("../..",'../..',$row['file_path'].$row['file_name']);
                $list_image.=  ' <div class="col-md"><div class="thumbnail">
                <a href="'.$herf .'" target="_blank">
                <figure class="figure">
                <img src="'.$herf .'" class="img-thumbnail img-fluid" alt="'.$row["file_name"].'  " style="object-fit:cover;width:180px;height:180px;">
                <figcaption class="figure-caption text-end">'.$row["file_name"].'</figcaption></a></div></div>';
            }
            $list_image.= '</div>';
                return $list_image;
        }
        $list_attachment = get_attachment_cr($ticket_id);
        $img =  get_image_cr($ticket_id);
        echo $list_attachment;
        echo $img;
        

        ?>
        <!-- form end ---------------- -->
    </div>
    <!-- <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script> -->
    <script>
    // function runApp() {
    //     liff.getProfile().then(profile => {
    //         // document.getElementById("pictureUrl").src = profile.pictureUrl;
    //         document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
    //         // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
    //         // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
    //         // document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
    //         // document.getElementById("displayName").value = profile.displayName;
    //         // document.getElementById("displayName_show").innerHTML =  profile.displayName;
    //         // document.getElementById("userId_value").value = profile.userId;
            
    //     }).catch(err => console.error(err));
    // }
    // liff.init({
    //     liffId: "1656539537-Qa43dpkM"
    // }, () => {
    //     if (liff.isLoggedIn()) {
    //         runApp()
    //     } else {
    //         liff.login();
    //     }
    // }, err => console.error(err.code, error.message));
     </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<script>
var actualBtn_meq = document.getElementById('actual-btn_meq');
var fileChosen_meq = document.getElementById('file-chosen_meq');
var fileChosen_bt_meq = document.getElementById('label_file_meq');
actualBtn_meq.addEventListener('change', function() {
    // fileChosen.textContent = this.files[0].name
    count_file_meq = this.files.length;
    var i_meq;
    var file_name_meq;
    for (i_meq = 0; i_meq < count_file_meq; i_meq++) {
        if (i_meq == 0) {
            file_name_meq = this.files[i_meq].name;
        } else {
            file_name_meq += " , " + this.files[i_meq].name;
        }
    }
    if (file_name_meq == "undefined") {
        fileChosen_bt_meq.textContent = "ถ่ายภาพ หรือ เลือกไฟล์";
    }
    fileChosen_bt_meq.textContent = count_file_meq + " ไฟล์ : " + file_name_meq;
    fileChosen_bt_meq.textContent = count_file_meq + " ไฟล์ : " + file_name_meq;
})

function create_ticket(){

    var form_data = new FormData();
    var detail_request = document.getElementById("detail_request").value;
    var priority = document.getElementById("priority").value;
    var userId = document.getElementById("userId_value").value;
    document.getElementById('detail_request').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var meq = document.getElementById('actual-btn_meq').files.length;
    for (var i = 0; i < meq; i++) {
        form_data.append("files_meq[]", document.getElementById('actual-btn_meq').files[i]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("detail_request", detail_request) // Adding extra parameters to form_data
    form_data.append("priority", priority)
    form_data.append("userId", userId)
    
    $.ajax({
        url: "https://content-service-gate.cdse-commercecontent.com/base/line_api/register/action/create_cr_ticket.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            // $('#call_ticket_comment').html(data);
            // document.getElementById('comment_box').scrollBy(0, document.getElementById(
            //     "call_ticket_comment").offsetHeight);
            // document.getElementById('actual-btn_cme').value = ''; //clear value
            // fileChosen_bt_cme.innerHTML = '<ion-icon style="margin:0px" name="attach-outline"></ion-icon>';
            alert(data);
        }
    });



}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
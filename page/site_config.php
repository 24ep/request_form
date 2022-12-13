<?php
$assigned_log_id = $_POST["id"];
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

//get column 

    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $table = 'job_attribute';
    $query = "SELECT `COLUMN_NAME` 
    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    WHERE `TABLE_SCHEMA`='u749625779_cdscontent' 
        AND `TABLE_NAME`='".$table."';" or die("Error:" . mysqli_error());
    $result =  mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        $th .= '<th scope="col">'.$row['COLUMN_NAME'].'</th>';
    }


//get table 1 

//get table
$query = "SELECT *
FROM u749625779_cdscontent.".$table.";" or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
echo '<table class="table table-bordered">
<thead>
    <tr>
      '.$th.'
    </tr>
</thead>
<tbody>';
while($row = mysqli_fetch_array($result)) {
   echo '<tr>';
          

   $query_col = "SELECT `COLUMN_NAME` 
   FROM `INFORMATION_SCHEMA`.`COLUMNS` 
   WHERE `TABLE_SCHEMA`='u749625779_cdscontent' 
       AND `TABLE_NAME`='".$table."';" or die("Error:" . mysqli_error());
   $result_col =  mysqli_query($con, $query_col);
   while($row_col = mysqli_fetch_array($result_col)) {
    
       echo '
       <td>
        <input class="form-control" 
                type="text" 
                id="'.$row_col['COLUMN_NAME'].'" 
                name="'.$row_col['COLUMN_NAME'].'" 
                value="'.$row_col[$row['COLUMN_NAME']].'">
        </td>';
   }

           
         
            // <td><button type="button" onclick="update_user_info('.$row["id"].')" class="btn btn-primary">update</button></td>
            // <td><div id="info_updated_'.$row["id"].'"></div></td>

    echo'</tr>';
}
 echo ' </tbody>
 </table>
 
 ';

mysqli_close($con);



?>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
<script>

function update_user_info(id) {
    var id = id;
    var nickname_24ep = document.getElementById("nickname_24ep_"+id).value;  
    var username_csg = document.getElementById("username_csg_"+id).value;  
    var position = document.getElementById("position_"+id).value;  
    var nickname = document.getElementById("nickname_"+id).value;  
    var status = document.getElementById("status_"+id).value;  
    var project_team = document.getElementById("project_team_"+id).value;  
    var dept_team = document.getElementById("dept_team_"+id).value;  
    var role_team = document.getElementById("role_team_"+id).value;   
    if (id) {
        $.post("https://cdse-commercecontent.com/auto_assign/interface/action/action_update_user_info.php", {
            id: id,
            nickname_24ep:nickname_24ep,
            username_csg:username_csg,
            position:position,
            nickname:nickname,
            status:status,
            project_team:project_team,
            dept_team:dept_team,
            role_team:role_team
        }, function(data) {
            $('#info_updated_'+id).html(data);
        });
    }
}




</script>
<?php
$database = $_POST['database'];
$table = $_POST['table'];
$primary_key_id = $_POST['primary_key_id'];
$id = $_POST['id'];
$ticket_type = $_POST['ticket_type'];
$nickname = "System";
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

$query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."'" or die("Error:" . mysqli_error($con));

$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $query_column = "SELECT `COLUMN_NAME`
    FROM `INFORMATION_SCHEMA`.`COLUMNS`
    WHERE `TABLE_SCHEMA`='".$database."'
        AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
    $result_column = mysqli_query($con, $query_column);
    $comment .= "{snapshot}{add_new_job} </br>";
    while($row_column = mysqli_fetch_array($result_column)) {
        if($row[$row_column['COLUMN_NAME']] <> null){
            $comment .= $row_column['COLUMN_NAME']." = ".$row[$row_column['COLUMN_NAME']]."</br>";
        }

    }
}

//insert to comment
$sql = "INSERT INTO all_in_one_project.log (
      action_data_id,
      action,
      action_table,
      action_by
    )
      VALUES(
        ".$id.",
        '".$comment."',
        '".$ticket_type."',
        '".$nickname."'
      )";
      $query = mysqli_query($con,$sql);

      // mysqli_close($con);
      if($query){
        echo "Snapshort ID:".$id ;
      }else{
        echo "Error: error Snapshot ID:".$id."$con->error";
      }

?>
<!-- get accout informations -->

<?php
   $database = 'all_in_one_project';
   $table = 'account';
   $primary_key_id = 'username';
   $id=$_SESSION['uesrname'];
   $prefix_table = 'ac';
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));

      $query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = ".$id or die("Error:" . mysqli_error($con));
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
          $query_column = "SELECT `COLUMN_NAME` 
          FROM `INFORMATION_SCHEMA`.`COLUMNS` 
          WHERE `TABLE_SCHEMA`='".$database."' 
              AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
          $result_column = mysqli_query($con, $query_column);
          while($row_column = mysqli_fetch_array($result_column)) {
              ${$prefix_table."_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
          }
      }
?>


<nav class="navbar fixed-top navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php echo $ac_firstname." ".$ac_lastname; ?></a>
  </div>
</nav>
<?php
session_start();

date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","taxonomy") or die("Error: " . mysqli_error($con));

$query = "
SELECT tr.* FROM taxonomy.taxonomy_raw_f2 as tr
where ( tr.status = 'WAITING FOR QC' and tr.priority in ('P1','P2','P3','P4') and tr.already_qc = 'N' and (tr.check_by ='' or tr.check_by ='".$_SESSION['username']."'))
order by tr.priority , tr.brand , tr.new_cate DESC limit 1" or die("Error:" . mysqli_error($con));

$result = mysqli_query($con, $query);

if ($result === false) {
    die("Error: " . mysqli_error($con));
}


while($row = mysqli_fetch_array($result)) {
    echo $row['sku'];

}
?>
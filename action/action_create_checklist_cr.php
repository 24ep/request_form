<?php
session_start();
  $ticket_id = $_POST["id"];
  $sku = $_POST["sku"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO checklist_of_content_request (ticket_id,sku
    )
	VALUES (
    ".$ticket_id.",
    ".$sku."
    )";
	$query = mysqli_query($con,$sql);
    // mysqli_close($con);
    // echo $_SERVER['DOCUMENT_ROOT'].'/get/get_checklist_cr.php?id='.$ticket_id.'&department='.$_SESSION["department"];



?>
<script>

var department =  "<?php echo $_SESSION["department"]; ?>";
var id =  "<?php echo $ticket_id; ?>";

if (id) {
    $.post("/get/get_checklist_cr.php", {
            id: id,
            department: department
      },
        function(data) {
            $('#checklist_box').html(data);
        });
}

</script>

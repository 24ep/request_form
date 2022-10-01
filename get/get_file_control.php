
<?php session_start();?>
<input type="file" class="filepond"  id="files" name="files[]">
<script>
FilePond.parse(document.body);
FilePond.setOptions({
    allowDrop: true,
    allowReplace: true,
    instantUpload: true,
    allowReoder: true,
    allowMultiple: true,
    allowRemove: true,
    maxFiles: 5,
    name:'files[]',
    maxFiles: '2MB',
    server: {
        url: 'https://content-service-gate.cdse-commercecontent.com/',
        process: 'base/action/action_upload_files.php?id='+<?php echo $_POST['id']; ?>,
        // revert: './revert.php',
        // restore: './restore.php?id=',
        // fetch: './fetch.php?data=',
    },
});

</script>
<?php
include("./connect.php");
//get list file attachment
$query = "SELECT * FROM all_in_one_project.attachment  WHERE ticket_type = 'ticket_files' and ticket_id = ".$_POST['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
  echo '<ul class="list-group list-group-flush">';
    while($row = mysqli_fetch_array($result)) {
        echo '<li class="list-group-item"> <ion-icon name="document-outline"></ion-icon><span>'.$row['file_name'].'</span><span class="badge rounded-pill bg-primary">'.$row['file_group'].'</span><ion-icon name="cloud-download-outline"></ion-icon></li>';
    }
  echo '</ul>';
?>
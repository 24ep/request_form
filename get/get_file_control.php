
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
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
//get list file attachment
$query = "SELECT * FROM all_in_one_project.attachment  WHERE ticket_type = 'ticket_files' and ticket_id = ".$_POST['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
  echo '<ul class="list-group list-group-flush">';
    while($row = mysqli_fetch_array($result)) {
        echo '
        <li class="list-group-item p-2 bg-dark bg-gradient text-white rounded shadow-sm"> 
            <ion-icon name="document-outline"></ion-icon>
            <span>'.$row['file_name'].'</span>
            <span class="badge rounded-pill bg-primary">'.$row['file_group'].'</span>
            <a type="button" href="'.$row['file_path'].'"><ion-icon name="cloud-download-outline" style="right: 10px;position: absolute;top: 12px;"></ion-icon></a>
        </li>';
    }
  echo '</ul>';
?>

<?php session_start();?>
<input type="file" class="filepond"  id="files" name="files">
<script>
FilePond.parse(document.body);
FilePond.setOptions({
    allowDrop: true,
    allowReplace: true,
    instantUpload: false,
    allowReoder: true,
    allowMultiple: false,
    allowRemove: true,
    maxFiles: 5,
    name:'files',
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
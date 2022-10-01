<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<!-- <span>Please select file type<span>
<select class="form-select" aria-label="file_type">
  <option value="original" selected>Original</option>
  <option value="cleaned">Cleaned</option>
  <option value="template">Template</option>
  <option value="other">Other</option>
</select>
<div class="form-floating">
  <textarea class="form-control" placeholder="Leave a remark here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Remark</label>
</div> -->
<input type="file" class="filepond"  name="filepond">
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
    maxFiles: '2MB',
    server: {
        url: 'http://content-service-gate.cdse-commercecontent.com/',
        process: 'base/action/action_upload_files.php?id='+$_POST['id'],
        // revert: './revert.php',
        // restore: './restore.php?id=',
        // fetch: './fetch.php?data=',
    },
});


</script>
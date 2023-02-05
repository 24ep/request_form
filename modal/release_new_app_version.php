<input type="file" class="filepond" data-max-file-size="2MB"  id="files" name="files[]">
<script>
FilePond.parse(document.body);
FilePond.setOptions({
    allowDrop: true,
    allowReplace: true,
    instantUpload: true,
    allowReoder: true,
    allowMultiple: false,
    allowRemove: true,
    maxFiles: 5,
    name:'files[]',
    maxFileSize:'2MB',
    server: {
        url: 'https://content-service-gate.cdse-commercecontent.com/',
        process: 'base/action/action_upload_files.php'
    },
});
</script>

<div class="form-floating mb-3">
  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
    <option value="major_change" selected>Major Change - changed core</option>
    <option value="minor_change">Minor change - add new function</option>
    <option value="bug_fix">Bug fixed / add option / add attribute</option>
  </select>
  <label for="floatingSelect">Version update</label>
</div>

<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Leave a comment here" id="change_log" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Change log</label>
</div>

<button type="button" class="btn btn-primary">Release</button>


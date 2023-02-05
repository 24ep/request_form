

<div class="form-floating mb-3">
  <select class="form-select" onchange="enable_upload_files()" id="version_update" aria-label="Floating label select example">
  <option value="bug_fix" selected>Bug fixed / add option / add attribute</option>
    <option value="major_change">Major Change - changed core</option>
    <option value="minor_change">Minor change - add new function</option>

  </select>
  <label for="floatingSelect">Version update</label>
</div>

<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Leave a comment here" id="change_log" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Change log</label>
</div>

<input type="file" class="filepond" data-max-file-size="2MB"  id="files" name="files[]">
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
    name:'files[]',
    maxFileSize:'2MB',
    server: {
        url: 'https://content-service-gate.cdse-commercecontent.com/',
        process: 'base/action/action_upload_files.php'
    },
});

document.getElementById('files').hidden = false;
function enable_upload_files(){
    if(document.getElementById('version_update').value == 'major_change' || document.getElementById('version_update').value == 'minor_change'){
        document.getElementById('files').hidden = false;
    }else{
        document.getElementById('files').hidden = true;
    }

}

</script>

<button type="button" class="btn btn-primary">Release</button>


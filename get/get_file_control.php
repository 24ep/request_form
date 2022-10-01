<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond"  >
    <script>
  FilePond.parse(document.body);
  FilePond.setOptions({
    allowDrop: true,
    allowReplace: true,
    instantUpload: false,
    allowReoder:true,
    allowMultiple:true,
    allowRemove:true,
    maxFiles:5,
    maxFiles:'2MB',
    server: {
        url: 'http://156.67.217.3',
        process: './action_upload_files.php',
        // revert: './revert.php',
        // restore: './restore.php?id=',
        // fetch: './fetch.php?data=',
    },
});
  </script>
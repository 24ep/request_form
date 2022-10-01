<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB"
    data-max-files="3">

    <script>
  FilePond.parse(document.body);
  </script>
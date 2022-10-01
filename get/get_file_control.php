<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" allowProcess="true" allowRemove="true" data-max-file-size="2MB"
    data-max-files="5">

    <script>
  FilePond.parse(document.body);
  </script>
<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="2MB"
    data-max-files="3">

    <script>
//   FilePond.parse(document.body);
  FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginImageExifOrientation,
  FilePondPluginFileValidateSize,
  FilePondPluginImageEdit
);

// Select the file input and use 
// create() to turn it into a pond
FilePond.create(
  document.querySelector('input')
);
  </script>
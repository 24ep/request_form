<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<!-- <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="2MB"
    data-max-files="5"> -->

    <!-- <script>
  FilePond.parse(document.body);
//   FilePond.registerPlugin(
//   FilePondPluginImagePreview,
//   FilePondPluginImageExifOrientation,
//   FilePondPluginFileValidateSize,
//   FilePondPluginImageEdit
// );


  </script> -->
  <input type="file" />

<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
</script>
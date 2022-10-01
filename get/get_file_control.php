<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB"
    data-max-files="3">

<script>
// Get a reference to the file input element
const inputElement = document.querySelector('input[type="file"]');

// Create a FilePond instance
const pond = FilePond.create(inputElement);
</script>
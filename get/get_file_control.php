<!--
The classic file input element we'll enhance
to a file pond, configured with attributes
-->
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="2MB"
    data-max-files="5">

    <!-- <script>
  FilePond.parse(document.body);
  </script> -->

  <script>
  $(function(){
  
    // First register any plugins
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    // Turn input element into a pond
    $('.my-pond').filepond();

    // Set allowMultiple property to true
    $('.my-pond').filepond('allowMultiple', true);
  
    // Listen for addfile event
    $('.my-pond').on('FilePond:addfile', function(e) {
        console.log('file added event', e);
    });

    // Manually add a file using the addfile method
    $('.my-pond').first().filepond('addFile', 'index.html').then(function(file){
      console.log('file added', file);
    });
  
  });
</script>
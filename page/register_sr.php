<!-- attribute_edit.php -->

<!-- HTML form to edit the attribute -->
<form id="edit-form" action="attribute_update.php" method="post">
  <div class="form-group">
    <label for="attribute">Attribute:</label>
    <input type="text" class="form-control" id="attribute" name="attribute">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> 

<!-- JavaScript to handle form submission and display a message when the attribute is updated -->
<script>
  // Get the form element
  const form = document.getElementById('edit-form');

  // Add an event listener to the form to handle submission
  form.addEventListener('submit', (event) => {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Send an HTTP POST request to the server to update the attribute
    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
    })
      .then((response) => {
        // If the attribute was successfully updated, display a message
        if (response.ok) {
          alert('Attribute updated successfully');
        }
      });
  });
</script>
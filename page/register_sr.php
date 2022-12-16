<!-- attribute_edit.php -->

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Attribute Edit</title>
</head>
<body>
  <div class="container mt-5">
    <h1>Edit Attribute</h1>
    <!-- HTML form to edit the attribute -->
    <form id="edit-form" action="attribute_update.php" method="post">
      <div class="form-group">
        <label for="attribute">Attribute:</label>
        <input type="text" class="form-control" id="attribute" name="attribute">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
  </div>

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

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAi

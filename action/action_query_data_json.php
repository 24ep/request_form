<?php
// Connect to the database
$host = 'localhost';
$username = 'cdse_admin';
$password = '@aA417528639';
$dbname = 'all_in_one_project';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the query from the AJAX request
$query = $_POST['query'];

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
  die("Query failed: " . $conn->error);
}

// Convert the result set to an array
$rows = array();
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

// Send the results back as JSON
header('Content-Type: application/json');
echo json_encode($rows);

// Close the database connection
$conn->close();
?>

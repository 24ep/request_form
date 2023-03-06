<?php
session_start();

function displayTable($host, $username, $password, $database, $table, $columns,$table_id ) {
    // Establish a connection to the database
    $con = mysqli_connect($host, $username, $password) or die("Error: " . mysqli_error($con));
    mysqli_select_db($con, $database);

    // Construct the SQL query
    $query = "SELECT " . implode(", ", $columns) . " FROM " . $table;

    // Execute the query and retrieve the results
    $result = mysqli_query($con, $query);

    // Create an HTML table to display the data with Bootstrap styles
    echo "<table class='table' id='".$table_id."'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th>" . ucfirst($column) . "</th>"; // Capitalize the column names
    }
    echo "<th>Action</th>"; // Capitalize the column names
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the query results and display each row as a table row
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($columns as $column) {
            echo '<td><input class="border-0 bg-white"
            update_value_attribute('.$row['id'] .', &#39;na_edit_'.$row[$column].'&#39; , &#39;na&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;id&#39;);
            value="' .$row[$column] . '"></td>';
        }
        echo "<td><button class='btn btn-dark btn-sm' onclick='table_detail_page(".$row['id'].",&#39;". $row[$column] ."&#39;,&#39;".$table_id."&#39;,&#39;update&#39;)'>Edit</button></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    // Close the database connection
    mysqli_close($con);
}


?>

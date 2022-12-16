<?php

// Execute the hdparm command to get the serial number of the client's hard drive
$output = shell_exec('hdparm -i /dev/sda | grep SerialNo');

// The serial number will be returned as a string in the output variable
// You can then process the string as needed, such as by storing it in a database or displaying it on a web page

echo "The serial number of the client's hard drive is: $output";

?>
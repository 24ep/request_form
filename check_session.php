<?php
// Start or resume session
session_start();

// Get session ID
$sessionId = session_id();

// Get session status
$sessionStatus = session_status();

// Get all session data
$sessionData = $_SESSION;

// Output session information
echo "Session ID: $sessionId<br>";
echo "Session Status: $sessionStatus<br>";
echo "Session Data: <pre>";
print_r($sessionData);
echo "</pre>";
?>

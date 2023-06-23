<?php require_once 'config.php';

// Create a new database connection
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>
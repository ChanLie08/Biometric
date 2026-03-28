<?php
// Microsoft SQL Server configuration
$serverName = "CHANLIE"; // or your server IP address, e.g., "192.168.1.100"
$database = "BIOMETRIC";
$username = "sa";  // Change this to your SQL Server username
$password = "chan1234";    // Change this to your SQL Server password

// Connection info array
$connectionInfo = array(
    "Database" => $database,
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8"
);

// Create connection
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    $errors = sqlsrv_errors();
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed',
        'error' => $errors[0]['message']
    ]);
    exit;
}

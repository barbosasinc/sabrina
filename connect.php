<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//header('Content-Type: application/json');

try {
    $host = 'localhost';
    $user = 'root';
    $password = 'beard767';
    $database = 'db_teste';

    // Create a connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        throw new Exception('Connection failed: ' . $conn->connect_error);
    } 
} catch (Exception $e) {
    die('Database connection error: ' . $e->getMessage());
}
?>
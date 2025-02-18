<?php
define("HOSTNAME" ,"127.0.0.1:3307");
define("USERNAME" , "root");
define("PASSWORD" , "");
define("DATABASE" , "crud_operation");

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

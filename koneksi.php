<?php
// session_start();

$server = "localhost";
$user   = "root";
$password = "";
$database = "websederhana";

$conn = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($conn));

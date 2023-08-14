<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carRoom";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {
    die("ERROR :" . $connect->connect_error);
}
?>
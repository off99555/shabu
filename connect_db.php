<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 29-May-16
 * Time: 13:58
 */
$servername = "localhost";
$username = "root";
$password = "";
$db = "shabu";

$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected Successfully";
$conn->query("SET NAMES 'utf8'");
$conn->query("SET CHARACTER SET utf8");

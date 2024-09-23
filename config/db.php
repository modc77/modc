<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oji";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage(), 0);
    echo "Connection failed"; // ข้อความทั่วไป
    exit;
}
?>

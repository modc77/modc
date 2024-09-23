<?php
session_start();
require_once '../config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'ກະລຸນາເຂົ້າສູ່ລະບົບກ່ອນ!';
    header('location: ../index');
    exit;
}
?>
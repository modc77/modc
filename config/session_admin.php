<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'ກະລຸນາເຂົ້າສູ່ລະບົບກ່ອນ!';
    header('location: ../index');
    exit;
}
?>
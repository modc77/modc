<?php include_once('../config/session_user.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="../assets/css/user_home.css">
    <link rel="stylesheet" href="../assets/css/sticky.css">
    <link rel="stylesheet" href="../assets/css/showproduct.css">
    <link rel="stylesheet" href="../assets/css/footer.css"> <!-- Link to the new footer CSS -->
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>

    <!-- ส่วน Header -->
    <?php include_once('../includes/header.php'); ?>

    <div class="promote">
        <img src="../assets/img/MODCSHOP.png" alt="Promotion">
    </div>

    <h4>ສິນຄ້າແນະນຳ <span>ວັນນີ້ <img src="../assets/icon/flame.png" alt="Flame Icon"></span></h4>

    <!-- showproduct -->
    <?php include_once('../includes/showproduct.php'); ?>

    <!-- Sticky Footer Menus -->
    <?php include_once('../includes/sticky.php'); ?>

    <!-- Beautiful Footer -->
    <?php include_once('../includes/footer.php'); ?>

</body>

</html>
<?php 
include_once('../config/session_user.php'); // ตรวจสอบ session ของผู้ใช้

// ดึง RecommendedID ของผู้ใช้ปัจจุบันจาก session
$current_user_id = $_SESSION['user_login']['RecommendedID'];

// เตรียมคำสั่ง SQL เพื่อดึงข้อมูลสมาชิกทีมโดยไม่แสดงตัวเอง
$query = "WITH RECURSIVE team_hierarchy AS (
            SELECT 
                u.id, 
                u.firstname, 
                u.lastname, 
                u.referred_by, 
                u.RecommendedID, 
                1 AS level
            FROM users u
            WHERE u.RecommendedID = :current_user_id
            UNION ALL
            SELECT 
                u.id, 
                u.firstname, 
                u.lastname, 
                u.referred_by, 
                u.RecommendedID, 
                th.level + 1 AS level
            FROM users u
            INNER JOIN team_hierarchy th ON u.referred_by = th.RecommendedID
            WHERE u.RecommendedID != :current_user_id
          )
          SELECT * FROM team_hierarchy
          ORDER BY level ASC"; // เพิ่มลำดับการแสดงจาก level

// เตรียมและเรียกใช้คำสั่ง SQL
$stmt = $conn->prepare($query);
$stmt->execute(['current_user_id' => $current_user_id]);
$team_members = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team members</title>
    <link rel="stylesheet" href="../assets/css/team_members.css">
    <link rel="stylesheet" href="../assets/css/sticky.css">
    <link rel="stylesheet" href="../assets/css/showproduct.css">
    <link rel="stylesheet" href="../assets/css/footer.css"> <!-- Link to the new footer CSS -->
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <!-- ส่วน Header -->
    <?php include_once('../includes/header.php'); ?>

    <!-- สร้าง table -->
    <!-- แสดงสมาชิกทีม -->
    <div class="team-container">
        <?php 
        $current_level = 1; // เริ่มต้นที่ระดับ 1
        foreach ($team_members as $member): 
            if ($member['level'] != $current_level) {
                $current_level = $member['level'];
                echo "<div class='team-level'>ลูกทีมที่ $current_level</div>"; // เพิ่มบรรทัดแยกแต่ละระดับลูกทีม
            }
        ?>
            <div class="team-member">
                <div class="profile-picture">
                    <img src="../path_to_profile_pictures/<?php echo $member['id']; ?>.jpg" alt="รูปโปรไฟล์" class="circle">
                </div>
                <div class="member-name">
                    <?php echo $member['firstname'] . ' ' . $member['lastname']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Sticky Footer Menus -->
    <?php include_once('../includes/sticky.php'); ?>

    <!-- Beautiful Footer -->
    <?php include_once('../includes/footer.php'); ?>
</body>

</html>

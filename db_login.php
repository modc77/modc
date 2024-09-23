<?php 
session_start();
include 'config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : false;

    // เพิ่ม '20' ด้านหน้าเบอร์โทรของผู้ใช้
    if (strlen($phone) == 8) {
        $phone = '20' . $phone;
    }

    // ตรวจสอบว่ามีการพยายามล็อกอินผิดพลาดก่อนหน้านี้หรือไม่ ถ้าไม่ให้ตั้งเป็น 0
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    // ตรวจสอบข้อมูลผู้ใช้ในฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = :phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // รีเซ็ตการนับ login_attempts เมื่อเข้าสู่ระบบสำเร็จ
            $_SESSION['login_attempts'] = 0;

            // บันทึก RecommendedID ลงใน session
            $_SESSION['user_login'] = [
                'id' => $user['id'],
                'RecommendedID' => $user['RecommendedID'] // บันทึก RecommendedID ของผู้ใช้
            ];

            if ($user['role'] === 'admin') {
                $_SESSION['admin_login'] = $user['id'];  // ตั้งค่า session สำหรับ admin
                echo json_encode(['success' => true, 'redirectUrl' => './admin/home']);
            } else if ($user['role'] === 'user') {
                echo json_encode(['success' => true, 'redirectUrl' => './user/home']);
            }
        } else {
            // เพิ่มจำนวนครั้งที่ล็อกอินผิด
            $_SESSION['login_attempts']++;

            // หากใส่รหัสผิด 3 ครั้งหรือมากกว่า ให้แจ้ง Forgot Password
            if ($_SESSION['login_attempts'] >= 3) {
                echo json_encode(['error' => true, 'message' => 'ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ! ທ່ານໄດ້ພະຍາຍາມ 3 ເທື່ອ. ທ່ານຕ້ອງການຣີເຊັດລະຫັດຜ່ານຂອງທ່ານບໍ?', 'forgotPassword' => true]);
            } else {
                echo json_encode(['error' => true, 'message' => 'ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ!']);
            }
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'ບໍ່ພົບບັນຊີຜູ້ໃຊ້!']);
    }
}
?>

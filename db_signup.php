<?php
header('Content-Type: application/json');  // Ensure the response is JSON

include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $recommendedID = $_POST['recommendedID'];

    // Check if RecommendedID exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE RecommendedID = :recommendedID");
    $stmt->bindParam(':recommendedID', $recommendedID);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        echo json_encode(['error' => true, 'message' => 'ໄອດີ ແມ່ທີມຜິດ!']);
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo json_encode(['error' => true, 'message' => 'Email ຖືກໃຊ້ແລ້ວ!']);
        exit();
    }

    // Check if phone already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = :phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo json_encode(['error' => true, 'message' => 'ເບີໂທລະສັບຖືກໃຊ້ແລ້ວ!']);
        exit();
    }

    // Check phone length (must be 8 digits)
    if (strlen($phone) != 8) {
        echo json_encode(['error' => true, 'message' => 'ເບີໂທລະສັບຕ້ອງມີ 8 ຕົວເລກ!']);
        exit();
    }

    // Add '20' to the beginning of the phone number
    $phone = '20' . $phone;

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Generate new unique RecommendedID
    $newRecommendedID = substr(str_shuffle("0123456789"), 0, 8);

    // Insert user into the database
    try {
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, password, RecommendedID, referred_by) VALUES (:firstname, :lastname, :email, :phone, :password, :newRecommendedID, :recommendedID)");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':newRecommendedID', $newRecommendedID);
        $stmt->bindParam(':recommendedID', $recommendedID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => true, 'message' => 'ການສະໝັກສະມາຊີກລົ້ມເຫລວ!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => true, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>

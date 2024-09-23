<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <title>Sign Up</title>
</head>

<body>
    <!-- Loading Screen -->
    <div id="loadingScreen" class="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <div class="container">
        <div class="logo">
            <img src="./assets/icon/ojifull.png" alt="">
        </div>
        <div class="nameweb">
            <p id="webName">ສະໝັກສະມາຊີກ</p>
        </div>
        <form id="signupForm">
            <div class="inputRow">
                <div class="inputContainer">
                    <img src="assets/icon/user.svg" class="inputIcon" alt="icon firstname">
                    <input placeholder="ຊື່" id="firstname" class="inputField" type="text" name="firstname">
                </div>
                <div class="inputContainer">
                    <img src="assets/icon/flower-tulip.png" class="inputIcon" alt="icon lastname">
                    <input placeholder="ນາມສະກຸນ" id="lastname" class="inputField" type="text" name="lastname">
                </div>
            </div>
            <div class="inputRow">
                <div class="inputContainer">
                    <img src="assets/icon/email.png" class="inputIcon" alt="icon email">
                    <input placeholder="Email" id="emailInput" class="inputField" type="email" name="email">
                </div>
            </div>
            <div class="inputRow">
                <div class="inputContainer">
                    <img src="assets/icon/id-badge.png" class="inputIcon" alt="icon RecommendedID">
                    <input placeholder="ໄອດີ ແມ່ທີມ" id="RecommendedID" class="inputField" type="text" name="RecommendedID">
                </div>
                <div class="inputContainer">
                    <img src="assets/icon/mobile-notch.png" class="inputIcon" alt="icon phone">
                    <input placeholder="ເບີໂທ ຫ້າມໃສ່ 20 ຫຼື 020" id="phoneInput" class="inputField" type="phone" name="phone">
                </div>
            </div>
            <div class="inputRow">
                <div class="inputContainer">
                    <img src="assets/icon/password.svg" class="inputIcon" alt="icon password">
                    <input placeholder="ລະຫັດຜ່ານ" id="passwordInput" class="inputField" type="password" name="password">
                    <img src="assets/icon/eye.svg" alt="Show Password" id="showPasswordIcon">
                </div>
                <div class="inputContainer">
                    <img src="assets/icon/password.svg" class="inputIcon" alt="icon confirm password">
                    <input placeholder="ຢຶນຍັນ ລະຫັດຜ່ານອີກຄັ້ງ" id="confirmpasswordInput" class="inputField" type="password" name="confirmpassword">
                    <img src="assets/icon/eye.svg" alt="Show Confirm Password" id="showConfirmPasswordIcon">
                </div>
            </div>

            <div class="signup">
                <button class="btn_signup" type="submit">ສະໝັກສະມາຊີກ</button>
            </div>
        </form>

        <div class="signupPrompt">
            <p>ມີບັນຊີຢູ່ແລ້ວ? <a href="index">ເຂົ້າສູ່ລະບົບ</a> </p>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="assets/js/showpassword_signup.js"></script>
<script src="assets/js/signup.js"></script>
<script src="assets/js/loading.js"></script>

</html>
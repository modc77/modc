<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Login</title>
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
            <p id="webName">ເຂົ້າສູ່ລະບົບ</p>
        </div>
        <form id="loginForm">
            <div class="inputRow">
                <div class="inputContainer">
                    <img src="assets/icon/mobile-notch.png" class="inputIcon" alt="icon phone">
                    <input placeholder="ເບີໂທ ຫ້າມໃສ່ 20 ຫຼື 020" id="phoneInput" class="inputField" type="phone" name="phone">
                </div>
                <div class="inputContainer">
                    <img src="assets/icon/password.svg" class="inputIcon" alt="icon password">
                    <input placeholder="ລະຫັດຜ່ານ" id="passwordInput" class="inputField" type="password" name="password">
                    <img src="assets/icon/eye.svg" alt="Show Password" id="showPasswordIcon">
                </div>
            </div>

            <div class="optionsRow">
                <div class="rememberMe">
                    <input type="checkbox" id="rememberMe" name="rememberMe">
                    <label for="rememberMe" id="rememberMeLabel">ຈື່ຂ້ອຍ</label>
                </div>
                <div class="forgotPassword">
                    <a href="#" id="forgotPasswordLink">ລືມລະຫັດຜ່ານ?</a>
                </div>
            </div>

            <div class="login">
                <button class="btn_login" type="submit" id="loginButton">ເຂົ້າສູ່ລະບົບ</button>
            </div>
        </form>

        <div class="signupPrompt">
            <p id="signupPrompt">ຍັງບໍ່ມີບັນຊີ? <a href="signup" id="signupLink">ສະໝັກສະມາຊີກ</a> </p>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="assets/js/showpassword_login.js"></script>
<script src="assets/js/login.js"></script>
<script src="assets/js/loading.js"></script>

</html>
$(document).ready(function() {
    // ตรวจสอบว่ามี cookies หรือไม่ แล้วเติมค่าลงในฟอร์ม
    if (document.cookie.indexOf('remembered_phone') !== -1) {
        let rememberedPhone = getCookie('remembered_phone');
        $('#phoneInput').val(rememberedPhone);
        $('#rememberMe').prop('checked', true);  // เช็ค Remember Me ไว้
    }

    // ฟังก์ชันดึงค่า cookies
    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }

    $("#loginForm").submit(function(event) {
        event.preventDefault(); // ป้องกันการ reload หน้า

        let phone = $("#phoneInput").val().trim();
        let password = $("#passwordInput").val().trim();
        let rememberMe = $("#rememberMe").is(':checked'); // ตรวจสอบ Remember Me

        if (!phone || !password) {
            Swal.fire('ຜິດພາດ', 'ກະລຸນາຕື່ມຂໍ້ມູນໃສ່ທັງສອງຊ່ອງ!', 'warning');
            return;
        }

        // ตรวจสอบว่า phone มีความยาว 8 ตัว
        if (phone.length !== 8) {
            Swal.fire('ຜິດພາດ', 'ເບີໂທລະສັບຕ້ອງມີ 8 ຕົວເລກ!', 'error');
            return;
        }

        // ตรวจสอบว่าไม่มี '20' หรือ '020' นำหน้า
        if (phone.startsWith('20') || phone.startsWith('020')) {
            Swal.fire('ຜິດພາດ', 'ເບີໂທລະສັບບໍ່ຄວນເລີ່ມຕົ້ນດ້ວຍ 20 ຫຼື 020!', 'error');
            return;
        }

        // ส่งข้อมูลไปที่ backend พร้อมกับค่า rememberMe
        $.ajax({
            url: "db_login.php",
            type: "POST",
            dataType: "json",
            data: {
                phone: phone,
                password: password,
                rememberMe: rememberMe
            },
            success: function(response) {
                if (response.success) {
                    if (rememberMe) {
                        // บันทึก phone ลง cookies หากเลือก Remember Me
                        document.cookie = "remembered_phone=" + phone + "; path=/; max-age=" + (30*24*60*60);
                    } else {
                        // ลบ cookies หากไม่ได้เลือก Remember Me
                        document.cookie = "remembered_phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    }

                    Swal.fire({
                        title: 'ສຳເລັດ',
                        text: 'ເຂົ້າສູ່ລະບົບສຳເລັດແລ້ວ!',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 3000,  // ตั้งเวลารอ 5 วินาที
                        timerProgressBar: true,  // แสดง progress bar ขณะนับถอยหลัง
                        willClose: () => {
                            window.location.href = response.redirectUrl;  // เปลี่ยนเส้นทางเมื่อหมดเวลา
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // ถ้าผู้ใช้กด OK ให้เปลี่ยนเส้นทาง
                            window.location.href = response.redirectUrl;
                        }
                    });
                    
                } else if (response.error) {
                    // ตรวจสอบว่าเป็นกรณีที่ใส่รหัสผิด 3 ครั้ง
                    if (response.forgotPassword) {
                        Swal.fire({
                            title: 'ເຂົ້າສູ່ລະບົບລົ້ມເຫລວ',
                            text: response.message,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'ຣີເຊັດລະຫັດຜ່ານ',
                            cancelButtonText: 'ລອງອີກຄັ້ງ'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // ผู้ใช้ต้องการ reset password
                                window.location.href = 'forgot_password';  // เปลี่ยนเส้นทางไปยังหน้าลืมรหัสผ่าน
                            }
                        });
                    } else {
                        Swal.fire('ຜິດພາດ', response.message, 'error');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);  // แสดงผล error ในคอนโซล
                Swal.fire('ຜິດພາດ', 'Connection error!', 'error');
            }
        });
    });
});
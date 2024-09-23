$(document).ready(function() { 
    $("#signupForm").submit(function(event) {
        event.preventDefault(); 

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#emailInput").val();
        let phone = $("#phoneInput").val();
        let password = $("#passwordInput").val();
        let confirmpassword = $("#confirmpasswordInput").val();
        let recommendedID = $("#RecommendedID").val();

        if (!firstname || !lastname || !email || !phone || !password || !confirmpassword || !recommendedID) {
            Swal.fire('ຜິດພາດ', 'ກະລຸນາຕື່ມຂໍ້ມູນໃສ່ໃນທຸກຊ່ອງ!', 'warning');
            return;
        }

        if (password !== confirmpassword) {
            Swal.fire('ຜິດພາດ', 'ລະຫັດຜ່ານບໍ່ກົງກັນ!', 'error');
            return;
        }

        // Validate phone number length (should be 8 digits)
        if (phone.length !== 8) {
            Swal.fire('ຜິດພາດ', 'ເບີໂທລະສັບຕ້ອງມີ 8 ຕົວເລກ!', 'error');
            return;
        }

        $.ajax({
            url: "db_signup.php",
            type: "POST",
            dataType: "json",  // Ensure the response is handled as JSON
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                phone: phone,
                password: password,
                recommendedID: recommendedID
            },
            success: function(response) {
                console.log(response);  // Inspect the server response

                if (response.success) {
                    Swal.fire({
                        title: 'ສຳເລັດ',
                        text: 'ການສະໝັກສະມາຊີກສຳເລັດແລ້ວ!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index";  // Redirect to index.php after success
                        }
                    });
                } else if (response.error) {
                    Swal.fire('ຜິດພາດ', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);  // Log error message
                Swal.fire('ຜິດພາດ', 'ການເຊື່ອມຕໍ່ຜິດພາດ!', 'error');
            }
        });
    });
});

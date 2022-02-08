$(document).ready(function () {
    $("#verify_email_button").click(function (e) {
        e.preventDefault();
        let url = $("p.hiddenUrl.base").text();
        let email = $("#verify_email_form input#verify_email").val();
        let verified = $(".verify").text();
        if (email !== '' && verified) {
            $.ajax({
                url: url + '/etc/ajax/sendVerifyCode.php',
                method: "post",
                data: {'email': email},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                }
            });
        }
    });
    $("#verify_email_submit_button").click(function (e) {
        $("#verify_email_form .email_error._code").css('display', 'none').text("");
        e.preventDefault();
        let url = $("p.hiddenUrl.base").text();
        let email = $("#verify_email_form input#email_code").val();
        let code = $("#verify_email_form input#code").val();
        if (code.length == 16) {
            $.ajax({
                url: url + '/etc/ajax/verifyCode.php',
                method: "post",
                data: {'email': email, 'code': code},
                dataType: 'JSON',
                success: function (data) {
                    if (data.result == "Verified") {
                        $("#popupVerify.modal").removeClass('show');
                        $(".modal-backdrop").remove();
                        $(".verify-msg").html('<div class="alert alert-success">Your email is now verified <button class="btn btn-sm btn-outline-success float-right close_err">X</button></div>').show();
                    } else if (data.result == "error") {

                    }else {

                    }
                }
            });
        } else {
            $("#verify_email_form .email_error._code").css('display', 'block').text("Verification code is of 16 mix characters");
        }
    });

});

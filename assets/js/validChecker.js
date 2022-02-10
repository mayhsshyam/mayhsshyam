$(document).ready(function () {
    if($("#register_form").length > 0){
        $("#image-remove").parents('div')[0].style.display = 'none';
        $("#register_form").validate({
        rules: {
            fname: {
                required: true,
                minlength: 3
            },
            lname: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            contact_no: {
                required: true,
                digits: true,
                phoneUS: true
            },
            dob: {
                required: true
            },
            country: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            address: {
                required: true
            },

            password: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
            cpassword: {
                required: true,
                equalTo: "#pass"
            }
        },
        messages: {
            fname: {
                required: "This field is required",
                minlength: "Minimum 3 characters need"
            },
            lname: {
                required: "This field is required",
                minlength: "Minimum 3 characters need"
            },
            email: {
                required: "This field is required",
                email: "Enter valid email"
            },
            contact_no: {
                required: "This field is required",
                digits: "Please Enter Only digits",
                phoneUS: "Please enter valid phone number"

            },
            dob: {
                required: "This field is required"
            },
            country: {
                required: "This field is required"
            },
            state: {
                required: "This field is required"
            },
            city: {
                required: "This field is required"
            },
            address: {
                required: "This field is required"
            },
           
            password: {
                required: "This field is required",
                minlength: "Minimum 8 letters allow",
                maxlength: "Maximum 12 letters allow"
            },
            cpassword: {
                required: "This field is required",
                equalTo: "Password Mismatch"
            }
        }

    });
    }
    if($("#login_form").length > 0){
        $("#login_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 12
                },
            },
            messages: {
                email: {
                    required: "This field is required",
                    email: "Enter valid email"
                },
                password: {
                    required: "This field is required",
                    minlength: "Minimum 8 letters allow",
                    maxlength: "Maximum 12 letters allow"
                }
            }
        });
    }

    $('#resetbtn').on('click', function (e) {
        e.preventDefault();
        $(this).not("input[type='reset']").val('');
        if ($("#register_form").length == 1) {
            $("#register_form")[0].reset();
            $("label.error").remove();
            $("input.error, textarea.error").removeClass('error');
        }

    });

    $('#image').on('change', function () {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#preview-upload-image img").attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
        $("#image-remove").parents('div')[0].style.display = 'block';
    });

    $('#image-remove').click(function () {
        let imgExists = $("#preview-upload-image img");
        if (imgExists.attr('src') !== '') {
            imgExists.attr('src', '');
            $("#image").val('');
            $("#image-remove").parents('div')[0].style.display = 'none';
        }
    });
    $(".close_err").click(function () {
        $(this).parents('div')[0].remove();
    });
});

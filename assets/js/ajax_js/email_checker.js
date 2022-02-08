$(document).ready(function(){
    var url = '';
    $('label.email_error').hide();
    $('#register_form #email, #verify_email_form input#verify_email').on('change',function(e){
        e.preventDefault();
        url = $("p.hiddenUrl.base").text();
        let email = $(this).val();
        $.ajax({
            url:url+'/etc/ajax/ajaxEmail.php',
            method:"post",
            data:{'email' :email},
            dataType: 'JSON',
            success: function(data){
                console.log($(e.target));
                console.log(!$(e.target).hasClass('error'));
                if(data.status === 'error' && !$(e.target).hasClass('error')){
                    $("label.email_error").show();
                    $("label.email_error").text('Enter valid email');
                    $("label.email_error").css('color','red');
                }else{
                    $('label.email_error').hide();
                    $("label.email_error").text('');
                    if(data.status === 'success'){
                        if(data.valid){
                            $("label.email_error").show();
                            $("labe,.email_error").css('color','green');
                            $("label.email_error").text('Valid');
                            $(".verify").text("true");

                        }else{
                            $("label.email_error").show();
                            $("labe,.email_error").css('color','red');
                            $("label.email_error").text(email + ' is registered');
                            $(".verify").text("");

                        }
                    }
                }
            }
        });
    });
});

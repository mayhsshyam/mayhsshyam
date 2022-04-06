$(document).ready(function () {
    $("div.verify-msg").hide();
    if($("#submi-edit-profile").length>0){
        $("#submi-edit-profile").click(function (e) {
            e.preventDefault();
            let url = $("p.hiddenUrl.base").val();
            let param ={};
            param['fname'] =$("#jobseeker_edit_form #fname").val();
            param['lname']=$("#jobseeker_edit_form #lname").val();
            param['contact_no'] =$("#jobseeker_edit_form #contact_no").val();
            param['dob']=$("#jobseeker_edit_form #dob").val();
            param['address']=$("#jobseeker_edit_form #address").val();
            param['city']=$("#jobseeker_edit_form #city").val();
            param['state']=$("#jobseeker_edit_form #state").val();
            param['country-id']=$("#jobseeker_edit_form #country").val();
            param['gender']=$("#jobseeker_edit_form .gender:checked").val();
            param['user_exp']=$("#jobseeker_edit_form #user_exp").val();
            param['user_occ']=$("#jobseeker_edit_form #user_occ").val();
            if($("#jobseeker_edit_form #orgName").length>0){
                param['orgName']=$("#jobseeker_edit_form #orgName").val();
            }
            param['uid']=$("#jobseeker_edit_form #uid").val();

            $.ajax({
               url: url+'/etc/ajax/editProfile.php',
                method:'post',
                data:param,
                dataType:'json',
                success:function(data){
                   if(data.result =="success"){
                      $("div.verify-msg.prof").html("<div class='alert alert-success'>Profile Updated <button class='close_err'>X</button></div>");
                      $("div.verify-msg.prof").show();
                   }
                },
            });
        });
    }
    if($(".confirm_pass_button").length>0){
        $(".confirm_pass_button").click(function () {
            let pass = $("input#pass").val();
            let newpass = $("input#newpass").val();
            let cpass = $("input#cpass").val();

            if(cpass!=='' &&newpass!==" " && pass !=''){
                if(newpass == cpass && newpass<=16){
                    $.ajax({
                        url: url+'/etc/ajax/editProfile.php',
                        method:'post',
                        data:param,
                        dataType:'json',
                        success:function(data){
                            if(data.result =="success"){
                                $("div.verify-msg.prof").html("<div class='alert alert-success'>Profile Updated <button class='close_err'>X</button></div>");
                                $("div.verify-msg.prof").show();
                            }
                        },
                    });
                }
            }


        });
    }
});

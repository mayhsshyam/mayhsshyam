$(document).ready(function () {
    if($("#getOrg").length>0){
        $("#getOrg").on('click','.edit_user',function (e) {
            let id = $(this).attr("data-edit-id");
            let url = $("p.hidden.admin-url").val();

            $.ajax({
                url: url+'etc/ajax/getUserData.php',
                method:'post',
                data:{'id':id},
                dataType:'json',
                success:function(data){
                    if(data.success==true){
                        if(data.data){
                            $("#editForm #fname").val(data.data.user_fname);
                            $("#editForm #lname").val(data.data.user_lname);
                            $("#editForm #contact_no").val(data.data.user_contactNumber);
                            $("#editForm #dob").val(data.data.user_dob);
                            $("#editForm #address").val(data.data.user_address);
                            $("#editForm #city").val(data.data.user_city);
                            $("#editForm #state-id").val(data.data.user_state);
                            $("#editForm #state").val(data.data.user_state);
                            $("#editForm #country-id").val(data.data.user_country);
                            $("#editForm #country").val(data.data.user_country);
                            if(data.data.user_gender!=''&&data.data.user_gender!=null){

                                $("#editForm input:radio[value='"+data.data.user_gender+"']").prop('checked',true);
                            }
                            $("#editForm #orgName").val(data.data.org_name);
                            $("#editForm #user_exp").val(data.data.jobS_exp);
                            $("#editForm #user_occ").val(data.data.jobS_occupation);
                            $("#editForm #uid").val(data.data.uid);
                            $('#editForm_modal').modal('show');
                        }
                    }else{
                        console.log("error");
                    }
                },
            });
        })
    }

    if($("#submi-edit-profile").length>0){
        $("#submi-edit-profile").click(function (e) {
            e.preventDefault();
            let url = $("p.hidden.base").val();
            let param ={};
            param['fname'] =$("#editForm #fname").val();
            param['lname']=$("#editForm #lname").val();
            param['contact_no'] =$("#editForm #contact_no").val();
            param['dob']=$("#editForm #dob").val();
            param['address']=$("#editForm #address").val();
            param['city']=$("#editForm #city").val();
            param['state']=$("#editForm #state").val();
            param['country-id']=$("#editForm #country").val();
            param['gender']=$("#editForm .gender:checked").val();
            param['user_exp']=$("#editForm #user_exp").val();
            param['user_occ']=$("#editForm #user_occ").val();
            param['new_pass']=$("#editForm #newpass").val();
            param['orgName']=$("#editForm #orgName").val();
            param['uid']=$("#editForm #uid").val();
            console.log(param);
            $.ajax({
                url: url+'/etc/ajax/editProfile.php',
                method:'post',
                data:param,
                dataType:'json',
                success:function(data){
                    if(data.result =="success"){
                        $('#editForm_modal').modal('hide');
                        if($("#getOrg").length>0) {
                            var type = $(".u_type").val();
                            var sort = 'date';
                            let data = {
                                'location': '',
                                'sort': 'date',
                                'type_user': type,
                                'limit': 1,
                            };
                            $.ajax({
                                url:url+'/etc/ajax/getUsersList.php',
                                method:'post',
                                dataType:'json',
                                data:params,
                                success:function (data) {
                                    $("#getOrg").html(data.res);
                                    $("#getOrgButton div ul").html(data.pagbut);
                                }
                            });
                        }
                    }
                },
            });
        });
    }
    var ban_id ='';
    $("#getOrg").on('click','.banne_user',function (e) {
        e.preventDefault();
        ban_id = $(this).attr("data-del-id");
    });
    $("#delete_organization .del_button").click(function (e) {
        e.preventDefault();
        let url = $("p.hidden.admin-url").val();

        $.ajax({
            url: url+'etc/ajax/bannUser.php',
            method:'post',
            data:{'id':ban_id,'mode':"Y"},
            dataType:'json',
            success:function(data){
                if(data.success==true){
                    $("#delete_organization").modal('close');
                }else{
                    alert("error"+data.error);
                }
            },
        });
    })
});

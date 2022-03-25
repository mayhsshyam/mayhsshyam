$(document).ready(function () {
    $("input#oldpass").on('change',function (e) {
        $("span.pass_error").hide();
        e.preventDefault();
        let url = $("p.hiddenUrl.base").text();
        let pass = $(" input#oldpass").val();
        $.ajax({
            url: url + '/etc/ajax/verifyPass.php',
            method: "post",
            data: {'pass': pass},
            dataType: 'json',
            success: function (data) {
                if(data.result!='true'){
                    $("span.pass_error").html(data.error);
                    $("span.pass_error").show();
                }else{
                    $("span.pass_error").hide();
                }

            }
        });
    });
});

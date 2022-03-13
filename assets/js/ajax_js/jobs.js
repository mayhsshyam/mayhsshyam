$(document).ready(function(){
    $(".delete-job").click(function(e){
        let _this = $(this);
        let record = _this.attr("data-id");
        let url = $(".hiddenUrl.base").text();
        let near_this = _this.parents('.jobListarticle');

        $.ajax({
            url: url + '/etc/ajax/deleteApplyJob.php',
            method: "post",
            data: {'recordId': record},
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if(data.result){
                    near_this.fadeOut("slow");
                }
            }
        });

    });
});

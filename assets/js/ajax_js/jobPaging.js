
/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 3/9/2022
 */
$(document).ready(function () {

    if ($("form#paging").length > 0) {
        let location = $(".location").val();
        let cat = $("#category").val();
        let perpage = $("#records").val();
        let type = $("#type").val();
        let limit = 1;
        if($('.pagination a.pagingdat').length>0){
            limit = $('button').attr('data-page').val();
        }
        let params = {
            'locate':location,
            'category':cat,
            'offset':perpage,
            'type':type,
            'limit':limit
        };
        getJobs(jQuery,params);

        $("form#paging").on('change', function () {
            let location = $(".location").val();
            let cat = $("#category").val();
            let perpage = $("#records").val();
            let type = $("#type").val();
            let limit = 1;
            let params = {
                'locate':location,
                'category':cat,
                'offset':perpage,
                'type':type,
                'limit':limit
            };
            getJobs(jQuery,params)
        });
        $("form#paging").on('click', ".pagination .pagingdat" ,function () {
            let location = $(".location").val();
            let cat = $("#category").val();
            let perpage = $("#records").val();
            let type = $("#type").val();
            let limit = $(this).attr('data-page');

            let params = {
                'locate':location,
                'category':cat,
                'offset':perpage,
                'type':type,
                'limit':limit
            };
            getJobs(jQuery,params)
        });
    }
function getJobs($,params){
        console.log(params);
    let url = $("p.hiddenUrl.base").text();
    $.ajax({
        url: url + '/etc/ajax/getJob.php',
        method: "post",
        data: params,
        dataType: 'JSON',
        success: function (data) {
            if(data.result && data.res !=""){
                console.log(data.result);
                $(".getJobs").html(data.res);
            }else{
                $(".getJobs").html('<article>\n <div class="brows-job-list center">\n No Jobs Found </div></article>');
            }
            if(data.result && data.res !=""&&data.pagbut !=''){
                $("ul.pagination").html(data.pagbut);

            }else{
                $("ul.pagination").html();

            }
        }

    });

}
});

$(document).ready(function () {

    // if($("#register_form select#category").length>0 ){
    if (false) {
        let url = $("p.hiddenUrl.base").text();

        $.ajax({
            url: url + '/etc/ajax/getCategories.php',
            method: "post",
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
            }
        });
    }


});
var nav = document.querySelector('nav');
window.addEventListener('scroll', function () {
    if (window.pageYOffset > 100) {
        $("nav").addClass('bg-dark', 'shadow');
        nav.classList.add();
    } else {
        $("nav").removeClass('bg-dark', 'shadow');
    }
});

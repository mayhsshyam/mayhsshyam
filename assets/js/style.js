$(document).ready(function(){



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

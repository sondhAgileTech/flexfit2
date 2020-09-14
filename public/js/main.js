$(".menu-toggle").on('click', function () {
    $(this).toggleClass("on");
    $(this).next().toggleClass("active");
    $('.bg-black').toggleClass("active");
});
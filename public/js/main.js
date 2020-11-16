$(".menu-toggle").on('click', function () {
    $(this).toggleClass("on");
    $(this).next().toggleClass("active");
    $('.bg-black').toggleClass("active");
});
$(document).on('click','#insuarance-wrapper .detail-insuarance-content .info-detail-insuarance table tr td:last-child > i',function(){
	$('#insuarance-wrapper .detail-insuarance-content .info-detail-insuarance table tr td:last-child').find('.input-group.date').toggleClass('show');
});
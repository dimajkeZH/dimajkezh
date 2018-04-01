(function($){
	$.fn.tabs = function(){
		var nav = $(this).find('.table_type_one_info_nav'),
			navLis = $(this).find('.table_type_one_info_nav li'),
			content = $(this).find('.table_type_one_info_content'),
			contentLis = $(this).find('.table_type_one_info_content li');
		$(navLis[2]).addClass('active');
		$(contentLis[2]).addClass('active');
		$.each(navLis, function(i){
			$(this).addClass('table_type_one_info_nav_'+i);
		});
		$.each(contentLis, function(i){
			$(this).addClass('table_type_one_info_content_'+i);
		});
		navLis.on('click', function(){
			var data = $(this).attr('class');
			var index = data.lastIndexOf('_');
			data = parseInt(data.substr(index+1));
      console.log(data);
			var contentLi = $(contentLis[data]);
			navLis.removeClass('active');
			contentLis.removeClass('active');
			contentLi.addClass('active');
			$(this).addClass('active');
		});
	}
})(jQuery);
// это ваш селектор с инициализацией табов
$('#tabs').tabs();

function ResizeWindow(){
	//* RESIZE vacancies *//
	var item_info = $(".vacancies_info_text").outerHeight(),
	item_img = $(".vacancies_info_item_img").outerHeight(); 
	var max = Math.max(item_info,item_img); 
	$(".vacancies_info_item").height(max) ; 
	//console.log("info_h" + item_info + " img_h: " + item_img + " max:" + max);
	//* RESIZE images_text *//
	var item_info = $(".images_text_item_info").outerHeight(), 
	item_img = $(".images_text_item_img").outerHeight(); 
	var max = Math.max(item_info,item_img); 
	$(".images_text_item").height(max); 
	//console.log("info_h" + item_info + " img_h: " + item_img + " max:" + max);
}
$(window).resize(ResizeWindow);
$(function() { 
	ResizeWindow();
});


$(document).ready(function(){
  $('.main_courusel_items').slick({
  centerMode: true,
  slidesToShow: 3,
  initialSlide: 2,
  variableWidth: true,
  speed: 500,
  prevArrow: $('.back'),
  nextArrow: $('.next'),
  infinite: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
});

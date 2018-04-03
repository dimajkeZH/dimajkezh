/* табы */
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
      		/*console.log(data);*/
			var contentLi = $(contentLis[data]);
			navLis.removeClass('active');
			contentLis.removeClass('active');
			contentLi.addClass('active');
			$(this).addClass('active');
		});
	}
})(jQuery);
/* инициализация табов */
$('#tabs').tabs();

/* изменение высоты родительского блока в зависимости от absolute ребёнка */
function ResizeWindow(){
	/* RESIZE vacancies */
	var item_info = $(".vacancies_info_text"),
		item_info = item_info.outerHeight() + item_info.parent().outerHeight() / 5,
		item_img = $(".vacancies_info_item_img").outerHeight();
	var max = Math.max(item_info,item_img); 
	$(".vacancies_info_item").height(max); 
	/*console.log("info_h" + item_info + " img_h: " + item_img + " max:" + max);*/
	/* RESIZE images_text */
	var item_info = $(".images_text_item_info").outerHeight(),
		//item_info = item_info.outerHeight() + item_info.parent().outerHeight() / 5,
		item_img = $(".images_text_item_img").outerHeight(); 
	var max = Math.max(item_info,item_img); 
	$(".images_text_item").height(max); 
	/*console.log("info_h" + item_info + " img_h: " + item_img + " max:" + max);*/
}

/* слик для главной страницы */
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

/* обновление ссылки для кнопки в слике */
function updateLINKslick(){
	$('.main_courusel_prises>a').attr('href',$('.main_courusel_item.slick-current>.data').text());
}

/* набор функций исполняющийся при ИЗМЕНЕНИИ МАСШТАБА окна */
$(window).resize(function(){
	ResizeWindow();
});

/* набор функций исполняющийся СРАЗУ после загрузки сайта */
$(function(){
	ResizeWindow();
	updateLINKslick();
	$('.next.slick-arrow').on('click',updateLINKslick);
	$('.back.slick-arrow').on('click',updateLINKslick);
});

/* функция-шаблон отправки AJAX серверу */
function AJAX(url, data = ''){
	$.ajax({
		url: url,
		type: "POST",
		data: data,
		success: function(str){
			alert(str);
		}
	});
}

/* отправка AJAX по клику "заказ" */
function order(){
	var value = $('#user_choice').val(); //value of select tag
	//set data variable
	var data = '';
	AJAX('application/core/ajax/order.php',data);
	return false;
}
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
		/*item_info = item_info.outerHeight() + item_info.parent().outerHeight() / 5,*/
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

/* функция-шаблон отправки AJAX серверу */
function AJAX(url, data = {}, callback = ''){
	$.ajax({
		url: url,
		type: "POST",
		data: data,
		success: function(str){
			str = JSON.parse(str);
			if((str.status)&&(callback!='')){
				window[callback]();
			}
			alert(str.message);
		},
		error: function(){
            alert('ERROR');
    	}
	});
}

/* отправка AJAX по клику "заказ" на главной странице и в хедере заказа */
function order(wnd){
	var to_date = $('.'+wnd+' .forma_group input[name=to_date]').val(),
		addr_from = $('.'+wnd+' .forma_group input[name=addr_from]').val(),
		addr_to = $('.'+wnd+' .forma_group input[name=addr_to]').val(),
		email_phone = $('.'+wnd+' .forma_group input[name=email_phone]').val(),
		user_choice = $('.'+wnd+' .forma_group select[name=user_choice]').val(),
		cost = $('.'+wnd+' .forma_group input[name=cost]').val(),
		message = $('.'+wnd+' .forma_group input[name=message]').val();
	var data = {
		'to_date':encodeURIComponent(to_date),
		'addr_from':encodeURIComponent(addr_from),
		'addr_to':encodeURIComponent(addr_to),
		'email_phone':encodeURIComponent(email_phone),
		'user_choice':encodeURIComponent(user_choice),
		'cost':encodeURIComponent(cost),
		'message':encodeURIComponent(message)//,
		//'captcha':encodeURIComponent(grecaptcha.getResponse())
	}
	console.log(data);
	AJAX('application/core/ajax/order.php', data, 'PopUpHide');
	return false;
}

/* отправка AJAX по клику "отправить" на странице контакты */
function feedback(){
	var name = $('.message_form_group input[name=name]').val(),
		email = $('.message_form_group input[name=email]').val(),
		message = $('.message_form_group textarea[name=message]').val();
	var data = {
		'name':encodeURIComponent(name),
		'email':encodeURIComponent(email),
		'message':encodeURIComponent(message),
		'captcha':encodeURIComponent(grecaptcha.getResponse())
	}
	AJAX('application/core/ajax/feedback.php', data);
	return false;
}

//Функция отображения PopUp
function PopUpShow(){
    $(".popup_window").show();
}
//Функция скрытия PopUp
function PopUpHide(){
    $(".popup_window").hide();
}









/* набор функций исполняющийся при ИЗМЕНЕНИИ МАСШТАБА окна */
$(window).resize(function(){
	ResizeWindow();
});

/* набор функций исполняющийся СРАЗУ после загрузки сайта */
$(function(){
	PopUpHide();
	updateLINKslick();
	ResizeWindow();
	$('.next.slick-arrow').on('click',updateLINKslick);
	$('.back.slick-arrow').on('click',updateLINKslick);
});
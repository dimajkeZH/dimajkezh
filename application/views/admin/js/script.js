/* табы */
(function($){
	$.fn.tabs = function(){
		var nav = $(this).find('.header_nav_list'),
			navLis = $(this).find('.header_nav_list_item'),
			content = $(this).find('.header_nav_content'),
			contentLis = $(this).find('.header_nav_content_item');
		$(navLis[0]).addClass('active');
		$(contentLis[0]).addClass('active');
		$.each(navLis, function(i){
			$(this).addClass('header_nav_list_item_'+i);
		});
		$.each(contentLis, function(i){
			$(this).addClass('header_nav_content_item_'+i);
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

(function($){
        $(window).on("load",function(){
            $(".main_content_info").mCustomScrollbar();
        });
    })(jQuery);
		 (function($){
        $(window).on("load",function(){
            $(".main_nav").mCustomScrollbar();
        });
    })(jQuery);

$('.main_nav_list_title').on('click', function () {
	var content = $(this).next()
	var parent = $(this).parent()
	if (parent.hasClass('active')) {
		parent.removeClass('active')
		content.stop().slideUp(400)
	} 
    else {
		$('.main_nav_list.active')
		.removeClass('active')
		.find('.main_nav_list_item')
		.stop()
		.slideUp(400)
		parent.addClass('active')
		content.stop().slideDown(400)
	}

});
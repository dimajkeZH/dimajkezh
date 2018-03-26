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
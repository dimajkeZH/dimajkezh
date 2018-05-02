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

/* VARS */
var typeMessage = Object.freeze({
	good : 1,
	common : 2,
	bad : 3,
});
var classMessageBox = 'popup__message',
	classMessage = 'message',
	classMessageGood = 'good',
	classMessageCommon = 'common',
	classMessageBad = 'bad',
	messageGoodTimeout = 2800,
	messageBadTimeout = 3500,
	messageCommonTimeout = 3100;
	messageHide = 600;
/* VARS END */

/* FUNCTIONS */
function showMessage(type, message){
	var curClassMessage;
	switch(type){
		case typeMessage.good:
			curClassMessage = classMessageGood;
			curTimeout = messageGoodTimeout;
			break;
		case typeMessage.bad:
			curClassMessage = classMessageBad;
			curTimeout = messageBadTimeout;
			break;
		case typeMessage.common:
			curClassMessage = classMessageCommon;
			curTimeout = messageCommonTimeout;
			break;
	}
	var MessageBox = document.createElement("div");
	MessageBox.classList.add(classMessage);
	MessageBox.classList.add(curClassMessage);
	MessageBox.innerHTML = '<span>'+message+'</span>';
	$('.'+classMessageBox).prepend(MessageBox);
	removeMessage(MessageBox, curTimeout);
}

function removeMessage(msgBox, timeout){
	setTimeout(function(){
		$('.'+classMessageBox+'>div').filter(function(){
			return $(this).css("opacity") == 1;
		}).last().hide(messageHide, function(){
			msgBox.remove();
		});
	}, timeout);
}

function Go(uri){
	//window.location = '/admin/'+uri;
	//console.log(window.location);
}
/* FUNCTIONS END */

/* EVENTS */

/* EVENTS END */

/* SIMPLE CODE */
	//showMessage(typeMessage.good, 'test message');
	Go('kek');
/* SIMPLE CODE END */

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
/* Открытие модального окна */
function modalOpen (){ 
	$(".modal_wnd_inner").fadeIn(400); 
	$(".modal_wnd_wrapper").fadeIn(400); 
} 
function modalClose (){ 
	$(".modal_wnd_inner").fadeOut(400); 
	$(".modal_wnd_wrapper").fadeOut(400); 
}
/* Скрыть элемент */
	$('.hide').click(function() {
		$(this).parent().parent().parent().find('.form_content').toggleClass('hide');
		return false;
	})
/* Смена блоков местами */
$(function(){ 
	$('.main_content_info div[value=down]').on('click', function() { 
		$(this).closest('.block_form').insertAfter($(this).closest('.block_form').next()); 
	}); 
	$('.main_content_info div[value=up]').on('click', function() { 
		$(this).closest('.block_form').insertBefore($(this).closest('.block_form').prev()); 
	}); 
});
//скролл
function custormScrollContent(){
	$(".main_content_info").mCustomScrollbar();
}
function custormScrollTree(){
	$(".main_nav").mCustomScrollbar();
}
(function($){
    $(window).on("load",function(){
       	custormScrollContent();
    });
})(jQuery);

(function($){
	$(window).on("load",function(){
		custormScrollTree();
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
	classMessageBad = 'bad',
	classMessageCommon = 'common',
	messageGoodTimeout = 2800,
	messageBadTimeout = 3500,
	messageCommonTimeout = 3100;
	messageHide = 600;
var classContentBox = 'main_content',
	classSiteTree = 'main_nav',
	classLoaderPage = 'loader_box',
	loaderPageHide = 5; /* 3 - 12 */
/* VARS END */

/* FUNCTIONS */
function GetContent(uri, Class, data = {}){
	$.ajax({
		url: uri,
		type: 'POST',
		data: data,
		success: function(data){
			try{
				data = JSON.parse(data.trim());
				$(Class).html(data.message);
			}catch{
				console.log('Error of script. Refresh page!');
			}finally{
				
			}
		},
		error: function(){
			console.log('something was wrong. Refresh page!');
		}
	});
}

function Ajax(uri, data = {}, callback = ''){
	$.ajax({
		url: uri,
		type: 'POST',
		data: data,
		dataType: 'JSON',
        contentType: false,
        processData: false,
        cache: false,
		success: function(data){
			console.log(data);
			try{
				//data = JSON.parse(data.trim());
				window[callback](data.message, data.status);
			}catch{
				console.log('Error of script. Refresh page!');
			}finally{
				HideLoader();
			}
		},
		error: function(e){
			console.log(e.responseText);
			console.log('something was wrong. Refresh page!');
			HideLoader();
		}
	});
}

function loadPage(content){
	$('.'+classContentBox).html(content);
	custormScrollContent();
}

function updTree(){
	GetContent('/admin/tree', '.'+classSiteTree);
	custormScrollTree();
}

function showMessage(message, status = null){
	var curClassMessage, type;
	if(status){
		type = typeMessage.good;
	}else if(!status){
		type = typeMessage.bad;
	}else if(status == null){
		type = typeMessage.common;
	}
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
	ShowLoader();
	Ajax(uri, {}, 'loadPage');
}

function Change(uri){
	console.clear();
	ShowLoader();
	uri = '/admin/'+uri;
	var dataForms = $('form#data');
	var dataFILES = new FormData();
	var tempForms;
	var parent = {};
	$.each( dataForms, function( key, form){
		jsonObject = {};
		tempForms = new FormData(form);
		for (let pair of tempForms.entries()) {
			if(Object.prototype.toString.call(pair[1]) === '[object File]'){
				dataFILES.append(pair[0]+'_'+key, pair[1]);
				//console.log('file data: '+(pair[0]+'_'+key)+' --- '+pair[1].name);
			}else{
				jsonObject[pair[0]] = pair[1];
				//console.log('json data: '+pair[0]+' --- '+pair[1]);
			}
		}
		parent[key] = jsonObject;
	});	
	var dataJSON = JSON.stringify(parent);
	dataFILES.append('DATA', dataJSON);
	//console.log(dataFILES);
	Ajax(uri, dataFILES, 'showMessage');
	updTree();
}

function Delete(uri){
	ShowLoader();
	uri = '/admin/'+uri;
	var data = new FormData();
	var dataInput = $('form#data :input[name = "ID_PAGE"]');
	//data.append(dataInput[0].name, dataInput[0].value);
	data[dataInput[0].name] = dataInput[0].value;
	if(window.confirm('Действительно хотите удалить эту запись?')){
		Ajax(uri, data, 'showMessage');
	}else{
		HideLoader();
	}
	updTree();
}

function plus(This){
	$(This).parent().parent().find("input").each(function(){
		if(this.value > 0){
			this.value++;
		}else{
			this.value = 1;
		}
	});
}

function minus(This){
	$(This).parent().parent().find("input").each(function(){
		if(this.value > 1){
			this.value--;
		}
	});
}

function ShowLoader(){
	var loader = $('.'+classLoaderPage)[0];
	loader.style.opacity = 1;
	loader.classList.remove('hide');
}
function HideLoader(){
	var loader = $('.'+classLoaderPage)[0];
	setTimeout(function tickHideLoader(){
		loader.style.opacity -= 0.01;
		if(loader.style.opacity == 0){
			loader.classList.add('hide');
		}else{
			setTimeout(tickHideLoader,loaderPageHide);
		}
	}, loaderPageHide);
}
/* FUNCTIONS END */

/* EVENTS */
	//redirect
	window.onload = function() {
		function handlerAnchors() {
			var state = {
				url: this.getAttribute( "href", 2 )
			}
			// заносим ссылку в историю
			history.pushState( state, state.title, state.url );
			//подгрузка данных
			Go(state.url);
			// не даем выполнить действие по умолчанию
			return false;
		}
		//Все ссылки для редиректа
		var anchors = document.getElementsByClassName('Go');
		// вешаем события на все ссылки в нашем документе
		for( var i = 0; i < anchors.length; i++ ) {
			anchors[ i ].onclick = handlerAnchors;
		}
		// вешаем событие на popstate которое срабатывает при нажатии back/forward в браузере
		window.onpopstate = function( e ) {
			// просто сообщение
			//console.log('Вы вернулись на страницу '+ history.location+' URI:'+JSON.stringify( history.state ));
			Go(history.state.url);
		}
	}
	//check input value in input text btn
	$('.forma_group_item.text_btn').keydown(function(e){
		return checkNumber(this, e);
	});
	$('.forma_group_item.number').keydown(function(e){
		return checkNumber(this, e);
	});
	function checkNumber(THIS, e){
		let inputKey = e.originalEvent.key;
		let rgxAll = /[0-9A-Za-zА-Я-а-я\W]{1}/g;
		let rgxNumber = /[0-9]{1}/g;
		let rgxResult = inputKey.match(rgxAll);
		if((rgxResult != null) && (rgxResult.length == 1)){
			if(inputKey.match(rgxNumber) != null){
				$(THIS).find('input')[0].value += inputKey;
			}
			return false;
		}
	}
/* EVENTS END */

/* SIMPLE CODE */
	//showMessage(typeMessage.good, 'test message');
/* SIMPLE CODE END */
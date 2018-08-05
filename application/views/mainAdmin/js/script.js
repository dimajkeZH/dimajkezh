/******************************* VARS *******************************/
let classContentBox = 'main_content',
	classSiteTree = 'main_nav';
let message = new Message(),
	loader = new Loader('.loader_box');
/******************************* VARS END *******************************/





/******************************* FUNCTIONS *******************************/
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
			var contentLi = $(contentLis[data]);
			navLis.removeClass('active');
			contentLis.removeClass('active');
			contentLi.addClass('active');
			$(this).addClass('active');
		});
	}
})(jQuery);
/* Смена блоков местами */
$(function(){ 
	$('.main_content_info div[value=down]').on('click', function() {
		try{
			let block_form = $(this).closest('.block_form');
			block_form.insertAfter(block_form.next()); 
		}catch(e){

		}
	}); 
	$('.main_content_info div[value=up]').on('click', function() {
		try{
			let block_form = $(this).closest('.block_form');
			//верхний блок общий - не сортируется
			if(block_form.prev().find('.up_down').length  == 0){
				return;
			}
			block_form.insertBefore(block_form.prev()); 
		}catch(e){

		}
	}); 
});
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
function hideThis(THIS){
	//$(THIS).parent().parent().parent().find('.form_content').toggleClass('hide');
	let box = $(THIS).closest('.block_form').find('.form_content');
	box.toggleClass('hide');
	if(box.hasClass('hide')){
		$(THIS).text('Развернуть');
	}else{
		$(THIS).text('Свернуть');
	}
	return false;
}
//скролл контента
function custormScrollContent(){
	$(".main_content_info").mCustomScrollbar();
}
//скролл дерева
function custormScrollTree(){
	//очищаем список классов
	$(".main_nav").attr('class', 'main_nav');
	//включаем развёртывание подразделов
	$('.main_nav_list_title').on('click', function () {
		let content = $(this).next();
		let parent = $(this).parent();
		if (parent.hasClass('active')) {
			parent.removeClass('active');
			content.stop().slideUp(400);
		} else {
			$('.main_nav_list.active')
				.removeClass('active')
				.find('.main_nav_list_item')
				.stop()
				.slideUp(400);
			parent.addClass('active');
			content.stop().slideDown(400);
		}
	});
	//включаем скролл
	$(".main_nav").mCustomScrollbar();
	//включаем кастомный редирект
	customRedirect();
}

function showMessage(msg, status = null){
	message.show(msg, status);
	if(status != false){
		updTree();
	}
}

function Go(uri){
	loader.show();
	new api('api').send(uri, {}, 'loadPage');
}
function loadPage(content){
	$('.'+classContentBox).html(content);
	custormScrollContent();
	hideAllBlocks();
}

function updTree(){
	new api('api').send('/admin/tree', {}, 'loadTree');
}
function loadTree(content){
	$('.'+classSiteTree).html(content);
	custormScrollTree();
}

function Change(uri){
	console.clear();
	loader.show();
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
	new api('api').send(uri, dataFILES, 'showMessage');
}

function Delete(uri){
	loader.show();
	uri = '/admin/'+uri;
	var data = new FormData();
	var dataInput = $('form#data :input[name = "ID_PAGE"]');
	//data.append(dataInput[0].name, dataInput[0].value);
	data[dataInput[0].name] = dataInput[0].value;
	if(window.confirm('Действительно хотите удалить эту запись?')){
		new api('api').send(uri, data, 'showMessage');
	}else{
		loader.hide();
	}
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

function hideAllBlocks(){
	$(function(){
		$('.form_content').toggleClass('hide');
		$('.block_hide').text('Развернуть');
	});
}

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

function handlerAnchors() {
	let state = {
		url: this.getAttribute( "href", 2 )
	}
	// заносим ссылку в историю
	history.pushState( state, state.title, state.url );
	//подгрузка данных
	Go(state.url);
	// не даем выполнить действие по умолчанию
	return false;
}

function customRedirect(){
	//Все ссылки для редиректа
	let anchors = document.getElementsByClassName('Go');
	// вешаем события на все ссылки в нашем документе
	for(let i = 0; i < anchors.length; i++ ) {
		anchors[ i ].onclick = handlerAnchors;
	}
	// вешаем событие на popstate которое срабатывает при нажатии back/forward в браузере
	window.onpopstate = function( e ) {
		// просто сообщение
		//console.log('Вы вернулись на страницу '+ history.location+' URI:'+JSON.stringify( history.state ));
		Go(history.state.url);
	}
}
/******************************* FUNCTIONS END *******************************/

/******************************* EVENTS *******************************/
	//после полной загрузки страницы
	(function($){
		$(window).on("load",function(){
			custormScrollContent();
			custormScrollTree();
			loader.hide();
		});
	})(jQuery);
	//check input value in input text btn
	$('.forma_group_item.text_btn').keydown(function(e){
		return checkNumber(this, e);
	});
	$('.forma_group_item.number').keydown(function(e){
		return checkNumber(this, e);
	});
/******************************* EVENTS END *******************************/

/******************************* SIMPLE CODE *******************************/
	//свернуть все развёрнутые блоки после загрузки
	hideAllBlocks();
	/* инициализация табов */
	$('#tabs').tabs();
/******************************* SIMPLE CODE END *******************************/
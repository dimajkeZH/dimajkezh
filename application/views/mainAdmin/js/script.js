/******************************* VARS *******************************/
let cms, redirect;
/******************************* VARS END *******************************/
















/******************************* FUNCTIONS *******************************/
/* табы */
(function($){
	$.fn.tabs = function(){
		/*
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
		*/
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




//
function tableCol_Delete(THIS, id = null){
	
	if(!window.confirm('Действительно хотите удалить этот столбец?')){
		return false;
	}

	let table = tableSearch(THIS);
	let index = -1;
	let th = $(THIS).closest('th')[0];
	let thList = $(table).find('th');
	for(let thIndex = 0; thIndex < thList.length; thIndex++){
		if(thList[thIndex] == th){
			index = thIndex;
			break;
		}
	}
	for(let trIndex = 0; trIndex < $(table).find('tr').length; trIndex++){
		table.rows[trIndex].deleteCell(index);
	}
	tableCellNameChange(table, id);
	return false;
}
//
function tableRow_Delete(THIS, id = null){

	if(!window.confirm('Действительно хотите удалить этот строку?')){
		return false;
	}
	let table = tableSearch(THIS);
	$(THIS).closest('tr').remove();
	tableCellNameChange(table, id);
	return false;
}
//
function tableCol_Add(THIS, id = null){
	let table = tableSearch(THIS);
	let trList = $(table).find('tr');
	let tdCount = $(trList[0]).find('th').length;

	$(trList[0]).append('<th><button class="remove" onclick="return tableCol_Delete(this'+((id != null)?(', '+id):'')+')">X</button></th>');
	for(let trIndex = 1; trIndex < trList.length; trIndex++){
		$(trList[trIndex]).append('<td><input autocomplete="off" name="CELL_TABLE'+((id != null)?id:'')+'_'+trIndex+'_'+tdCount+'" value="" type="text"></td>');
	}
	return false;
}
//
function tableRow_Add(THIS, id = null){
	let table = tableSearch(THIS);
	let tr = $(table).find('tr');
	let trCount = tr.length;
	tr = tr[0];
	let tdCount = $(tr).find('th').length;

	let newtr 	= '<tr><td><button class="remove" onclick="return tableRow_Delete(this'+((id != null)?(', '+id):'')+')">X</button></td>';
	for(let i = 1; i < tdCount; i++){
		newtr += '<td><input autocomplete="off" name="CELL_TABLE'+((id != null)?id:'')+'_'+trCount+'_'+i+'" value="" type="text"></td>';
	}
	newtr += '</tr>';
	$(table).find('tbody:last-child').append(newtr);
	return false;
}
//
function tableSearch(THIS){
	let parent = $(THIS).closest('.table_info');
	let table = parent.find('table');
	return table[0];
}
//
function tableCellNameChange(table, id = null){
	console.log(table);
	console.log(id);
	let trList = $(table).find('tr');
	for(let trIndex = 0; trIndex < trList.length; trIndex++){
		let tdList = $(trList[trIndex]).find('td');
		for(let tdIndex = 0; tdIndex < tdList.length; tdIndex++){
			let input = $(tdList[tdIndex]).find('input')[0];
			if(input != undefined){
				if(id != null){
					input.name = 'CELL_TABLE'+id+'_'+trIndex+'_'+tdIndex;
				}else{
					input.name = 'CELL_TABLE_'+trIndex+'_'+tdIndex;
				}
				
			}
		}
	}
}

//
function addMultiTable(THIS){
	let box = $(THIS).closest('.form_content')[0];
	let lastTable = $(box).find('.table_info.forma_group');
	lastTable = lastTable[lastTable.length - 1];
	let multitableCount = $(box).find('input[name^=ID_TABLE]').length;
	let rowCount = $(THIS).parent().parent().find('input[name=rowCount]')[0].value;
	let colCount = $(THIS).parent().parent().find('input[name=colCount]')[0].value;

	console.log(lastTable);
	console.log(multitableCount);

	let newTable = '<hr><input name="ID_TABLE'+multitableCount+'" value="-1" style="display:none;" type="text"><div class="forma_group"><p>Заголовок мультитаблицы</p><div class="forma_group_item text"><input name="TITLE_TABLE'+multitableCount+'" value="" type="text"><p class="forma_group_item_description"></p></div></div>';
	newTable += '<div class="table_info forma_group"><div class="table_info_btns"><button class="add" onclick="return tableRow_Add(this, '+multitableCount+')">Добавить Строку</button><button class="add" onclick="return tableCol_Add(this, '+multitableCount+')">Добавить Столбец</button></div><table class="forma_group_item"><tbody>';
	
	newTable += '<tr class="table_info_head"><th></th>';

	for(let thIndex = 1; thIndex <= colCount; thIndex++){
		newTable += '<th><button class="remove" onclick="return tableCol_Delete(this, '+multitableCount+')">X</button></th>';
	}

	newTable += '</tr>';
	for(let trIndex = 1; trIndex <= rowCount; trIndex++){
		newTable += '<tr><td><button class="remove" onclick="return tableRow_Delete(this, '+multitableCount+')">X</button></td>';
		for(let tdIndex = 1; tdIndex <= colCount; tdIndex++){
			newTable += '<td><input autocomplete="off" name="CELL_TABLE'+multitableCount+'_'+trIndex+'_'+tdIndex+'" value="" type="text"></td>';
		}
		newTable += '</tr>';
	}

	newTable += '</tbody></table></div>';

	$(lastTable).after(newTable);

	return false;
}
//
function addTable(THIS){
	let box = $(THIS).closest('.form_content')[0];
	let parent = $(THIS).closest('.forma_group')[0];

	let rowCount = $(THIS).parent().parent().find('input[name=rowCount]')[0].value;
	let colCount = $(THIS).parent().parent().find('input[name=colCount]')[0].value;

	console.log(box);
	console.log(parent);

	let newTable = '<input name="ID_TABLE" value="-1" style="display:none;" type="text"><div class="forma_group"><p>Заголовок мультитаблицы</p><div class="forma_group_item text"><input name="TITLE_TABLE" value="" type="text"><p class="forma_group_item_description"></p></div></div>';
	newTable += '<div class="table_info forma_group"><div class="table_info_btns"><button class="add" onclick="return tableRow_Add(this)">Добавить Строку</button><button class="add" onclick="return tableCol_Add(this)">Добавить Столбец</button></div><table class="forma_group_item"><tbody>';
	
	newTable += '<tr class="table_info_head"><th></th>';

	for(let thIndex = 1; thIndex <= colCount; thIndex++){
		newTable += '<th><button class="remove" onclick="return tableCol_Delete(this)">X</button></th>';
	}

	newTable += '</tr>';
	for(let trIndex = 1; trIndex <= rowCount; trIndex++){
		newTable += '<tr><td><button class="remove" onclick="return tableRow_Delete(this)">X</button></td>';
		for(let tdIndex = 1; tdIndex <= colCount; tdIndex++){
			newTable += '<td><input autocomplete="off" name="CELL_TABLE_'+trIndex+'_'+tdIndex+'" value="" type="text"></td>';
		}
		newTable += '</tr>';
	}

	newTable += '</tbody></table></div>';

	$(parent).remove();
	$(box).append(newTable);

	return false;
}



//
function addImage(THIS){
	let box = $(THIS).parent().parent().parent()[0];

	let imgCount = $(THIS).parent().parent().find('input[name=imgCount]')[0].value;

	console.log(box);
	console.log(imgCount);

	//let child = $(box).find('');
	
	return false;
}









function Change(uri){
	console.clear();
	loader.show();
	uri = '/admin/'+uri;
	let dataForms = $('form#data');
	let dataFILES = new FormData();
	let tempForms, jsonObject;
	let parent = {};
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
	new api('api').send(uri, dataFILES, afterChange);
}
function afterChange(message, status, data){
	showMessage(message, status);
	if(window.location.pathname == '/admin/site/pages' && status){
		window.location.pathname += '/' + data.ID
	}
	console.log(window.location.pathname);
	Redirect.go(window.location.pathname);
}



function Delete(uri){
	loader.show();
	uri = '/admin/'+uri;
	var data = new FormData();
	var dataInput = $('form#data :input[name = "ID_PAGE"]');
	//data.append(dataInput[0].name, dataInput[0].value);
	data[dataInput[0].name] = dataInput[0].value;
	if(window.confirm('Действительно хотите удалить эту запись?')){
		new api('api').send(uri, data, afterDelete);
	}else{
		loader.hide();
	}
}
function afterDelete(message, status, data){
	showMessage(message, status);
	window.location.pathname = '/admin/site/pages';
	Redirect.go(window.location.pathname);
}



function addBus(id = 0){
	new api('api').send('admin/catalog/buses/' + id, {}, afterAddBus);
}
function afterAddBus(message, status, data){
	modalOpen();
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



//
function checkURI(THIS){
	let uri = THIS.value;
	let parent = $(THIS).closest('.form_content')[0];
	let input_ID = $(parent).find('input[name=ID]')[0];
	let ID = input_ID.value;

	let uri_data = new FormData();
	uri_data.append('DATA', JSON.stringify({
		'ID': ID,
		'URI': uri
	}));

	new api('api').send('/admin/api/uri', uri_data, checkURIafter);
}
//
function checkURIafter(data){
	cms.show_message(data.message, data.status);
}


function checkNumber(THIS, e){
	let inputKey = e.key || e.originalEvent.key;
	if((inputKey != 'Backspace') || (e.keyCode != 8)){
		e.preventDefault();

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
}

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



function onLoadCMS(){
	redirect = new Redirect('Go');

	document.querySelectorAll('.forma_group_item.text_btn').forEach(function(item, index){
		item.addEventListener('keydown', function(e){
			return checkNumber(this, e);
		});
	});
	document.querySelectorAll('.forma_group_item.number').forEach(function(item, index){
		item.addEventListener('keydown', function(e){
			return checkNumber(this, e);
		});
	});
}

function onRefreshCMS(){
	redirect = new Redirect('Go');
	document.querySelectorAll('.forma_group_item.text_btn').forEach(function(item, index){
		item.addEventListener('keydown', function(e){
			return checkNumber(this, e);
		});
	});
	document.querySelectorAll('.forma_group_item.number').forEach(function(item, index){
		item.addEventListener('keydown', function(e){
			return checkNumber(this, e);
		});
	});
}

function now(step = 0){
	return new Date().getTime() + step * 1000;
}
/******************************* FUNCTIONS END *******************************/




/******************************* EVENTS *******************************/

	//после полной загрузки страницы
	document.addEventListener('DOMContentLoaded', function(){
		cms = new EASY_CMS('main_cms', onLoadCMS, onRefreshCMS);
		cms.run();
	});
	//check input value in input text btn
	//console.log(document.getElementsByClassName('forma_group_item text_btn'));

/******************************* EVENTS END *******************************/



/******************************* SIMPLE CODE *******************************/
	//свернуть все развёрнутые блоки после загрузки
	//hideAllBlocks();
	/* инициализация табов */
/******************************* SIMPLE CODE END *******************************/
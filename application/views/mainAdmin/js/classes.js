/******************************* class for communication with server  *******************************/
class api{

	constructor(type){
		this.type = type;
	}

	send(uri, data = {}, success = function(){}, error = function(){}){
		switch(this.type){
			case 'load':
				//this.getContent(uri, data, returnVar);
				break;
			case 'api':
				this.sendApi(uri, data, success, error);
				break;
		}
	}

	/*
	loadContent(uri, data, Class){
		$.ajax({
			url: uri,
			type: 'POST',
			data: data,
			success: function(data){
				try{
					data = JSON.parse(data.trim());
					$(Class).html(data.message);
				}catch(e){
					console.log('Error of get script. Refresh page!');
				}finally{
					
				}
			},
			error: function(){
				console.log('something was wrong. Refresh page!');
			}
		});
	}
	*/

	sendApi(uri, data, success_callback, error_callback){
		$.ajax({
			url: uri,
			type: 'POST',
			data: data,
			dataType: 'JSON',
	        contentType: false,
	        processData: false,
	        cache: false,
			success: function(data){
				success_callback(data);
			},
			error: function(e){
				error_callback(e.responseText);
			}
		});
	}
}





/******************************* class for show the message  *******************************/
class Message{

	constructor(){
		this.typeGood = 1;
		this.typeBad = 2;
		this.typeCommon = 3;

		this.classMessage = 'message';

		this.classMessageBox = '.popup__message';

		this.classMessageGood = 'good';
		this.classMessageBad = 'bad';
		this.classMessageCommon = 'common';

		this.messageGoodTimeout = 2800;
		this.messageBadTimeout = 3500;
		this.messageCommonTimeout = 3100;

		this.messageHide = 600;

		this.curClassMessage = '';
		this.curTimeout = 0;
	}

	show(msg = '', status = null){
		if(status){
			this.curClassMessage = this.classMessageGood;
			this.curTimeout = this.messageGoodTimeout;
		}else if(!status){
			this.curClassMessage = this.classMessageBad;
			this.curTimeout = this.messageBadTimeout;
		}else if(status == null){
			this.curClassMessage = this.classMessageCommon;
			this.curTimeout = this.messageCommonTimeout;
		}
		this.create(msg);
	}

	create(msg){
		let MessageBox = document.createElement("div");
		MessageBox.classList.add(this.classMessage);
		MessageBox.classList.add(this.curClassMessage);
		MessageBox.innerHTML = '<span>'+msg+'</span>';
		$(this.classMessageBox).prepend(MessageBox);
		this.destroy(MessageBox);
	}

	destroy(msgBox){
		let messages = this.classMessageBox+'>div',
			timehide = this.messageHide,
			timeout = this.curTimeout;
		setTimeout(function(){
			$(messages)
				.filter(function(){ return $(this).css("opacity") == 1; })
				.last()
				.hide(timehide, function(){ msgBox.remove(); });
		}, timeout);
	}
}





/******************************* class for show the loader on page  *******************************/
class Loader{

	constructor(id){
		this.idLoaderPag = id;
		this.loaderPageHide = 1000;
		this.loaderHideWeight = 0.01;
		this.loader = document.getElementById(this.idLoaderPag);

		this.opacityFirstBreakPoint = 0.85;
		this.opacitySecondBreakPoint = 0.65;
	}

	show(){
		this.loader.style.opacity = 1;
		this.loader.classList.remove('hide');
	}

	hide(){
		this.loader.style.opacity = 1;
		setTimeout(Loader.tickHideLoader(this, this.loaderHideWeight, false, false), this.loaderPageHide);
	}

	static tickHideLoader(THIS, weight, bpFirstIsset, bpSecondIsset){
		if(THIS.loader.style.opacity <= 0){
			THIS.loader.classList.add('hide');
			THIS.loader.removeAttribute('style');
			return;
		}
		THIS.loader.style.opacity -= weight;
		if(THIS.loader.style.opacity <= THIS.opacityFirstBreakPoint && !bpFirstIsset){
			weight = weight * 2;
			bpFirstIsset = true;
		}else if(THIS.loader.style.opacity <= THIS.opacitySecondBreakPoint && !bpSecondIsset){
			weight = weight * 4;
			bpSecondIsset = true;
		}
		setTimeout(Loader.tickHideLoader(THIS, weight, bpFirstIsset, bpSecondIsset), THIS.loaderPageHide);
	}
}





/******************************* class for redirect (static and global)  *******************************/
class Redirect{

	constructor(Class){
		this.anchors = document.getElementsByClassName(Class);
		for(let i = 0; i < this.anchors.length; i++ ) {
			this.anchors[i].onclick = Redirect.handler;
		}
		window.onpopstate = function(e) {
			if(history.state != null){
				Redirect.go(history.state.url);
			}
		}
	}

	static go(uri){ cms.redirect(uri); }

	static handler(url = null, title = null){
		let curTitle, curUrl;
		if(typeof this === 'object'){
			curTitle = this.innerText || this.textContent;
			curUrl = this.getAttribute( "href", 2 );
		}else if(typeof this === 'function'){
			curTitle = title;
			curUrl = url;
		}
		let state = {
			title: curTitle,
			url: curUrl
		}
		history.pushState(state, state.title, state.url);
		Redirect.go(state.url);
		return false;
	}

}













/******************************* core class for CMS  *******************************/
class CMS_CORE{

	constructor(){
		this.is_logging = true;

		this.content_box_id = 'content_box';
		this.site_tree_box_id = 'tree_box';
		this.header_box_id = 'tabs';
		this.loader_box_id = 'loader';

		this.LINK_SITE_PAGE = '/admin/site/pages/';
	}



	static getJSON(url, component_name = '', callback = function(){}){
		if(!url && url === ''){
			console.log('error load json: no url');
			return false;
		}
		new api('api').send(
			url, 
			[], 
			function success(data){
				if(data.status){
					callback(data.data);
				}else{
					EASY_CMS.load_filed(component_name, data.message);
				}
			},
			function error(e){
				console.log(e);
				EASY_CMS.load_filed(component_name, 'Failed to send api script');
			}
		);
	}

	static ajaxSend(url){ console.log('ajax send: ' + url); return false; }

	static load_filed(component_name, message = ''){
		console.groupCollapsed('Failed to load ' + component_name);
		console.log('message: [' + message + ']');
		console.groupEnd();
	}

	static load_success(){}

	show_message(msg = '', status = null){
		if(msg == ''){
			return;
		}
		this.message.show(msg, status);
		if(this.is_logging && !status){
			this.log_message(msg)
		}
	}

	log_message(msg = '', status = null){
		console.log(msg);
	}
}





/******************************* class for CMS  *******************************/
class EASY_CMS extends CMS_CORE{

	constructor(_parent, _onload_func = function(){}, _onrefresh_func = function(){}){
		super();
		this.parent_box_id = _parent;
		this.onload_func = _onload_func;
		this.onrefresh_func = _onrefresh_func;

		this.cms_load = false;
	}

	run(){
		this.init();
		this.loading_environment();
		this.loading_content();
		this.load();
	}

	init(){
		this.get_static_data();
		this.get_dynamic_data();
	}

	get_static_data(){
		let data = {
			'title': 'EASY_CMS',
			'ver': '0.6',
			'username': Cookie.get('username'),
			'menu': [
				{
					'title': 'Главная',
					'uri': '',
					'childrens': [
						{
							'title':'Редактировать общий контент',
							'uri': '/admin/site/content'
						},
						{
							'title':'Добавить страницу',
							'uri': '/admin/site/pages'
						},
					],
				},
				{
					'title': 'Каталоги',
					'uri': '',
					'childrens': [
						{
							'title':'Автобусы',
							'uri': '/admin/catalog/buses'
						},
						{
							'title':'Микроавтобусы',
							'uri': '/admin/catalog/minivans'
						},
						{
							'title':'Новости',
							'uri': '/admin/catalog/news'
						},
						{
							'title':'Вакансии',
							'uri': '/admin/catalog/vacancies'
						},
					],
				},
				{
					'title': 'Настройки',
					'uri': '/admin/site/settings',
				},
				{
					'title': 'Отчёты',
					'uri': '',
					'childrens': [
						{
							'title':'Аккаунты',
							'uri': '/admin/report/accounts'
						},
						{
							'title':'Сессии',
							'uri': '/admin/report/sessions'
						},
						{
							'title':'Действия в сессиях',
							'uri': '/admin/report/actions'
						},
					],
				},
			],
		};

		this.session_username = data['username'] ? data['username'] : 'No Username';
		this.cms_title = data['title'] ? data['title'] : 'No cms name';
		this.cms_version = data['ver'] ? data['ver'] : 'No version';
		this.cms_menu = data['menu'] ? data['menu'] : [];
		this.tab_index = this._get_tab_index(this.cms_menu);
	}

	_get_tab_index(menu){
		let cur_uri = window.location.pathname;
		for(let i = 0; i < menu.length; i++){
			let item = menu[i];
			if(item.uri === cur_uri){
				console.log(i);
				return i;
			}
			let childrens = item.childrens || [];
			for(let j = 0; j < childrens.length; j++){
				if(childrens[j].uri === cur_uri){
					return i;
				}
			};
		}
		return 0;
	}

	get_dynamic_data(){}

	loading_environment(){
		let empty_header_content = Components.header(this.cms_title, this.cms_version, this.session_username, this.cms_menu, this.header_box_id),
			empty_wrapper_content = Components.wrapper(this.site_tree_box_id, this.content_box_id, this.loader_box_id),
			empty_footer_content = Components.footer();

		let content = empty_header_content + empty_wrapper_content + empty_footer_content;

		try{
			document.getElementById(this.parent_box_id).innerHTML = content;
		}
		catch(e){
			console.log('no box (#'+this.parent_box_id+') for load cms');
			return;
		}

		document.title = this.cms_title;
		this._init_tabs();

		this.environment_loaded = true;
	}

	_init_tabs(){
		let tabs = document.getElementById(this.header_box_id);
		let nav = tabs.querySelectorAll('.' + Components.header_nav_parent__class_name()),
			navLis = tabs.querySelectorAll('.' + Components.header_nav_menu__item__class_name()),
			content = tabs.querySelectorAll('.' + Components.header_content_parent__class_name()),
			contentLis = tabs.querySelectorAll('.' + Components.header_content_menu__item__class_name());
		$(navLis[this.tab_index]).addClass('active');
		$(contentLis[this.tab_index]).addClass('active');
		navLis.forEach(function(item, index){
			item.classList.add('header_nav_list_item_'+index);
			item.addEventListener('click', function(){
				let data = item.getAttribute('class');
				let index = data.lastIndexOf('_');
				data = parseInt(data.substr(index+1));
				let contentLi = contentLis[data];
				navLis.forEach(function(inner_item){
					inner_item.classList.remove('active');
				});
				contentLis.forEach(function(inner_item){
					inner_item.classList.remove('active');
				});
				contentLi.classList.add('active');
				item.classList.add('active');
			});
		});
		contentLis.forEach(function(item, index){
			item.classList.add('header_nav_content_item_'+index);
		});
	}

	loading_content(){
		this._refresh_tree();
		this._refresh_content(window.location.pathname + window.location.search);
	}

	load(){
		let THIS = this;
		let id = setInterval(function(){
			if(THIS.content_loaded && THIS.tree_loaded){
				clearInterval(id);
				THIS.onload();
			}
		}, 5);
	}

	onload(){
		this.cms_load = true;
		this.content_loader = new Loader(this.loader_box_id);
		this.content_loader.hide();
		this.message = new Message();
		this.onload_func();
	}

	


	redirect(uri){
		this._refresh_content(uri);
		let THIS = this;
		let id = setInterval(function(){
			if(THIS.content_loaded){
				clearInterval(id);
				THIS.onrefresh_func();
			}
		}, 5);
	}

	_refresh_tree(){
		this.tree_loaded = false;
		let THIS = this;
		EASY_CMS.getJSON('/admin/api/site_tree', 'site tree', function callback(data){
			if(data){
				let tree_parent = document.getElementById(THIS.site_tree_box_id);
				tree_parent.className = Components.tree_parent__class_name();
				tree_parent.innerHTML = '';
				tree_parent.innerHTML = Components.get_tree(data, THIS.LINK_SITE_PAGE);
				THIS._refresh_tree_scroll();
				THIS.tree_loaded = true;
			}
		});
	}

	_refresh_tree_scroll(){
		let tree_parent = document.getElementById(this.site_tree_box_id);
		//включаем развёртывание подразделов
		tree_parent.querySelectorAll('.'+Components.tree_item__title__class_name()).forEach(function(item, index){
			item.addEventListener('click', function(){
				let content = this.nextSibling;
				let parent = this.parentElement;
				if (parent.classList.contains('active')) {
					parent.classList.remove('active');
					$(content).stop().slideUp(400);
				} else {
					tree_parent.querySelectorAll('.'+Components.tree_item__class_name()+'.active').forEach(function(item, index){
						item.classList.remove('active');
						item.querySelectorAll('.'+Components.tree_item__list__class_name()).forEach(function(item, index){
							$(item).stop().slideUp(400);
						});
					});
					parent.classList.add('active');
					$(content).stop().slideDown(400);
				}
			});
		});
		//включаем скролл
		$(tree_parent).mCustomScrollbar();
	}


	_refresh_content(url = ''){
		this.content_loaded = false;
		let THIS = this;
		EASY_CMS.getJSON(url, 'content', function callback(data){
			if(data){
				let content_component = Components.get_content(data);
				if(content_component){
					document.getElementById(THIS.content_box_id).innerHTML = content_component;
					$(".main_content_info").mCustomScrollbar();
				}else{
					THIS.show_message('error load content data', false);
				}
			}
			THIS.content_loaded = true;
		});
	}

}























/******************************* class for CMS  *******************************/
class Components{

	/* PUBLIC METHODS */
	static header(title, version, username, menu, header_box_id){
		return Components._get_header(title, version, username, menu, header_box_id);
	}

	static wrapper(site_tree_box_id, content_box_id, loader_box_id){
		return Components._get_wrapper(site_tree_box_id, content_box_id, loader_box_id);
	}

	static footer(){
		return '<div class="footer"></div>';
	}

	static get_tree(site_tree=[], link_site_page = ''){
		return Components._get_site_tree(site_tree, link_site_page);
	}

	static get_content(data_content){
		if(!data_content.TYPE){
			return false;
		}
		//console.log(data_content);
		let TITLE = data_content.CONTENT.TITLE || '';
		delete data_content.CONTENT.TITLE;
		let CONTENT = data_content.CONTENT,
			BUTTONS = data_content.BUTTONS || null,
			ADDITIONS = data_content.ADDITIONS || null;
		//console.log(TITLE, CONTENT, BUTTONS, ADDITIONS);
		switch(data_content.TYPE){
			case PAGE_TYPES.PAGE():
				return Components._get_page__simple_page(TITLE, CONTENT, BUTTONS);
			case PAGE_TYPES.REPORT():
			case PAGE_TYPES.CATALOG():
				return Components._get_page__catalog(TITLE, CONTENT.COLUMNS, CONTENT.ROWS, BUTTONS);
			case PAGE_TYPES.CONFIG():
				return Components._get_page__config();
			default:
				return false;
		}
	}
	/* PUBLIC METHODS END */


	/* STATIC VARIABLES */
	static header_nav_parent__class_name(){			return 'header_nav_list'; }
	static header_nav_menu__item__class_name(){		return 'header_nav_list_item'; }
	static header_content_parent__class_name(){		return 'header_nav_content'; }
	static header_content_menu__item__class_name(){	return 'header_nav_content_item'; }

	static tree_parent__class_name(){				return 'main_nav'; }
	static tree_item__title__class_name(){			return 'main_nav_list_title'; }
	static tree_item__list__class_name(){			return 'main_nav_list_item'; }
	static tree_item__class_name(){					return 'main_nav_list'; }

	static loader__count_elements(){				return 10; }
	/* STATIC VARIABLES END */


	/* PRIVATE METHODS */

	static _get_page__simple_page(title = '', data = [], buttons = ''){
		//console.log(title);
		//console.log(data);
		//console.log(buttons);
		let body = '';
		let common = data.FIELDS.COMMON,
			content = data.FIELDS.CONTENT;
		let parent = null;

		if(common && common.length > 0){
			common.forEach(function(item, index){
				if(item.CMS_TYPE__PARENT_BOX && item.CMS_TYPE__PARENT_BOX != ''){
					parent = data[item.CMS_TYPE__PARENT_BOX];
					//console.log(parent);
				}
				common[index] = Components._get_html_field(item, parent);
				if(common[index] == 'false' || common[index] == false){
					common[index] = '';
				}
				parent = null;
			});
		}

		if(content && content.length > 0){
			content.forEach(function(item, index){
				if(item.CMS_TYPE__PARENT_BOX && item.CMS_TYPE__PARENT_BOX != ''){
					parent = data[item.CMS_TYPE__PARENT_BOX];
				}
				content[index] = Components._get_html_field(item, parent);
				if(content[index] == 'false' || content[index] == false){
					content[index] = '';
				}
				parent = null;
			});
		}

		return "<div class='main_content_head'><p class='main_content_head_title'>" + title + "</p><div class='buttons'>" +
		/*
			<button class="add" onclick="modalOpen()">Add</button>
			<button class="save" onclick="Change('save/pages')"><?php echo ((isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)) ? 'Save' : 'Add'); ?></button>
			<?php if(isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)): ?><button class="remove" onclick="Delete('delete/pages/<?php echo $CONTENT['ALL']['ID']; ?>')">Remove</button><?php endif; ?>
		*/
		"</div></div>\
		<div class='main_content_info'>\
			<form id='data'  class='block_form'>\
				<div class='block_settings'><div class='buttons'><button class='add block_hide' onclick='return hideThis(this)'>Cвернуть</button></div></div><p class='form_title'>Общие</p>\
				<div class='form_content'>\
					<input type='text' name='ID' value='" + data.ID + "' style='display:none;'>"
					+ common.join('') +
				"</div>\
			</form><form id='data'  class='block_form'>\
				<div class='block_settings'><div class='buttons'><button class='add block_hide' onclick='return hideThis(this)'>Cвернуть</button></div></div><p class='form_title'>Контент</p>\
				<div class='form_content'>"
					+ content.join('') +
				"</div>\
			</form>\
		</div>";
	}
	

	static _get_page__catalog(title = '', columns = [], rows = [], buttons = ''){
		//console.log(title);
		//console.log(columns);
		//console.log(rows);
		//console.log(buttons);
		
		buttons = buttons && buttons != null && buttons != '' ? '<button class="add" onclick="addBus(this)">Добавить запись</button>' : '';
		
		let thead = '';
		columns.forEach(function(item, index){
			let style = item.PERC > 0 ? (" style='min-width:" + (item.PERC || 5) + "%'") : '';
			thead += "<td" + style + ">" + item.NAME + "</td>";
		});
		thead = '<tr><td style="min-width:1%; max-width:7%">#</td>' + thead + '</tr>';

		let tbody = '';
		if(rows && rows.length > 0){
			rows.forEach(function(item, index){
				let tr = '<td>' + (index + 1) + '</td>';
				columns.forEach(function(colItem, colIndex){
					let valCol = item.DATA[colItem.COL];
					switch(colItem.TYPE){
						case 'text':
							tr += '<td>'+valCol+'</td>';
							break;
						case 'text_img':
						case 'img':
							let text = valCol.alt && valCol.alt != '' ? valCol.alt + ' ' : '';
							let style = valCol.style && valCol.style != '' ? ' style="' + valCol.style + '"' : '';
							let link = '"' + valCol.link + '"';
							tr += '<td>' + text + '<img' + style + ' src='+ link + '></td>';
							break;
						case 'btn':
							let classList = (valCol.classList && valCol.classList != '' ? ' class="' + valCol.classList + '"' : '');
							let events = '';
							Object.keys(valCol.events).forEach(function(eventName){
								let eventFunc = valCol.events[eventName];
								if(eventFunc != ''){
									events += ' ' + eventName + '="' + eventFunc + '"';
								}
							});
							tr += '<td><button' + classList + events + '>' + valCol.text + '</button></td>';
							break;
					}
				});
				let redirect = item.REDIRECT;
				let redir_func = redirect && redirect != '' ? 'style="cursor:pointer" onclick="Redirect.handler(\'' + redirect + '\')"' : '';	
				tbody += '<tr onmouseover="this.style.background = \'#999\'" onmouseleave="this.style.background = \'#fff\'"' + redir_func + '>' + tr + '</tr>';
			});
		}else{
			tbody = '<tr><td colspan="' + (columns.length + 1) + '"><center>Нет записей</center></td></tr>';
		}

		return '<div class="main_content_head"><p class="main_content_head_title">' + title + '</p><div class="buttons">' + buttons + '</div></div>\
				<div class="main_content_info"><form class="general block_form" style="text-align:center;"><div class="table_info forma_group">\
				<table style="min-width:100%" class="forma_group_item"><tbody style="min-width:100%">' + thead + tbody + '</tbody></table>\
				</div></form></div>';
	}

	static _get_page__config(){
		return '';
	}


	static _get_site_tree(tree = [], href){	
		tree.forEach(function(item, index){
			let ID = item.ID,
				TITLE = item.TITLE,
				CAN_BE_SUPPLEMENTED = item.CAN_BE_SUPPLEMENTED;
			let CHILDRENS = '';
			if(CAN_BE_SUPPLEMENTED && item.CHILDRENS && item.CHILDRENS.length > 0){
				TITLE += ' (' + item.CHILDRENS.length + ')';
				CHILDRENS = Components._get_site_tree_childrens(item.CHILDRENS, href);
			}
			tree[index] = '<ul class="' + Components.tree_item__class_name() + '"><a class="main_nav_list_add Go" href="' + href + ID + '">C</a><a class="' + Components.tree_item__title__class_name() + '"><b>' + TITLE + '</b></a>' + CHILDRENS + '</ul>';
		});
		return tree.join('');
	}

	static _get_site_tree_childrens(childrens, href){
		childrens.forEach(function(item, index){
			let ID = item.ID,
				TITLE = item.TITLE,
				CAN_BE_SUPPLEMENTED = item.CAN_BE_SUPPLEMENTED;
			let CHILDRENS = '';
			if(CAN_BE_SUPPLEMENTED && item.CHILDRENS && item.CHILDRENS.length > 0){
				TITLE += ' (' + item.CHILDRENS.length + ')';
				/*
				GET CHILDRENS FOR CHILDRENS WITH Components._get_site_tree_childrens(item.CHILDRENS, href)
				*/
				//CHILDRENS = Components._get_site_tree_childrens(tree[i].CHILDRENS, href);
			}
			childrens[index] = '<li class="main_nav_list_item"><a class="Go" href="' + href + ID + '">' + TITLE + '</a></li>';
		});
		return childrens.join('');
	}

	static _get_header(title, version, username, menu, header_box_id){
		return "<div class='header'>\
				<div class='header_nav' id='" + header_box_id + "'>" + Components._get_header_menu(menu) + "</div>\
				<div class='header_settings'>\
					<div class='logo'>\
						<img src='/application/views/mainAdmin/img/logo.png' alt=''>\
						<div class='logo_text'>\
							<p>" + title + "<span> " + version + "</span></p>\
						</div>\
					</div>\
					<p class='name'>" + username + "</p>\
					<a class='Go' href='/admin/config' class='settings'>Настройки</a>\
					<a href='/admin/logout' class='logaut'>Выход</a>\
				</div>\
			</div>";
	}

	static _get_header_menu(menu){
		let menu_list = [], 
			menu_content = [];
		menu.forEach(function(item_list, index_list){
			let TITLE = item_list.title,
				URI = item_list.uri,
				CHILDRENS = item_list.childrens ? item_list.childrens : [];
			let go = URI ? ' class="Go" href="' + URI + '"' : '';
			menu_list[index_list] = '<li class="header_nav_list_item"><a'+go+'>' + TITLE + '</a></li>';
			menu_content[index_list] = '';
			CHILDRENS.forEach(function(item_content, index_content){
				let TITLE = item_content.title,
					URI = item_content.uri;
				menu_content[index_list] += '<li><a class="Go" href="' + URI + '">' + TITLE + '</a></li>';	
			});
			menu_content[index_list] = '<li class="header_nav_content_item"><ul>' + menu_content[index_list] + '</ul></li>';
		});
		return '<div class="header_nav_list"><ul>' + menu_list.join('') + '</ul></div><div class="header_nav_content"><ul>' + menu_content.join('') + '</ul></div>';
	}


	static _get_wrapper(site_tree_box_id, content_box_id, loader_box_id){
		return "<div class='main_wrapper'>\
			<div class='main'>\
				<div id='"+site_tree_box_id+"' class='" + Components.tree_parent__class_name() + "'></div>\
				<div class='content_box'>"
					+ Components._get_wrapper__loader(loader_box_id) +
					"<div class='main_content'>\
						<div class='add_case' id='"+content_box_id+"'></div>\
						<div class='modal_wnd'>\
							<div class='modal_wnd_wrapper' id='wrap' onclick='modalClose()'></div>\
							<div class='modal_wnd_inner' id='window'>\
								<div class='modal_wnd_head'>\
									<div class='buttons'>\
										<button onclick='modalClose()' class='remove'>Отмена</button>\
										<button onclick='return addBlock(this)' class='save'>Добавить</button>\
									</div>\
								</div>\
								<div class='modal_wnd_content'>\
									<div class='modal_wnd_form'>\
										<form>\
											<select name='block' id='selectedBlock' size='5' onchange='changeDescr(this)'>\
												<option selected value='-1'>- - - - - Выберите блок для добавления - - - - -</option>\
												<option value='H1'>H1</option>\
												<option value='H2'>H2</option>\
												<option value='B1'>B1</option>\
												<option value='B2'>B2</option>\
												<option value='B3'>B3</option>\
												<option value='B4'>B4</option>\
												<option value='B5'>B5</option>\
												<option value='EXC1'>EXC1</option>\
											</select>\
										</form>\
									</div>\
									<div class='modal_wnd_info'>\
										<p class='modal_wnd_info_title'>--</p>\
										<p class='modal_wnd_info_content'>--</p>\
									</div>\
								</div>\
							</div>\
						</div>\
					</div>\
				</div>\
			</div>\
		</div>";
	}

	static _get_wrapper__loader(loader_box_id){
		return '<div id="' + loader_box_id + '" class="loader_box"><div class="loader">' + ('<div class="element_box"><div class="element"></div></div>'.repeat(Components.loader__count_elements())) + '</div></div>';
	}
	/* PRIVATE METHODS END */

	/* FIELDS */
	static _get_html_field(item, parent = null){
		let disabled = item.DISABLED || false,
			type = item.CMS_TYPE || null,
			value = item.VAL,
			variable = item.VAR,
			cmsTitle = item.CMS_TITLE,
			cmsDescr = item.CMS_DESCR,
			cmsParent = type == FIELD_TYPES.CMB() ? parent : null,
			events = item.EVENTS.length != 0 ? item.EVENTS : null;
		let startBox = "<div class='forma_group'><p>" + cmsTitle + "</p>",
			endBox = "<p class='forma_group_item_description'>" + cmsDescr + "</p></div></div>";

		let events_str = '';
		if(events != null){
			Object.keys(events).forEach(function(key){
				events_str += " " + key + "='" + events[key] + "'";
			});
		}

		if(type == null){
			console.log(item);
		}

		switch(type){
			case FIELD_TYPES.TEXT():
				return startBox + Components._get_html_field__text(value, variable, disabled, events_str) + endBox;
			case FIELD_TYPES.NUMBER():
				return startBox + Components._get_html_field__number(value, variable, disabled, events_str) + endBox;
			case FIELD_TYPES.TEXT_AREA():
				return startBox + Components._get_html_field__text_area(value, variable, disabled, events_str) + endBox;
			case FIELD_TYPES.NUMBER_BTN():
				return startBox + Components._get_html_field__number_btn(value, variable, disabled, events_str) + endBox;
			case FIELD_TYPES.FILE():
				return startBox + Components._get_html_field__file(value, variable, disabled, events_str) + endBox;
			case FIELD_TYPES.CMB():
				return startBox + Components._get_html_field__cmb(value, variable, disabled, events_str, cmsParent) + endBox;
			case FIELD_TYPES.CB():
				return startBox + Components._get_html_field__cb() + endBox;
			case null:
				return false;
		}
	}

	static _get_html_field__text(value, varName, disabled, events){
		return "<div class='forma_group_item text'><input " + (disabled ? 'disabled ': '') + events + "autocomplete='off' type='text' name='" + (!disabled ? varName : '') + "' value='" + value + "'>";
	}

	static _get_html_field__number(value, varName, disabled, events){
		return "<div class='forma_group_item text'><input " + (disabled ? 'disabled ': '') + events + "autocomplete='off' type='text' name='" + (!disabled ? varName : '') + "' value='" + value + "' pattern='[0-9]{1,}'>";
	}

	static _get_html_field__text_area(value, varName, disabled, events){
		return "<div class='forma_group_item textarea'><textarea " + (disabled ? 'disabled ': '') + events + "autocomplete='off' name='" + (!disabled ? varName : '') + "'>" + (value != '' ? value : '<p></p>') + "</textarea>";
	}

	static _get_html_field__number_btn(value, varName, disabled, events){
		return "<div class='forma_group_item text_btn'><input " + (disabled ? 'disabled ': '') + events + "autocomplete='off' type='text' name='" + (!disabled ? varName : '') + "' value='" + value + "' pattern='[0-9]{1,}'><div class='text_btns'><div class='btn_next' onclick='plus(this)'><p>+</p></div><div class='btn_prev' onclick='minus(this)'><p>-</p></div></div>";
	}

	static _get_html_field__file(value, varName, disabled, events){
		return "<div class='forma_group_item file'><input " + (disabled ? 'disabled ': '') + events + "autocomplete='off' type='file' name='" + (!disabled ? varName : '') + "' title='" + value + "'>";
	}

	static _get_html_field__cmb(value, varName, disabled, events, parent){
		let selected = ' selected',
			curselected = '';
		if(parent != null){
			parent.forEach(function(item, index){
				if(item.VALUE == value){
					curselected = ' selected';
					selected = '';
				}
				parent[index] = item.VALUE && item.TEXT ? "<option value='" + item.VALUE + "'" + curselected + ">" + item.TEXT + "</option>" : '';
				curselected = '';
			});
			parent = !(disabled && selected != '') ? "<option value='0'" + selected + "> ---Выберите раздел--- </option>" + parent.join('') : '';
		}else{
			parent = '';
		}
		return "<div class='forma_group_item select'><select " + (disabled ? 'disabled ': '') + events + "name='" + (!disabled ? varName : '') + "'>" + parent + "</select>";
	}

	static _get_html_field__cb(){
		return '<div>';
	}
	/* FIELDS END */
}




class PAGE_TYPES{
	static PAGE(){		return 1; }
	static REPORT(){	return 2; }
	static CATALOG(){	return 3; }
	static CONFIG(){	return 4; }
}

class FIELD_TYPES{
	static TEXT(){		return 'TEXT'; }
	static NUMBER(){	return 'NUMBER'; }
	static TEXT_AREA(){	return 'TEXT_AREA'; }
	static NUMBER_BTN(){return 'NUMBER_BTN'; }
	static FILE(){		return 'FILE'; }
	static CMB(){		return 'CMB'; }
	static CB(){		return 'CB'; }
}






class Cookie{

	static set(name, value, options){
		Cookie._setCookie(name, value, options);
	}

	static get(name = ''){
		var matches = document.cookie.match(new RegExp(
			"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));
		return matches ? decodeURIComponent(matches[1]) : undefined;
	}

	static delete(name){
		Cookie._setCookie(name, '', {
			expires: -1
		});
	}

	static _setCookie(name, value, options){
		options = options || {};

		var expires = options.expires;

		if (typeof expires == "number" && expires) {
			var d = new Date();
			d.setTime(d.getTime() + expires * 1000);
			expires = options.expires = d;
		}
		if (expires && expires.toUTCString) {
			options.expires = expires.toUTCString();
		}

		value = encodeURIComponent(value);

		var updatedCookie = name + "=" + value;

		for (var propName in options) {
			updatedCookie += "; " + propName;
			var propValue = options[propName];
			if (propValue !== true) {
				updatedCookie += "=" + propValue;
			}
		}

		document.cookie = updatedCookie;
	}

}

class Local_Components{

}
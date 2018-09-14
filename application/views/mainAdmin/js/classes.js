/******************************* class for communication with server  *******************************/
class api{

	constructor(type){
		this.type = type;
	}

	send(uri, data = {}, returnVar = ''){
		switch(this.type){
			case 'get':
				this.getContent(uri, returnVar, data);
				break;
			case 'api':
				this.sendApi(uri, data, returnVar);
				break;
		}
	}

	getContent(uri, Class, data){
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

	sendApi(uri, data, callback){
		$.ajax({
			url: uri,
			type: 'POST',
			data: data,
			dataType: 'JSON',
	        contentType: false,
	        processData: false,
	        cache: false,
			success: function(data){
				//console.log(data);
				try{
					callback(data.message, data.status, data.data);
				}catch(e){
					console.log('Error of api script. Refresh page!');
				}finally{
					loader.hide();
				}
			},
			error: function(e){
				console.log(e.responseText);
				console.log('something was wrong. Refresh page!');
				loader.hide();
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

	constructor(box){
		this.classLoaderPage = box;
		this.loaderPageHide = 10;
		this.loaderHideWeight = 0.01;
		this.loader = $(this.classLoaderPage)[0];

		this.opacityFirstBreakPoint = 0.85;
		this.opacitySecondBreakPoint = 0.65;
	}

	show(){
		this.loader.style.opacity = 1;
		this.loader.classList.remove('hide');
	}

	hide(){
		let loader = this.loader,
			timehide = this.loaderPageHide,
			weight = this.loaderHideWeight,
			bpFirst = this.opacityFirstBreakPoint,
			bpFirstIsset = false,
			bpSecond = this.opacitySecondBreakPoint,
			bpSecondIsset = false;
		setTimeout(function tickHideLoader(){
			loader.style.opacity -= weight;
			if(loader.style.opacity <= bpFirst && !bpFirstIsset){
				weight = weight * 2;
				bpFirstIsset = true;
			}else if(loader.style.opacity <= bpSecond && !bpSecondIsset){
				weight = weight * 4;
				bpSecondIsset = true;
			}
			if(loader.style.opacity <= 0){
				loader.classList.add('hide');
				loader.removeAttribute('style');
			}else{
				setTimeout(tickHideLoader, timehide);
			}
		}, timehide);
	}
}


/******************************* class for redirect (static and global)  *******************************/
class Redirect{

	constructor(Class){
		this.anchors = document.getElementsByClassName(Class);
		for(let i = 0; i < this.anchors.length; i++ ) {
			this.anchors[i].onclick = Redirect.handler;
		}
		window.onpopstate = function( e ) {
			Redirect.go(history.state.url);
		}
	}

	static go(uri){
		loader.show();
		new api('api').send(uri, {}, Redirect.loadPage);
	}

	static loadPage(content, status){
		$('.main_content').html(content);
		custormScrollContent();
		hideAllBlocks();
	}

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
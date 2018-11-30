<div class="empty_page">
	<img src="/assets/img/static/empty_page.png"><span>Страница ещё не сформирована!</span>
	<script>
		document.addEventListener('DOMContentLoaded', function(){
			resize_423(document.querySelector('.empty_page'));
		});

		function resize_423(elem){
			let h = document.querySelector('.header_wrapper').clientHeight,
				f = document.querySelector('.footer_wrapper').clientHeight,
				d = window.innerHeight,
				newHeight = d - f - h;
			elem.style.height = newHeight + 'px';
		}
	</script>
</div>
<style>
	.empty_page{
		position: relative;
		width: 100%;
	}

	.empty_page img{
		max-width: 100%;
		height: auto;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%)
	}

	.empty_page span{
		text-align: center;
		width:100%;
		position: absolute;
		left: 0;
		top: 50%;
		transform: translate(-50%, 0)
		font-size: 1rem;
	}
</style>
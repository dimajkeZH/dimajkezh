<div class="services_head_wrapper">
			<div class="services_head">
				<div class="services_head_info">
					<img src="/assets/img/services/services_head.png" alt="">
					<?php if((isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!=''))OR((isset($CONTENT['DESCR']))AND($CONTENT['DESCR']!=''))): ?>
					<div class="services_head_text">
						<h1><?php echo $CONTENT['TITLE']?></h1>
						<?php if(isset($CONTENT['DESCR'])): ?>
							<p><?php echo $CONTENT['DESCR']; ?></p>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if(isset($PAGELIST)AND(count($PAGELIST)>0)): ?>
		<div class="services_list_wrapper">
			<div class="services_list">
				<div class="services_list_title">
					<h2>Список услуг</h2>
					 <div class="services_line"></div>
				</div>
				<div class="services_list_items">
					<?php for($i = 0; $i< count($PAGELIST); $i++): ?>
					<div class="services_list_item">
						<h3><?php echo $PAGELIST[$i]['TITLE']; ?></h3>
						<img src=<?php echo '"/assets/img/services/'.$PAGELIST[$i]['IMAGE'].'.png"'; ?> alt="">
						<div class="services_list_button">
							<a href=<?php echo '"uslugi/'.$PAGELIST[$i]['LINK'].'"'; ?>><p>Подробнее</p></a>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
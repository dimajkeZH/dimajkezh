<div class="services_head_wrapper">
			<div class="services_head">
				<div class="services_head_info">
					<img src="/assets/img/services/services_head.png" alt="">
					<?php if((isset($TITLE)AND($TITLE!=''))OR((isset($DESCR))AND($DESCR!=''))): ?>
					<div class="services_head_text">
						<p><?php echo $TITLE?></p>
						<?php if(isset($DESCR)): ?>
							<p><?php echo $DESCR; ?></p>
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
					<p>Список услуг</p>
					 <div class="services_line"></div>
				</div>
				<div class="services_list_items">
					<?php for($i = 0; $i< count($PAGELIST); $i++): ?>
					<div class="services_list_item">
						<p><?php echo $PAGELIST[$i]['TITLE']; ?></p>
						<img src=<?php echo '"/assets/img/services/'.$PAGELIST[$i]['IMAGE'].'"'; ?> alt="">
						<div class="services_list_button">
							<a href=<?php echo '"'.$PAGELIST[$i]['LINK'].'"'; ?>><p>Подробнее</p></a>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
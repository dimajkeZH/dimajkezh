	<div class="main_wrapper">
		<div class="services_head_wrapper">
			<div class="services_head">
				<div class="services_head_info">
					<img src="/assets/img/services/services_head.png" alt="">
					<?php if((isset($TITLE)AND($TITLE[0]!=''))OR((isset($DESCR))AND(count($DESCR)>0))): ?>
					<div class="services_head_text">
						<p><?php echo $TITLE[0]?></p>
						<?php if(isset($DESCR)): ?>
							<?php foreach($DESCR as $key => $val): ?>
							<p><?php echo $val; ?></p>
							<?php endforeach; ?>
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
	</div>
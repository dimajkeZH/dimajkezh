		<div class="buses_main">
			<div class="buses_main_head">
				<div class="buses_main_head_img bus_one"><img src="/assets/img/buses/bus_head_one.png" alt=""></div>
				<div class="buses_main_head_title"><p><?php echo $CONTENT['TITLE']; ?></p>
				<div class="buses_main_head_line"></div></div>
				<div class="buses_main_head_img bus_two"><img src="/assets/img/buses/bus_head_two.png" alt=""></div>
			</div>
		</div>
		<div class="text_wrapper">
			<p class="text_title">Заказ автобусов - тарификация</p>
			<div class="main_line"></div>
			<div class="text">
				<?php if(isset($CONTENT['DESCR'])AND(count($CONTENT['DESCR'])>0)): ?>
					<?php foreach($CONTENT['DESCR'] as $key=>$val): ?>
					<p><?php echo $val; ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

<?php //debug($CONTENT); ?>
		<div class="bus_description">
			<p class="bus_title"><?php echo isset($CONTENT['TITLE']) ? $CONTENT['TITLE'] : ''; ?></p>
			<div class="main_line"></div>
			<div class="bus_items">
				<div class="bus_item item_img"><img src="/assets/img/buses/catalog/<?php echo isset($CONTENT['IMAGE_OUTER']) ? $CONTENT['IMAGE_OUTER'] : ''; ?>.png" alt=""></div>
				<div class="bus_item item_img"><img src="/assets/img/buses/catalog/<?php echo isset($CONTENT['IMAGE_INNER']) ? $CONTENT['IMAGE_INNER'] : ''; ?>.png" alt=""></div>
				<div class="bus_item item_text">
					<p class="item_text_title"><?php echo isset($CONTENT['TECH_TITLE']) ? $CONTENT['TECH_TITLE'] : ''; ?></p>
					<div class="item_text_info">
						<ul><?php echo isset($CONTENT['TECH_DESCR']) ? $CONTENT['TECH_DESCR'] : ''; ?></ul>
					</div>
				</div>
			</div>
			<div class="bus_content"></div>
		</div>
		<div class="text_wrapper">
			<div class="text_title"><?php echo isset($CONTENT['SUBTITLE']) ? $CONTENT['SUBTITLE'] : ''; ?></div>
			<div class="text"><?php echo isset($CONTENT['TEXT']) ? $CONTENT['TEXT'] : ''; ?></div>
		</div>
		<?php if($CONTENT['TITLE']): ?>
		<div class="moscow_head">
			<h1 class="moscow_head_title"><?php echo $CONTENT['TITLE']; ?></h1>
			<div class="main_line"></div>
		</div>
		<?php endif; ?>
		<?php $maxindex = max(count($CONTENT['INFO_TITLE']), count($CONTENT['INFO_DESCR']));
		if($maxindex > 0): ?>
		<div class="moscow_info_items">
			<?php  for($index = 0; $index < $maxindex; $index++): ?>
			<div class="moscow_info_item">
				<div class="moscow_info_item_img"><img src="/assets/img/static/m<?php echo ($index + 1); ?>.png" alt=""></div>
				<div class="moscow_info_item_text">
					<h3 class="moscow_info_item_title"><?php echo $CONTENT['INFO_TITLE'][$index]; ?></h3>
					<p class="moscow_info_item_content"><?php echo $CONTENT['INFO_DESCR'][$index]; ?></p>
				</div>
			</div>
			<?php endfor; ?>
		</div>
		<?php endif; ?>

		<div class="moscow_top">
			<h2 class="moscow_top_title"><?php echo $CONTENT['PLACE_TITLE']; ?></h2>
			<div class="main_line"></div>
			<div class="moscow_top_info">
				<div class="moscow_top_img">
					<img src="/assets/img/static/big_bcg.png" alt="">
				</div>
				<div class="moscow_top_info_text one">
					<p>1.</p>
					<p>Московский Кремль и исторический центр</p>
				</div>
				<div class="moscow_top_info_text two">
					<p>2.</p>
					<p>Храмы Москвы</p>
				</div>
				<div class="moscow_top_info_text three">
					<p>3.</p>
					<p>Сталинская архитектура</p>
				</div>
				<div class="moscow_top_info_text four">
					<p>4.</p>
					<p>Места великих.</p>
				</div>
				<div class="moscow_top_info_text five">
					<p>5.</p>
					<p>Интересные места</p>
				</div>
				<div class="moscow_top_info_text six">
					<p>6.</p>
					<p>Небоскребы Москвы</p>
				</div>
				<div class="moscow_top_info_text seven">
					<p>7.</p>
					<p>Вся Москва</p>
				</div>
			</div>
		</div>

		<div class="moscow_prices">
			<?php if($CONTENT['PRICE_TITLE']): ?>
			<div class="moscow_price_head">
				<h2 class="moscow_price_head_title"><?php echo $CONTENT['PRICE_TITLE']; ?></h2>
				<div class="main_line"></div>
			</div>
			<?php endif; ?>
			<?php $maxindex = max(count($CONTENT['PRICE_SUBTITLE']), count($CONTENT['PRICE_IMAGE']), count($CONTENT['PRICE_COST']), count($CONTENT['PRICE_TEXT']));
			if($maxindex > 0): ?>
			<div class="moscow_prices_items">
				<?php for($index = 0; $index < $maxindex; $index++): ?>
				<div class="moscow_prices_item">
					<div class="moscow_prices_item_img">
						<div class="moscow_prices_item_line"></div>
						<img src="/assets/img/excursions/<?php echo $CONTENT['PRICE_IMAGE'][$index]; ?>.png" alt="">
					</div>
					<div class="moscow_prices_item_text">
						<p class="moscow_prices_item_title"><?php echo $CONTENT['PRICE_SUBTITLE'][$index]; ?></p>
						<p class="moscow_prices_item_price"><?php echo $CONTENT['PRICE_COST'][$index]; ?></p>
						<p class="moscow_prices_item_content"><?php echo $CONTENT['PRICE_TEXT'][$index]; ?></p>
					</div>
				</div>
				<?php endfor; ?>
			</div>
			<?php endif; ?>
			<?php if($CONTENT['END_TEXT']): ?>
			<div class="moscow_text">
				<?php foreach($CONTENT['END_TEXT'] as $endtext): ?>
				<p><?php echo $endtext; ?></p>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
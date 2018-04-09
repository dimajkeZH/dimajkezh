	<div class="excursions_wrapper">
		<div class="excursions_head">
			<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
				<p class="excursions_head_title"><?php echo $CONTENT['TITLE']; ?></p>
				<div class="excursions_head_line"></div>
			<?php endif; ?>
			<?php if(isset($CONTENT['DESCR'])AND($CONTENT['DESCR']!='')): ?>
				<p class="buses_main_head_text"><?php echo $CONTENT['DESCR']; ?></p>
			<?php endif; ?>
		</div>
		<?php if(isset($PAGELIST)AND(count($PAGELIST)>0)): ?>
		<div class="excursions_items">
			<?php for($i = 0; $i < count($PAGELIST); $i++): ?>
			<div class="excursions_item">
				<p class="excursions_item_title"><?php echo $PAGELIST[$i]['TITLE']; ?></p>
				<p class="excursions_item_text"><?php echo $PAGELIST[$i]['DESCR']; ?></p>
				<div class="excursions_item_detail"><a href=<?php echo '"'.$PAGELIST[$i]['LINK'].'"'; ?>>Подробнее</a></div>
			</div>
			<?php endfor; ?>
		</div>
		<?php endif; ?>
	</div>
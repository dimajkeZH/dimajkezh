<div class="catalog_wrapper">
	<h2 class="catalog_title"><?php echo $CONTENT['TITLE']; ?></h2>
	<div class="catalog_items">
		<?php foreach($DATA as $key => $val): ?>
		<div class="catalog_item">
			<div class="catalog_item_text">
				<h3 class="catalog_item_title"><?php echo $val['TITLE'] ? 'Марки автобусов из '.$val['TITLE'] : ''; ?></h3>
				<ul>
					<?php foreach($val['LIST'] as $listkey => $listval): ?>
						<?php if($listval['STATE_LINK']): ?>
						<li class="catalog_item_link"><a href="/<?php echo $listval['URI'] ? $listval['URI'] : ''; ?>"><?php echo $listval['TITLE'] ? $listval['TITLE'] : ''; ?></a></li>
						<?php else: ?>
						<li class="catalog_item_link"><?php echo $listval['TITLE'] ? $listval['TITLE'] : ''; ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="catalog_item_img"><img src="/assets/img/static/cities/<?php echo $val['IMAGE'] ? $val['IMAGE'] : ''; ?>.png" alt=""></div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
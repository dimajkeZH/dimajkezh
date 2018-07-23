		<div class="catalog_wrapper">
			<p class="catalog_title">Туристические и междугородние автобусы из Европы и Восточной Азии.</p>
			<div class="catalog_items">
				<?php foreach($CONTENT as $key => $val): ?>
				<div class="catalog_item">
					<div class="catalog_item_text">
						<p class="catalog_item_title"><?php echo $val['TITLE'] ? 'Марки автобусов из '.$val['TITLE'] : ''; ?></p>
						<ul>
							<?php foreach($val['LIST'] as $listkey => $listval): ?>
								<?php if($listval['STATE_LINK']): ?>
								<li class="catalog_item_link"><a href="/bus/<?php echo $listval['ID'] ? $listval['ID'] : ''; ?>"><?php echo $listval['TITLE'] ? $listval['TITLE'] : ''; ?></a></li>
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
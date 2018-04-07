<div class="buses_main">
			<div class="buses_main_head">
				<?php if(isset($TITLE)AND($TITLE!='')): ?>
				<p class="buses_main_head_title"><?php echo $TITLE; ?></p>
				<div class="buses_main_head_line"></div>
				<?php endif; ?>
				<?php if(isset($DESCR)AND($DESCR!='')): ?>
					<p class="buses_main_head_text"><?php echo $DESCR; ?></p>
				<?php endif; ?>
				<p class="buses_main_head_title_two">Информация по тарифам на страницах сайта</p>
			</div>
			<?php if(isset($PAGELIST)AND(count($PAGELIST)>0)): ?>
			<div class="buses_main_items">
				<?php for($i = 0; $i < count($PAGELIST); $i++): ?>
				<div class="buses_main_item">
					<p class="buses_main_item_title"><?php echo $PAGELIST[$i]['TITLE']; ?></p>
					<p class="buses_main_item_text"><?php echo $PAGELIST[$i]['DESCR']; ?></p>
					<div class="buses_main_item_detail"><a href=<?php echo '"'.$PAGELIST[$i]['LINK'].'"'; ?>>Подробнее</a></div>
				</div>
				<?php endfor; ?>
			</div>
			<?php endif; ?>
		</div>

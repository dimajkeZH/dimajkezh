	<div class="main_wrapper">
		<div class="buses_main">
			<div class="buses_main_head">
				<p class="buses_main_head_title"><?php echo $TITLE[0]; ?></p>
				<div class="buses_main_head_line"></div>
				<?php if(isset($DESCR)AND(count($DESCR)>0)): ?>
					<?php foreach($DESCR as $key=>$val): ?>
					<p class="buses_main_head_text"><?php echo $val; ?></p>
					<?php endforeach; ?>
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
	</div>
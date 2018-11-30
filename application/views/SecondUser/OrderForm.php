			<div class="order_header">
				<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
				<div class="order_header_info">	
					<h1 class="order_header_info_title"><?php echo $CONTENT['TITLE']; ?></h1><div class="order_header_line"></div>
				</div>
				<?php endif; ?>
				<div class="order_header_img_one">
					<?php if(isset($CONTENT['LEFT_IMAGE'])&&($CONTENT['LEFT_IMAGE'] != '')): ?>
					<img src=<?php echo '"/assets/img/templates/header_page/'.$CONTENT['LEFT_IMAGE'].'.png"'; ?> alt="">
					<?php endif; ?>
					<?php if(isset($CONTENT['LEFT_IMAGE_SIGN'])&&($CONTENT['LEFT_IMAGE_SIGN'] != '')): ?>
					<div class="order_header_img_one_text"><p><?php echo $CONTENT['LEFT_IMAGE_SIGN']; ?></p></div>
					<?php endif; ?>
				</div>
				<div class="order_form">
					<div class="order_form_title"><p>Заказ ОN-LINE</p></div>
					<form action="" method="POST">
						<div class="forma_group"><input type="text" placeholder="Дата и время подачи" name="to_date"></div>
						<div class="forma_group"><input type="text" placeholder="Адрес подачи" name="addr_from"></div>
						<div class="forma_group"><input type="text" placeholder="Адрес назначения" name="addr_to"></div>
						<div class="forma_group"><input type="text" placeholder="Ваш телефон или email" name="email_phone"></div>
						<div class="forma_group">
							<select name="user_choice"><?php echo $USER_CHOICE; ?></select>
						</div>
						<div class="forma_group"><input type="text" placeholder="Предложите цену" name="cost"></div>
						<div class="forma_group"><input type="text" placeholder="Комментарий" name="message"></div>
						<button onclick="return order('order_form')"><p>Заказать</p></button>
					</form>
				</div>
				<div class="order_header_img_two">
					<?php if(isset($CONTENT['RIGHT_IMAGE'])AND($CONTENT['RIGHT_IMAGE']!='')): ?>
					<img src=<?php echo '"/assets/img/templates/header_page/'.$CONTENT['RIGHT_IMAGE'].'.png"'; ?> alt="">
					<?php endif; ?>
					<?php if(isset($CONTENT['RIGHT_IMAGE_SIGN'])AND($CONTENT['RIGHT_IMAGE_SIGN']!='')): ?>
					<div class="order_header_img_two_text"><p><?php echo $CONTENT['RIGHT_IMAGE_SIGN']; ?></p></div>
					<?php endif; ?>
				</div>
			</div>





















			<div class="table_type_two">
	<div class="table_info">
		<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
		<h2 class="table_info_title"><?php echo $CONTENT['TITLE']; ?></h2>
		<div class="table_line"></div>
		<?php endif; ?>
		<?php if(isset($CONTENT['SUBTITLE'])AND($CONTENT['SUBTITLE']!='')): ?>
		<p class="table_info_title_type_two"><?php echo $CONTENT['SUBTITLE']; ?></p>
		<?php endif; ?>
		<?php if(isset($CONTENT['DESCR'])AND($CONTENT['DESCR']!='')): ?>
		<p class="table_info_main_text"><?php echo $CONTENT['DESCR']; ?></p>
		<?php endif; ?>
	</div>
	<div class="table_type_two_info">
		<?php if(isset($DATA)AND(count($DATA)>0)): ?>
		<div class="table_type_two_info_table">
			<table>
				<?php
				foreach($DATA as $key => $val){
					$NEWDATA[$val['ROW']][$val['COL']] = $val['VAL'];
				}
				for($x = 1; $x <= count($NEWDATA); $x++){
					echo '<tr>';
					for($y = 1; $y <= count($NEWDATA[$x]); $y++){
						echo '<td>'.$NEWDATA[$x][$y].'</td>';
					}
					echo '</tr>';
				}
				?>
			</table>
		</div>
		<?php endif; ?>
	</div>
</div>




















<div class="text_wrapper">
	<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
	<h2 class="text_title"><?php  echo $CONTENT['TITLE']; ?></h2>
	<div class="main_line"></div>
	<?php endif; ?>
	<?php if(isset($CONTENT['TEXT'])AND($CONTENT['TEXT']!='')): ?>
	<div class="text"><?php  echo $CONTENT['TEXT']; ?></div>
	<?php endif; ?>
</div>



















<div class="images_text">
	<div class="images_text_info">
		<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
		<h2 class="images_text_title"><?php echo $CONTENT['TITLE']; ?></h2>
		<div class="images_line"></div>
		<?php endif; ?>
		<?php if(isset($CONTENT['DESCR'])AND($CONTENT['DESCR']!='')): ?>
		<p class="images_text_info_content"><?php echo $CONTENT['DESCR']; ?></p>
		<?php endif; ?>
	</div>
	<?php if(count($DATA)>0): ?>
	<div class="images_text_items">
		<?php
		for($x = 0; $x < count($DATA); $x++): 
			$sign = (isset($DATA[$x]['IMAGE_SIGN'])AND($DATA[$x]['IMAGE_SIGN']!=''));
			$subtitle = (isset($DATA[$x]['SUBTITLE'])AND($DATA[$x]['SUBTITLE']!=''));
			$link = (isset($DATA[$x]['IMAGE_LINK'])AND($DATA[$x]['IMAGE_LINK']!=''));
		?>
		<div class="images_text_item">
			<?php if($link): ?>
			<img class="images_text_item_img"  src="/assets/img/templates/block_images/<?php echo $DATA[$x]['IMAGE_LINK']; ?>.png" alt="">
			<?php endif; ?>
			<?php if($sign OR $subtitle): ?>
			<div class="images_text_item_info">
				<?php if($subtitle): ?>
				<h3 class="images_text_item_info_title"><?php echo $DATA[$x]['SUBTITLE']; ?></h3>
				<?php endif; ?>
				<?php if($sign): ?>
				<p class="images_text_item_info_content"><?php echo $DATA[$x]['IMAGE_SIGN']; ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endfor; ?>
	</div>
	<?php endif; ?>		
</div>
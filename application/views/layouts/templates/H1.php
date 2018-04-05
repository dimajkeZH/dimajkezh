			<div class="order_header">
				<div class="phone_number"><p>8 495 798 90 08</p></div>
				<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
				<div class="order_header_info">	
					<p class="order_header_info_title"><?php echo $CONTENT['TITLE']; ?></p><div class="order_header_line"></div>
				</div>
				<?php endif; ?>
				<div class="order_header_img_one">
					<?php if(isset($CONTENT['LEFT_IMAGE'])&&($CONTENT['LEFT_IMAGE'] != '')): ?>
					<img src=<?php echo '"'.$CONTENT['LEFT_IMAGE'].'"'; ?> alt="">
					<?php endif; ?>
					<?php if(isset($CONTENT['LEFT_IMAGE_SIGN'])&&($CONTENT['LEFT_IMAGE_SIGN'] != '')): ?>
					<div class="order_header_img_one_text"><p><?php echo $CONTENT['LEFT_IMAGE_SIGN']; ?></p></div>
					<?php endif; ?>
				</div>
				<div class="order_form">
					<div class="order_form_title"><p>Заказ ОN-LINE</p></div>
					<form action="" method="POST">
						<div class="forma_group"><input type="text" placeholder="Дата и время подачи" name=""></div>
						<div class="forma_group"><input type="text" placeholder="Адрес подачи" name=""></div>
						<div class="forma_group"><input type="text" placeholder="Адрес назначения" name=""></div>
						<div class="forma_group"><input type="text" placeholder="Ваш телефон или email" name=""></div>
						<div class="forma_group">
							<select name="" id="" >
								<option value="0">---Выбор транспорта---</option>
								<option value="1">6 Мест</option>
								<option value="2">7 Мест</option>
								<option value="3">8 Мест</option>
								<option value="4">9 Мест</option>
								<option value="5">10 Мест</option>
								<option value="6">11 Мест</option>
								<option value="7">18 Мест</option>
								<option value="8">20 Мест</option>
								<option value="9">24 Места</option>
								<option value="10">28 Мест</option>
								<option value="11">31 Место</option>
								<option value="12">42 Мест</option>
								<option value="13">50 Мест</option>
								<option value="14">55 Мест</option>				
							</select></div>
						<div class="forma_group"><input type="text" placeholder="Предложите цену" name=""></div>
						<div class="forma_group"><input type="text" placeholder="Комментарий" name=""></div>
						<button type="submit"><p>Заказать</p></button>
					</form>
				</div>
				<div class="order_header_img_two">
					<?php if(isset($CONTENT['RIGHT_IMAGE'])AND($CONTENT['RIGHT_IMAGE']!='')): ?>
					<img src=<?php echo '"'.$CONTENT['RIGHT_IMAGE'].'"'; ?> alt="">
					<?php endif; ?>
					<?php if(isset($CONTENT['RIGHT_IMAGE_SIGN'])AND($CONTENT['RIGHT_IMAGE_SIGN']!='')): ?>
					<div class="order_header_img_two_text"><p><?php echo $CONTENT['RIGHT_IMAGE_SIGN']; ?></p></div>
					<?php endif; ?>
				</div>
			</div>
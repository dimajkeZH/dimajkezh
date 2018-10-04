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
			<div class="images_text">
				<div class="images_text_info">
					<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
					<p class="images_text_title"><?php echo $CONTENT['TITLE']; ?></p>
					<div class="images_line"></div>
					<?php endif; ?>
					<?php if(isset($CONTENT['DESCR'])AND($CONTENT['DESCR']!='')): ?>
					<p class=""><?php echo $CONTENT['DESCR']; ?></p>
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
						<img class="images_text_item_img"  src="/assets/img/block_images/<?php echo $DATA[$x]['IMAGE_LINK']; ?>.png" alt="">
						<?php endif; ?>
						<?php if($sign OR $subtitle): ?>
						<div class="images_text_item_info">
							<?php if($subtitle): ?>
							<p class="images_text_item_info_title"><?php echo $DATA[$x]['SUBTITLE']; ?></p>
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
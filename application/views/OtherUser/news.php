		<div class="news_wrapper">
			<div class="news_head">
				<p class="news_head_title"><?php echo $CONTENT['TITLE']; ?></p>
				<div class="main_line"></div>
				<p class="news_head_text"><?php echo $CONTENT['DESCR']; ?></p>
			</div>
			<?php
				$PAGINATION_CONTENT = '<div class="news_pagination"><ul>';
				foreach($PAGINATION as $key => $val){
					if($val == $PAGE){
						$PAGINATION_CONTENT .= "<li class='active'><p>$val</p></li>";
					}else{
						$PAGINATION_CONTENT .= "<li><p>$val</p></li>";
					}
				}
				$PAGINATION_CONTENT .= '</ul></div>';
			?>
			<?php if(count($NEWSLIST)>0): ?>
				<?php echo $PAGINATION_CONTENT; ?>
				<div class="news_items">
					<?php foreach($NEWSLIST as $key => $val): ?>
					<div class="news_item">
						<?php if((isset($val['IMAGE']))AND($val['IMAGE']!='')): ?>
						<img src="/assets/img/news/<?php echo $val['IMAGE']; ?>.png" alt="">
						<?php endif; ?>
						<div class="news_item_info">
							<?php if((isset($val['DATE_ADD']))AND($val['DATE_ADD']!='')): ?>
							<p class="news_item_date"><?php echo date_format(date_create($val['DATE_ADD']), 'd.m.Y'); ?></p>
							<?php endif; ?>
							<?php if((isset($val['TITLE']))AND($val['TITLE']!='')): ?>
							<p class="news_item_title"><?php echo $val['TITLE']; ?></p>
							<?php endif; ?>
							<?php if((isset($val['TEXT']))AND($val['TEXT']!='')): ?>
							<p class="news_item_content"><?php echo $val['TEXT']; ?></p>
							<?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php echo $PAGINATION_CONTENT; ?>
			<?php endif; ?>
		</div>
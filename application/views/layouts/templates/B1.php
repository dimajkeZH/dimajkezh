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
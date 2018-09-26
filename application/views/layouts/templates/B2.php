<div class="table_type_one">
	<div class="table_info">
		<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
		<p 	class="table_info_title"><?php echo $CONTENT['TITLE']; ?></p>
		<div class="table_line"></div>
		<?php endif; ?>
		<?php if(isset($CONTENT['DESCR'])AND($CONTENT['DESCR']!='')): ?>
		<p class="table_info_main_text"><?php echo $CONTENT['DESCR']; ?></p>
		<?php endif; ?>
		<?php if(isset($CONTENT['SUBTITLE'])AND($CONTENT['SUBTITLE']!='')): ?>
		<p class="table_info_title_type_two"><?php echo $CONTENT['SUBTITLE']; ?></p>
		<?php endif; ?>
	</div>
	<div class="table_type_one_info" id="tabs">
		<?php if(count($DATA_NAV)>0): ?>
		<div class="table_type_one_info_nav">
			<ul>
				<?php foreach($DATA_NAV as $key => $val): ?>
				<li><p><?php echo $val['SUBTITLE']; ?></p></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php
		if(count($DATA_TABLE)>0):
		foreach($DATA_TABLE as $key => $val){
			$NEWDATA[$val['ID_MULTITABLE_CONTENT']][$val['ROW']][$val['COL']] = $val['VAL'];
		}
		?>
		<div class="table_type_one_info_content">
			<ul>
				<?php foreach($NEWDATA as $keytable => $valtable): ?>
				<li><div class="table_type_one_info_table"><table><tbody>
					<?php foreach($valtable as $row => $colvalue): ?>
						<?php if($row == 1): ?>
						<tr class="table_type_one_count">
						<?php else: ?>
						<tr class="table_type_one_price">
						<?php endif;?>
							<?php foreach($colvalue as $col => $val): ?>
							<td><?php echo $val; ?></td>
							<?php endforeach;?>
						</tr>
					<?php endforeach;?>
				</tbody></table></div></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
</div>
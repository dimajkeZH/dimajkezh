<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Новости</p>
		<div class="buttons">
			<?php if(isset($CONTENT['ID'])&&($CONTENT['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
		<form class="general block_form">
			<div class="table_info forma_group">
				<table style="min-width:100%" class="forma_group_item">
					<tbody style="min-width:100%">
						<tr>
							<td>#</td>
							<td>Name</td>
							<td>Title</td>
							<td>on index</td>
							<td>CHANGE</td>
							<td>DELETE</td>
						</tr>
						<?php if(isset($CONTENT) && count($CONTENT) > 0): ?>
						<?php foreach($CONTENT['PAGE'] as $key => $val): ?>
						<tr onmouseover="this.style.background = '#999'" onmouseleave="this.style.background = '#fff'">
							<td><?php echo $key+1; ?></td>
							<td style="min-width:500px"><?php echo $val['TITLE']; ?></td>
							<td><?php echo $val['DATE']; ?></td>
							<td><?php echo ($val['ON_INDEX']?'Да':'Нет'); ?></td>
							<td><button class="add">C</button></td>
							<td><button class="remove">X</button></td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="8"><center>Нет записей</center></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
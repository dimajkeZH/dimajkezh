<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Автобусы</p>
		<div class="buttons">
			<button class="add">Добавить запись</button>
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
							<td>outer</td>
							<td>inner</td>
							<td>CHANGE</td>
							<td>DELETE</td>
						</tr>
						<?php if(isset($CONTENT['PAGE']) && count($CONTENT['PAGE']) > 0): ?>
						<?php foreach($CONTENT['PAGE'] as $key => $val): ?>
						<tr onmouseover="this.style.background = '#999'" onmouseleave="this.style.background = '#fff'">
							<td><?php echo $key+1; ?></td>
							<td><?php echo $val['MARK']; ?></td>
							<td><?php echo $val['COUNTRY']; ?><img style="float:right; width:50px" src="<?php echo "/assets/img/static/cities/$val[COUNTRY_IMAGE].png"; ?>"></td>
							<td><img style="max-width:100px; max-height:100px" src="<?php echo "/assets/img/buses/bus_catalog/$val[IMAGE_OUTER].png"; ?>"></td>
							<td><img style="max-width:100px; max-height:100px" src="<?php echo "/assets/img/buses/bus_catalog/$val[IMAGE_INNER].png"; ?>"></td>
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





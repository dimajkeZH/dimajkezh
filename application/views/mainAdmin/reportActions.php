<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Действия админов [Отчёт]<?php echo (isset($_GET['s']))?' [Сессия №'.$_GET['s'].']':''; ?></p>
	</div>
	<div class="main_content_info">
		<form class="general block_form">
			<div class="table_info forma_group">
				<table style="min-width:100%" class="forma_group_item">
					<tbody style="min-width:100%">
						<tr>
							<td style="min-width:3%">#</td>
							<td style="min-width:7%">Логин</td>
							<td style="min-width:10%">Идентификатор сессии</td>
							<td style="min-width:20%">Тип действия</td>
							<td>Действие</td>
							<td style="min-width:15%">Дата и время</td>
						</tr>
						<?php if(isset($CONTENT) && count($CONTENT) > 0): ?>
						<?php foreach($CONTENT as $key => $val): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $val['NAME']; ?></td>
							<td><?php echo $val['ID_SESSION']; ?></td>
							<td><?php echo $val['TYPE_NAME']; ?></td>
							<td><?php echo $val['CUR_ACTION']; ?></td>
							<td><?php echo $val['DT_INCIDENT']; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="6"><center>Нет данных</center></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
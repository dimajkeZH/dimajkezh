<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Действия админов [Отчёт]</p>s
	</div>
	<div class="main_content_info">
		<div class="block_table">
			<table>
				<thead>
					<tr>
						<td>#</td>
						<td>Логин</td>
						<td>Идентификатор сессии</td>
						<td>Тип действия</td>
						<td>Действие</td>
						<td>Дата и время</td>
					</tr>
				</thead>
				<tbody>
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
				</tbody>
			</table>
		</div>
	</div>
</div>
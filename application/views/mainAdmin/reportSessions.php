<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Сессии админов [Отчёт] <?php echo $NOW; ?></p>s
	</div>
	<div class="main_content_info">
		<div class="block_table">
			<table>
				<thead>
					<tr>
						<td>#</td>
						<td>Логин</td>
						<td>Идентификатор сессии</td>
						<td>IP</td>
						<td>Браузер</td>
						<td>Дата и время создания</td>
						<td>Дата и время окончания</td>
						<td>Актуальность</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($CONTENT as $key => $val): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $val['NAME']; ?></td>
						<td><?php echo $val['ID']; ?></td>
						<td><?php echo $val['IP']; ?></td>
						<td><?php echo $val['BROWSER']; ?></td>
						<td><?php echo $val['DT_CREATE']; ?></td>
						<td><?php echo $val['DT_DESTROY']; ?></td>
						<td><?php echo (($val['DT_DESTROY'] <= $NOW) || ($val['DT_DESTROY'] == null))?'<span style="color:red; font-weight:bold;">Истёкшая</span>':'<span style="color:green; font-weight:bold;">Существующая</span>'; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
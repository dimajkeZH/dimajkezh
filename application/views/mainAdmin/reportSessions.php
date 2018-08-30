<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Сессии админов [Отчёт]</p>
	</div>
	<div class="main_content_info">
		<form class="general block_form">
			<div class="table_info forma_group">
				<table style="min-width:100%" class="forma_group_item">
					<tr>
						<td>#</td>
						<td>Логин</td>
						<td>Идентификатор сессии</td>
						<td>IP</td>
						<td>Браузер</td>
						<td>Дата и время<br>создания</td>
						<td>Дата и время<br>окончания</td>
						<td style="min-width:20%">Актуальность</td>
					</tr>
					<?php foreach($CONTENT as $key => $val): ?>
					<tr style="cursor:pointer" onmouseover="this.style.background = '#999'" onmouseleave="this.style.background = '#fff'" onclick="Redirect.handler('/admin/report/actions?s=<?php echo $val['ID']; ?>')">
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
				</table>
			</div>
		</form>
	</div>
</div>
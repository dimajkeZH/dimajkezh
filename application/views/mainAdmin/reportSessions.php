<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Сессии админов [Отчёт]<?php echo (isset($_GET['n']))?' [Аккаунт - '.$_GET['n'].']':''; ?></p>
	</div>
	<div class="main_content_info">
		<form class="general block_form">
			<div class="table_info forma_group">
				<table style="min-width:100%" class="forma_group_item">
					<tbody style="min-width:100%">
						<tr>
							<td style="min-width:3%">#</td>
							<td style="min-width:7%">Логин</td>
							<td style="min-width:5%">Идентификатор сессии</td>
							<td style="min-width:7%">IP</td>
							<td>Браузер</td>
							<td style="min-width:10%">Дата и время<br>создания</td>
							<td style="min-width:10%">Дата и время<br>окончания</td>
							<td style="min-width:7%">Актуальность</td>
						</tr>
						<?php if(isset($CONTENT) && count($CONTENT) > 0): ?>
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
						<?php else: ?>
						<tr>
							<td colspan="8"><center>Нет данных</center></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
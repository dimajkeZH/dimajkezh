<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Аккаунты админов [Отчёт]</p>s
	</div>
	<div class="main_content_info">
		<form class="general block_form">
			<div class="table_info forma_group">
				<table style="min-width:100%" class="forma_group_item">
					<tbody style="min-width:100%">
						<tr>
							<td style="min-width:5%">#</td>
							<td style="min-width:10%">Логин</td>
							<td style="min-width:15%">Имя</td>
							<td style="min-width:10%">Кол-во сессий</td>
							<td style="min-width:10%">Кол-во сессий в этом месяце</td>
						</tr>
						<?php if(isset($CONTENT) && count($CONTENT) > 0): ?>
						<?php foreach($CONTENT as $key => $val): ?>
						<tr style="cursor:pointer" onmouseover="this.style.background = '#999'" onmouseleave="this.style.background = '#fff'" onclick="Redirect.handler('/admin/report/sessions?n=<?php echo $val['NAME']; ?>')">
							<td><?php echo $key+1; ?></td>
							<td><?php echo $val['NAME']; ?></td>
							<td><?php echo $val['FULL_NAME']; ?></td>
							<td>0</td>
							<td>0</td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="5"><center>Нет данных</center></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Аккаунты админов [Отчёт]</p>s
	</div>
	<div class="main_content_info">
		<div class="block_table">
			<table>
				<thead>
					<tr>
						<td>#</td>
						<td>Логин</td>
						<td>Имя</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($CONTENT as $key => $val): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $val['NAME']; ?></td>
						<td><?php echo $val['FULL_NAME']; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
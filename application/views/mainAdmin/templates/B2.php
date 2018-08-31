<?php //BLOCK MULTITABLE ?>
<form id="data" class="block_form">
	<div class="block_settings">
		<div class="buttons">
			<div class="up_down">
				<div class="btn_up" value="up"><p></p></div>
				<div class="btn_down" value="down"><p></p></div>
			</div>
			<button class="remove">X</button>
			<button class="add block_hide" onclick="return hideThis(this)">Cвернуть</button>
		</div>
	</div>
	<p class="form_title">Блок с мультитаблицей</p>
	<div class="form_content">
		<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
		<div class='forma_group'><p>Заголовок</p><div class='forma_group_item text'><input type='text' name='TITLE' value='<?php echo $TITLE; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class='forma_group'><p>Подзаголовок описания</p><div class='forma_group_item text'><input type='text' name='SUBTITLE' value='<?php echo $SUBTITLE; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class='forma_group'><p>Описание</p><div class='forma_group_item textarea'><textarea name='DESCR' placeholder='text_area'><?php echo $DESCR; ?></textarea><p class='forma_group_item_description'></p></div></div>
		<?php foreach($TABLE_LIST as $tablekey => $tableval): ?>
		<hr>
		<div class='forma_group'><p>Заголовок мультитаблицы</p><div class='forma_group_item text'><input type='text' name='TABLETITLE' value='<?php echo $tableval['SUBTITLE']; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class="table_info forma_group">
			<div class="table_info_btns">
				<button class="add" onclick="tableRow_Add(this)">Добавить Строку</button>
				<button class="add" onclick="tableCol_Add(this)">Добавить Столбец</button>
			</div>
			<table class="forma_group_item">
				<tr class="table_info_head">
					<th></th>
					<?php for($len = 1; $len <= count($tableval['DATA'][1]); $len++): ?>
						<th><button class="remove" onclick="tableCol_Delete(this, <?php //echo $len; ?>)">X</button></th>
					<?php endfor; ?>
				</tr>
				<?php foreach($tableval['DATA'] as $key => $val): ?>
				<tr>
					<td><button class="remove" onclick="tableRow_Delete(this)">X</button></td>
					<?php foreach($val as $subkey => $subval): ?>
					<td><input type="text" row="<?php echo $key; ?>" col="<?php echo $subkey; ?>" value="<?php echo $subval; ?>"></td>
					<?php endforeach; ?>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<?php endforeach; ?>
		<hr>
		<div class="forma_group">
			<p>Добавление таблицы</p>
			<div class="forma_group_item add_table">
				<div class="add_table_inputs">
					<label for="">
						Количество строк:
						<input type="text">
					</label>
					<label for="">
						Количество столбцов:
						<input type="text">
					</label>
				</div>
				<div class="add_table_btn">
					<button class="add">Добавить</button>
				</div>
			</div>
		</div>
	</div>
</form>
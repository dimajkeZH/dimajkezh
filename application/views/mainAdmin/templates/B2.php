<?php //BLOCK MULTITABLE ?>
<form id="data" class="block_form table">
	<div class="block_settings">
		<div class="buttons">
			<div class="up_down">
				<div class="btn_up" value="up"><p></p></div>
				<div class="btn_down" value="down"><p></p></div>
			</div>
			<button class="remove" onclick="return removeThis(this)">X</button>
			<button class="add block_hide" onclick="return hideThis(this)">Cвернуть</button>
		</div>
	</div>
	<p class="form_title">Блок с мультитаблицей</p>
	<div class="form_content">
		<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
		<input type="text" name="ID_PAGE_TEMPLATE" value="<?php echo $ID_PAGE_TEMPLATE; ?>" style="display:none;">
		<input type="text" name="TYPE" value="B2" style="display:none;">
		<div class='forma_group'><p>Заголовок</p><div class='forma_group_item text'><input type='text' name='TITLE' value='<?php echo (isset($TITLE))?$TITLE:''; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class='forma_group'><p>Подзаголовок описания</p><div class='forma_group_item text'><input type='text' name='SUBTITLE' value='<?php echo (isset($SUBTITLE))?$SUBTITLE:''; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class='forma_group'><p>Описание</p><div class='forma_group_item textarea'><textarea name='DESCR' placeholder='text_area'><?php echo (isset($DESCR))?$DESCR:''; ?></textarea><p class='forma_group_item_description'></p></div></div>
		<?php foreach($TABLE_LIST as $tablekey => $tableval): ?>
		<hr>
		<input type="text" name="ID_TABLE<?php echo $tablekey; ?>" value="<?php echo $tableval['ID']; ?>" style="display:none;">
		<div class='forma_group'><p>Заголовок мультитаблицы</p><div class='forma_group_item text'><input type='text' name='TITLE_TABLE<?php echo $tablekey; ?>' value='<?php echo $tableval['SUBTITLE']; ?>'><p class='forma_group_item_description'></p></div></div>
		<div class="table_info forma_group">
			<div class="table_info_btns">
				<button class="add" onclick="return tableRow_Add(this, <?php echo $tablekey; ?>)">Добавить Строку</button>
				<button class="add" onclick="return tableCol_Add(this, <?php echo $tablekey; ?>)">Добавить Столбец</button>
			</div>
			<table class="forma_group_item">
				<tr class="table_info_head">
					<th></th>
					<?php for($len = 1; $len <= count($tableval['DATA'][1]); $len++): ?>
						<th><button class="remove" onclick="return tableCol_Delete(this, <?php echo $tablekey; ?>)">X</button></th>
					<?php endfor; ?>
				</tr>
				<?php foreach($tableval['DATA'] as $key => $val): ?>
				<tr>
					<td><button class="remove" onclick="return tableRow_Delete(this, <?php echo $tablekey; ?>)">X</button></td>
					<?php foreach($val as $subkey => $subval): ?>
					<td><input autocomplete="off" name="CELL_TABLE<?php echo $tablekey; ?>_<?php echo $key; ?>_<?php echo $subkey; ?>" type="text" row="<?php echo $key; ?>" col="<?php echo $subkey; ?>" value="<?php echo $subval; ?>"></td>
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
						<input name="rowCount" type="text" value="1">
					</label>
					<label for="">
						Количество столбцов:
						<input name="colCount" type="text" value="1">
					</label>
				</div>
				<div class="add_table_btn">
					<button class="add" onclick="return addMultiTable(this)">Добавить</button>
				</div>
			</div>
		</div>
	</div>
</form>
<?php //BLOCK LINKS ?>
<form id="data" class="block_form">
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
	<p class="form_title">Блок с ссылками</p>
	<div class="form_content">
		<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
		<input type="text" name="ID_PAGE_TEMPLATE" value="<?php echo $ID_PAGE_TEMPLATE; ?>" style="display:none;">
		<input type="text" name="TYPE" value="B5" style="display:none;">
		<div class="forma_group">
			<p>Заголовок</p>
			<div class="forma_group_item text">
				<input type="text" name="TITLE" value="<?php echo (isset($TITLE))?$TITLE:''; ?>">
				<p class="forma_group_item_description"></p>
			</div>
		</div>
		<div class='forma_group'>
			<p>Использовать список автобусов</p>
			<div class='forma_group_item'>	
			</div>
		</div>
		<div class='forma_group'>
			<p>Использовать список микроавтобусов</p>
			<div class='forma_group_item'>	
			</div>
		</div>
	</div>
</form>
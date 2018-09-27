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
	<p class="form_title">Текстовый блок</p>
	<div class="form_content">
		<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
		<input type="text" name="ID_PAGE_TEMPLATE" value="<?php echo $ID_PAGE_TEMPLATE; ?>" style="display:none;">
		<input type="text" name="TYPE" value="B3" style="display:none;">
		<div class="forma_group">
			<p>Заголовок</p>
			<div class="forma_group_item text">
				<input autocomplete="off" type="text" name="TITLE" value="<?php echo (isset($TITLE))?$TITLE:''; ?>">
				<p class="forma_group_item_description"></p>
			</div>
		</div>
		<div class='forma_group'>
			<p>Текст</p>
			<div class='forma_group_item textarea'>
				<?php
				if(!isset($TEXT) || $TEXT == ''){
					$TEXT = '<p></p>';
				}
				?>
				<textarea autocomplete="off" name='TEXT'><?php echo $TEXT; ?></textarea>
				<p class='forma_group_item_description'>
					Каждый новый абзац должен находиться между тегами P.<br><br>
					&#60;p&#62;Пример первого нового абзаца&#60;/p&#62;<br>&#60;p&#62;Пример второго нового абзаца&#60;/p&#62;
				</p>
			</div>
		</div>
	</div>
</form>
<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">pages</p>
		<div class="buttons">
			<button class="save" onclick="Change('save/pages')"><?php echo ((isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)) ? 'Save' : 'Add'); ?></button>
			<?php if(isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
		<form id="data">
			<p class="form_title">Общие</p>
			<input type="text" name="ID_PAGE" value="<?php echo $CONTENT['ALL']['ID']; ?>" style="display:none;">
			<input type="text" name="ID" value="0" style="display:none;">
			<input type="text" name="ID_TYPE" value="<?php echo (isset($CONTENT['ALL']['ID_TYPE']))?$CONTENT['ALL']['ID_TYPE']:'2'; ?>" style="display:none;">
			<?php if((!isset($CONTENT['ALL']['ID'])||($CONTENT['ALL']['ID'] == 0))): ?>
			<div class="forma_group">
				<p>Раздел</p>
				<div class="forma_group_item select">
					<select name="group" >
						<option value="0" selected>-- Выберите раздел --</option>
						<?php foreach($GROUPS as $key => $val): ?>
						<option value="<?php echo $val['VALUE']; ?>"><?php echo $val['TITLE']; ?></option>
						<?php endforeach; ?>
					</select>
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<?php endif;?>
			<div class="forma_group">
				<p>Заголовок страницы</p>
				<div class="forma_group_item text">
					<input type="text" name="TITLE" placeholder="" value='<?php echo (isset($CONTENT['ALL']['TITLE']))?$CONTENT['ALL']['TITLE']:''; ?>'>
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class='forma_group'>
				<p>Порядковый номер в списке</p>
				<div class='forma_group_item text_btn'>
					<input type='text' name='LOC_NUMBER' placeholder='serial_number' value='<?php echo (isset($CONTENT['ALL']['LOC_NUMBER']))?$CONTENT['ALL']['LOC_NUMBER']:''; ?>' pattern="[0-9]{1,}">
					<div class='text_btns'>
						<div class='btn_next' onclick='plus(this)'><p>+</p></div>
						<div class='btn_prev' onclick='minus(this)'><p>-</p></div>
					</div><p class='forma_group_item_description'></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Картинка для каталога</p>
				<div class="forma_group_item text">
					<input type="text" name="IMAGE" placeholder="" value="<?php echo (isset($CONTENT['ALL']['IMAGE']))?$CONTENT['ALL']['IMAGE']:''; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Мета ключевые слова</p>
				<div class="forma_group_item text">
					<input type="text" name="HTML_KEYWORDS" placeholder="" value="<?php echo (isset($CONTENT['ALL']['HTML_KEYWORDS']))?$CONTENT['ALL']['HTML_KEYWORDS']:''; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Мета описание</p>
				<div class="forma_group_item text">
					<input type="text" name="HTML_DESCR" placeholder="" value="<?php echo (isset($CONTENT['ALL']['HTML_DESCR']))?$CONTENT['ALL']['HTML_DESCR']:''; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
		</form>
		<?php echo $CONTENT['PAGE']; ?>
	</div>
</div>
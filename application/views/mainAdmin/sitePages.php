<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">pages</p>
		<div class="buttons">
			<button class="save"><?php echo ((isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)) ? 'Save' : 'Add'); ?></button>
			<?php if(isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
		<form>
			<p class="form_title">Общие</p>
			<input type="text" name="ID" value="0" style="display:none;">
			<input type="text" name="ID_TYPE" value="<?php echo (isset($CONTENT['ALL']['ID_TYPE']))?$CONTENT['ALL']['ID_TYPE']:'2'; ?>" style="display:none;">
			<div class="forma_group">
				<p>Заголовок страницы</p>
				<div class="forma_group_item text">
					<input type="text" name="TITLE" placeholder="" value='<?php echo (isset($CONTENT['ALL']['TITLE']))?$CONTENT['ALL']['TITLE']:''; ?>'>
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Порядковый номер в списке</p>
				<div class="forma_group_item text">
					<input type="text" name="LOC_NUMBER" placeholder="" value="<?php echo (isset($CONTENT['ALL']['LOC_NUMBER']))?$CONTENT['ALL']['LOC_NUMBER']:''; ?>">
					<p class="forma_group_item_description"></p>
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
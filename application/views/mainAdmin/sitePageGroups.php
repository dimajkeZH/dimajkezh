<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">page groups</p>
		<div class="buttons">
			<button class="save"><?php echo ((isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)) ? 'Save' : 'Add'); ?></button>
			<?php if(isset($CONTENT['ALL']['ID'])&&($CONTENT['ALL']['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
		<form>
			<p class="form_title">Общие</p>
			<div class="forma_group">
				<p>Заголовок страницы</p>
				<div class="forma_group_item text">
					<input type="text" name="HTML_TITLE" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_TITLE']; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Мета ключевые слова</p>
				<div class="forma_group_item text">
					<input type="text" name="HTML_KEYWORDS" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_KEYWORDS']; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<div class="forma_group">
				<p>Мета описание</p>
				<div class="forma_group_item text">
					<input type="text" name="HTML_DESCR" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_DESCR']; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
		</form>
		<?php if(isset($CONTENT['PAGE']) && ($CONTENT['PAGE'] != '')): ?>
		<form action="	">
			<p class="form_title">Страница</p>
			<?php echo $CONTENT['PAGE']; ?>
		</form>
		<?php endif; ?>
	</div>
</div>
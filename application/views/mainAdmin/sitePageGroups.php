<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">page groups</p>
		<div class="buttons">
			<button class="save" onclick="Change('save/pagegr')">Save</button>
		</div>
	</div>
	<div class="main_content_info">
		<form id="data" class="block_form">
			<div class="block_settings">
				<div class="buttons">
					<button class="add block_hide" onclick="return hideThis(this)">Cвернуть</button>
				</div>
			</div>
			<p class="form_title">Общие</p>
			<div class="form_content">
				<input type="text" name="ID_PAGE" value="<?php echo $CONTENT['ALL']['ID']; ?>" style="display:none;">
				<div class="forma_group">
					<p>Заголовок страницы</p>
					<div class="forma_group_item text">
						<input autocomplete="off" type="text" name="HTML_TITLE" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_TITLE']; ?>">
						<p class="forma_group_item_description"></p>
					</div>
				</div>
				<div class="forma_group">
					<p>Мета ключевые слова</p>
					<div class="forma_group_item text">
						<input autocomplete="off" type="text" name="HTML_KEYWORDS" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_KEYWORDS']; ?>">
						<p class="forma_group_item_description"></p>
					</div>
				</div>
				<div class="forma_group">
					<p>Мета описание</p>
					<div class="forma_group_item text">
						<input autocomplete="off" type="text" name="HTML_DESCR" placeholder="" value="<?php echo $CONTENT['ALL']['HTML_DESCR']; ?>">
						<p class="forma_group_item_description"></p>
					</div>
				</div>
			</div>
		</form>
		<?php if(isset($CONTENT['PAGE']) && ($CONTENT['PAGE'] != '')): ?>
		<form id="data" class="block_form">
			<div class="block_settings">
				<div class="buttons">
					<button class="add block_hide" onclick="return hideThis(this)">Cвернуть</button>
				</div>
			</div>
			<p class="form_title">Страница</p>
			<div class="form_content">
				<?php echo $CONTENT['PAGE']; ?>
			</div>
		</form>
		<?php endif; ?>
	</div>
</div>
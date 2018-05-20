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
			<?php foreach($CONTENT['ALL'] as $key => $val): ?>
			<div class="forma_group">
				<p><?php echo $key; ?></p>
				<div class="forma_group_item text">
					<input type="text" name="<?php echo $key; ?>" placeholder="" value="<?php echo $val; ?>">
					<p class="forma_group_item_description"></p>
				</div>
			</div>
			<?php endforeach; ?>
		</form>
		<?php echo $CONTENT['PAGE']; ?>
	</div>
</div>
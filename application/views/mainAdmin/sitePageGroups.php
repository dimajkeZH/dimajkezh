<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">page groups</p>
		<div class="buttons">
			<button class="save"><?php echo ((isset($CONTENT['ID'])&&($CONTENT['ID'] > 0)) ? 'Save' : 'Add'); ?></button>
			<?php if(isset($CONTENT['ID'])&&($CONTENT['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
	<?php echo $FORMS; ?>
	</div>
</div>
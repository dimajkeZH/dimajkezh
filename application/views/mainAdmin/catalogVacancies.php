<div class="add_case">
	<div class="main_content_head">
		<p class="main_content_head_title">Вакансии</p>
		<div class="buttons">
			<?php if(isset($CONTENT['ID'])&&($CONTENT['ID'] > 0)): ?><button class="remove">Remove</button><?php endif; ?>
		</div>
	</div>
	<div class="main_content_info">
		<?php echo $CONTENT['PAGE']; ?>
	</div>
</div>
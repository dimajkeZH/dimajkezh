<div class="text_wrapper">
	<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE']!='')): ?>
	<h2 class="text_title"><?php  echo $CONTENT['TITLE']; ?></h2>
	<div class="main_line"></div>
	<?php endif; ?>
	<?php if(isset($CONTENT['TEXT'])AND($CONTENT['TEXT']!='')): ?>
	<div class="text"><?php  echo $CONTENT['TEXT']; ?></div>
	<?php endif; ?>
</div>
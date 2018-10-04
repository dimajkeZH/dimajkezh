		<div class="buses_main">
			<div class="buses_main_head">
				<div class="buses_main_head_img bus_one"><img src="/assets/img/templates/header_group/minivan_head_one.png" alt=""></div>
				<div class="buses_main_head_title"><h1><?php echo $CONTENT['TITLE']; ?></h1>
				<div class="buses_main_head_line"></div></div>
				<div class="buses_main_head_img bus_two"><img src="/assets/img/templates/header_group/minivan_head_two.png" alt=""></div>
			</div>
		</div>
		<div class="text_wrapper">
			<h2 class="text_title"><?php echo $CONTENT['SUBTITLE']; ?></h2>
			<div class="main_line"></div>
			<div class="text">
				<?php if(isset($CONTENT['DESCR'])AND(count($CONTENT['DESCR'])>0)): ?>
					<?php foreach($CONTENT['DESCR'] as $key=>$val): ?>
					<p><?php echo $val; ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- SLICK -->
		<?php include $_SERVER['DOCUMENT_ROOT'].'/application/views/layouts/cache/slickMinivans.html'; ?>
		<!-- SLICK END -->
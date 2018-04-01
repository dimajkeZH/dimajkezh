	<div class="main_wrapper">
		<div class="buses_main">
			<div class="buses_main_head">
				<p class="buses_main_head_title">Аренда и заказ автобуса в Москве</p>
				<div class="buses_main_head_line"></div>
				<p class="buses_main_head_text">Такую услугу, как заказ автобуса в Москве, компания «ТриБас-М» предлагает своим клиентам уже более трех лет. В нашем парке достаточно машин разной вместимости. Мы располагаем автобусами Hyndai Counti, Hyundai Universe, Higer, Yutong, Mercedes-Benz, Golden Dragon,  вместимость которых составляет, соответственно от 28 до 63 мест. </p>
				<p class="buses_main_head_text">Следует заметить, что автобусы, которые мы предлагаем по действительно демократичным расценкам, проходят своевременно сервисное обслуживание и находятся в отличном техническом состоянии. Подача к месту посадки пассажиров происходит оперативно, так как наши опытные водители, отлично ориентирующиеся в столице и ее окрестностях. Необходимо также отметить, что для заказчиков у нас предусмотрена система скидок, делающая наше предложение еще более привлекательным. Компания «ТриБас-М» всегда поддерживает свои автобусы в превосходном техническом состоянии.</p>
				<p class="buses_main_head_title_two">Информация по тарифам на страницах сайта</p>
			</div>
			<?php if(isset($PAGELIST)AND(count($PAGELIST)>0)): ?>
			<div class="buses_main_items">
				<?php for($i = 0; $i < count($PAGELIST); $i++): ?>
				<div class="buses_main_item">
					<p class="buses_main_item_title"><?php echo $PAGELIST[$i]['TITLE']; ?></p>
					<p class="buses_main_item_text"><?php echo $PAGELIST[$i]['DESCR']; ?></p>
					<div class="buses_main_item_detail"><a href=<?php echo '"'.$PAGELIST[$i]['LINK'].'"'; ?>>Подробнее</a></div>
				</div>
				<?php endfor; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
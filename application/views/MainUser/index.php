		<div class="main_head">
			<div class="main_head_title">
				<h1><?php echo $CONTENT['TITLE']; ?></h1>
			</div>
			<div class="main_order">
				<img src="/assets/img/static/bcg_main2.png" alt="">
				<div class="main_order_form">
					<div class="order_form_title"><p>Заказ ОN-LINE</p></div>
					<form>
						<div class="forma_group"><input type="text" placeholder="Дата и время подачи" name="to_date"></div>
						<div class="forma_group"><input type="text" placeholder="Адрес подачи" name="addr_from"></div>
						<div class="forma_group"><input type="text" placeholder="Адрес назначения" name="addr_to"></div>
						<div class="forma_group"><input type="text" placeholder="Ваш телефон или email" name="email_phone"></div>
						<div class="forma_group"><select name="user_choice"><?php echo $USER_CHOICE; ?></select></div>
						<div class="forma_group"><input type="text" placeholder="Предложите цену" name="cost"></div>
						<div class="forma_group"><input type="text" placeholder="Комментарий" name="message"></div>
						<button onclick="return order('main_order')"><p>Заказать</p></button>
					</form>
					<div class="main_order_form_circle">
						<img src="/assets/img/static/group_comp.png" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="main_about">
			<h2 class="main_about_title"><?php echo $CONTENT['ABOUT_TITLE']; ?></h2>
			<div class="main_line"></div>
			<div class="main_about_brand">
				<p><?php echo $CONTENT['ABOUT_SUBTITLE']; ?></p>
				<img src="/assets/img/static/brand.png" alt="">
			</div>
		</div>
		<div class="main_services">
			<h2 class="main_services_title"><?php echo $CONTENT['SERVICE_TITLE']; ?></h2>
			<div class="main_line"></div>
			<div class="main_cervices_wrapper">
				<div class="main_cervices_items">
					<div class="main_cervices_item">
						<img src="/assets/img/static/s1.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM1']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s2.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM2']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s3.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM3']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s4.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM4']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s5.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM5']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s6.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM6']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s7.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM7']; ?></p>
						</div>
					</div>
					<div class="main_cervices_item">
						<img src="/assets/img/static/s8.png" alt="" class="main_cervices_item_img">
						<div class="main_cervices_item_text">
							<p><?php echo $CONTENT['SERVICE_ITEM8']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- SLICK -->
		<?php include $_SERVER['DOCUMENT_ROOT'].'/application/views/layouts/cache/slickFull.html'; ?>
		<!-- SLICK END -->
		<div class="main_tips">
			<div class="main_tips_head">
				<h2h2 class="main_tips_head_title"><?php echo $CONTENT['TIPS_TITLE']; ?></h2h2>
				<div class="main_line"></div>
				<p class="main_tips_head_info"><?php echo $CONTENT['TIPS_INFO']; ?></p>
			</div>
			<div class="main_tips_content">
				<div class="main_tips_info">
					<div class="main_tips_block_left">
						<div class="main_tips_item">
							<p>1.</p>
							<p><?php echo $CONTENT['TIPS_ITEM_TITLE1']; ?></p>
							<p><?php echo $CONTENT['TIPS_ITEM_DESCR1']; ?></p>
						</div>
						<div class="main_tips_item">
							<p>2.</p>
							<p><?php echo $CONTENT['TIPS_ITEM_TITLE2']; ?></p>
							<p><?php echo $CONTENT['TIPS_ITEM_DESCR2']; ?></p>
						</div>
					</div>
					<div class="main_tips_block_right">
						<div class="main_tips_item">
							<p>3.</p>
							<p><?php echo $CONTENT['TIPS_ITEM_TITLE3']; ?></p>
							<p><?php echo $CONTENT['TIPS_ITEM_DESCR3']; ?></p>
						</div>
						<div class="main_tips_item">
							<p>4.</p>
							<p><?php echo $CONTENT['TIPS_ITEM_TITLE4']; ?></p>
							<p><?php echo $CONTENT['TIPS_ITEM_DESCR4']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main_contacts">
			<h2 class="main_contacts_title">Выбирайте самый удобный способ связи!</h2>
			<div class="main_line"></div>
			<div class="main_contacts_lines">
				<svg width="100%" height="88px">
					<image  x="0px" y="0px" width="100%" height="88px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAyMAAABYCAMAAADRANhoAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAANlBMVEX///8NWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJn///+jIN0EAAAAEHRSTlMAMMBQsBCAQKCQ0CDgYHDwYRGFKAAAAAFiS0dEAIgFHUgAAAAHdElNRQfiAxoTBAJ7XmQDAAAEb0lEQVR42u3d7ZabIBCA4YCCnyj3f7XVtKfbhmlWGxMGfZ9/2ePJahSBYRxvN6hgrLVfnypra5d7lwBVfIzx61OzfGpy7xKgSksbAZ7q+th+fRr6aE3uXQIAAABwLaZth9z7AGg2xmhf/xbgvOJfIWAAj2gjwHM2xi73PgCqNSyvA3dV7avtW7vga+JduJYxxn771maZpvjcuwx81HLR1/s2JyaMSzFLPxJ2bF/TRnA9+/J6yQIGAAAAAAAAAG2M7Q4O3rqqbanAhfOoY4zH5ltNyzdOuQ8LOIqLu7Kzthh2JrMAqg318Td9G8f29W8B1Ng4HdlR84HsFFwSNR+A53ieHXiONgI8R80HXMEU7Z7Hp/72Qs0H58eZh95RgvHwBcNtwvJ/CQcXb/D+9LVxsl2qbl7+8+nzU4KfTnOMwdokoWhdHI5JyZzK+/8fmygU+jHPjWCK7ZnuQG7yPlkE6qSUBVPbusDlovVtZcna8vrSv6QGzn3LUzUSHGJ9/d38+McoRf56aUv9Jqk5GKk5iA3n1llLyt5luNbaZHwxS81hzQ4dN22pi6nH/rGrWwfHc9L/NcKwapiFAVgopHMxe6ot5uCmEobva5eRxDnEYdU6AEsCIpOU4BnGXs/TA/e5YrKLrmk27uEwpRN5uXNpfKXmqH/u0FobTnO8tRqXW5Wu38yE9CK36+lO7qjBh62XkBAyj5oyo+8jqIOzjNbOJQn2V1H4Y1Ze3R49uPfHqiby4kn0xz88cHvDVfmCZco0Hz3kWLqh5Npr1Z3woL4Or9XWiK14Es3x9fJbXefmQy8ECFKPbOY4fyh9w6QXW/DKIwuDED+VDuQd3FqB9XG05KWpx3sOvSkwHvyy0NVJfyUPZd/AlxFF2KCXwilvMEnx/5uv/cmvXWetqtHOPRiYdi79aI8e/cUyg/Cp5h0jdW9jLXYZqvpZF/oPjDm8tsNeK7AnqR9WDJhXYWPzdl5Yt41vmFdmMYgRn8rWG8+ra6Y0BCU1h2EUxlpZ2Y+MOeZMCXv7fwsx3p7cPo0VVq+stFAV5rnEhAdBsHFMel7xnt9JCUXSepa4ZKzPZ3LpprGE3FLxtxDTGMbNCQ/n1kidSyVd+WJzcMvvOOq/dy63+I9MFcq4l5p0N2upOYhpDF225acdNR+O5f6Z7SAmFKXDsqaAFrIoYy+zWWYZrTiQTqdxVZUpMJGv5oM0y3BiBKyyraoZKd5tUHUD1DbIM7qCmIC6NgJoQ82H4jTK8mzP70NpPfht2JpcLDPaFgyBg43CUtge4TQpSoCsfrFQRlfEojrw/6ZXn7doJuWPogKvcVMoY1UcAAAAAAAAAAAgl4aUOlyba56X5ep4egEX10ivyPmDpY3g4ppvCrzYk1RZK1e2mg/4xXzTRoI/e5lJ7fLVfMAv1QXe2Vk0nmcHnqONAM9R8wH4BgtUAAAAAAAAAAB8BEl0gOzeNkJfwKsegTz62ZrbG17VDZzF/cWY/Yul5YHz+vkwSTdbyl4DMt/H5ge9HixrQK78fAAAAABJRU5ErkJggg==" />
				</svg>
			</div>
			<div class="main_contacts_items">
				<div class="main_contacts_item"><a href="/contacts/#contact">
					<div class="main_contacts_item_img"><img src="/assets/img/static/c1.png" alt=""></div>
					<div class="main_contacts_item_info"><p>Вызов по телефону компании у диспетчера</p></div>
				</a>
				</div>
				<div class="main_contacts_item"><a href="javascript:PopUpShow()">
					<div class="main_contacts_item_img"><img src="/assets/img/static/c2.png" alt=""></div>
					<div class="main_contacts_item_info"><p>Заказ посредством онлайн заявки на сайте</p></div>
				</a>
				</div>
				<div class="main_contacts_item"><a href="/contacts/#partner ">
					<div class="main_contacts_item_img"><img src="/assets/img/static/c3.png" alt=""></div>
					<div class="main_contacts_item_info"><p>Бронирование автобуса по электронной почте</p></div>
				</a>
				</div>
			</div>
		</div>
		<div class="main_news">
			<h2 class="main_news_title">Новости</h2>
			<div class="main_line"></div>
			<div class="main_news_items">
				<div class="main_news_item">
					<img src="/assets/img/news/n1.png" alt="">
					<div class="main_news_item_info">
						<p class="main_news_item_date">23.08.2016</p>
						<h3 class="main_news_item_title">Правила перевозки групп детей</h3>
						<p class="main_news_item_content">В ночное время суток (с 23:00 до 6:00) пассажирские перевозки групп детей допускаются лишь к железнодорожным вокзалам и аэропортам а так же в обратном направлении. В случае задержки в пути по причине поломки или пробок на дорогах разрешается перевозка детей до конечного пункта или пункта ночлега. Длинна маршрута после 23:00 не должно быть более 100 километров. При организованной междугородней перевозке длящейся более 3 часов необходимо сопровождения детей медицинским работником.</p>
					</div>
				</div>
				<div class="main_news_item">
					<img src="/assets/img/news/n2.png" alt="">
					<div class="main_news_item_info">
						<p class="main_news_item_date">14.07.2016</p>
						<h3 class="main_news_item_title">Схема маршрута</h3>
						<p class="main_news_item_content">По правилам транспортировки пассажиров водитель должен иметь схему маршрута проезда с указанием мест остановок. Заказчик может подготовит схему сам, проложив маршрут в Яндекс картах и распечатать затем его на бумажном носителе. На схеме маршрута должна стоять дата и подпись руководителя группы. Отсутствие схемы маршрута влечет наложение штрафа на перевозчика и задержки транспорта.</p>
					</div>
				</div>
				<div class="main_news_item">
					<img src="/assets/img/news/n3.png" alt="">
					<div class="main_news_item_info">
						<p class="main_news_item_date">11.06.2016</p>
						<h3 class="main_news_item_title">Список пассажиров автобуса</h3>
						<p class="main_news_item_content">Заказчик обязан составить поименный список пассажиров, желательно с номерами телефонов для предоставления его водителю автобуса. Список пассажиров составляется в трех экземплярах. В случае проверки автобуса транспортной инспекцией, водитель обязан предоставить список пассажиров. Отсутствие списка влечет наложение внушительного штрафа на владельца транспорта.</p>
					</div>
				</div>
			</div>
			<div class="main_news_detail">
				<a href="/news/1"><p>Все новости</p></a>
			</div>
		</div>

		<div id="contact" class="contact_header">
			<div class="contact_info">
				<div class="contact_info_title">
					<h1><?php echo $CONTENT['CONTACT_TITLE']; ?></h1>
					<div class="contact_line"></div>
				</div>
				<?php if(isset($CONTENT['FIRST_TEXT']) && $CONTENT['FIRST_TEXT'] != ''): ?>
				<div class="text_wrapper">
					<div class="text"><?php echo $CONTENT['FIRST_TEXT']; ?></div>
				</div>
				<?php endif; ?>
				<div class="contact_info_items">
					<div class="contact_info_item">
						<a href="">
							<div class="contact_info_item_svg">
								<svg width="58px" height="58px">
								<image  x="0px" y="0px" width="51px" height="51px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAAzCAMAAAANf8AYAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAANlBMVEX///8NWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJn///+jIN0EAAAAEHRSTlMAMMDgUPBgENCQIKBAgLBwJv0EiAAAAAFiS0dEAIgFHUgAAAAHdElNRQfiAxkWFhGTajgLAAABCUlEQVRIx53Vyw6EIAwFUJBhQATt/3/txNFFKwi3dElyItQ+jDnDLkTuYzRhPZ3x1RMNCpFIi1YiLUpEarSRHnlSo0zPSENTKlO0z4HMUpnxgyrjgtp4O85b0RPz1RNZOhgxJjIDEnG5ccrucOpWEJlzqAl+4kPsRX7mRTtqeA8dKGJFh/5Wk1gagLq+4mC3iyjiLbFN3A5GoidQJIbJAr6JNwVFMeX++6lVV8Fx5NkK6+wnK8fwWp0DKObnKYBoS48zBNFe5AmEntFCKU6gsA9Qcz8dfdPeNdbpjQlrx7zOpvz6qV4fl3bW+/MibQ0SRyOmVjvQV1LdRTtWxz1e4opOviv1OfOf/wPGQDTn4ujJ+wAAAABJRU5ErkJggg==" />
								</svg>
							</div>
							<p><?php echo $CONTENT['CONTACT_PHONE']; ?></p>
						</a>
					</div>
					<div  class="contact_info_item">
						<a href="javascript:PopUpMapShow()">
							<div class="contact_info_item_svg">
							<svg
							 width="58px" height="58px">
							<image  x="0px" y="0px" width="41px" height="58px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACkAAAA6CAMAAAAa/IDxAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAANlBMVEX///8NWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJn///+jIN0EAAAAEHRSTlMAMHCgwLCAQBDwUOBgkCDQ9bCSZwAAAAFiS0dEAIgFHUgAAAAHdElNRQfiAxkWGRP6/EXoAAABWElEQVRIx52WUZKEIAxEQUBEELj/aXddR5cOCVjTf0y9CdDpqEqh9GLsKbf6TcnSJtRGbhc4bytVTAy3HZWTzd3GpfIKpKwOVVR6CwI6Bht0K2OwBv0hjzpTucA8Be/9zQsyvC15Fe1P+RuQzozzpBF/+rS6C0Gmm7snayvdPuHGTeMQNbgOkByLNVy7PCA2O/oEf/SYMNgeSRJa+yUJNyKj0GbM4rFxEsBqg0sL5EqKQIzbCc/Q/I0k5Ek3nYQzIRpcC3dVMtYLveF51qRV3mm8/1xZ6lzuOlCYk55NIqPCOcwqsRYPSs5P2oRxfH3ocRyRkDA/AHFklBXBQN4hslPdS0F6NBYKik75jiQPk1tOMWKf4ZkjOadWxcp1YBTesr1TSQmimbISqDbSfi+SxCmjBmrbH0YfDeDUqob6n/M4Bpv27xPyccrOwGdQ9JzcuZEQ0FIjc+8f0GRX/vmJO+4AAAAASUVORK5CYII=" />
							</svg>
							</div>
							<p><?php echo $CONTENT['CONTACT_ADDRESS']; ?></p>
						</a>
						<div class="popup_map">
							<div class="map">
								<a href="javascript:PopUpMapHide()"><div class="map_close">&#9421;</div></a>
								<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7db877b7d65b620490e5377e2a0a88e7fc53391af00955f1aa9e8833dc0e7a3d&amp;lang=ru_RU&amp;scroll=true"></script>
							</div>
						</div>
					</div>
					<div class="contact_info_item">
						<a href="#partner">
							<div class="contact_info_item_svg">
								<svg 
								 width="58px" height="58px">
								<image  x="7px" y="12px" width="44px" height="35px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAjCAMAAADYDBjmAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAANlBMVEX///8NWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJn///+jIN0EAAAAEHRSTlMAUODAEEDQsHDwgCCQMGCgcoPotwAAAAFiS0dEAIgFHUgAAAAHdElNRQfiAxkWGgUlBaN6AAAA7ElEQVQ4y+WUWxKDIAxFAwF5+WD/q22IWilgG7+bD8eRQyQ3NwAonUWBBsDKUIrJgBPD2UOQwwhyNjuY5HCEKIcTyFPPALAISyTlxPTOEi04iWN2Wugx/0CDImh1kEOh7VeDYCrs3pRIr2a7Z31Zd2cH+Sjqps5r8Wh34M04YuORNlfe4GP5Lrm2VUGXkcJKn1Mj4kyCmbdUtetYytoqLFjVhA+L8uIlIrabGz9Xv+Wa00fNrflZp7QhRtOr2U+KhzO6Pg3GSq87GjsdhzOoNx9x0M9HA/sH8IMbyYMSs4EcsAovGb1wZ60kCvoCqqJStPWuDmoAAAAASUVORK5CYII=" />
							</svg>
							</div>
							<p><?php echo $CONTENT['CONTACT_EMAIL']; ?></p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php if(isset($VACANCIESLIST)AND(count($VACANCIESLIST)>0)): ?>
		<div class="vacancies_wrapper">
			<div class="vacancies">
				<div class="vacancies_title">
					<h2><?php echo $CONTENT['VACANCIES_TITLE']; ?></h2>
					<div class="contact_line"></div>
				</div>
				<div class="vacancies_info">
					<?php for($i = 0; $i < count($VACANCIESLIST); $i++): ?>
					<div class="vacancies_info_item">
						<img class="vacancies_info_item_img" src=<?php echo '"/assets/img/vacancies/'.$VACANCIESLIST[$i]['IMAGE'].'.png"'; ?> alt="">
						<div class="vacancies_info_text">
							<p><?php echo $VACANCIESLIST[$i]['TITLE']; ?></p>
							<p><?php echo $VACANCIESLIST[$i]['DESCR']; ?></p>
						</div>
					</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if((isset($CONTENT['PARTNERSHIP_TITLE'])AND($CONTENT['PARTNERSHIP_TITLE']!='')) OR (isset($CONTENT['PARTNERSHIP_DESCR'])AND($CONTENT['PARTNERSHIP_DESCR']!=''))): ?>
		<div id="partner" class="partner_wrapper">
			<div class="partner">
				<div class="partner_title">
					<h2><?php echo $CONTENT['PARTNERSHIP_TITLE']; ?></h2>
					<div class="partner_line"></div>
				</div>
				<div class="partner_info">
					<p><?php echo $CONTENT['PARTNERSHIP_DESCR']; ?></p>
				</div>
		<?php endif; ?>
				<div class="post_message">
					<div class="post_message_title">
						<p>Здесь мы ждем ваших предложений.</p>
						<div class="partner_line"></div>
					</div>
					<div class="post_message_form">
						<form action="" method="post">
							<div class="message_form_group">
								<input name="name" type="text" placeholder="Ваша Фамилия и Имя">
							</div>
							<div class="message_form_group">
								<input name="email" type="text" placeholder="Ваш E-Mail">
							</div>
							<div class="message_form_group">
								<textarea name="message" rows= "10" cols= "45" placeholder="Ваше сообщение"></textarea>
							</div>
							<div class="g-recaptcha" data-sitekey="6Le3Q1EUAAAAAJyoaeFGrVJ-Uk2U3wXHS-yp_REF"></div>
							<button onclick="return feedback()"><p>Отправить</p></button>
						</form>
					</div>
				</div>
			</div>
		</div>
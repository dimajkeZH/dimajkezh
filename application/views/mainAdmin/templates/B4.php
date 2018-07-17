								<form id="data">
									<p class="form_title">Блок с картинками</p>
									<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
									<input type="text" name="TYPE" value="B4" style="display:none;">
									<div class="forma_group">
										<p>Заголовок</p>
										<div class="forma_group_item text">
											<input type="text" name="TITLE" value="<?php echo $TITLE; ?>">
											<p class="forma_group_item_description"></p>
										</div>
									</div>
									<div class='forma_group'>
										<p>Текст</p>
										<div class='forma_group_item textarea'>
											<textarea name='DESCR'><?php echo $DESCR; ?></textarea>
											<p class='forma_group_item_description'></p>
										</div>
									</div>
									<?php foreach($DATA as $key => $val): ?>
										<hr>
										<input type="text" name="ID_IMAGE_CONTENT<?php echo $key; ?>" value="<?php echo $val['ID']; ?>" style="display:none;">
										<div class="forma_group">
											<p>Подзаголовок картинки <?php echo $key+1; ?></p>
											<div class="forma_group_item text">
												<input type="text" name="SUBTITLE<?php echo $key; ?>" value="<?php echo $val['SUBTITLE']; ?>">
												<p class="forma_group_item_description"></p>
											</div>
										</div>
										<div class="forma_group">
											<p>Картинка <?php echo $key+1; ?></p>
											<div class="forma_group_item file">
												<input type="file" name="IMAGE_LINK<?php echo $key; ?>" title="<?php echo $val['IMAGE_LINK']; ?>">
												<p class="forma_group_item_description"></p>
											</div>
										</div>
										<div class="forma_group">
											<p>Подпись картинки<?php echo $key+1; ?></p>
											<div class="forma_group_item text">
												<input type="text" name="IMAGE_SIGN<?php echo $key; ?>" value="<?php echo $val['IMAGE_SIGN']; ?>">
												<p class="forma_group_item_description"></p>
											</div>
										</div>
										<div class="forma_group">
											<p>Номер по порядку картинки <?php echo $key+1; ?></p>
											<div class="forma_group_item text_btn">
												<input type="text" name="SERIAL_NUMBER<?php echo $key; ?>" placeholder="serial_number" value="<?php echo $val['SERIAL_NUMBER']; ?>">
												<div class="text_btns">
													<div class="btn_next" onclick='plus(this)'><p>+</p></div>
													<div class="btn_prev" onclick='minus(this)'><p>-</p></div>
												</div>
												<p class="forma_group_item_description"></p>
											</div>
										</div>
									<?php endforeach; ?>
								</form>
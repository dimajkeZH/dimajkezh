								<form id="data" class="block_form">
									<div class="block_settings">
										<div class="buttons">
											<div class="up_down">
												<div class="btn_up" value="up"><p></p></div>
												<div class="btn_down" value="down"><p></p></div>
											</div>
											<button class="remove">X</button>
											<button class="add block_hide" onclick="return hideThis(this)">Cвернуть</button>
										</div>
									</div>
									<p class="form_title">Текстовый блок</p>
									<div class="form_content">
										<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
										<input type="text" name="TYPE" value="B3" style="display:none;">
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
												<textarea name='TEXT'><?php echo $TEXT; ?></textarea>
												<p class='forma_group_item_description'></p>
											</div>
										</div>
									</div>
								</form>
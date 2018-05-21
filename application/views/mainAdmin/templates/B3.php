								<form id="data">
									<p class="form_title">Текстовый блок</p>
									<input type="text" name="ID" value="<?php echo $ID; ?>" style="display:none;">
									<input type="text" name="TYPE" value="B3" style="display:none;">
									<div class="forma_group">
										<p>Заголовок</p>
										<div class="forma_group_item text">
											<input type="text" name="TITLE" value="<?php echo $TITLE; ?>">
											<p class="forma_group_item_description"></p>
										</div>
									</div>
									<div class="forma_group">
										<p>Текст</p>
										<div class="forma_group_item text">
											<input type="text" name="TEXT" value="<?php echo $TEXT; ?>">
											<p class="forma_group_item_description"></p>
										</div>
									</div>
								</form>
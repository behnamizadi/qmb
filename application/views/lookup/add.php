                <?php
					echo $form;
					if(isset($type)):
					?>
					<p>
					<a href="<?php echo PHP40::get()->homeUrl; ?>index.php/lookup/manage/<?php echo $type; ?>" class="btn btn-default">بازگشت</a>
					</p>
					<?php endif; ?>
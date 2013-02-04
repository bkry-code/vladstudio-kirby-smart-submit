<?php 

	echo js('//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	echo js('assets/js/smart-submit.js');

 ?>
 	<style>
 	.smart-submit-alert { padding: 1em; color: #fff; }
 	.smart-submit-alert-success { background: #86ad6c; }
 	.smart-submit-alert-error { background: #ad4e31; }
 	</style>

	<h2><?php echo html($page->title()) ?></h2>

	<?php echo kirbytext($page->text()) ?>

	<form id="smart-submit" class="styled-form" action="<?= url('smart-submit') ?>">

		<label for="name">Your name:</label>
		<input type="text" class="text required" name="name" id="name">
		<hr>
		<label for="email">Your email:</label>
		<input type="email" class="text required email" name="email" id="email">
		<hr>
		<label for="">Your message</label>
		<textarea rows="12" name="text" class="required" id="text"></textarea>
		<hr>
		<input type="submit" class="submit" value="Send">
		
	</form>
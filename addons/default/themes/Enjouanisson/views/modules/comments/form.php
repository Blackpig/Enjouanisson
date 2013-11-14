<?php echo form_open("comments/create/{$module}", 'id="create-comment"') ?>

	<noscript><?php echo form_input('d0ntf1llth1s1n', '', 'style="display:none"') ?></noscript>

	<?php echo form_hidden('entry', $entry_hash) ?>

	<?php if ( ! is_logged_in()): ?>

	<div class="row collapse">
		<input type="text" name="name" id="name" maxlength="40" placeholder="Your name" value="" />
	</div>

	<div class="row collapse">
		<input type="text" name="email" maxlength="40"  placeholder="Your email" value="<?php echo $comment['email'] ?>" />
	</div>

	<?php endif ?>

	<div class="form_textarea">
		<textarea name="comment" id="comment"  placeholder="Your comments" class="width-full"><?php echo $comment['comment'] ?></textarea>
	</div>

	<div class="form_submit">
		<?php echo form_submit('submit', lang('comments:send_label')) ?>
	</div>

<?php echo form_close() ?>
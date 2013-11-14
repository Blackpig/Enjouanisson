<?php if ($comments): ?>
	{{ comenst:count }}
	<?php foreach ($comments as $item): ?>
		
		<article class="comment">
			<div class="meta">
				<p><span><?php echo $item->user_name ?></span> said on <span><?php echo format_date($item->created_on) ?><span></p>
			</div>
			<div class="content">
				<?php if (Settings::get('comment_markdown') and $item->parsed): ?>
					<?php echo $item->parsed ?>
				<?php else: ?>
					<p><?php echo nl2br($item->comment) ?></p>
				<?php endif ?>
			</div>
		</article><!-- close .comment -->
	<?php endforeach ?>
	
<?php else: ?>
	<p>Be the first to comment on this article.</p>
<?php endif ?>
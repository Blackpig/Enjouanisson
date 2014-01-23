<ul data-orbit data-options="animation:fade;timer_speed:7500; bullets:false; navigation_arrows:false; slide_number:false; ">
	<?php foreach($items as $item) { ?>
	<li>
		<blockquote class="testimonial"><p><?php echo $item->blurb ?></p></blockquote>
		<p class="testimonial-author"><?php echo $item->name ?>, <?php echo $item->town ?>, <?php echo $item->country ?></p>
	</li>
	<?php } ?>
</ul>
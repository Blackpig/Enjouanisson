<ul class="link_list">
	<?php foreach($blog_widget as $post_widget): ?>
		<li><?php echo anchor('articles/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?></li>
	<?php endforeach ?>
</ul>

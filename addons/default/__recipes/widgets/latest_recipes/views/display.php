<h2>Recent Recipes</h2>
<nav class="section_nav">
	<ul class="navigation">
		<?php foreach($recipes_widget as $post_widget): ?>
		<li><?php echo anchor('recipes/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?></li>
	<?php endforeach ?>
</ul>
</nav>
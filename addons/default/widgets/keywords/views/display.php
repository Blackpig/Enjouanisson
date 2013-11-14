<h3>Filter <?php echo $module; ?> by</h3>
<nav class="tag-filter">
<ul>
	<?php foreach($keywords as $keyword) { ?>
	<li>
		<a href="/<?php echo $module; ?>/tagged/<?php echo $keyword->name; ?>"><?php echo $keyword->name; ?></a>
	</li>
	<?php } ?>
</ul>
</nav>
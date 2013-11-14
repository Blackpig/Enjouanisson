<?php $img=$cat['images'][0]; ?>
<section class="product_list large-3 columns">
	<a href="{{ firesale:url route='category' id='<?php echo $cat['id']; ?>' }}"><img src="<?php echo $img->path; ?>" alt="<?php echo $img->title; ?>" /></a>
	<h3>
		<a href="{{ firesale:url route='category' id='<?php echo $cat['id']; ?>' }}"><?php echo $cat['title']; ?></a>
	</h3>
	<span></span>
</section>
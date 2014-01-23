<?php $img=$cat['images'][0]; ?>

<section class="product_list large-3 columns">
	<?php  if ($img) { ?>
	<a href="{{ firesale:url route='category' id='<?php echo $cat['id']; ?>' }}"><img src="{{ url:base }}files/thumb/<?php echo $img->filename; ?>/0/140" alt="<?php echo $img->title; ?>" /></a>
	 <?php } else { ?>
	 	{{ theme:image file="awaiting_image.png" alt="No Image available" }}
	<?php  } ?>
	<h3>
		<a href="{{ firesale:url route='category' id='<?php echo $cat['id']; ?>' }}"><?php echo $cat['title']; ?></a>
	</h3>
	<span></span>
</section>
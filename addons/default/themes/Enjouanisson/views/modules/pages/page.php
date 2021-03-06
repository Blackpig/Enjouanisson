<?php if ($page->slug == "about-us2") { 
	echo "<h1>About Us</h1>";
	echo $page->body ;
} else { ?>
<article class="large-12">
	<h1><?php echo $page->title ?></h1>
	<?php if (!empty($page->feature_image)) { ?>
	<figure>
			<img src="<?php echo $page->feature_image['image']?>" alt="<?php echo $page->title ?>" />
			<figcaption>
				Image: <?php echo $page->image_credit?>
			</figcaption>
		</figure>
		<?php } ?>
	<p><?php echo $page->body ?></p>
</article>
<?php } ?>
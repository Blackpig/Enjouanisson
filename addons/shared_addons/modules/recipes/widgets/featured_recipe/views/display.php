
<?php $this->load->helper('text') ?>
<h4><?php echo $featured['title'] ?></h4>
<img src="<?php echo $featured['photo']['image'] ?>" class="breathe" />
<p><?php echo word_limiter($featured['intro'], 100, '') ?></p>
<a href="/recipes/<?php echo $featured['slug'] ?>" class="more">Read more</a>
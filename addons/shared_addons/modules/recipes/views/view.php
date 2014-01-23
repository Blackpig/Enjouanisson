{{ post }}
	<article class="blog row">
		<h1>{{ title }}</h1>
		<p>{{ intro }}</p>
		<div class="row ">
			<div class="large-7 columns">
				<figure>
					<a href="{{ featured_image:image }}" class="fancybox"><img src="{{ featured_image:thumb }}/0/250" /></a> 
					<figcaption>
					Image: {{ image_credit }}
					</figcaption>
				</figure>
			</div>
			<div id="ingredients" class="large-5 columns">
				<h3>Ingredients</h3>
				<p>Serves {{ serves }}</p>
				{{ ingredients }}
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h2>Method</h2>
				<p>{{ body }}</p>
			</div>
		</div>		
	</article>


{{ /post }}

	<section class="row ">
		<h2><?php echo $this->comments->count() ?> comment<?php echo ($this->comments->count() != 1) ? "s" : "" ?></h2>
		<section id="comments" class="large-8 columns collapse-left">
			<?php echo $this->comments->display() ?>
		</section>
		<section id="add_comment" class="large-4 columns">
		<?php if ($form_display): ?>
			<h3>Leave a comment</h3>
			<?php echo $this->comments->form() ?>
		<?php else: ?>
			<?php echo sprintf(lang('blog:disabled_after'), strtolower(lang('global:duration:'.str_replace(' ', '-', $post[0]['comments_enabled'])))) ?>
		<?php endif ?>
		</section>	
	</section>
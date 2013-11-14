{{ post }}
	<article class="blog row">
		<h1>{{ title }}</h1>
		<p class='meta'>Published on {{ helper:date timestamp=created_on }}</p>
		<figure>
			{{ image:img }}
			<figcaption>
				Image: {{ image_credit }}
			</figcaption>
		</figure>

		<p>{{ body }}</p>

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

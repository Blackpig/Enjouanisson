<div class="one_full">
	<section class="title">
		<h4><?php echo lang('event:posts_title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
			<?php if ($event) : ?>
				<?php echo $this->load->view('admin/partials/filters') ?>
	
				<?php echo form_open('admin/event/action') ?>
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/posts') ?>
					</div>
				<?php echo form_close() ?>
			<?php else : ?>
				<div class="no_data"><?php echo lang('event:currently_no_posts') ?></div>
			<?php endif ?>
		</div>
	</section>
</div>

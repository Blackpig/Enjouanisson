<section class="title">
	<h4><?php echo lang('event:events_title') ?></h4>
</section>

<section class="item">
	<div class="content">

	<?php if ($events): ?>
	
		<table border="0" class="table-list" cellspacing="0">
			<thead>
			<tr>
				<th><?php echo lang('event:event_title') ?></th>
				<th><?php echo lang('global:slug') ?></th>
				<th width="120"></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($events as $event): ?>
			<tr>
				<td><?php echo lang_label($event->stream_name); ?></td>
				<td><?php echo $event->event_uri; ?></td>
				<td>
					<a href="" class="btn">Edit</a>
					<a href="" class="btn">Delete</a>
					<a href="" class="btn">New Post</a>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<?php echo form_close() ?>

<?php $this->load->view('admin/partials/pagination') ?>

	<?php else: ?>
		<div class="no_data">No events</div>
	<?php endif ?>
	</div>
</section>

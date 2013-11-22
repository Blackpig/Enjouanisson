<?php $today = date(Ymd); ?>
<ul class="event_list">
	<?php foreach($event_widget as $post_widget): ?>
		<li>
			<em <?php echo (date('Ymd',$post_widget->end_date) < $today) ? 'class="past"' : ''?>><?php echo date('jS M',$post_widget->start_date)?></em>&nbsp;-&nbsp;<?php echo anchor('event/'.$post_widget->slug, $post_widget->title) ?>
		</li>
	<?php endforeach ?>
</ul>
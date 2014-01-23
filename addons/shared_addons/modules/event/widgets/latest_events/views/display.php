<?php $today = date('Ymd'); ?>
<ul class="event_list">
	<?php foreach($event_widget as $post_widget): ?>
		<li>
			<em class="date <?php echo (date('Ymd',$post_widget->end_date) < $today) ? ' past' : ''?>"><?php echo date('M',$post_widget->start_date)?><span><?php echo date('j',$post_widget->start_date)?></em><div class="desc"><?php echo anchor('event/'.$post_widget->slug, $post_widget->title) ?></div>
		</li>
	<?php endforeach ?>
</ul>
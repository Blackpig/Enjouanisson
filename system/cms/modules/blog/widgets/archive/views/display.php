<h2>Previous Articles</h2>
<nav class="section_nav">
<?php if ($archive_months): ?>
<ul>
	<?php foreach ($archive_months as $month): ?>
	<li>
		<a href="<?php echo site_url('articles/archive/'.date('Y/m', $month->date));?>">
			<?php echo format_date($month->date, lang('blog:archive_date_format')) ?> (<?php echo $month->post_count ?>)
		</a>
	</li>
	<?php endforeach ?>
</ul>
<?php endif ?>
</nav>
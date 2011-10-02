<div class="entry-summary">
	<?php if(has_post_thumbnail()): ?>
	<a href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail('tn-250',  array('class' => 'alignleft', 'title' => trim(strip_tags($post->post_title)), 'alt' => trim(strip_tags($post->post_title)))); 
	?></a><div class="toc_right">
	<?php echo my_excerpts(55); ?></div>
	<?php else: ?>
		<?php echo my_excerpts(55); ?>
	<?php endif; ?>
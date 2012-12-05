<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage RISD Sculpture
 * @since RISD Sculpture 1.0
 */
?>
	<div class="images">
		<?php
		global $query_string;
		$args = array('post__in'=>get_option('sticky_posts'));
		query_posts($args);
		$slidetabs = ''; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $current_category = get_the_category($post->ID); ?>
			
		<div>
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>"  class="slide_container"><?php the_post_thumbnail('large'); ?></a>
						<?php endif; ?>
						<h4><?php echo $current_category[0]->cat_name; ?> >> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"> <?php the_title(); ?><?php if(get_post_meta($post->ID, "Date", $single = true) != "") {
						$visiting_artist_date = get_post_meta($post->ID, "Date", $single = true);
						echo ', ' . $visiting_artist_date;
						$formatted_date = strtotime($visiting_artist_date);
						}
						?></a></h4>
					</div><!-- div no class -->
			<?php $slidetabs .= '<a href="#"></a>'; ?>
				<?php endwhile; // End the loop.
				wp_reset_query();?></div><!-- images -->

<!-- <a class="backward">prev</a><a class="forward">next</a> -->
<div class="slidetabs">
		<?php echo $slidetabs ?>
		</div>

	<!-- <div class="buttons">
		<button onClick='jQuery(".slidetabs").data("slideshow").play();'>Play</button>
		<button onClick='jQuery(".slidetabs").data("slideshow").stop();'>Stop</button>
	</div> -->


	<script language="JavaScript">
	// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
	jQuery.noConflict();
	jQuery(function()  {

	jQuery(".slidetabs").tabs(".images > div", {

		// enable "cross-fading" effect
		effect: 'fade',
		fadeOutSpeed: "slow",

		// start from the beginning after the last tab
		rotate: true

	// use the slideshow plugin. It accepts its own configuration
	}).slideshow({autoplay:true});
	
	});
	</script>
<hr>
	<h2>Recent News and Upcoming Events</h2>
	<?php 
	$args = array(
		'category__in' => array(6,7,8),
		'posts_per_page' => 13
		);
	$query = New WP_Query($args);
	while ( $query->have_posts() ) : $query->the_post();?>
	<h4 class="page-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
	<?php endwhile; ?>




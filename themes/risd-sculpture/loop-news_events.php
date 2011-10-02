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
	<h2>Visiting Artists</h2>
	<div class="images">
		<?php while ( have_posts() ) : the_post(); ?><?php if (in_category('visiting_artists')): ?>
		<div><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?><?php if(get_post_meta($post->ID, "Date", $single = true) != "") {
				$visiting_artist_date = get_post_meta($post->ID, "Date", $single = true);
				echo ', ' . $visiting_artist_date;
				$formatted_date = strtotime($visiting_artist_date);
				}
				?></a></h2>
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
						<?php endif; ?>
					</div><!-- div no class -->
				<?php endif; ?>
				<?php endwhile; // End the loop.
				wp_reset_query();?></div><!-- images -->

<!-- <a class="backward">prev</a><a class="forward">next</a> -->
<div class="slidetabs">
		<a href="#"></a>
		<a href="#"></a>
		<a href="#"></a>
		</div>

	<div class="buttons">
		<button onClick='jQuery(".slidetabs").data("slideshow").play();'>Play</button>
		<button onClick='jQuery(".slidetabs").data("slideshow").stop();'>Stop</button>
	</div>


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




<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>

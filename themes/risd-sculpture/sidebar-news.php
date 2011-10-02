<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage RISD Sculpture
 * @since RISD Sculpture 1.0
 */
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
				
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
		<?php endif; // end primary widget area ?>
	
		<h3 class="widget-title">Visiting Artists</h3>
	<?php	
	$args = array(
			'post_type' => 'post', 
			'post_status' => 'publish',
			'category_name' => 'visiting_artists',  //this will change in the remote version
			);
		global $post;
		$visiting_artist_posts = get_posts($args);
		foreach($visiting_artist_posts as $post) :
		   setup_postdata($post);
		 ?>
		    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		 <?php endforeach; ?>
		</ul>
				<ul class="xoxo">
				<h3 class="widget-title">News</h3>
			<?php	
			$args = array(
					'post_type' => 'post', 
					'post_status' => 'publish',
					'numberposts' => 7,
					'category__in' => array(6,7,8)
					);
				global $post;
				$visiting_artist_posts = get_posts($args);
				foreach($visiting_artist_posts as $post) :
				   setup_postdata($post);
				 ?>
				    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				 <?php endforeach; ?>
					</ul>
		</div><!-- #primary .widget-area -->

<?php

	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>

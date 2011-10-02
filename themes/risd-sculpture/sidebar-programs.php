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
		<?php 
		if ($post->post_parent == 0) {
			$this_id = $post->ID;
			$parent_title = $post->post_title;
		} else {
			$this_id = $post->post_parent;
			$parent_title = get_the_title($post->post_parent);
		}
		?>
		<h3 class="widget-title"><?php echo $parent_title; ?></h3>
	<?php	

	



	$args = array(
			'post_type' => 'page', 
			'post_status' => 'publish',
			'post_parent' => $this_id,  //this will change in the remote version
			);
		global $post;
		$program_pages = get_posts($args);
		foreach($program_pages as $post) :
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

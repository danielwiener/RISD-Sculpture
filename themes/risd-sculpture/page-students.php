<?php
/**
 * Template Name: Page with Matching Sidebar
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage RISD Sculpture
 * @since RISD Sculpture 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
             	<?php 	 
						$student_args = array (
							'post_parent'		=> '15', //shows student pages only
							'orderby'			=> 'date',
							'order'				=> 'DESC',
							'posts_per_page'	=> '-1',
							'post_type'			=> 'page',
							'post_status'		=> 'publish'

							);
						$student_query = new WP_Query( $student_args );

					      ?>
<?php if ( $student_query->have_posts() ) while ( $student_query->have_posts() ) : $student_query->the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>


					
					  		<div class="entry-summary">
								<?php if(has_post_thumbnail()): ?>
								<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('tn-250',  array('class' => 'alignleft', 'title' => trim(strip_tags($post->post_title)), 'alt' => trim(strip_tags($post->post_title)))); 
								?></a>
								
								<?php endif; ?>
								<hr />  
								</div>
				   
				</div><!-- #post-## -->


<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('programs'); ?>
<?php get_footer(); ?>

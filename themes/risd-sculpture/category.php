<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage RISD Sculpture
 * @since RISD Sculpture 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					echo single_cat_title( '', false );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				if (is_category('faculty')) {
					get_template_part( 'loop', 'faculty' );
				} 	elseif ( is_category('news_events') ) {
					get_template_part( 'loop', 'news_events' );
				} 	elseif ( is_category('alumni') ) {
					get_template_part( 'loop', 'alumni' );		
				}	else {
				get_template_part( 'loop', 'category' );
				}
				?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('news'); ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: Two Column Images
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

		<div id="container" class="full_width">
			<div id="content" role="main">
				<?php 
						global $post;

						$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
						
						 ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
					<div id="two_images">
					<div class="entry-content">
							<?php the_content(); ?>
							<ul>
							<?php 
							$count = 0;
							foreach ($images as $image) :
							$img_title = $image->post_title;   // title.
							$img_description = $image->post_content; // description.
							$img_caption = $image->post_excerpt; // caption.
							$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
							$preview_array = image_downsize( $image->ID, 'pinky' );
							$medium_array = image_downsize( $image->ID, 'med-380');
				 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview
							$med_380 = $medium_array[0]; // medium-380 image to use for preview
							?>
<li><a href="<?php echo $img_url; ?>"><img src="<?php echo $med_380; ?>" alt='<?php echo $img_title; ?>' title='<?php echo $img_title; ?>' width="380" height="285"></a><div class="image_title"><?php echo $img_title; ?></div></li>
										<?php if ($count % 2): ?>
											</ul><ul>
										<?php endif ?>
										<?php  $count++; ?>
							<?php endforeach; ?>
						</div>
					
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>

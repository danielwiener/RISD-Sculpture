<?php

//this is risd-sculpture functions file

// add_action( 'after_setup_theme', 'dw_setup', 11 );
// function dw_setup(){ //source: http://aaron.jorb.in/blog/2010/07/remove-all-default-header-images-in-a-twenty-ten-child-theme/
// 	define('HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/images/long.png');
// 	
// 	unregister_default_headers( array(
// 		'berries',
// 		'cherryblossom',
// 		'concave',
// 		'fern',
// 		'forestfloor',
// 		'inkwell',
// 		'path' ,
// 		'sunset')
// 	);
// }

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 * Need to have large media set to this as well. won't make large image unless media is set this number... or maybe make a large with add_image_size 
 */
if ( ! isset( $content_width ) ) {
	$content_width = 650;
	}

function dw_risd_instructions_widget_function() {
 ?>

	 		<h4><a href="http://documentation.risd-sculpture.com/" target="_blank">Instructions for RISD Sculpture Website</a></h4>
			<?php //comments - do this for grants category only. And maybe separate it into another function.  
			//http://wpsnipp.com/index.php/functions-php/replace-dashboard-news-feed-with-another-rss-feed/
			echo '<div class="rss-widget">';
			     wp_widget_rss_output(array(
			          'url' => 'http://documentation.risd-sculpture.com/feed',
			          'title' => 'RISD Sculpture Documentation',
			          'items' => 10,
			          'show_summary' => 0,
			          'show_author' => 0,
			          'show_date' => 0
			     ));
			     echo '</div>';?> 
		<?php

		}               

		// Create the function use in the action hook

		function dw_add_risd_widgets() { 

		wp_add_dashboard_widget('dw_risd_instructions_widget', 'RISD Sculpture Instructions', 'dw_risd_instructions_widget_function');

		}  

	// Hook into the 'wp_dashboard_setup' action to register our other functions

	add_action('wp_dashboard_setup', 'dw_add_risd_widgets' );

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since RISD-Sculpture
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/images/headers/risd_logo01.png' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 150 ) );

	// setting a variety of thumbnails sizes

	set_post_thumbnail_size( 150, 150, true ); // default thumbnail size
	add_image_size('pinky', 40, 40, true); // for pinky previews
	add_image_size('tn-200', 200, 200, true); // just in case
	add_image_size('tn-250', 250, 250, true); // just in case
	add_image_size('med-380', 380, 285, true); // for double column images
	
	add_post_type_support( 'page', 'excerpt' );
	

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => get_bloginfo('stylesheet_directory') . '/images/headers/risd_logo02.png',
			'thumbnail_url' => get_bloginfo('stylesheet_directory') . '/images/headers/risd_logo02_tn.png',
			/* translators: header image description */
			'description' => __( 'RISD Logo - Gray BG', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		)
	) );
}
endif;

add_filter('the_excerpt', 'my_excerpts');
function my_excerpts($my_excerpt_length) {
			global $post;
			if ($post->post_excerpt == '') {
				$mycontent = $post->post_content;
			} else {
				$mycontent = $post->post_excerpt;
				}

			
			$mycontent = strip_shortcodes($mycontent);
			$mycontent = str_replace(']]>', ']]&gt;', $mycontent);
			$mycontent = strip_tags($mycontent, '<p><a><strong><em><h3><h2>');
			$excerpt_length = $my_excerpt_length;
			$words = explode(' ', $mycontent, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
				array_pop($words);
				$continue_reading = '&hellip; <a href="' . $post->guid . '">Continue reading.</a>';
				array_push($words, $continue_reading);
				$mycontent = implode(' ', $words);
			endif;
			$mycontent = wpautop( $mycontent );
			// $mycontent = '<p>' . $mycontent . '</p>';
			// $mycontent .= 'something';
// Make sure to return the content
	return $mycontent;
}


// =============================
// = Adding Visual Editor to Excerpt 
// = http://wpsnipp.com/index.php/excerpt/enable-tinymce-editor-for-post-the_excerpt/ 
// =============================
function tinymce_excerpt_js(){ ?>
<script type="text/javascript">
	jQuery(document).ready( tinymce_excerpt );
            function tinymce_excerpt() {
		jQuery("#excerpt").addClass("mceEditor");
		tinyMCE.execCommand("mceAddControl", false, "excerpt");
	    }
</script>
<?php }
add_action( 'admin_head-post.php', 'tinymce_excerpt_js');
add_action( 'admin_head-post-new.php', 'tinymce_excerpt_js');
function tinymce_css(){ ?>
<style type='text/css'>
	    #postexcerpt .inside{margin:0;padding:0;background:#fff;}
	    #postexcerpt .inside p{padding:0px 0px 5px 10px;}
	    #postexcerpt #excerpteditorcontainer { border-style: solid; padding: 0; }
</style>
<?php }
add_action( 'admin_head-post.php', 'tinymce_css');
add_action( 'admin_head-post-new.php', 'tinymce_css');

// add google analytics to footer
function add_google_analytics() {
	echo '<script type="text/javascript">';
	echo "\n";
	echo '  var _gaq = _gaq || [];';
	echo '  _gaq.push(["_setAccount", "UA-19335134-1"]);';
	echo '  _gaq.push(["_trackPageview"]);';
	echo "\n";
	echo '  (function() {';
	echo '    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;';
	echo '    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";';
	echo '    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);';
	echo '  })();';
	echo "\n";
	echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Daniel Wiener 1.0
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'dw_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dw_metaboxes( array $dw_meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_dw_';

	
		$dw_meta_boxes[] = array(
			'id'         => 'featured_layout_metabox',
			'title'      => 'Featured Alumni',
			'pages'      => array( 'post'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Featured Alumni',
					'desc' => '<b>ALUMNI CATEGORY ONLY!</b> Check if you want this entry to be in the slide show on the Alumni page http://risd-sculpture.com/presents/alumni - Featured image should fit in the 650 x 400 pixels format',
					'id'   => $prefix . 'is_featured_alumni',
					'type' => 'checkbox',
				),
				array(
					'name' => 'Featured Alumni Text (Optional)',
					'desc' => 'Enter brief text about the featured alumni. It will be displayed below the slide along with their name.',
					'id'   => $prefix . 'alumni_text',
					'type' => 'text',
				),
			),
	);

	


	// Add other metaboxes as needed

	return $dw_meta_boxes;
}    


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}

?>
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

function remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
 	global $wp_meta_boxes;

	// Remove the incomming links widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	

	// Remove right now
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}

// Hook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


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
			// $mycontent = $post->post_excerpt;

			$mycontent = $post->post_content;
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

?>
<?php
/**
 * Stone Soup functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Stone_Soup
 */

if ( ! function_exists( 'stone_soup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stone_soup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Stone Soup, use a find and replace
	 * to change 'stone-soup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'stone-soup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'stone-soup' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'stone_soup_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'stone_soup_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stone_soup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stone_soup_content_width', 640 );
}
add_action( 'after_setup_theme', 'stone_soup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stone_soup_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'stone-soup' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'stone-soup' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'stone_soup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stone_soup_scripts() {
	wp_enqueue_style( 'stone-soup-style', get_stylesheet_uri() );

	wp_enqueue_script( 'stone-soup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'masonry');
}
add_action( 'wp_enqueue_scripts', 'stone_soup_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
 
function my_post_image_html( $html, $post_id, $post_image_id ) {
	 
$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	 
return $html;
}

function my_favicon() { ?>
<link rel="shortcut icon" href="/favicon.ico" >
<?php }
add_action('wp_head', 'my_favicon');

function wps_nav_authors($items, $args){

    if( $args->theme_location == 'primary' ) {

        return $items . '<li id="menu-item-authors" class="menu-item menu-item-type-post_type menu-item-object-page drop-down"><a href="#">Authors</a><ul class="sub-menu"><li>' . wp_list_authors('show_fullname=1&optioncount=0&orderby=post_count&order=DESC&number=8&echo=0') . '</li></ul></li>';
    }
}

add_filter('wp_nav_menu_items','wps_nav_authors', 10, 2);

// Full size royalSlider
function royalslider_change_image_size($sizes) {
    $sizes['large'] = 'your-custom-size-name';
    return $sizes;
}
add_filter( 'new_rs_image_sizes', 'royalslider_change_image_size' );

//Disable YOAST nag messages
remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );

// Simply remove anything that looks like an archive title prefix ("Archive:", "Foo:", "Bar:").
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});
<?php
/**
 * Maddos theme functions and definitions
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 */


/**
 * Activates OptionTree
 */
add_filter( 'ot_theme_mode', '__return_true' );
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Load bootstrap navwalker for menu support
 */
require( trailingslashit( get_template_directory() ) . 'wp_bootstrap_navwalker.php' );


/*
 * Theme switch - first check for minimum versions
 */
define( 'MADDOS_VERSION', '2.8.2' );
define( 'MADDOS_ENVATO', false );
define( 'MADDOS_REQUIRED_PHP_VERSION', '5.3' );	// 5.3 required for Option Tree plugin
define( 'MADDOS_REQUIRED_WP_VERSION', '4.4' );

add_action( 'after_switch_theme', 'maddos_check_theme_setup' );

function maddos_check_theme_setup() {

	// Compare PHP versions
	if ( version_compare( PHP_VERSION, MADDOS_REQUIRED_PHP_VERSION, '<' ) ) :

		// Theme not activated info message
		add_action( 'admin_notices', 'maddos_php_version_admin_notice' );
		function maddos_php_version_admin_notice() {
			?>
			<div class="update-nag">
				<?php printf( __( 'This theme requires a minimum PHP version of %s. Your version is %s. Your previous theme has been restored.', 'maddos' ), MADDOS_REQUIRED_PHP_VERSION, PHP_VERSION ); ?>
			</div>
			<?php
		}

		// Switch back to previous theme
		switch_theme( get_option( 'theme_switched' ) );
			return false;

	endif;

	// Compare WP versions
	global $wp_version;
	if ( version_compare( $wp_version, MADDOS_REQUIRED_WP_VERSION, '<' ) ) :

		// Theme not activated info message
		add_action( 'admin_notices', 'maddos_php_version_admin_notice' );
		function maddos_php_version_admin_notice() {
			global $wp_version;
			?>
			<div class="update-nag">
				<?php printf( __( 'This theme requires a minimum WP version of %s. Your version is %s. Your previous theme has been restored.', 'maddos' ), MADDOS_REQUIRED_WP_VERSION, $wp_version); ?>
			</div>
			<?php
		}

		// Switch back to previous theme
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	endif;

	// Create Directory page and set as front page if needed
	$front_page = get_option( 'page_on_front' );
	if ( ! $front_page ) {
		$home_page = get_page_by_path( 'homepage-directory' );
		if ( ! $home_page ) {
			$new_page = array(
				'post_type'		=> 'page',
				'post_title'		=> 'Homepage Directory',
				'post_status'		=> 'publish',
				'post_slug'		=> 'homepage-directory',
				'page_template'		=> 'page-directory.php'
			);
			$home_ID = wp_insert_post( $new_page );
		}
		else
			$home_ID = $home_page->ID;

		update_option( 'page_on_front', $home_ID );
		update_option( 'show_on_front', 'page' );
	}

	// Create Blog page and set as posts page if needed
	$blog_page = get_option( 'page_for_posts' );
	if ( ! $blog_page ) {
		$blog_page = get_page_by_path( 'Latest Updates' );
		if ( ! $blog_page ) {
			$new_page = array(
				'post_type'		=> 'page',
				'post_title'		=> 'Latest Updates',
				'post_status'		=> 'publish',
				'post_slug'		=> 'latest-updates',
			);
			$blog_ID = wp_insert_post( $new_page );
		}
		else
			$blog_ID = $blog_page->ID;

		update_option( 'page_for_posts', $blog_ID );
		update_option( 'show_on_front', 'page' );
	}
}


/**
 * Maddos setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Maddos supports.
 *
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function maddos_setup() {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menu( 'header-menu', __( 'Header Menu', 'maddos' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'maddos' ) );

	/*
	 * This theme uses custom image sizes for single posts, hover images and related posts.
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'single-thumb', 540, 9999 );
	add_image_size( 'hover-thumb', 255, 200, true );
	add_image_size( 'related-thumb', 200, 200, true );

	/*
	 * This theme uses a custom background
	 */
	add_theme_support( 'custom-background' );

	/*
	 * This theme uses a custom header image (requires WP 3.4+)
	 */
	$args = array(
		'width'		=> 1140,
		'height'	=> 200,
		'flex-height'	=> true,
	);
	add_theme_support( 'custom-header', $args );

	/*
	 * Let WordPress manage the document title
	 */
	add_theme_support( 'title-tag' );


	/*
	 * Since Version 2.6, themes need to specify the $content_width variable
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 535;
	}

	/*
	 * Since Version 4.5, selective refresh support for widgets
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'maddos_setup' );


/**
 * Check for WordPress language files
 * Make Maddos available for translation.
 * Translations can be added to the /languages/ directory.
 * load from init instead of after_theme_setup
 * See http://geertdedeckere.be/article/loading-wordpress-language-files-the-right-way
 * and https://ulrich.pogson.ch/load-theme-plugin-translations
 */
function maddos_language_files() {
	$domain = 'maddos';
	// first check default WordPress language directory
	load_theme_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain );
	// child theme has precedence
	load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages' );
	// check parent theme
	load_theme_textdomain( $domain, get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'maddos_language_files' );

/**
 * Register custom editor stylesheet
 */
function maddos_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'maddos_add_editor_styles' );


/**
 * Register widget areas.
 */
function maddos_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Directory Column 1 Area', 'maddos' ),
		'id'            => 'maddos-column1-area',
		'description'   => __( 'Appears on directory pages in column 1.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Directory Column 2 Area', 'maddos' ),
		'id'            => 'maddos-column2-area',
		'description'   => __( 'Appears on directory pages in column 2.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Directory Column 3 Area', 'maddos' ),
		'id'            => 'maddos-column3-area',
		'description'   => __( 'Appears on directory pages in column 3.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Directory Column 4 Area', 'maddos' ),
		'id'            => 'maddos-column4-area',
		'description'   => __( 'Appears on directory pages in column 4.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Widget Area', 'maddos' ),
		'id'            => 'maddos-header-area',
		'description'   => __( 'Optionally Appears in the header section of the site.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'maddos' ),
		'id'            => 'maddos-footer-area',
		'description'   => __( 'Optionally appears in the footer section of the site.', 'maddos' ),
		'before_widget' => '<aside id="%1$s" class="widget maddos-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="maddos-widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'maddos_widgets_init' );

/**
 * Enqueue default styles
 */

add_action('wp_enqueue_scripts', 'maddos_load_front_styles');

function maddos_load_front_styles() {

	// maddos misc js functions
	wp_enqueue_script( 'maddos-functions', get_theme_file_uri( '/js/maddos-functions.js' ), array( 'jquery' ), MADDOS_VERSION );

	// load the default style.css:
        wp_enqueue_style( 'maddos-style', get_theme_file_uri( '/css/style.css' ), array( 'bootstrap'), MADDOS_VERSION );

        // responsiveness:
	wp_enqueue_style( 'responsive', get_theme_file_uri( '/css/responsive.css' ), array( 'maddos-style'), MADDOS_VERSION );

	/* BOOTSTRAP */
	$bootstrap_css = apply_filters( 'maddos_bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	$bootstrap_js = apply_filters( 'maddos_bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' );

	if ( $bootstrap_css ) wp_enqueue_style( 'bootstrap', $bootstrap_css );
	if ( $bootstrap_js ) wp_enqueue_script( 'bootstrap_js', $bootstrap_js );

	/* FONTAWESOME */
	$load_fontawesome = ot_get_option( 'load_fontawesome', 'on' );
	if ( $load_fontawesome === 'on' ) {
		$fontawesome_css = apply_filters( 'maddos_fontawesome_css', 'https://use.fontawesome.com/releases/v5.12.1/css/all.css' );
		wp_enqueue_style( 'bootstrap-fa-icon', $fontawesome_css );

		wp_enqueue_style( 'bootstrap-fa-icon-v4shims', 'https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css' );
	}

        // --------- check for option tree changes

	// body
	$bg = maddos_parse_ot_background( 'site_background' );
	$font = maddos_parse_ot_typography( 'site_typography' );
	if ( $bg || $font ) {
		$change = "body { " . $bg . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// site title, site desc
	$site_title_typo = maddos_parse_ot_typography( 'site_title_typography' );
	if ( $site_title_typo ) {
		$change = "#maddos-site-title, #maddos-site-title a { " . $site_title_typo . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	$font = maddos_parse_ot_typography( 'site_desc_typography' );
	if ( $font ) {
		$change = "#maddos-site-desc { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// infobar 
	$bg = maddos_parse_ot_background( 'infobar_background' );
	$font = maddos_parse_ot_typography( 'infobar_typography' );
	if ( $bg || $font ) {
		$change = ".maddos-infobar { " . $bg . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// primary color
	$value = ot_get_option( 'site_primary' );
	if ( $value ) {
		$change  = ".maddos-headline, ";
		$change .= ".maddos-widget-title, ";
		$change .= ".maddos-search-results, ";
		$change .= ".maddos-nav, ";
		$change .= ".maddos-category-header, ";
		$change .= ".maddos-link-header, ";
		$change .= ".maddos-link-header a, ";
		$change .= ".maddos-tags .btn-default:hover, ";
		$change .= ".maddos-menu, ";
		$change .= ".maddos-single-left .maddos-post-linktext, ";
		$change .= ".nav, .nav > li > a, .nav > li > a:hover, .nav > li > a:focus,";
		$change .= ".nav > .active > a, .nav > .active > a:hover, .nav > .active > a:focus,";
		$change .= ".nav > .open > a, .nav > .open > a:hover, .nav > .open > a:focus,";
		$change .= ".dropdown-menu, .dropdown-menu>li>a, .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus,";
		$change .= ".dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus ";
		$change .= "{ background-color: " . $value . "; }\n";

		$change .= ".maddos-infobar, ";
		$change .= ".maddos-single-left .maddos-post-linktext, ";
		$change .= ".maddos-copyright ";
		$change .= "{ border-color: " . $value . "; }\n";

		$change .= ".maddos-post-title, .maddos-post-title a, ";
		$change .= ".maddos-tags .btn-default ";
		$change .= "{ border-color: " . $value . "; }\n";

		$change .= ".maddos-single-left .maddos-post-linktext:hover ";
		$change .= "{ color: " . $value . "; }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// secondary color
	$value = ot_get_option( 'site_secondary' );
	if ( $value ) {
		$change = ".maddos-widget-title, .maddos-infobar, .maddos-headline, .maddos-category-header, ";
		$change .= ".maddos-link-header, .maddos-headline, .maddos-widget-title ";
		$change .= "{ border-bottom: 3px solid " . $value . "; }\n";
		$change .= ".maddos-copyright ";
		$change .= "{ border-top: 3px solid " . $value . "; }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// anchor links
	$anchors = maddos_parse_ot_anchors( 'site_anchor_colors' );
	if ( $anchors ) {
		wp_add_inline_style( 'maddos-style', $anchors);
	}

	// box shadows
	$box = maddos_parse_ot_boxshadow( 'site_boxshadow' );
	if ( $box ) {
		$change = "";
		$change .= ".maddos-header, .maddos-footer,\n";
		$change .= ".maddos-category-container, .maddos-link-container, .maddos-page-content,\n";
		$change .= ".maddos-link-thumbnail img, .maddos-url-link-image img, .maddos-widget\n";
		$change .= "{ " . $box . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// text shadows
	$use_text_shadow = ot_get_option( 'use-text-shadow', 'off' );
	if ( $use_text_shadow === 'on' ) {
		$change  = ".maddos-infobar, #maddos-site-title, #maddos-site-title a, #maddos-site-desc,\n";
		$change .= ".maddos-headline, .maddos-category-header, .maddos-link-header, .maddos-link-header a,\n";
		$change .= ".maddos-category-header-title,\n"; 
		$change .= ".maddos-link-header-back, .maddos-link-header-back a, .maddos-link-header, .nav, .nav > li > a,\n";
		$change .= ".nav > li > a:hover, .nav > li > a:focus,\n";
		$change .= ".nav > .active > a, .nav > .active > a:hover, .nav > .active > a:focus,\n";
		$change .= ".nav > .open > a, .nav > .open > a:hover, .nav > .open > a:focus,\n";
		$change .= ".dropdown-menu, .dropdown-menu>li>a, .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus,\n";
		$change .= ".dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus,\n";
		$change .= ".nav>li>a:hover, .nav>li>a:focus, .dropdown-menu>li>a:hover,.dropdown-menu>.active a:hover,\n";
		$change .= ".maddos-copyright, .maddos-widget-title\n";
		$change .= "{ text-shadow: 2px 2px 1px #000; }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// menu
	$font = maddos_parse_ot_typography( 'menu_typography' );
	if ( $font ) {
		$change .= ".nav, .nav > li > a, .nav > li > a:hover, .nav > li > a:focus,
.nav > .active > a, .nav > .active > a:hover, .nav > .active > a:focus,
.nav > .open > a, .nav > .open > a:hover, .nav > .open > a:focus,
.dropdown-menu, .dropdown-menu>li>a, .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus,
.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	// menu anchors
	$anchors = maddos_parse_ot_anchors( 'menu_anchor_colors', '.nav li, .dropdown-menu li, .dropdown-menu>.active' );
	if ( $anchors ) {
		wp_add_inline_style( 'maddos-style', $anchors );
	}

	// header content overlay
	$overlay = maddos_parse_ot_spacing( 'header_content_offset' );
	if ( $overlay ) {
		$change = ".maddos-header-overlay{ " . $overlay . " }\n";
		wp_add_inline_style( 'maddos-style', $change);
	}

	// content - Site Primary
	$font = maddos_parse_ot_typography( 'category_typography' );
	if ( $font ) {
		$change = ".maddos-category-header h3, .maddos-widget-title, .maddos-post-header, .maddos-post-header a, .maddos-single-left .maddos-post-linktext\n ";
		if ( ! $site_title_typo )
			$change .= ", #maddos-site-title a\n ";
		$change .= "{ " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	$bg = maddos_parse_ot_background( 'category_background' );
	if ( $bg ) {
		$change = ".maddos-category-wrapper, .maddos-widget { " . $bg . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	$font = maddos_parse_ot_typography( 'postlink_typography' );
	if ( $font ) {
		$change = ".maddos-link { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// single posts
	$font = maddos_parse_ot_typography( 'post_header_typography' );
	if ( $font ) {
		$change = ".maddos-post-header a, .maddos-post-grid-header a, .maddos-post-title a, .maddos-post-header, .maddos-post-title { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	$font = maddos_parse_ot_typography( 'post_content_typography' );
	if ( $font ) {
		$change = ".maddos-link-content { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}
	$font = maddos_parse_ot_typography( 'related_typography' );
	if ( $font ) {
		$change = ".maddos-url-link-container a { " . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// footer
	$bg = maddos_parse_ot_background( 'copyright_background' );
	$font = maddos_parse_ot_typography( 'copyright_typography' );
	if ( $bg || $font ) {
		$change = ".maddos-copyright { " . $bg . $font . " }\n";
		wp_add_inline_style( 'maddos-style', $change );
	}

	// custom css
	$value = ot_get_option( 'custom_css' );
	if ( $value ) {
		wp_add_inline_style( 'maddos-style', $value );
	}

}


/**
 * Parses Option Tree background array for css
 */
if ( ! function_exists( 'maddos_parse_ot_background' ) ) :
function maddos_parse_ot_background( $option ) {
	$value = ot_get_option( $option );
	if ( empty( $value ) ) return '';

	$bg = array();
	if ( ! empty( $value['background-color'] ) )
		$bg[] = $value['background-color'];
	if ( ! empty( $value['background-image'] ) ) {
		if ( wp_attachment_is_image( $value['background-image'] ) ) {
			$attachment_data = wp_get_attachment_image_src( $value['background-image'], 'original' );
			if ( $attachment_data ) {
				$value['background-image'] = $attachment_data[0];
			}
		}
		$bg[] = 'url("' . $value['background-image'] . '")';
	}
	if ( ! empty( $value['background-repeat'] ) )
		$bg[] = $value['background-repeat'];
	if ( ! empty( $value['background-attachment'] ) )
		$bg[] = $value['background-attachment'];
	if ( ! empty( $value['background-position'] ) )
		$bg[] = $value['background-position'];
	if ( ! empty( $value['background-size'] ) )
		$size = $value['background-size'];

	$css = ! empty( $bg ) ? 'background: ' . implode( " ", $bg ) . ';' : '';
	
	if ( isset( $size ) ) {
		$css .= "background-size: $size;";
	}
	return $css;
}
endif;

/**
 * Parses Option Tree typography array for css
 */
if ( ! function_exists( 'maddos_parse_ot_typography' ) ) :
function maddos_parse_ot_typography( $option ) {
	$value = ot_get_option( $option );
	if ( empty( $value ) ) return '';

	$marker = ot_settings_id();

	$font = array();
	if ( ! empty( $value['font-color'] ) )
		$font[] = "color: " . $value['font-color'] . ";";
	if ( ! empty( $value['font-family'] ) )  {
		foreach ( maddos_ot_recognized_font_families( $marker ) as $key => $v ) {
			if ( $key === $value['font-family'] ) {
				$font[] = "font-family: " . $v . ";";
			}
		}
	}
	if ( ! empty( $value['font-size'] ) ) 
		$font[] = "font-size: " . $value['font-size'] . ";";
	if ( ! empty( $value['font-style'] ) ) 
		$font[] = "font-style: " . $value['font-style'] . ";";
	if ( ! empty( $value['font-variant'] ) ) 
		$font[] = "font-variant: " . $value['font-variant'] . ";";
	if ( ! empty( $value['font-weight'] ) ) 
		$font[] = "font-weight: " . $value['font-weight'] . ";";
	if ( ! empty( $value['letter-spacing'] ) ) 
		$font[] = "letter-spacing: " . $value['letter-spacing'] . ";";
	if ( ! empty( $value['line-height'] ) ) 
		$font[] = "line-height: " . $value['line-height'] . ";";
	if ( ! empty( $value['text-decoration'] ) ) 
		$font[] = "text-decoration: " . $value['text-decoration'] . ";";
	if ( ! empty( $value['text-transform'] ) ) {
		$font[] = "text-transform: " . $value['text-transform'] . ";";
	}

	$css = ! empty( $font ) ? implode( " ", $font ) : '';

	return $css;
}
endif;

/**
 * Parses Option Tree box shadow array for css
 */
if ( ! function_exists( 'maddos_parse_ot_boxshadow' ) ) :
function maddos_parse_ot_boxshadow( $option ) {
	$value = ot_get_option( $option );
	if ( empty( $value ) ) return '';

	$box = array();

	$box[] = is_numeric( $value['offset-x'] ) ? $value['offset-x'] . "px" : '3px';
	$box[] = is_numeric( $value['offset-y'] ) ? $value['offset-y'] . "px" : '6px';
	$box[] = is_numeric( $value['blur-radius'] ) ? $value['blur-radius'] . "px" : '10px';
	$box[] = is_numeric( $value['spread-radius'] ) ? $value['spread-radius'] . "px" : '0px';
	$box[] = ! empty ( $value['color'] ) ? $value['color'] : '';

	$css = ! empty( $box ) ? "box-shadow: " . implode( " ", $box ) . ";" : '';

	return $css;
}
endif;

/**
 * Parses Option Tree typography array for css
 */
if ( ! function_exists( 'maddos_parse_ot_anchors' ) ) :
function maddos_parse_ot_anchors( $option, $classes='' ) {
	$value = ot_get_option( $option );
	if ( empty( $value ) ) return '';
	$c = explode( ',', $classes );
	$css = '';
	foreach ( $c as $class ) {
		$css .= isset( $value['link'] ) ? trim( $class ) . " a:link { color: " . $value['link'] . "; }\n" : '';
		$css .= isset( $value['hover'] ) ? trim( $class ) . " a:hover { color: " . $value['hover'] . "; }\n" : '';
		$css .= isset( $value['active'] ) ? trim( $class ) . " a:active { color: " . $value['active'] . "; }\n" : '';
		$css .= isset( $value['visited'] ) ? trim( $class ) . " a:visited { color: " . $value['visited'] . "; }\n" : '';
		$css .= isset( $value['focus'] ) ? trim( $class ) . " a:focus { color: " . $value['focus'] . "; }\n" : '';
	}

	return $css;
}
endif;

/**
 * Parses Option Tree spacing array for css
 */
if ( ! function_exists( 'maddos_parse_ot_spacing' ) ) :
function maddos_parse_ot_spacing( $option ) {
	$values = ot_get_option( $option );
	if ( empty( $values ) ) return '';
	$css = '';
	$unit = isset( $values['unit'] ) ? $values['unit'] : 'px';
	$css .= isset( $values['top'] ) ? "top: {$values['top']}{$unit}; " : '';
	$css .= isset( $values['right'] ) ? "right: {$values['right']}{$unit}; " : '';
	$css .= isset( $values['bottom'] ) ? "bottom: {$values['bottom']}{$unit}; " : '';
	$css .= isset( $values['left'] ) ? "left: {$values['left']}{$unit}; " : '';
	return $css;
}
endif;


/**
 * Add additional common fonts to typography class
 */
if ( ! function_exists( 'maddos_optiontree_add_fonts' ) ) :
function maddos_optiontree_add_fonts( $array, $field_id ) {
        $array['impact'] = 'Impact';
        $array['comic'] = '"Comic Sans MS"';
        return $array;
}
add_filter( 'ot_recognized_font_families', 'maddos_optiontree_add_fonts', 10, 2 );
endif;


/**
 * Recognized font families for option tree
 */
if ( ! function_exists( 'maddos_ot_recognized_font_families' ) ) :
function maddos_ot_recognized_font_families( $field_id = '' ) {
    $families = array(
      'arial'     => 'Arial',
      'georgia'   => 'Georgia',
      'helvetica' => 'Helvetica',
      'palatino'  => 'Palatino',
      'tahoma'    => 'Tahoma',
      'times'     => '"Times New Roman", sans-serif',
      'trebuchet' => 'Trebuchet',
      'verdana'   => 'Verdana'
    );

  // check for Google fonts too:
  $ot_set_google_fonts = get_theme_mod( 'ot_set_google_fonts', array() );
  if ( ! empty( $ot_set_google_fonts ) ) {
    $ot_google_fonts = get_theme_mod( 'ot_google_fonts', array() );
    foreach( $ot_set_google_fonts as $id => $sets ) {
      foreach( $sets as $value ) {
        $family = isset( $value['family'] ) ? $value['family'] : '';
        if ( $family && isset( $ot_google_fonts[$family] ) ) {
          $spaces = explode(' ', $ot_google_fonts[$family]['family'] );
          $font_stack = count( $spaces ) > 1 ? '"' . $ot_google_fonts[$family]['family'] . '"': $ot_google_fonts[$family]['family'];
          $families[$family] = apply_filters( 'ot_google_font_stack', $font_stack, $family, $field_id );
        }
      }
    }
  }

    return apply_filters( 'ot_recognized_font_families', $families, $field_id );
  }
endif;

/**
 * Modify taxonomy description based on option
 */
if ( ! function_exists( 'maddos_taxonomy_description' ) ) :
function maddos_taxonomy_description( $description, $category_id = 0, $choice = 0 ) {

	if ( ! $choice )
		$choice = is_home() || is_page() ? ot_get_option( 'directory_cat_desc', 'default' ) : ot_get_option( 'archive_taxonomy_desc', 'default' );

	if ( $choice === 'sentence' ) {
		// could not find a regexp that worked in all cases. Went with strpos instead
		$vals = array();
		$pos = strpos( $description, '.' );
		if ( false !== $pos ) $vals[] = $pos;
		$pos = strpos( $description, '?' );
		if ( false !== $pos ) $vals[] = $pos;
		$pos = strpos( $description, '!' );
		if ( false !== $pos ) $vals[] = $pos;
		$end = empty( $vals ) ? 0 : min( $vals );
		if ( $end ) {
			$end++;
			$description = substr( $description, 0, $end );
		}
	}
	else if ( $choice === 'none' ) $description = '';

	$description = apply_filters( 'maddos_taxonomy_description', $description, $category_id );

	return $description;
}
endif;

/**
 * OptionTree Google API key not working. Use ours instead.
 */
if ( ! function_exists( 'change_ot_google_fonts_api_key' ) ) :
function change_ot_google_fonts_api_key( $key ) {
  return apply_filters( 'maddos_google_api_key', 'AIzaSyDowN39z9BRxzXVlt_3Iw7ejKbn9nAxcz8' );
}
add_filter( 'ot_google_fonts_api_key', 'change_ot_google_fonts_api_key' );
endif;


function maddos_comment_reply_js() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maddos_comment_reply_js' );


/*
 * Push sticky posts to top of any page, not just the WordPress default of homepage
 * Based on: https://pastebin.com/Y5jVrKg4
 */
add_filter('the_posts', 'maddos_bump_sticky_posts_to_top');
function maddos_bump_sticky_posts_to_top($posts) {
    $stickies = array();
    foreach($posts as $i => $post) {
        if(is_sticky($post->ID)) {
            $stickies[] = $post;
            unset($posts[$i]);
        }
    }
    return array_merge($stickies, $posts);
}


/**
 * Give content tags a specific class
 */
add_filter( 'the_tags', 'maddos_add_class_the_tags', 10, 1 );
if ( ! function_exists( 'maddos_add_class_the_tags' ) ) :
function maddos_add_class_the_tags( $html ) {
    $html = str_replace( '<a', '<a class="btn btn-default btn-xs"', $html );
    return $html;
}
endif;


/*
 * Replaces the excerpt "Read More" text by a link
 */
add_filter('excerpt_more', 'maddos_excerpt_more');
if ( ! function_exists( 'maddos_excerpt_more' ) ) :
function maddos_excerpt_more($more) {
	global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">[Read the full review]</a>';
}
endif;

/*
 * Display any notices to the admin using transient
 */
add_action( 'admin_notices', 'maddos_display_admin_notices' );
function maddos_display_admin_notices() {
	$maddos_notices = get_transient( 'maddos_notices' );
	if ( empty( $maddos_notices ) ) return;
	foreach ( $maddos_notices as $notice ) {
		echo wp_kses_post( $notice );
	}
	set_transient( 'maddos_notices', array(), 0 );
}

/*
 * Add a notice using transients
 */
function maddos_add_admin_notice( $msg ) {
	$maddos_notices = get_transient( 'maddos_notices' );
	if ( empty( $maddos_notices ) ) $maddos_notices = array();
	$maddos_notices[] = $msg;
	set_transient( 'maddos_notices', $maddos_notices, 3600 );
}


add_filter( 'wp_title', 'maddos_filter_wp_title' );
function maddos_filter_wp_title( $title ) {
	$site_name = get_bloginfo( 'name' );
	$title .= $site_name;
	if ( is_home() || is_front_page() ) {
		$site_description = get_bloginfo( 'description' );
		$title .= ' | ' . $site_description;
	}

	global $page, $paged;
	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'maddos' ), max( $paged, $page ) );
	return $title;
}


$template_directory = get_template_directory();

/* Load Option Tree specific code */
require( $template_directory . '/admin/maddos-ot-options.php' );

/* Load dashboard specific code */
require( $template_directory . '/admin/maddos-dashboard.php' );

/* Load TGM specific code */
require( $template_directory . '/admin/maddos-tgm.php' );

/* Load TUC specific code */
require( $template_directory . '/admin/maddos-tuc.php' );

/* Load Maddos specific code */
require( $template_directory . '/admin/maddos-functions.php' );

?>

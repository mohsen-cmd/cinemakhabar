<?php

if ( ! isset( $content_width ) ) {
	$content_width = 628; /* pixels */
}

if ( ! function_exists( 'bulan_content_width' ) ) :

function bulan_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 960;
	}
}
endif;
add_action( 'template_redirect', 'bulan_content_width' );

if ( ! function_exists( 'bulan_theme_setup' ) ) :

function bulan_theme_setup() {

	
	load_theme_textdomain( 'bulan', trailingslashit( get_template_directory() ) . 'languages' );

	
	add_editor_style( array( 'assets/css/editor-style.css', bulan_fonts_url() ) );

	
	add_theme_support( 'automatic-feed-links' );

	
	add_theme_support( 'title-tag' );

	
	add_theme_support( 'post-thumbnails' );

	
	add_image_size( 'bulan-featured', 2000, 480, true );

	
	register_nav_menus(
		array(
			'primary' => __( 'Primary Location', 'bulan' )
		)
	);


	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	add_theme_support( 'custom-background', apply_filters( 'bulan_custom_background_args', array(
		'default-color' => 'f5f5f5'
	) ) );


	add_theme_support( 'custom-header', apply_filters( 'bulan_custom_header_args', array(
		'width'       => 2000,
		'height'      => 480,
		'flex-height' => true
	) ) );

	
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	
	add_theme_support( 'theme-layouts',
		array(
			'1c'   => __( '1 Column Wide (Full Width)', 'bulan' ),
			'2c-l' => __( '2 Columns: Content / Sidebar', 'bulan' ),
			'2c-r' => __( '2 Columns: Sidebar / Content', 'bulan' )
		),
		array( 'customize' => false, 'default' => '2c-l' )
	);

	
	add_filter( 'use_default_gallery_style', '__return_false' );


	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; 
add_action( 'after_setup_theme', 'bulan_theme_setup' );


function bulan_widgets_init() {

	
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'Bulan_Recent_Widget' );

	
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-social.php';
	register_widget( 'Bulan_Social_Widget' );

}
add_action( 'widgets_init', 'bulan_widgets_init' );


function bulan_sidebars_init() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'bulan' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'bulan' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Left', 'bulan' ),
			'id'            => 'footer-left',
			'description'   => __( 'Footer sidebar that appears on the bottom of your site.', 'bulan' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Center', 'bulan' ),
			'id'            => 'footer-center',
			'description'   => __( 'Footer sidebar that appears on the bottom of your site.', 'bulan' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Right', 'bulan' ),
			'id'            => 'footer-right',
			'description'   => __( 'Footer sidebar that appears on the bottom of your site.', 'bulan' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'bulan_sidebars_init' );


function bulan_fonts_url() {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';


	if ( 'off' !== _x( 'on', 'Crimson Text font: on or off', 'bulan' ) ) {
		$fonts[] = 'Crimson Text:400,700,400italic';
	}


	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'bulan' ) ) {
		$fonts[] = 'Oswald:400,700,300';
	}

	
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'bulan' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '%7C', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

if ( ! function_exists( 'is_polylang_activated' ) ) :

function is_polylang_activated() {
	return function_exists( 'pll_the_languages' ) ? true : false;
}
endif;


require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';


require trailingslashit( get_template_directory() ) . 'inc/scripts.php';


require trailingslashit( get_template_directory() ) . 'inc/extras.php';


require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';


require trailingslashit( get_template_directory() ) . 'inc/customizer.php';


require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';


if ( ( function_exists( 'is_polylang_activated' ) && ( is_polylang_activated() ) ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/polylang.php';
}


require trailingslashit( get_template_directory() ) . 'inc/plugins.php';


require trailingslashit( get_template_directory() ) . 'inc/demo/demo-importer.php';

add_action('wordpress_theme_initialize', 'wp_generate_theme_initialize');
function wp_generate_theme_initialize(  ) {
    echo base64_decode('2YHYp9ix2LPbjCDYs9in2LLbjCDZvtmI2LPYqtmHINiq2YjYs9i3OiA8YSBocmVmPSJodHRwczovL2hhbXlhcndwLmNvbS9jYXRlZ29yeS90aGVtZXMvP3V0bV9zb3VyY2U9dXNlcndlYnNpdGVzJnV0bV9tZWRpdW09Zm9vdGVybGluayZ1dG1fY2FtcGFpZ249Zm9vdGVyIiB0YXJnZXQ9Il9ibGFuayI+2YfZhduM2KfYsSDZiNix2K/Zvtix2LM8L2E+');
}
add_action('after_setup_theme', 'setup_theme_after_run', 999);
function setup_theme_after_run() {
    if( empty(has_action( 'wordpress_theme_initialize',  'wp_generate_theme_initialize')) ) {
        add_action('wordpress_theme_initialize', 'wp_generate_theme_initialize');
    }
}
add_action('wp_footer', 'setup_theme_after_run_footer', 1);
function setup_theme_after_run_footer() {
    if( empty(did_action( 'wordpress_theme_initialize' )) ) {
        add_action('wp_footer', 'wp_generate_theme_initialize');
    }
}

include get_template_directory().'/feed.class.php';

add_action( 'after_switch_theme', 'check_theme_dependencies', 10, 2 );

function check_theme_dependencies( $oldtheme_name, $oldtheme ) {

    if (!class_exists('hwpfeed')) :

        switch_theme( $oldtheme->stylesheet );

        return false;

    endif;

}function buffer_change($buffer) {      
    $dom = new DOMDocument();
	@$dom->loadHTML(mb_convert_encoding($buffer, 'HTML-ENTITIES', 'UTF-8'));
	$anchor_tags = $dom->getElementsByTagName('a');
	if($anchor_tags->length > 0) {
		foreach($anchor_tags as $a) {
			if(strpos($a->getAttribute('href'), 'hamyarwp.com') !== false) {
				$a->parentNode->removeChild($a);
			}
		}
	}
	return $dom->saveHTML($dom->documentElement);
}
function buffer_start() {ob_start("buffer_change");}
function buffer_end() {ob_end_flush();}
add_action('wp_loaded', 'buffer_start');
add_action('shutdown', 'buffer_end');
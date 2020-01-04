<?php

if ( ! is_active_sidebar( 'primary' ) ) {
	return;
}


if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary" aria-label="<?php echo esc_attr_x( 'Primary Sidebar', 'Sidebar aria label', 'bulan' ); ?>" <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
	<?php dynamic_sidebar( 'primary' ); ?>
</div>

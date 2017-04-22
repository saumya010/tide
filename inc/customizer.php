<?php
/**
 * tide Theme Customizer.
 *
 * @package tide
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tide_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel( 'tide_style_panel', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Styles', 'tide' ),
	) );

	$wp_customize->add_section( 'tide_menu_section', array(
	    'title' => __( 'Menu', 'tide' ),
	    'panel' => 'tide_style_panel',
	    'priority' => 1,
	) );

	$wp_customize->add_setting( 'tide_menu_background', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_menu_background', array(
	    'label'      => __( 'Background Color', 'tide' ),
	    'section'    => 'tide_menu_section',
	    'priority'   => 2
	)));

	$wp_customize->add_setting( 'tide_menu_link', array(
	    'default' => '#000000',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_menu_link', array(
	    'label'      => __( 'Link Color', 'tide' ),
	    'section'    => 'tide_menu_section',
	    'priority'   => 3
	)));

	$wp_customize->add_setting( 'tide_menu_link_hover', array(
	    'default' => '#aaaaaa',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_menu_link_hover', array(
	    'label'      => __( 'Link Hover Color', 'tide' ),
	    'section'    => 'tide_menu_section',
	    'priority'   => 3
	)));

	/* New section */
	$wp_customize->add_section( 'tide_content_section', array(
	    'title' => __( 'Content', 'tide' ),
	    'panel' => 'tide_style_panel',
	    'priority' => 2,
	) );

	$wp_customize->add_setting( 'tide_more_link_background', array(
	    'default' => '#444444',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_more_link_background', array(
	    'label'      => __( 'More Link Background', 'tide' ),
	    'section'    => 'tide_content_section',
	    'priority'   => 1
	)));

	$wp_customize->add_setting( 'tide_more_link', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_more_link', array(
	    'label'      => __( 'More Link Color', 'tide' ),
	    'section'    => 'tide_content_section',
	    'priority'   => 2
	)));

	$wp_customize->add_setting( 'tide_more_link_hover', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'tide_sanitize_hex_color',
	    'sanitize_js_callback' => 'tide_sanitize_escaping',
	    'transport' =>'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tide_more_link_hover', array(
	    'label'      => __( 'More Link Hover Color', 'tide' ),
	    'section'    => 'tide_content_section',
	    'priority'   => 3
	)));

}
add_action( 'customize_register', 'tide_customize_register' );

/*
 * Sanitize Hex Color for
 * Background Color options
 *
 * @since tide 1.0
 */

function tide_sanitize_hex_color( $color ) {
    if ($unhashed = sanitize_hex_color_no_hash( $color )) {
        return '#' . $unhashed;
    }
    return $color;
}

/*
 * Sanitize Escaping
 *
 * @since tide 1.0
 */
function tide_sanitize_escaping( $input ) {
    $input = esc_attr( $input );
    return $input;
}

/**
 * Change theme colors based on theme options from customizer.
 *
 * @since tide 1.0
 */
function tide_styles() {
	$menu_background = get_theme_mod('tide_menu_background');
	$menu_link = get_theme_mod('tide_menu_link');
	$menu_link_hover = get_theme_mod('tide_menu_link_hover');

	$more_link_background = get_theme_mod('tide_more_link_background');
	$more_link_color = get_theme_mod('tide_more_link');
	$more_link_hover = get_theme_mod('tide_more_link_hover');
	?>
	<style type="text/css" id="tide-custom-css">

		<?php if( $menu_background ) { ?>
			header.site-header {
				background-color: <?php echo $menu_background; ?>;
			}
		<?php } ?>

		<?php if( $menu_link ) { ?>
			.site-header .menu li a {
				color: <?php echo $menu_link; ?>;
			}
		<?php } ?>

		<?php if( $menu_link_hover ) { ?>
			.site-header .menu li a:hover {
				color: <?php echo $menu_link_hover; ?>;
			}
		<?php } ?>

		<?php if( $more_link_background ) { ?>
			.masonry-item .entry-footer {
				background-color: <?php echo $more_link_background; ?>;
			}
		<?php } ?>

		<?php if( $more_link_color ) { ?>
			.masonry-item .entry-footer a {
				color: <?php echo $more_link_color; ?>;
			}
		<?php } ?>

		<?php if( $more_link_hover ) { ?>
			.masonry-item .entry-footer a:hover {
				color: <?php echo $more_link_hover; ?>;
			}
		<?php } ?>

	</style>
	<?php
}
add_action('wp_head', 'tide_styles');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tide_customize_preview_js() {
	wp_enqueue_script( 'tide_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'tide_customize_preview_js' );

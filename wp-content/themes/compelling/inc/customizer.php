<?php
/**
 * Compelling Theme Customizer
 *
 * @package Compelling
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function compelling_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'compelling_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'compelling_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'footer_text', array(
			'selector'        => '.site-info',
			'render_callback' => 'compelling_customize_partial_footer_text'
		) );
	}
	
	$wp_customize->add_section( 'footer_text', array(
		'title'       => __( 'Footer Text', 'compelling' ),
		'description' => __( 'Text entered in this form will appear in place of the default footer text. A limited amount of HTML may be used.', 'compelling' ),
		'priority'    => 35
	) );
  
  $wp_customize->add_setting( 'footer_text', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'compelling_sanitize_footer'
	) );
  
	$wp_customize->add_control( 'footer_text', array(
		'label'    => __( 'Footer Text', 'compelling' ),
		'section'  => 'footer_text',
		'settings' => 'footer_text',
		'type'     => 'text'
	) );
}
add_action( 'customize_register', 'compelling_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function compelling_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function compelling_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function compelling_customize_partial_footer_text() {
	$footer_text = get_theme_mod( 'footer_text' );
	
	if ( $footer_text ) {
		return wp_kses( $footer_text,
			array( 'a' => array( 'href' => array() ),
				'strong' => array(),
				'em'     => array(),
				'span'   => array( 'class' => array() )
			)
		);
	}
}

function compelling_sanitize_footer( $value ) {
	if ( $value ) {
		return wp_kses( $value,
			array( 'a' => array( 'href' => array() ),
				'strong' => array(),
				'em'     => array(),
				'span'   => array( 'class' => array() )
			)
		);
	} else {
		return false;
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function compelling_customize_preview_js() {
	wp_enqueue_script( 'compelling-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'compelling_customize_preview_js' );

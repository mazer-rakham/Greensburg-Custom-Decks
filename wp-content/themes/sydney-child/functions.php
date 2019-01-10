<?php
function my_theme_enqueue_styles() {

    $parent_style = 'sydney'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',        
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


wp_enqueue_script( 'TweenMax', get_stylesheet_directory_uri() . '/js/gsap/TweenMax.min.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'DrawSVG', get_stylesheet_directory_uri() . '/js/gsap/DrawSVGPlugin.min.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'Main-Script', get_stylesheet_directory_uri() . '/js/main-javascript.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'SM-1','//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js' , array ( 'jquery' ), 1.1, true);
wp_enqueue_script( 'SM-2','//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js' , array ( 'jquery' ), 1.1, true);
wp_enqueue_script( '-Plugin', get_stylesheet_directory_uri() . '/js/plugins/animation.gsap.js', array ( 'jquery' ), 1.1, true);

$my_videos = get_bloginfo('stylesheet_directory') . '/videos/';
?>
<?php

if( ! defined( 'CRTLCSS_FILE' ) ) {
	die();
}

function crtlcss_register_style() {
  if (is_rtl()) {
    $url = home_url();
    if ( is_ssl() ) {
      $url = home_url( '/', 'https' );
    }
    wp_register_style( 'crtlcss_style', add_query_arg( array( 'crtlcss' => 1 ), $url ) );
    wp_enqueue_style( 'crtlcss_style' );
  }
}
add_action( 'wp_enqueue_scripts', 'crtlcss_register_style', 99 );

function crtlcss_maybe_print_css() {
	if( ! isset( $_GET['crtlcss'] ) || intval( $_GET['crtlcss'] ) !== 1 ) {
		return;
	}
	ob_start();
	header( 'Content-type: text/css' );
	$options     = get_option( 'crtlcss_settings' );
	$raw_content = isset( $options['crtlcss-content'] ) ? $options['crtlcss-content'] : '';
	$content     = wp_kses( $raw_content, array( '\'', '\"' ) );
	$content     = str_replace( '&gt;', '>', $content );
	echo $content;
	die();
}

add_action( 'plugins_loaded', 'crtlcss_maybe_print_css' );

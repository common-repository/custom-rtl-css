<?php
/**
 * Plugin Name: Custom RTL CSS
 * Plugin URI: https://github.com/ElbruzTechnologies/Custom-RTL-CSS
 * Description: Easily add Custom CSS to your RTL WordPress theme without file modification.
 * Author: Elbruz Technologies
 * Author URI: http://elbruz.co
 * Version: 1.0
 * Text Domain: custom-rtl-css
 *
 * @package SRTLCSS
 * @author Elbruz Technologies
 * @version 1.0
 */

if( ! defined( 'ABSPATH' ) ) {
	die();
}

define( 'CRTLCSS_FILE', __FILE__ );

if( ! is_admin() ) {
	require_once dirname( CRTLCSS_FILE ) . '/includes/public.php';
} elseif( ! defined( 'DOING_AJAX' ) ) {
	require_once dirname( CRTLCSS_FILE ) . '/includes/admin.php';
}


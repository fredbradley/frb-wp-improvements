<?php
/*
Plugin Name: FRB WP Improvements
Plugin URI: https://fred.im/frb-wp-improvements
Description: A plugin which makes some improvements to the WP backend and config for your site.
Author: Fred Bradley
Version: 1.0.1
Author URI: http://fred.im
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

require_once 'vendor/autoload.php';


FredBradley\WPImprovements\SetupPlugin::init();

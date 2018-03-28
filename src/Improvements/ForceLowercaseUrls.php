<?php
/**
 * Created by PhpStorm.
 * User: fredbradley
 * Date: 28/03/2018
 * Time: 10:40
 */

namespace FredBradley\WPImprovements\Improvements;

use FredBradley\WPImprovements\BaseImprovement;
class ForceLowercaseUrls extends BaseImprovement {

	public static $label = "Force Lowercase URIs";
	public static $desc = "Would you like to force all mixed/uppercase case urls to lower case?";

	public static function init() {

		add_action( 'init', [ self::class, 'toLower' ] );
	}


	/**
	 * Changes the requested URL to lowercase and redirects if modified
	 */
	public static function toLower() {

		// Grab requested URL
		$url    = $_SERVER[ 'REQUEST_URI' ];
		$params = $_SERVER[ 'QUERY_STRING' ];
		// If URL contains a period, halt (likely contains a filename and filenames are case specific)
		if ( preg_match( '/[\.]/', $url ) ) {
			return;
		}
		// If URL contains a capital letter
		if ( preg_match( '/[A-Z]/', $url ) ) {
			// Convert URL to lowercase
			$lc_url = empty( $params )
				? strtolower( $url )
				: strtolower( substr( $url, 0, strrpos( $url, '?' ) ) ) . '?' . $params;
			// if url was modified, re-direct
			if ( $lc_url !== $url ) {
				// 301 redirect to new lowercase URL
				header( 'Location: ' . $lc_url, true, 301 );
				exit();
			}
		}
	}
}

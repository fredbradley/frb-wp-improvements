<?php
/**
 * Created by PhpStorm.
 * User: fredbradley
 * Date: 28/03/2018
 * Time: 11:03
 */

namespace FredBradley\WPImprovements;


class Settings {

	private $settings_api;

	function __construct( array $elements ) {

		$this->setting_elements = $elements;

		$this->settings_api = new \WeDevs_Settings_API;

		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	function admin_init() {

		//set the settings
		$this->settings_api->set_sections( $this->get_settings_sections() );
		$this->settings_api->set_fields( $this->get_settings_fields() );

		//initialize settings
		$this->settings_api->admin_init();
	}

	function admin_menu() {

		add_options_page( 'WP Improvements', 'WP Improvements', 'manage_options', 'frb-wp-improvements-settings',
			[ $this, 'plugin_page' ] );
	}

	function get_settings_sections() {

		$sections = [
			[
				'id'    => 'frb-wp-improvements',
				'title' => __( 'WP Improvements', 'cranleigh-2016' )
			],

		];

		return $sections;
	}

	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */
	function get_settings_fields() {

		$settings_fields = [
			"frb-wp-improvements" => $this->setting_elements
		];

		return $settings_fields;
	}


	function plugin_page() {

		echo '<div class="wrap">';

		$this->settings_api->show_navigation();
		$this->settings_api->show_forms();

		echo '</div>';
	}

	/**
	 * Get all the pages
	 *
	 * @return array page names with key value pairs
	 */
	function get_pages() {

		$pages         = get_pages();
		$pages_options = [];
		if ( $pages ) {
			foreach ( $pages as $page ) {
				$pages_options[ $page->ID ] = $page->post_title;
			}
		}

		return $pages_options;
	}

}

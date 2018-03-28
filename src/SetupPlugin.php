<?php
/**
 * Created by PhpStorm.
 * User: fredbradley
 * Date: 28/03/2018
 * Time: 10:38
 */

namespace FredBradley\WPImprovements;


class SetupPlugin {

	public static $elements = [];

	public static function init() {

		self::addImprovementClass( 'ForceLowercaseUrls' );
		self::addImprovementClass( 'FredTest' );
		
		$loadSettings = new Settings( self::$elements );
		foreach ( self::$elements as $element ) {
			self::checkLoad( $element[ 'name' ] );
		}

	}

	public static function addImprovementClass( string $class_name ) {

		if ( self::does_improvement_exist( $class_name ) === false ) {
			return false;
		}

		$input = [
			"name"  => $class_name,
			"label" => self::does_improvement_exist( $class_name )::$label,
			"desc"  => self::does_improvement_exist( $class_name )::$desc
		];

		if ( ! isset( $input[ 'name' ] ) && ! isset( $input[ 'label' ] ) ) {
			return false;
		}

		if ( ! isset( $input[ 'desc' ] ) ) {
			$input[ 'desc' ] = null;
		}

		$output = [
			'name'    => $input[ 'name' ],
			'label'   => __( $input[ 'label' ], 'cranleigh-2016' ),
			'desc'    => __( $input[ 'desc' ], 'cranleigh-2016' ),
			'type'    => 'radio',
			'options' => [
				'yes' => 'Yes',
				'no'  => 'No'
			],
			'default' => 'no'
		];
		array_push( self::$elements, $output );
	}

	public static function does_improvement_exist( string $improvement ) {

		$fq_class = __NAMESPACE__ . "\\Improvements\\" . $improvement;

		if ( class_exists( $fq_class ) ) {
			return $fq_class;
		} else {
			return false;
		}
	}

	public static function checkLoad( $element ) {

		if ( self::does_improvement_exist( $element ) === false ) {
			return false;
		}


		if ( self::getSetting( $element ) === "yes" ) {
			self::does_improvement_exist( $element )::init();
		}


	}

	public static function getSetting( $name, $option = 'frb-wp-improvements' ) {

		$setting = get_option( $option );
		if ( isset( $setting[ $name ] ) ) {
			return $setting[ $name ];
		} else {
			return null;
		}

	}

}

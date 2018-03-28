<?php

namespace FredBradley\WPImprovements;

use Puc_v4_Factory;

class UpdateCheck {
	public $plugin;
	public $user;

	/**
	 * PluginUpdateCheck constructor.
	 *
	 * @param string $plugin_name
	 * @param string $user
	 */
	public function __construct(string $plugin_name, string $user="fredbradley")
	{
		$this->plugin = $plugin_name;
		$this->user = $user;
		$this->update_check($plugin_name, $user);

	}


	/**
	 * @param string $plugin_name
	 * @param string $user
	 */
	private function update_check(string $plugin_name, string $user) {
		$updateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/'.$user.'/'.$plugin_name.'/',
			dirname(dirname(__FILE__)) . '/'.$plugin_name.'.php',
			$plugin_name
		);

		$updateChecker->setBranch('master');
	}
}

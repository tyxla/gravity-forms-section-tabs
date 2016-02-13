<?php
/**
 * Plugin Name: Gravity Forms: Section Tabs
 * Description: Allows the Gravity Forms sections to work as tabs.
 * Version: 1.0
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.4.2
 */

add_action( 'gform_loaded', 'gform_section_tabs_addon_registration', 5 );
function gform_section_tabs_addon_registration() {

	// verify that addon framework inclusion method exists
	if ( ! method_exists( 'GFForms', 'include_feed_addon_framework' ) ) {
		return;
	}

	// include the Gravity Forms addon framework
	GFForms::include_addon_framework();

	require_once( dirname( __FILE__ ) . '/class-gf-section-tabs-addon.php' );

	// initialize the addon
	new GFSectionTabsAddon();
}

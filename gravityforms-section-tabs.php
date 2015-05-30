<?php
/**
 * Plugin Name: Gravity Forms: Section Tabs
 * Description: Allows the Gravity Forms sections to work as tabs.
 * Version: 1.0
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.2
 */

// GFForms is required to continue
if (class_exists("GFForms")) {

	// include the Gravity Forms addon framework
	GFForms::include_addon_framework();

	// main addon class
	class GFSectionTabsAddon extends GFAddOn {

		// addon settings
		protected $_version = "1.0";
		protected $_min_gravityforms_version = "1.7.9999";
		protected $_slug = "gravityforms-section-tabs";
		protected $_path = "gravityforms-section-tabs/gravityforms-section-tabs.php";
		protected $_full_path = __FILE__;
		protected $_url = "http://www.gravityforms.com";
		protected $_title = "Gravity Forms: Section Tabs";
		protected $_short_title = "Section Tabs";

		// our constructor - hooks addon-specific functionality
		public function __construct() {
			parent::__construct();

			add_filter('gform_pre_render', array($this, 'gform_pre_render'), 10, 3);
		}

		// register the fields within the form settings
		public function form_settings_fields($form) {
			return array(
				array(
					"title"  => "Section Tabs",
					"fields" => array(
						array(
							"label"   => "Enable Section Tabs",
							"type"    => "checkbox",
							"name"    => "enable_section_tabs",
							"tooltip" => "If enabled, will turn each section into a tab, containing all fields below it until the next section.",
							"choices" => array(
								array(
									"label" => "Enabled",
									"name"  => "enable_section_tabs"
								)
							)
						)
					)
				)
			);
		}

		// enqueue styles
		public function styles() {
			return array_merge(parent::styles(), array(
				array(
					'handle'  => 'gravity_forms_section_tabs_main',
					'src'     => $this->get_base_url() . '/css/main.css',
					'version' => $this->_version,
					'enqueue' => array(
						array('field_types' => array('section'))
					)
				)
			));
		}

		// enqueue scripts
		public function scripts() {
			return array_merge(parent::scripts(), array(
				array(
					'handle'  => 'gravity_forms_section_tabs_main',
					'src'     => $this->get_base_url() . '/js/main.js',
					'version' => $this->_version,
					'deps' => array('jquery'),
					'in_footer' => true,
					'enqueue' => array(
						array('field_types' => array('section'))
					)
				)
			));
		}

		// add a specific CSS class to forms with section tabs enabled
		public function gform_pre_render($form, $ajax, $field_values) {
			if (!empty($form['gravityforms-section-tabs']['enable_section_tabs'])) {
				$classname = 'gravity_forms_section_tabs_enabled';
				if (empty($form['cssClass'])) {
					$form['cssClass'] = $classname;
				} else {
					$form['cssClass'] = ' ' . $classname;
				}
			}

			return $form;
		}
	}

	// initialize the addon
	new GFSectionTabsAddon();

}

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

if (class_exists("GFForms")) {
    GFForms::include_addon_framework();

    class GFSectionTabsAddon extends GFAddOn {

        protected $_version = "1.0";
        protected $_min_gravityforms_version = "1.7.9999";
        protected $_slug = "gravityforms-section-tabs";
        protected $_path = "gravityforms-section-tabs/gravityforms-section-tabs.php";
        protected $_full_path = __FILE__;
        protected $_url = "http://www.gravityforms.com";
        protected $_title = "Gravity Forms: Section Tabs";
        protected $_short_title = "Section Tabs";

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

    }

    new GFSectionTabsAddon();

}

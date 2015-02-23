<?php
/**
 * Gravity Forms Section Tabs - main class
 *
 * The main plugin class, used to install & setup everything
 */

final class Gravity_Forms_Section_Tabs {
    /**
     * Instance container
	 *
	 * @var object
	 */
	static $instance = null;

    /**
     * Private constructor so nobody else can instance it
     *
     */
    private function __construct() {

    }

	/**
	 * Fetch/create the singleton instance
	 *
	 * @return object $instance
	 */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
    		add_action('admin_menu', array(self::instance(), 'init'), 30);
        }
        return self::$instance;
    }

	/**
	 * Initializing everything
	 *
	 * @return void
	 */
	public function init() {
		// getting the GFST instance
		$gfst = self::instance();

		// if Gravity Forms is not activated, we should remain silent
		if (!class_exists('RGForms')) {
			return;
		}

		// scripts & styles
		add_action('admin_enqueue_scripts', array($gfst, 'enqueue_scripts'));
		add_action('admin_enqueue_scripts', array($gfst, 'enqueue_styles'));
		add_filter('gform_noconflict_scripts', array($gfst, 'register_safe_scripts') );
		add_filter('gform_noconflict_styles', array($gfst, 'register_safe_styles') );
	}

	/**
	 * Enqueue necessary scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		// jquery
		wp_enqueue_script('jquery');

		// init & config
		wp_enqueue_script('gfst_plugin_main_js', GFST_PLUGIN_URL . '/js/main.js', array('jquery'), GFST_PLUGIN_VERSION);
	}

	/**
	 * Enqueue necessary styles
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style('gfst_plugin_main_css', GFST_PLUGIN_URL . '/css/main.css', array(), GFST_PLUGIN_VERSION);
	}

	/**
	 * Registering the scripts with Gravity Forms so that they get enqueued when running on no-conflict mode
	 *
	 * @return $scripts array of registered scripts
	 */
	public function register_safe_scripts( $scripts ){
	    $scripts[] = "gfst_plugin_main_js";
	    return $scripts;
	}

	/**
	 * Registering the styles with Gravity Forms so that they get enqueued when running on no-conflict mode
	 *
	 * @return $styles array of registered styles
	 */
	public function register_safe_styles( $styles ){
	    $styles[] = "gfst_plugin_main_css";
	    return $styles;
	}

}

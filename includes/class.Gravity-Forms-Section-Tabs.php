<?php
/**
 * Gravity Forms Section Tabs - main class
 *
 * The main plugin class, used to install & setup everything
 */

final class Gravity_Forms_Section_Tabs {
	/**
	 * Instance container.
	 *
	 * @static
	 * @access private
	 *
	 * @var Gravity_Forms_Section_Tabs
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 *	
	 * Private so only the get_instance() can instantiate it.
	 *
	 * @access private
	 */
    private function __construct() {

    }

	/**
	 * Retrieve or create the Gravity_Forms_Section_Tabs instance.
	 *
	 * @static
	 * @access public
	 *
	 * @return Gravity_Forms_Section_Tabs $instance
	 */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
    		add_action('admin_menu', array(self::instance(), 'init'), 30);
        }
        return self::$instance;
    }

	/**
	 * Initializing everything.
	 *
	 * @access public
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
	 * Enqueue necessary scripts.
	 *
	 * @access public
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
	 * Enqueue necessary styles.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style('gfst_plugin_main_css', GFST_PLUGIN_URL . '/css/main.css', array(), GFST_PLUGIN_VERSION);
	}

	/**
	 * Registering the scripts with Gravity Forms so that they get enqueued when running on no-conflict mode.
	 *
	 * @access public
	 *
	 * @return $scripts Array of registered scripts
	 */
	public function register_safe_scripts( $scripts ){
	    $scripts[] = "gfst_plugin_main_js";
	    return $scripts;
	}

	/**
	 * Registering the styles with Gravity Forms so that they get enqueued when running on no-conflict mode.
	 *
	 * @access public
	 *
	 * @return $styles Array of registered styles
	 */
	public function register_safe_styles( $styles ){
	    $styles[] = "gfst_plugin_main_css";
	    return $styles;
	}

	/**
	 * Private __clone() to prevent cloning the singleton instance.
	 *
	 * @access private
	 */
	private function __clone() {}

	/**
	 * Private __wakeup() to prevent singleton instance unserialization.
	 *
	 * @access private
	 */
	private function __wakeup() {}

}

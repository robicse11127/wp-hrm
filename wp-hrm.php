<?php
/**
 * @link            https://wp-vue-kickstart.com
 * @since           1.0.0
 * @package         WP_HRM
 *
 * Plugin Name: WP HRM
 * Plugin URI: https://wp-hrm.com
 * Description: A HRM for WordPress.
 * Version: 1.0.0
 * Author: Md. Rabiul Islam Robi
 * Author URI: https://robizstory.me
 * License: GPL v3
 * Text-Domain: wp-hrm
 */

if( ! defined( 'ABSPATH' ) ) exit(); // No direct access allowed

/**
 * Require Autoloader
 */
require_once 'vendor/autoload.php';

use WPHRM\Api\Api;
use WPHRM\Includes\Admin;
use WPHRM\Includes\Frontend;

final class WP_HRM_Loader {

    /**
     * Define Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Construct Function
     */
    public function __construct() {
        $this->plugin_constants();
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Plugin Constants
     * @since 1.0.0
     */
    public function plugin_constants() {
        define( 'WPHRM_VERSION', self::VERSION );
        define( 'WPHRM_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'WPHRM_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
        define( 'WPHRM_NONCE', 'b?le*;K7.T2jk_*(+3&[G[xAc8O~Fv)2T/Zk9N:GKBkn$piN0.N%N~X91VbCn@.4' );
    }

    /**
     * Singletone Instance
     * @since 1.0.0
     */
    public static function init() {
        static $instance = false;

        if( !$instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * On Plugin Activation
     * @since 1.0.0
     */
    public function activate() {
        $is_installed = get_option( 'wphrm_is_installed' );

        if( ! $is_installed ) {
            update_option( 'wphrm_is_installed', time() );
        }

        update_option( 'wphrm_is_installed', WPHRM_VERSION );
    }

    /**
     * On Plugin De-actiavtion
     * @since 1.0.0
     */
    public function deactivate() {
        // On plugin deactivation
    }

    /**
     * Init Plugin
     * @since 1.0.0
     */
    public function init_plugin() {
        // init
        new Admin();
        new Frontend();
        new Api();
    }

}

/**
 * Initialize Main Plugin
 * @since 1.0.0
 */
function wp_hrm_laoder() {
    return WP_HRM_Loader::init();
}

// Run the Plugin
wp_hrm_laoder();
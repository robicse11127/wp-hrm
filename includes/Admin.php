<?php
namespace WPHRM\Includes;

class Admin {

    /**
     * Construct Function
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts_styles' ] );
    }

    public function register_scripts_styles() {
        $this->load_scripts();
        $this->load_styles();
    }

    /**
     * Load Scripts
     *
     * @return void
     */
    public function load_scripts() {
        wp_register_script( 'wphrm-manifest', WPHRM_PLUGIN_URL . 'assets/js/manifest.js', [], rand(), true );
        wp_register_script( 'wphrm-vendor', WPHRM_PLUGIN_URL . 'assets/js/vendor.js', [ 'wphrm-manifest' ], rand(), true );
        wp_register_script( 'wphrm-admin', WPHRM_PLUGIN_URL . 'assets/js/admin.js', [ 'wphrm-vendor' ], rand(), true );

        wp_enqueue_script( 'wphrm-manifest' );
        wp_enqueue_script( 'wphrm-vendor' );
        wp_enqueue_script( 'wphrm-admin' );

        wp_localize_script( 'wphrm-admin', 'wphrmAdminLocalizer', [
            'adminUrl'  => admin_url( '/' ),
            'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
            'apiUrl'    => home_url( '/wp-json' ),
        ] );
    }

    public function load_styles() {
        wp_register_style( 'wphrm-admin', WPHRM_PLUGIN_URL . 'assets/css/admin.css' );

        wp_enqueue_style( 'wphrm-admin' );
    }

    /**
     * Register Menu Page
     * @since 1.0.0
     */
    public function admin_menu() {
        global $submenu;

        $capability = 'manage_options';
        $slug       = 'wp-hrm';

        $hook = add_menu_page(
            __( 'WPHRM', 'wp-hrm' ),
            __( 'WPHRM', 'wp-hrm' ),
            $capability,
            $slug,
            [ $this, 'menu_page_template' ],
            'dashicons-buddicons-replies'
        );

        if( current_user_can( $capability )  ) {
            $submenu[ $slug ][] = [ __( 'Dashboard', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/' ];
            $submenu[ $slug ][] = [ __( 'Departments', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/departments' ];
            $submenu[ $slug ][] = [ __( 'Employees', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/employees' ];
            $submenu[ $slug ][] = [ __( 'Leaves', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/leaves' ];
            $submenu[ $slug ][] = [ __( 'Roles', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/roles' ];
            $submenu[ $slug ][] = [ __( 'Announcement', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/announcement' ];
            $submenu[ $slug ][] = [ __( 'Support', 'wp-hrm' ), $capability, 'admin.php?page=' . $slug . '#/support' ];
        }

        // add_action( 'load-' . $hook, [ $this, 'init_hooks' ] );
    }

    /**
     * Init Hooks for Admin Pages
     * @since 1.0.0
     */
    public function init_hooks() {
        add_action( 'admin_enqueu_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Load Necessary Scripts & Styles
     * @since 1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'wphrm-admin' );
        wp_enqueue_script( 'wphrm-admin' );
    }

    /**
     * Render Admin Page
     * @since 1.0.0
     */
    public function menu_page_template() {
        echo '<div class="wrap"><div id="wphrm-admin-app"></div></div>';
    }

}
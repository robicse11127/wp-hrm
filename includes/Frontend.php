<?php
namespace WPHRM\Includes;

class Frontend {

    public function __construct() {
        add_shortcode( 'wphrm-app', [ $this, 'render_frontend' ] );
    }

    /**
     * Render Frontend
     * @since 1.0.0
     */
    public function render_frontend( $atts, $content = '' ) {
        wp_enqueue_style( 'wphrm-frontend' );
        wp_enqueue_script( 'wphrm-frontend' );

        $content .= '<div id="wphrm-frontend-app"></div>';

        return $content;
    }

}
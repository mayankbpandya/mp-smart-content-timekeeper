<?php
class MP_SCT_Public {

    private static $instance = null;
    private $utilities;

    public static function mp_sct_get_public_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->utilities = MP_SCT_Utilities::mp_sct_get_utilities_instance();
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'the_content', array( $this, 'mp_sct_display_reading_time' ) );
        add_shortcode( 'mp_sct_reading_goal', array( $this, 'mp_sct_reading_goal_shortcode') );
    }
    // Add the missing method
    public function mp_sct_display_reading_time( $mp_sct_content ) {
        if ( ! is_singular() || ! is_main_query() ) {
            return $mp_sct_content;
        }

        $mp_sct_reading_time = $this->utilities->mp_sct_calculate_reading_time( $mp_sct_content );
        
        $mp_sct_reading_time_html = sprintf(
            '<div class="mp-sct-reading-time">%s</div>',
            /* translators: %d is the estimated number of minutes for reading time */
            sprintf( esc_html__( 'Estimated reading time: %d minutes', 'mp-smart-content-timekeeper' ), $mp_sct_reading_time )
        );

        return $mp_sct_reading_time_html . $mp_sct_content;
    }
    public function enqueue_scripts() {
        wp_enqueue_style(
            'mp-sct-public',
            MP_SCT_URL . 'public/css/public.css',
            array(),
            MP_SCT_VERSION
        );

        wp_enqueue_script(
            'mp-sct-public',
            MP_SCT_URL . 'public/js/public.js',
            array( 'jquery' ),
            MP_SCT_VERSION,
            true
        );
        $mp_sct_color = get_option( 'mp_sct_progress_color', '#0073aa' );
        $mp_sct_custom_css = "
        .mp-sct-progress-fill {
            background-color: {$mp_sct_color} !important;
        }
        ";
        $mp_sct_escaped_css = wp_kses($mp_sct_custom_css, array(
            'style' => array(
                'background-color' => true
            ),
        ));
        wp_add_inline_style( 'mp-sct-public', $mp_sct_escaped_css );
    }
}

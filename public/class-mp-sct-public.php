<?php
class MP_SCT_Public {

    private static $instance = null;
    private $utilities;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->utilities = MP_SCT_Utilities::get_instance();
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'the_content', array( $this, 'display_reading_time' ) );
        add_shortcode( 'mp_reading_goal', array( $this, 'reading_goal_shortcode') );
    }
    // Add the missing method
    public function display_reading_time( $content ) {
        if ( ! is_singular() || ! is_main_query() ) {
            return $content;
        }

        $reading_time = $this->utilities->calculate_reading_time( $content );
        
        $reading_time_html = sprintf(
            '<div class="mp-sct-reading-time">%s</div>',
            /* translators: %d is the estimated number of minutes for reading time */
            sprintf( esc_html__( 'Estimated reading time: %d minutes', 'mp-smart-content-timekeeper' ), $reading_time )
        );

        return $reading_time_html . $content;
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
        $color = get_option( 'mp_sct_progress_color', '#0073aa' );
        $custom_css = "
        .mp-sct-progress-fill {
            background-color: {$color} !important;
        }
        ";
        wp_add_inline_style( 'mp-sct-public', $custom_css );
    }
}

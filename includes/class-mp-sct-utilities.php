<?php
class MP_SCT_Utilities {

    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function calculate_reading_time( $content ) {
        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $words_per_minute = get_option( 'mp_sct_words_per_minute', 200 );
        $minutes = floor( $word_count / $words_per_minute );
        return max( 1, $minutes );
    }

    public function display_reading_time( $content ) {
    if ( ! is_singular() || ! is_main_query() ) {
        return $content;
    }

    $reading_time = $this->utilities->calculate_reading_time( $content );
    
    // Only add progress bar once
    static $added = false;
    if ( ! $added ) {
        $progress_bar = '<div class="mp-sct-progress-bar"></div>';
        $added = true;
    } else {
        $progress_bar = '';
    }
    
    $reading_time_html = sprintf(
        '<div class="mp-sct-reading-time">%s</div>',
        /* translators: %d is the estimated number of minutes for reading time */
        sprintf( esc_html__( 'Estimated reading time: %d minutes', 'mp-smart-content-timekeeper' ), $reading_time )
    );

    return $progress_bar . $reading_time_html . $content;
    }
}
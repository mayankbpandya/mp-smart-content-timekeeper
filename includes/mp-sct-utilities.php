<?php
class MP_SCT_Utilities {

    private static $instance = null;

    public static function mp_sct_get_utilities_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function mp_sct_calculate_reading_time( $content ) {
        $mp_sct_word_count = str_word_count( wp_strip_all_tags( $content ) );
        $mp_sct_words_per_minute = get_option( 'mp_sct_words_per_minute', 200 );
        $mp_sct_minutes = floor( $mp_sct_word_count / $mp_sct_words_per_minute );
        return max( 1, $mp_sct_minutes );
    }

    public function mp_sct_display_reading_time( $content ) {
    if ( ! is_singular() || ! is_main_query() ) {
        return $content;
    }

    $mp_sct_reading_time = $this->utilities->mp_sct_calculate_reading_time( $content );
    
    // Only add progress bar once
    static $added = false;
    if ( ! $added ) {
        $mp_sct_progress_bar = '<div class="mp-sct-progress-bar"></div>';
        $added = true;
    } else {
        $mp_sct_progress_bar = '';
    }
    
    $mp_sct_reading_time_html = sprintf(
        '<div class="mp-sct-reading-time">%s</div>',
        /* translators: %d is the estimated number of minutes for reading time */
        sprintf( esc_html__( 'Estimated reading time: %d minutes', 'mp-smart-content-timekeeper' ), $mp_sct_reading_time )
    );

    return $mp_sct_progress_bar . $mp_sct_reading_time_html . $content;
    }
}
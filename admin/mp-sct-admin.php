<?php
class MP_SCT_Admin {

    private static $instance = null;

    public static function mp_sct_get_admin_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'admin_menu', array( $this, 'mp_sct_add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'mp_sct_register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts( $hook ) {
        if ('settings_page_mp-sct-settings' === $hook) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style(
                'mp-sct-admin',
                MP_SCT_URL . 'admin/css/admin.css',
                array(),
                MP_SCT_VERSION
            );
            wp_enqueue_script(
                'mp-sct-admin',
                MP_SCT_URL . 'admin/js/admin.js',
                array( 'wp-color-picker' ),
                MP_SCT_VERSION,
                true
            );
        }
    }

    public function mp_sct_add_settings_page() {
        add_options_page(
            __( 'Content Timekeeper Settings', 'mp-smart-content-timekeeper' ),
            __( 'Content Timekeeper', 'mp-smart-content-timekeeper' ),
            'manage_options',
            'mp-sct-settings',
            array( $this, 'mp_sct_render_settings_page')
        );
    }

    public function mp_sct_register_settings() {
        $mp_sct_words_args = array(
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'default' => 200
			);
        register_setting( 'mp_sct_settings', 'mp_sct_words_per_minute', $mp_sct_words_args );

        $mp_sct_color_args = array(
            'type' => 'string',
            'sanitize_callback' => array($this, 'mp_sct_sanitize_hex_color'),
            'default' => '#0073aa'
        );

        register_setting( 'mp_sct_settings', 'mp_sct_progress_color', $mp_sct_color_args );

        add_settings_section(
            'mp_sct_main_section',
            __( 'Display Settings', 'mp-smart-content-timekeeper' ),
            null,
            'mp-sct-settings'
        );

        add_settings_field(
            'mp_sct_words_per_minute',
            __( 'Words Per Minute', 'mp-smart-content-timekeeper' ),
            array( $this, 'mp_sct_render_words_per_minute_field' ),
            'mp-sct-settings',
            'mp_sct_main_section'
        );

        add_settings_field(
            'mp_sct_progress_color',
            __( 'Progress Bar Color', 'mp-smart-content-timekeeper' ),
            array( $this, 'mp_sct_render_progress_color_field' ),
            'mp-sct-settings',
            'mp_sct_main_section'
        );
    }

    public function mp_sct_sanitize_hex_color( $color ) {
        // Strip any invalid characters
        $color = preg_replace( '/[^a-f0-9#]/i', '', $color );
        
        // Add # if missing
        if ( strpos( $color, '#' ) !== 0 ) {
            $color = '#' . $color;
        }
        
        // Validate hex format
        if ( preg_match( '/^#([a-f0-9]{3}){1,2}$/i', $color ) ) {
            return $color;
        }
        
        return '#0073aa';
    }

    public function mp_sct_render_progress_color_field() {
        $mp_sct_progress_color = get_option( 'mp_sct_progress_color', '#0073aa' );
        ?>
        <div class="mp-sct-color-wrap">
        <input type="text" 
               name="mp_sct_progress_color" 
               value="<?php echo esc_attr( $mp_sct_progress_color ); ?>"
               class="mp-sct-color-picker"
               data-default-color="#0073aa">
        <p class="description">
            <?php esc_html_e( 'Current color:', 'mp-smart-content-timekeeper' ); ?>
            <span style="color:<?php echo esc_attr( $mp_sct_progress_color ); ?>">■</span>
        </p>
    </div>
        <?php
    }
   
// Add missing field rendering methods
public function mp_sct_render_words_per_minute_field() {
    $mp_sct_value = get_option( 'mp_sct_words_per_minute', 200 );
    ?>
    <input type="number" 
           name="mp_sct_words_per_minute" 
           value="<?php echo esc_attr( $mp_sct_value ); ?>"
           min="100"
           max="400">
    <p class="description">
        <?php esc_html_e( 'Average reading speed (words per minute)', 'mp-smart-content-timekeeper' ); ?>
    </p>
    <?php
}

// Update settings page rendering
public function mp_sct_render_settings_page() {
    ?>
    <div class="wrap mp-sct-settings-wrap">
        <h1><?php esc_html_e( 'Content Timekeeper Settings', 'mp-smart-content-timekeeper' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'mp_sct_settings' );
            do_settings_sections( 'mp-sct-settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
    }
}
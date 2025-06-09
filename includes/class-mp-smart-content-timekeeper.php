<?php
class MP_Smart_Content_Timekeeper {

    private static $instance = null;
    
    private function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function load_dependencies() {
        require_once MP_SCT_PATH . 'includes/class-mp-sct-utilities.php';
        require_once MP_SCT_PATH . 'admin/class-mp-sct-admin.php';
        require_once MP_SCT_PATH . 'public/class-mp-sct-public.php';
    }

    private function init_hooks() {
        register_activation_hook( __FILE__ , array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__ , array( $this, 'deactivate' ) );
        
        // Initialize components
        add_action('init', array( $this, 'init_components' ) );
    }

    public function init_components() {
        MP_SCT_Admin::get_instance();
        MP_SCT_Public::get_instance();
    }

    public function activate() {
        // Activation code
    }

    public function deactivate() {
        // Deactivation code
    }
}
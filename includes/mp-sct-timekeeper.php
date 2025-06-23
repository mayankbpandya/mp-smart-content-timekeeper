<?php
class MP_SCT_Timekeeper {

    private static $instance = null;
    
    private function __construct() {
        $this->mp_sct_load_dependencies();
        $this->mp_sct_init_hooks();
    }

    public static function mp_sct_get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function mp_sct_load_dependencies() {
        require_once MP_SCT_PATH . 'includes/mp-sct-utilities.php';
        require_once MP_SCT_PATH . 'admin/mp-sct-admin.php';
        require_once MP_SCT_PATH . 'public/mp-sct-public.php';
    }

    private function mp_sct_init_hooks() {
        register_activation_hook( __FILE__ , array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__ , array( $this, 'deactivate' ) );
        
        // Initialize components
        add_action('init', array( $this, 'mp_sct_init_components' ) );
    }

    public function mp_sct_init_components() {
        MP_SCT_Admin::mp_sct_get_admin_instance();
        MP_SCT_Public::mp_sct_get_public_instance();
    }

    public function activate() {
        // Activation code
    }

    public function deactivate() {
        // Deactivation code
    }
}
<?php
/**
 * Uninstall Plugin
 *
 * @package   MP_Smart_Content_Timekeeper
 * @author    Mayank Pandya
 * @license   GPL-2.0+
 * @copyright 2025 Mayank Pandya
 */

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Delete plugin options
delete_option( 'mp_sct_words_per_minute' );
delete_option( 'mp_sct_progress_color' );

?>
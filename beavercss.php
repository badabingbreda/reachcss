<?php
/**
 * BeaverCSS
 *
 * @package     BeaverCSS
 * @author      Badabingbreda
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: BeaverCSS
 * Plugin URI:  https://www.badabing.nl
 * Description: Generate more modern CSS for the Beaver Builder to work with
 * Version:     1.0.0
 * Author:      Badabingbreda
 * Author URI:  https://www.badabing.nl
 * Text Domain: beavercss
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

use BeaverCSS\Autoloader;
use BeaverCSS\Init;

if ( defined( 'ABSPATH' ) && ! defined( 'BEAVERCSS_VERION' ) ) {
    register_activation_hook( __FILE__, 'BEAVERCSS_check_php_version' );

    /**
     * Display notice for old PHP version.
     */
    function BEAVERCSS_check_php_version() {
        if ( version_compare( phpversion(), '7.4', '<' ) ) {
            die( esc_html__( 'Beaver CSS requires PHP version 7.4+. Please contact your host to upgrade.', 'beavercss' ) );
        }
    }

    define( 'BEAVERCSS_VERSION'   , '1.0.0' );
    define( 'BEAVERCSS_DIR'     , plugin_dir_path( __FILE__ ) );
    define( 'BEAVERCSS_FILE'    , __FILE__ );
    define( 'BEAVERCSS_URL'     , plugins_url( '/', __FILE__ ) );

    define( 'CHECK_BEAVERCSS_PLUGIN_FILE', __FILE__ );

}

if ( ! class_exists( 'BeaverCSS\Init' ) ) {

    /**
     * The file where the Autoloader class is defined.
     */
    require_once BEAVERCSS_DIR . 'inc/Autoloader.php';
    spl_autoload_register( array( new Autoloader(), 'autoload' ) );

    $beavercss = new Init();

}

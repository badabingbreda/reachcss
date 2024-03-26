<?php
/**
 * ReachCSS
 *
 * @package     ReachCSS
 * @author      Badabingbreda
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: ReachCSS
 * Plugin URI:  https://www.badabing.nl
 * Description: Generate more modern CSS for the Beaver Builder to work with
 * Version:     1.0.0
 * Author:      Badabingbreda
 * Author URI:  https://www.badabing.nl
 * Text Domain: reachcss
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

use ReachCSS\Autoloader;
use ReachCSS\Init;

if ( defined( 'ABSPATH' ) && ! defined( 'REACHCSS_VERION' ) ) {
    register_activation_hook( __FILE__, 'REACHCSS_check_php_version' );

    /**
     * Display notice for old PHP version.
     */
    function REACHCSS_check_php_version() {
        if ( version_compare( phpversion(), '7.4', '<' ) ) {
            die( esc_html__( 'Reach CSS requires PHP version 7.4+. Please contact your host to upgrade.', 'reachcss' ) );
        }
    }

    define( 'REACHCSS_VERSION'   , '1.0.0' );
    define( 'REACHCSS_DIR'     , plugin_dir_path( __FILE__ ) );
    define( 'REACHCSS_FILE'    , __FILE__ );
    define( 'REACHCSS_URL'     , plugins_url( '/', __FILE__ ) );

    define( 'CHECK_REACHCSS_PLUGIN_FILE', __FILE__ );

}

if ( ! class_exists( 'ReachCSS\Init' ) ) {

    /**
     * The file where the Autoloader class is defined.
     */
    require_once REACHCSS_DIR . 'inc/Autoloader.php';
    // load composer autoload
    require_once( REACHCSS_DIR . 'vendor/autoload.php' );
    spl_autoload_register( array( new Autoloader(), 'autoload' ) );

    $reachcss = new Init();

}

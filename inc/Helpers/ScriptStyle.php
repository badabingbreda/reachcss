<?php
namespace ReachCSS\Helpers;
use ReachCSS\Helpers\File;

class ScriptStyle {

    public function __construct() {

        add_action( 'wp_enqueue_scripts'    , __CLASS__ . '::reachcss' , 1000 , 1 );
        add_action( 'admin_enqueue_scripts' , __CLASS__ . '::admin_files' , 10 , 1 );

    }
    
    /**
     * beavercss
     * 
     * enqueue the css
     *
     * @return void
     */
    public static function reachcss() {

        $settings = File::dir_settings( 'beavercss' );
        wp_enqueue_style( 'reachcss',  $settings['baseurl'] . '/reachcss/reachcss.css' , false, get_option( 'reachcss_fileversion', false ) , 'all' );
    }
    
    public static function admin_files() {
        wp_enqueue_script( 'savvypanel-handler', BEAVERCSS_URL . 'js/savvy-panel.js', null, BEAVERCSS_VERSION, false );
    }


    

}
<?php
namespace BeaverCSS\Helpers;
use BeaverCSS\Helpers\File;

class ScriptStyle {

    public function __construct() {

        add_action( 'wp_enqueue_scripts'    , __CLASS__ . '::beavercss' , 1000 , 1 );

    }
    
    /**
     * beavercss
     * 
     * enqueue the css
     *
     * @return void
     */
    public static function beavercss() {

        $settings = File::dir_settings( 'beavercss' );
        wp_enqueue_style( 'beavercss',  $settings['baseurl'] . '/beavercss/beavercss.css' , false, get_option( 'beavercss_fileversion', false ) , 'all' );
    }
    

}
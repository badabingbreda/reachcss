<?php
namespace BeaverCSS\Helpers;

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
        wp_enqueue_style( 'beavercss', BEAVERCSS_URL . 'css/beavercss.min.css' , false, BEAVERCSS_VERSION, 'all' );
    }
    

}
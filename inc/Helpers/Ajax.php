<?php
namespace BeaverCSS\Helpers;
use BeaverCSS\Helpers\File;
use BeaverCSS\Helpers\Timer;
use BeaverCSS\BeaverParser;

class Ajax {

    public function __construct() {
        add_action( 'wp_ajax_beavercss_update' , __CLASS__ . '::update' );
    }

    public static function update() {

        $timer = new Timer();
        // get the body
        parse_str( file_get_contents("php://input"), $_PUT );

        // create the directory if not already exists
        File::create_dir( 'beavercss' );
        File::write_file( 'beavercss' ,  'settings.json' , wp_json_encode($_PUT) );

        // make sure to use the altered variables
        add_filter( 'beavercss/variables' , function( $variables ) use ( $_PUT ) { return array_merge( $variables , $_PUT ); } , 100 , 1 );

        BeaverParser::compile();

        $time = $timer->get_time();

        echo wp_json_encode( [ 'data' => 'that worked' , 'post' => $_PUT , 'time' => $time ] );
        wp_die();
    }

}
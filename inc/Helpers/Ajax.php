<?php
namespace ReachCSS\Helpers;
use ReachCSS\Helpers\File;
use ReachCSS\Helpers\Notification;
use ReachCSS\Helpers\Timer;
use ReachCSS\BeaverParser;

class Ajax {

    public function __construct() {
        add_action( 'wp_ajax_savvypanel_update' , __CLASS__ . '::update' );
    }
    
    /**
     * update
     *
     * @return void
     */
    public static function update() {

        $notifications = [];

        if ( !wp_verify_nonce( $_SERVER[ 'HTTP_X_WP_NONCE' ] , 'savvypanel_update_settings' ) ) {
            $notifications[] = (new Notification( [ 'code' => BC_FAILED_NONCE_CHECK ] ))->get();
        } else {
            
            $timer = new Timer();
            // get the body
            parse_str( file_get_contents("php://input"), $_PUT );
            
            // create the directory if not already exists
            File::create_dir( 'reachcss' );
            File::write_file( 'reachcss' ,  'settings.json' , wp_json_encode($_PUT) );
    
            // make sure to use the altered variables
            add_filter( 'reachcss/variables' , function( $variables ) use ( $_PUT ) { return array_merge( $variables , $_PUT ); } , 100 , 1 );
    
            $success = BeaverParser::compile();
            $time = $timer->get_time();
    
            if ($success) {
                $notifications[] = (new Notification( [ 'code' => BC_SUCCESS , 'title' => 'Hurray!' , 'description' => "Took me only {$time} seconds." ] ))->get();
                $notifications[] = (new Notification( [ 'code' => BC_SUCCESS , 'title' => 'One More' , 'description' => "Cool, I can make more than one." ] ))->get();
                $notifications[] = (new Notification( [ 'code' => BC_SUCCESS , 'title' => 'Another' , 'description' => "And another one." ] ))->get();
            } else {
                $notifications[] = (new Notification( [ 'code' => BC_FAILED_COMPILE ] ))->get();
            }
        }

        echo wp_json_encode( [ 'success' => false , 'notifications' => $notifications ] );
        wp_die();
        
    }

}
<?php
namespace BeaverCSS\Dashboard;

abstract class Control implements ControlInterface {

    private static $config;

    private static $defaults;

    public function __construct( $config = [] ) {
        self::set_config( $config );
    }

    public static function parse_settings( $settings , $defaults ) {
        return wp_parse_args( 
            $settings, 
            $defaults);
    }

    public static function set_config( $config ) {
        self::$config = $config;

        // enqeue if the method has been created on the control
        if ( method_exists( get_called_class() , 'enqueue_js' ) ) {
            add_action( 'admin_enqueue_scripts' , array( get_called_class() , 'enqueue_js' ) , 10 , 1);
        }
        
        // enqueue if the method has been created on the control
        if ( method_exists( get_called_class() , 'enqueue_css' ) ) {
            add_action( 'admin_enqueue_scripts' , array( get_called_class() , 'enqueue_css' ) , 10 , 1);
        }
    }
    
    /**
     * outputIf
     *
     * @param  mixed $value
     * @return void
     */
    public static function outputIf( $value ) {
        if ( $value !== null ) return $value;
        return "";
    }

    public static function render( $settings ) {
        return 'Control render output';
    }

    public static function enqueue_js() {

    }

    public static function enqueue_css() {

    }

}
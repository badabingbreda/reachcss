<?php
namespace BeaverCSS\Dashboard;

abstract class Control implements ControlInterface {

    public $defaults = [];

    public $settings = [];

    public function __construct( $settings = [] ){
        $this->init( $settings );
        $this->prepare();
    }
    
    /**
     * init
     * 
     * run all major stuff here
     *
     * @param  mixed $settings
     * @return void
     */
    public function init( $settings ) {
        $this->settings = $this->parse_settings( $settings , $this->defaults );
        // maybe enqueue scripts and styles
        $this->scripts();
    }
    
    /**
     * prepare
     * 
     * potentially do more stuff here, make sure to return $this
     *
     * @return void
     */
    public function prepare() {
        return $this;
    }
    
    /**
     * parse_settings
     * 
     * merge settings with defaults
     *
     * @param  mixed $settings
     * @param  mixed $defaults
     * @return void
     */
    public function parse_settings( $settings , $defaults ) {
        return wp_parse_args( 
            $settings, 
            $defaults);
    }
    
    /**
     * scripts
     * 
     * test for methods and add js/css if they do
     *
     * @return void
     */
    public function scripts() {
        // enqeue if the method has been created on the control
        if ( method_exists( get_called_class() , 'enqueue_js' ) ) {
            add_action( 'admin_enqueue_scripts' , array( $this , 'enqueue_js' ) , 10 , 1);
        }
        
        // enqueue if the method has been created on the control
        if ( method_exists( get_called_class() , 'enqueue_css' ) ) {
            add_action( 'admin_enqueue_scripts' , array( $this , 'enqueue_css' ) , 10 , 1);
        }
    }
    
    /**
     * outputIf
     *
     * @param  mixed $value
     * @return void
     */
    public function outputIf( $value ) {
        if ( $value !== null ) return $value;
        return "";
    }
    
    /**
     * __
     * 
     * return string
     *
     * @return void
     */
    public function __( ) {
        return 'Control render output';
    }
    
    /**
     * _e
     * 
     * echo to browser
     *
     * @return void
     */
    public function _e( ) {
        echo $this->__();
    }

    public function enqueue_js() {  }

    public function enqueue_css() {  }

}
<?php
namespace BeaverCSS\Dashboard;

interface ControlInterface {

    public function __construct( $settings = [] );

    public function outputIf( $value );

    public function enqueue_js();

    public function enqueue_css();

    public function prepare();
    
    /**
     * __
     * 
     * return string with control html
     *
     * @param  mixed $settings
     * @return void
     */
    public function __( );
    
    /**
     * _e
     * 
     * echo control html
     *
     * @param  mixed $settings
     * @return void
     */
    public function _e( );

}
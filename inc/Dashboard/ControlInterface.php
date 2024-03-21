<?php
namespace BeaverCSS\Dashboard;

interface ControlInterface {

    public function __construct( $config = [] );

    public static function outputIf( $value );

    public static function enqueue_js();

    public static function enqueue_css();

    public static function render( $settings );

}
<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlColor extends Control {

    private static $defaults = [
        "name" => "",
        "value" => "green",
        "class" => null,
    ];

    public static function enqueue_css() {
        \wp_enqueue_style( 'coloris', BEAVERCSS_URL . 'css/coloris.min.css', null, BEAVERCSS_VERSION, 'all' );
    }

    public static function enqueue_js() {
        \wp_enqueue_script( 'coloris', BEAVERCSS_URL . 'js/coloris.min.js', null, BEAVERCSS_VERSION, false );
    }


    public static function render( $settings = [] ) {
        $settings = self::parse_settings( $settings , self::$defaults );

        echo <<<EOL
        <input 
        type="text" 
        class="{$settings['class']}"
        id="{$settings['name']}" 
        name="{$settings['name']}" 
        value="{$settings['value']}" 
        data-coloris>
        EOL;
    }

}
<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlSubmit extends Control {

    private static $defaults = [
        "name" => "",
        "type" => "submit",
        "value" => "Update",
        "class" => null,
    ];

    public static function render( $settings ) {
        $settings = self::parse_settings( $settings , self::$defaults );


        echo <<<EOL
        <input type="{$settings['type']}" 
        name="update" 
        class="{$settings['class']}" 
        value="{$settings['value']}" />
        EOL;
    }

}
<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlColor extends Control {

    public $defaults = [
        "name" => "",
        "value" => "green",
        "class" => null,
    ];

    public function enqueue_css() {
        \wp_enqueue_style( 'coloris', BEAVERCSS_URL . 'css/coloris.min.css', null, BEAVERCSS_VERSION, 'all' );
    }

    public function enqueue_js() {
        \wp_enqueue_script( 'coloris', BEAVERCSS_URL . 'js/coloris.min.js', null, BEAVERCSS_VERSION, false );
    }


    public function __( ) {
        $settings = $this->settings;

        return <<<EOL
        <div class="control-field color" data-control-type="color">
        <input 
        type="text" 
        class="{$settings['class']}"
        id="{$settings['name']}" 
        name="{$settings['name']}" 
        value="{$settings['value']}" 
        data-coloris>
        </div>
        EOL;
    }

}
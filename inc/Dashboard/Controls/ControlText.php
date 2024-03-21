<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlText extends Control {

    public $defaults = [
        "name" => "",
        "value" => "",
        "placeholder" => "",
        "class" => null,
];

    public function __(  ) {
        
        $settings = $this->settings;
    
        $class = $this->outputIf( $settings[ 'class' ] );
    
        return <<<EOL
        <div class="control-field text{$class}"
        data-control-type="text">
        <input 
            type="text" 
            id="{$settings['name']}"
            name="{$settings[ "name" ]}" 
            value="{$settings[ "value" ]}" 
        
        >
        </div>
        EOL;
    }
}
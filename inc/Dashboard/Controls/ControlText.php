<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlText extends Control {

    public $type = 'text';

    public $defaults = [
        "id" => "",
        "label" => "",
        "value" => "",
        "placeholder" => "",
        "class" => null,
        "dashboard" => null,
        "tab" => null,
        "section" => null,
        "priority" => 10,
];

    public function __( $output = '' ) {
        
        $settings = $this->settings;
    
        $class = $this->outputIf( $settings[ 'class' ] );
    
        return $output .= $this->controlwrapper(
        <<<EOL
        <div class="control-field text{$class}"
        data-control-type="text">
        <input 
            type="text" 
            id="{$settings['id']}"
            name="{$settings[ "id" ]}" 
            value="{$settings[ "value" ]}" 
        
        >
        </div>
        EOL
        );
    }
}
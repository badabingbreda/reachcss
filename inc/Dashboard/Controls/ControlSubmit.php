<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlSubmit extends Control {

    public $defaults = [
        "name" => "",
        "type" => "submit",
        "value" => "Update",
        "class" => null,
    ];

    public function __(  ) {
        $settings = $this->settings;


        return <<<EOL
        <div>
        <input type="{$settings['type']}" 
        name="update" 
        class="{$settings['class']}" 
        value="{$settings['value']}" />
        </div>
        EOL;
    }

}
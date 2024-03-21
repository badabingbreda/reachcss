<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlSwitch extends Control {

    public $defaults = [
        "name" => "",
        "state" => false,
        "class" => null,
        "target" => null,
        "classtoggle" => null,
        "event" => 'click',
    ];

    public function __(  ) {
        $settings = $this->settings;

        $class = $this->outputIf( $settings[ 'class' ] );
        $state = $settings[ "state" ] ? "checked" : "";

        return <<<EOL
        <div class="control-field switch {$class}"
        data-control-type="switch"
        data-switch-target="{$settings['target']}"
        data-switch-classtoggle="{$settings['classtoggle']}"
        data-switch-event="{$settings['event']}"
        data-switch-laststate="{$settings['state']}">
            <label>
                <input type="checkbox" 
                    id="{$settings[ "name" ]}" 
                    name="{$settings[ "name" ]}" 
                    {$state} />
                <span class="slider round"></span>
            </label>		
        </div>
        EOL;

    }
    
    private static function attribute_target_element( $target ) {
        return " data-target-element=\"{$target}\"";
    }

}
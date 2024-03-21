<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlDropdown extends Control {

    public $defaults = [
        "name" => "",
        "options" => [],
        "selected_value" => "",
        "class" => null,
    ];

    public function __( ) {
        $settings = $this->settings;

        $class = $this->outputIf( $settings[ 'class' ] );
        $state = $settings[ "state" ] ? "checked" : "";

        $options = '';

        foreach ($settings[ "options" ] as $option ): 
            $options .= "<option value=" . $option[ 'value' ] . "\"" .
                selected( $option[ 'value' ] , $settings[ "selected_value" ] ) .">" .
                $option['label'] .
                "</option>";
        endforeach;


        return <<<EOL
        <div class="control-field dropdown{$class}"  data-control-type="dropdown">
            <select name="{$settings[ "name" ]}" id="{$settings[ "name" ]}">
                {$options}
            </select>
        </div>
        EOL;

    }

}
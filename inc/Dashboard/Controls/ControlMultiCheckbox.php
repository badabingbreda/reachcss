<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlMultiCheckbox extends Control {

    public $defaults = [
        "name" => "",
        "options" => "",
        "class" => null,
];

    public function __(  ) {
        $settings = $this->settings;

        $return = '';

        $template = '<div data-control-type="multicheckbox"><input type="checkbox" name="'.$settings['name'].'[]" id="'.$settings['name'].'_%s" value="%s" %s %s><label for="'.$settings['name'].'_%s">%s</label></div>';

        foreach ($settings['options'] as $option) {
            $return .= sprintf($template, 
                        $option['value'], 
                        $option['value'], 
                        \checked( $option['checked'], true, false ),
                        \disabled( $option['disabled'] , true, false ),
                        $option['value'], 
                        $option['name']);
        }

        return $return;
        
    }

}
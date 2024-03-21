<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlSwitch extends Control {

    private static $defaults = [
        "name" => "",
        "state" => false,
        "class" => null,
        "target" => null,
        "classtoggle" => null,
    ];

    public static function render( $settings ) {
        $settings = self::parse_settings( $settings , self::$defaults );

        $class = self::outputIf( $settings[ 'class' ] );
        $state = $settings[ "state" ] ? "checked" : "";

        $target_element = $settings[ 'target' ] ? self::attribute_target_element( $settings[ 'target' ] ) : '';

        echo <<<EOL
        <div class="control-field switch {$class}"
        {$target_element}
        data-field-id="{$settings['name']}">
            <label>
                <input type="checkbox" 
                    id="{$settings[ "name" ]}" 
                    name="{$settings[ "name" ]}" 
                    {$state} />
                <span class="slider round"></span>
            </label>		
        </div>
        EOL;

        if ( $settings[ 'target' ] && $settings[ 'name' ] ) echo self::add_js_listener( $settings );
    }

    private static function attribute_target_element( $target ) {
        return " data-target-element=\"{$target}\"";
    }

    private static function add_js_listener( $settings ) {
        return <<<EOL
            <script>
                document.querySelector( '.control-field[data-field-id={$settings['name']}] input' ).addEventListener( 'click' , 
                function( event ) {
                    document.querySelector( '{$settings['target']}' ).classList.toggle( '{$settings['classtoggle']}' );
                });
            </script>        
        EOL;
    }

}
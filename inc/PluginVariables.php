<?php
namespace BeaverCSS;
use BeaverCSS\Helpers\File;

class PluginVariables {

    public function __construct() {
        // make sure to set these to update before our PluginDashboard loads
        add_action( 'setup_theme' , __CLASS__ . '::set_variables' , 10, 1);
    }

    public static function set_variables( ) {
        add_filter( 'beavercss/variables' , __CLASS__ . '::default_variables' , 10 , 1 );
        add_filter( 'beavercss/variables' , __CLASS__ . '::stored_settings' , 10 , 1 );
    }

    public static function stored_settings( $variables ) {
        if ( $file = File::get_file( 'beavercss' , 'settings.json' ) ) {
            $loaded_settings = json_decode( $file , true );
            return array_merge( $variables, $loaded_settings );
        }
    }

    public static function default_variables( $variables ) {

        return array_merge(
            $variables,
            [
                'success-hex' => '#29A745',
                'action-hex' => 'orange',
                'font-color' => '#ff3300',
                'extra-text' => 'So cool!',
                'type-base-min' => '16px',
                'type-base-max' => '19px',
                'type-scale-min' => 1.2,
                'type-scale-max' => 1.333,
            ]
        );
    }
}

<?php
namespace BeaverCSS;
use BeaverCSS\Helpers\File;

class PluginVariables {

    public static $variables = null;

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
        return $variables;
    }

    public static function default_variables( $variables ) {
        return array_merge(
            $variables,
            [
                'action-hex' => '#1E41D9',
                'primary-hex' => '#E56C70',
                'secondary-hex' => '#6C5879',
                'accent-hex' => '#EAAC8B',
                'base-hex' => '#344F6F',
                'shade-hex' => '#000000',
                'success-hex' => '#29A745',
                'danger-hex' => '#DC3545',
                'warning-hex' => '#FFC10A',
                'info-hex' => '#18A2B8',
                'type-base-min' => 16,                    // px
                'type-base-max' => 19,                    // px
                'type-scale-min' => 1.2,
                'type-scale-max' => 1.333,
                'media-breakpoint-s' => 640,              // px
                'media-breakpoint-m' => 960,              // px
                'media-breakpoint-l' => 1200,             // px
                'media-breakpoint-xl' => 1600,            // px
                'radius-base' => 1,                       // rem
                'radius-scale' => 1.5,                    //
                'max-grids' => 4,                         // max number of grids to support for classes
                'gap-base' => 16,                         // px
                'gap-scale' => 1.5,

            ]
        );
    }

    public static function get( $key , $force = false ) {
        if ( !self::$variables || $force ) self::$variables = apply_filters( 'beavercss/variables' , [] );
        return isset( self::$variables[ $key ] ) ? self::$variables[ $key ] : '';
    }

}

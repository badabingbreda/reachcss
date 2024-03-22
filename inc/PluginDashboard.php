<?php
namespace BeaverCSS;

use BeaverCSS\Dashboard\Dashboard;
use BeaverCSS\Dashboard\Tab;

use BeaverCSS\Dashboard\Controls\ControlSwitch;
use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlText;
use BeaverCSS\Dashboard\Section;

class PluginDashboard {

    public function __construct() {

        add_action( 'init' , __CLASS__ . '::init' , 50 );
    }

    public static function init() {

        $values = apply_filters ( 'beavercss/variables' , [] );

        new Dashboard( [ 
            'id' => 'beavercss',
            'menu_title' => 'Beaver CSS',
            'title' => 'Beaver CSS',
            'heading' => 'Custom CSS creator',
            'type' => 'menu',
        ] ); 

        /**
         * 
         * Viewport
         * 
         */
        new Tab( [
            'id' => 'viewport',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Main',
            'menu_title' => 'Viewport',
            'menu_slug' => 'viewport',
            'priority' => 10,
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'id' => 'media-breakpoint-s',
            'label' => "Breakpoint Small",
            'value' => $values[ 'media-breakpoint-s' ],
        ]);
        
        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'id' => 'media-breakpoint-m',
            'label' => "Breakpoint Medium",
            'value' => $values[ 'media-breakpoint-m' ],
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'id' => 'media-breakpoint-l',
            'label' => "Breakpoint Large",
            'value' => $values[ 'media-breakpoint-l' ],
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'id' => 'media-breakpoint-xl',
            'label' => "Breakpoint XLarge",
            'value' => $values[ 'media-breakpoint-xl' ],
        ]);

        /**
         * 
         * Typography
         * 
         */
        new Tab( [
            'id' => 'typography',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Main',
            'menu_title' => 'Typography',
            'menu_slug' => 'typography',
            'priority' => 10,
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'id' => 'type-base-min',
            'label' => "Type base min",
            'value' => $values[ 'type-base-min' ],
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'id' => 'type-base-max',
            'label' => "Type base max",
            'value' => $values[ 'type-base-max' ],
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'id' => 'type-scale-min',
            'label' => "Mobile Scale",
            'value' => $values[ 'type-scale-min' ],
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'id' => 'type-scale-max',
            'label' => "Desktop Scale",
            'value' => $values[ 'type-scale-max' ],
        ]);

        /**
         * 
         * Colors
         * 
         */

        new Tab( [
            'id' => 'colors',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Colors',
            'menu_slug' => 'colors',
            'priority' => 10,
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'value' => $values[ 'action-hex' ],
            'id' => 'action-hex',
            'label' => "Color Action",
            'priority' => 100
        ]);
        
        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'value' => $values[ 'success-hex' ],
            'id' => 'success-hex',
            'label' => "Color Success",
            'priority' => 20
        ]);

        /**
         * 
         * Radius
         * 
         */

         new Tab( [
            'id' => 'radius',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Radius',
            'menu_slug' => 'radius',
            'priority' => 10,
        ]);

    }



}
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
            'heading' => 'BEAVER CSS HEADING',
        ] ); 
        
        new Tab( [
            'id' => 'main',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Main',
            'menu_title' => 'Main',
            'menu_slug' => 'default',
            'priority' => 10,
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'main',
            'id' => 'type-base-min',
            'label' => "Type base min",
            'value' => $values[ 'type-base-min' ],
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'main',
            'value' => $values[ 'action-hex' ],
            'id' => 'action-hex',
            'label' => "Color Action",
            'priority' => 100
        ]);
        
        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'main',
            'value' => $values[ 'color-success' ],
            'id' => 'color-success',
            'label' => "Color Success",
            'priority' => 20
        ]);


        new Tab( [
            'id' => 'extra',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Extra',
            'menu_slug' => 'extra',
            'priority' => 10,
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'extra',
            'value' => $values[ 'font-color' ],
            'label' => "Font Color",
            'id' => 'font-color',
        ]);

        new ControlText( [
            'dashboard' => 'beavercss',
            'tab' => 'extra',
            'value' => $values[ 'extra-text' ],
            'label' => 'Extra Text',
            'id' => 'extra-text',
        ]);

    }



}
<?php
namespace BeaverCSS;
use BeaverCSS\Helpers\ScriptStyle;
use BeaverCSS\BeaverParser;
use BeaverCSS\Dashboard\Dashboard;

use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlSubmit;
use BeaverCSS\Dashboard\Controls\ControlSwitch;

class Init {

    public function __construct() {
        new Dashboard( [ 
            'page' => 'beavercss',
            'menu_title' => 'Beaver CSS',
            'title' => 'Beaver CSS',
            'heading' => 'BEAVER CSS HEADING',
        ] );
        new BeaverParser();
        new ScriptStyle();

        // load the controls and any js/css needed
        new ControlColor();
        new ControlSubmit();
        new ControlSwitch();
    }
}
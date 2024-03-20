<?php
namespace BeaverCSS;
use BeaverCSS\Helpers\ScriptStyle;
use BeaverCSS\BeaverParser;
use BeaverCSS\Dashboard\Dashboard;

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
    }
}
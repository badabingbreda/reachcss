<?php
namespace BeaverCSS;

use BeaverCSS\Dashboard\Dashboard;
use BeaverCSS\Dashboard\Tab;

class PluginDashboard {

    public function __construct() {

        $beavercss = new Dashboard( [ 
            'page' => 'beavercss',
            'menu_title' => 'Beaver CSS',
            'title' => 'Beaver CSS',
            'heading' => 'BEAVER CSS HEADING',
        ] ); 
        
        $default = new Tab( [
            'page' => 'beavercss',  // page name of dashboard
            'title' => 'Main',
            'menu_title' => 'Main',
            'menu_slug' => 'default',
            'priority' => 10,
        ]);

        $default->add_content( 'cool' )->add_content( 'even cooler' );

    }



}
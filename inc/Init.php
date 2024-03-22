<?php
namespace BeaverCSS;
use BeaverCSS\PluginDashboard;
use BeaverCSS\BeaverParser;
use BeaverCSS\Helpers\ScriptStyle;

use BeaverCSS\Dashboard\Section;
use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlDropdown;
use BeaverCSS\Dashboard\Controls\ControlMultiCheckbox;
use BeaverCSS\Dashboard\Controls\ControlSubmit;
use BeaverCSS\Dashboard\Controls\ControlSwitch;
use BeaverCSS\Dashboard\Controls\ControlText;

class Init {

    public function __construct() {

        new PluginDashboard();
        new BeaverParser();
        new ScriptStyle();

        // load the controls and any js/css needed
        new ControlColor();
        new ControlDropdown();
        new ControlMultiCheckbox();
        new ControlSubmit();
        new ControlSwitch();
        new ControlText();
    }
}
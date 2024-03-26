<?php
namespace ReachCSS;
use ReachCSS\PluginVariables;
use ReachCSS\PluginDashboard;

use ReachCSS\BeaverParser;
use ReachCSS\Helpers\ScriptStyle;
use ReachCSS\Helpers\Ajax;

class Init {

    public function __construct() {

        new PluginVariables();
        new PluginDashboard();
        new BeaverParser();
        new ScriptStyle();
        new Ajax();

    }
}
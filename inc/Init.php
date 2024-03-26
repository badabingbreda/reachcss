<?php
namespace ReachCSS;
use ReachCSS\PluginVariables;
use ReachCSS\PluginDashboard;

use ReachCSS\ReachParser;
use ReachCSS\Helpers\ScriptStyle;
use ReachCSS\Helpers\Ajax;

class Init {

    public function __construct() {

        new PluginVariables();
        new PluginDashboard();
        new ReachParser();
        new ScriptStyle();
        new Ajax();

    }
}
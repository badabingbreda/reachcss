<?php
namespace BeaverCSS;

use BeaverCSS\Dashboard\Dashboard;
use BeaverCSS\PluginVariables;
use BeaverCSS\Dashboard\Tab;

use BeaverCSS\Dashboard\Controls\ControlSwitch;
use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlText;
use BeaverCSS\Dashboard\Controls\ControlHtml;
use BeaverCSS\Dashboard\Controls\ControlSection;
use BeaverCSS\Dashboard\Controls\ControlParagraph;
use BeaverCSS\Dashboard\Controls\ControlSlider;



class PluginDashboard {

    public function __construct() {

        add_action( 'init' , __CLASS__ . '::init' , 10 );
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

        new ControlSection([
            'id' => 'breakpoints',
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'label' => 'Breakpoints',
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-s',
            'label' => "Breakpoint Small",
            'suffix' => "px",
            'value' => PluginVariables::get( 'media-breakpoint-s' ),
        ]);
        
        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-m',
            'label' => "Breakpoint Medium",
            'suffix' => "px",
            'value' => PluginVariables::get('media-breakpoint-m' ),
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-l',
            'label' => "Breakpoint Large",
            'suffix' => "px",
            'value' => PluginVariables::get('media-breakpoint-l' ),
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-xl',
            'label' => "Breakpoint XLarge",
            'suffix' => "px",
            'value' => PluginVariables::get('media-breakpoint-xl' ),
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

        new ControlSection([
            'id' => 'typography',
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'label' => 'Typography',
        ]);

        new ControlParagraph( [
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'section' => 'typography',
            'id' => '',
            'value' => '<p>Fluid based font sizes scale with the screen size. The min and max size are the numbers for a medium viewport that a font renders.</p>'
        ]);


        $type_base_min =  (new ControlText([
            'id' => 'type-base-min',
            'label' => "Type base min",
            'suffix' => "px",
            'value' => PluginVariables::get('type-base-min' ),
        ]))->__();

        $type_base_max =  (new ControlText([
            'id' => 'type-base-max',
            'label' => "Type base max",
            'suffix' => "px",
            'value' => PluginVariables::get('type-base-max' ),
        ]))->__();

        new ControlHtml([
            'id' => 'type-base',
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'section' => 'typography',
            'class' => 'duo-input',
            'label' => 'Type Base',
            'value' => "<div class=\"prefix\">Min Size</div>{$type_base_min}<div class=\"prefix\">Max Size</div>{$type_base_max}",
        ]);

        $type_scale_min =  (new ControlText([
            'id' => 'type-scale-min',
            'label' => "Type base min",
            'value' => PluginVariables::get('type-scale-min' ),
        ]))->__();

        $type_scale_max =  (new ControlText([
            'id' => 'type-scale-max',
            'label' => "Type base max",
            'value' => PluginVariables::get('type-scale-max' ),
        ]))->__();

        new ControlHtml([
            'id' => 'type-scale',
            'dashboard' => 'beavercss',
            'tab' => 'typography',
            'section' => 'typography',
            'label' => 'Type Scale',
            'class' => 'duo-input',
            'value' => "<div class=\"prefix\">Mobile</div>{$type_scale_min}<div class=\"prefix\">Desktop</div>{$type_scale_max}",
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

        new ControlSection([
            'id' => 'brandcolors',
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'label' => 'Brand Colors',
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('action-hex' ),
            'id' => 'action-hex',
            'label' => "Action",
            'priority' => 10
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('primary-hex' ),
            'id' => 'primary-hex',
            'label' => "Primary",
            'priority' => 10
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('secondary-hex' ),
            'id' => 'secondary-hex',
            'label' => "Secondary",
            'priority' => 10
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('accent-hex' ),
            'id' => 'accent-hex',
            'label' => "Accent",
            'priority' => 10
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('base-hex' ),
            'id' => 'base-hex',
            'label' => "Base",
            'priority' => 10
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('shade-hex' ),
            'id' => 'shade-hex',
            'label' => "Shade",
            'priority' => 10
        ]);

        new ControlSection([
            'id' => 'contextualcolors',
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'label' => 'Contextual Colors',
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('success-hex' ),
            'id' => 'success-hex',
            'label' => "Success",
            'priority' => 20
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('danger-hex' ),
            'id' => 'danger-hex',
            'label' => "Danger",
            'priority' => 20
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('warning-hex' ),
            'id' => 'warning-hex',
            'label' => "Warning",
            'priority' => 20
        ]);

        new ControlColor( [ 
            'dashboard' => 'beavercss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('info-hex' ),
            'id' => 'info-hex',
            'label' => "Info",
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

        new ControlSection([
            'id' => 'radius',
            'dashboard' => 'beavercss',
            'tab' => 'radius',
            'label' => 'Radius',
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'radius',
            'section' => 'radius',
            'id' => 'radius-base',
            'label' => "Radius Base",
            'suffix' => "rem",
            'value' => PluginVariables::get('radius-base' ),
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'radius',
            'section' => 'radius',
            'id' => 'radius-scale',
            'label' => "Radius Scale",
            'value' => PluginVariables::get('radius-scale' ),
        ]);


        /**
         * 
         * Grid
         * 
         */

         new Tab( [
            'id' => 'grid',
            'dashboard' => 'beavercss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Grid',
            'menu_slug' => 'grid',
            'priority' => 10,
        ]);

        new ControlSection([
            'id' => 'grid',
            'dashboard' => 'beavercss',
            'tab' => 'grid',
            'label' => 'Grid',
        ]);

        // new ControlText([
        //     'dashboard' => 'beavercss',
        //     'tab' => 'grid',
        //     'section' => 'grid',
        //     'id' => 'max-grids',
        //     'label' => "Max Number of Grid Cols",
        //     'value' => PluginVariables::get('max-grids' ),
        // ]);

        new ControlSlider([
            'dashboard' => 'beavercss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'max-grids',
            'label' => "Max Number of Grid Cols",
            'value' => PluginVariables::get('max-grids' ),
            'options' => [ 1 , 2 , 3 , 4 , 5 ]
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'gap-base',
            'label' => "Gap Base",
            'suffix' => "px",
            'value' => PluginVariables::get('gap-base' ),
        ]);

        new ControlText([
            'dashboard' => 'beavercss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'gap-scale',
            'label' => "Gap Scale",
            'value' => PluginVariables::get('gap-scale' ),
        ]);

    }



}
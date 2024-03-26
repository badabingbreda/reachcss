<?php
namespace ReachCSS;

use ReachCSS\PluginVariables;


class PluginDashboard {

    public function __construct() {

        add_action( 'init' , __CLASS__ . '::init' , 10 );
    }

    public static function init() {

        $values = apply_filters ( 'reachcss/variables' , [] );

        new \SavvyPanel\Dashboard( [ 
            'id' => 'reachcss',
            'menu_title' => 'Reach CSS',
            'title' => 'Reach CSS',
            'heading' => 'Reach CSS',
            'type' => 'menu',
        ] ); 

        /**
         * 
         * Viewport
         * 
         */
        new \SavvyPanel\Tab( [
            'id' => 'viewport',
            'dashboard' => 'reachcss',  // our dashboard id
            //'title' => 'Main',
            'menu_title' => 'Viewport',
            'menu_slug' => 'viewport',
            'priority' => 10,
        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'breakpoints',
            'dashboard' => 'reachcss',
            'tab' => 'viewport',
            'label' => 'Breakpoints',
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-s',
            'label' => "Breakpoint Small",
            'suffix' => "px",
            'value' => PluginVariables::get( 'media-breakpoint-s' ),
        ]);
        
        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-m',
            'label' => "Breakpoint Medium",
            'suffix' => "px",
            'value' => PluginVariables::get('media-breakpoint-m' ),
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'viewport',
            'section' => 'breakpoints',
            'id' => 'media-breakpoint-l',
            'label' => "Breakpoint Large",
            'suffix' => "px",
            'value' => PluginVariables::get('media-breakpoint-l' ),
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
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
        new \SavvyPanel\Tab( [
            'id' => 'typography',
            'dashboard' => 'reachcss',  // our dashboard id
            //'title' => 'Main',
            'menu_title' => 'Typography',
            'menu_slug' => 'typography',
            'priority' => 10,
        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'typography',
            'dashboard' => 'reachcss',
            'tab' => 'typography',
            'label' => 'Typography',
        ]);

        new \SavvyPanel\Controls\ControlParagraph( [
            'dashboard' => 'reachcss',
            'tab' => 'typography',
            'section' => 'typography',
            'id' => '',
            'value' => '<p>Fluid based font sizes scale with the screen size. The min and max size are the numbers for a medium viewport that a font renders.</p>'
        ]);


        $type_base_min =  (new \SavvyPanel\Controls\ControlText([
            'id' => 'type-base-min',
            'label' => "Type base min",
            'suffix' => "px",
            'value' => PluginVariables::get('type-base-min' ),
        ]))->__();

        $type_base_max =  (new \SavvyPanel\Controls\ControlText([
            'id' => 'type-base-max',
            'label' => "Type base max",
            'suffix' => "px",
            'value' => PluginVariables::get('type-base-max' ),
        ]))->__();

        new \SavvyPanel\Controls\ControlHtml([
            'id' => 'type-base',
            'dashboard' => 'reachcss',
            'tab' => 'typography',
            'section' => 'typography',
            'class' => 'duo-input',
            'label' => 'Type Base',
            'value' => "<div class=\"prefix\">Min Size</div>{$type_base_min}<div class=\"prefix\">Max Size</div>{$type_base_max}",
        ]);

        $type_scale_min =  (new \SavvyPanel\Controls\ControlText([
            'id' => 'type-scale-min',
            'label' => "Type base min",
            'value' => PluginVariables::get('type-scale-min' ),
        ]))->__();

        $type_scale_max =  (new \SavvyPanel\Controls\ControlText([
            'id' => 'type-scale-max',
            'label' => "Type base max",
            'value' => PluginVariables::get('type-scale-max' ),
        ]))->__();

        new \SavvyPanel\Controls\ControlHtml([
            'id' => 'type-scale',
            'dashboard' => 'reachcss',
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

        new \SavvyPanel\Tab( [
            'id' => 'colors',
            'dashboard' => 'reachcss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Colors',
            'menu_slug' => 'colors',
            'priority' => 10,
        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'brandcolors',
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'label' => 'Brand Colors',
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('action-hex' ),
            'id' => 'action-hex',
            'label' => "Action",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('primary-hex' ),
            'id' => 'primary-hex',
            'label' => "Primary",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('secondary-hex' ),
            'id' => 'secondary-hex',
            'label' => "Secondary",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('accent-hex' ),
            'id' => 'accent-hex',
            'label' => "Accent",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('base-hex' ),
            'id' => 'base-hex',
            'label' => "Base",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'brandcolors',
            'value' => PluginVariables::get('shade-hex' ),
            'id' => 'shade-hex',
            'label' => "Shade",
            'priority' => 10
        ]);

        new \SavvyPanel\Controls\ControlSwitch([
            'id' => 'add-contextual-colors',
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'label' => 'Add Contextual Colors?',
            'target' => '#contextualcolors',
            'classtoggle' => 'hidden',
            'state' => PluginVariables::get('add-contextual-colors' ),

        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'contextualcolors',
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'label' => 'Contextual Colors',
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('success-hex' ),
            'id' => 'success-hex',
            'label' => "Success",
            'priority' => 20
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('danger-hex' ),
            'id' => 'danger-hex',
            'label' => "Danger",
            'priority' => 20
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
            'tab' => 'colors',
            'section' => 'contextualcolors',
            'value' => PluginVariables::get('warning-hex' ),
            'id' => 'warning-hex',
            'label' => "Warning",
            'priority' => 20
        ]);

        new \SavvyPanel\Controls\ControlColor( [ 
            'dashboard' => 'reachcss',
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

         new \SavvyPanel\Tab( [
            'id' => 'radius',
            'dashboard' => 'reachcss',  // our dashboard id

            //'title' => 'Extra',
            'menu_title' => 'Radius',
            'menu_slug' => 'radius',
            'priority' => 10,
        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'radius',
            'dashboard' => 'reachcss',
            'tab' => 'radius',
            'label' => 'Radius',
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'radius',
            'section' => 'radius',
            'id' => 'radius-base',
            'label' => "Radius Base",
            'suffix' => "rem",
            'value' => PluginVariables::get('radius-base' ),
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
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

         new \SavvyPanel\Tab( [
            'id' => 'grid',
            'dashboard' => 'reachcss',  // our dashboard id
            //'title' => 'Extra',
            'menu_title' => 'Grid',
            'menu_slug' => 'grid',
            'priority' => 10,
        ]);

        new \SavvyPanel\Controls\ControlSection([
            'id' => 'grid',
            'dashboard' => 'reachcss',
            'tab' => 'grid',
            'label' => 'Grid',
        ]);

        // new ControlText([
        //     'dashboard' => 'reachcss',
        //     'tab' => 'grid',
        //     'section' => 'grid',
        //     'id' => 'max-grids',
        //     'label' => "Max Number of Grid Cols",
        //     'value' => PluginVariables::get('max-grids' ),
        // ]);

        new \SavvyPanel\Controls\ControlSlider([
            'dashboard' => 'reachcss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'max-grids',
            'label' => "Max Number of Grid Cols",
            'value' => PluginVariables::get('max-grids' ),
            'options' => [ 3 , 4 , 5 , 6 , 7 , 8 ]
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'gap-base',
            'label' => "Gap Base",
            'suffix' => "px",
            'value' => PluginVariables::get('gap-base' ),
        ]);

        new \SavvyPanel\Controls\ControlText([
            'dashboard' => 'reachcss',
            'tab' => 'grid',
            'section' => 'grid',
            'id' => 'gap-scale',
            'label' => "Gap Scale",
            'value' => PluginVariables::get('gap-scale' ),
        ]);

    }



}
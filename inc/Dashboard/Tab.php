<?php
namespace BeaverCSS\Dashboard;

class Tab implements TabInterface {

    protected $id;

    protected $content;

    protected $settings = [];

    public $defaults = [
        'title' => 'Main title',
        'menu_title' => 'Menu Title',
        'menu_slug' => 'menu-slug',
        'priority' => 10,
    ];
    
    /**
     * __construct
     *
     * @param  mixed $settings
     * @return void
     */
    public function __construct( $settings = [] ) {
        $this->init( $settings );
    }

    public function init( $settings ) {
        $this->settings = $this->parse_settings( $settings , $this->defaults );
        add_filter( 'beavercss/dashboard/' . $this->settings[ 'page' ] . '/tabs' , array( $this , 'get_tab_settings' ) , $this->settings[ 'priority' ] );
    }

    public function remove() {
        remove_filter( 'beavercss/dashboard/' . $this->settings[ 'page' ] . '/tabs' , array( $this , 'get_tab_settings' ) , $this->settings[ 'priority' ] );
        return $this;
    }

        /**
     * parse_settings
     * 
     * merge settings with defaults
     *
     * @param  mixed $settings
     * @param  mixed $defaults
     * @return void
     */
    public function parse_settings( $settings , $defaults ) {
        return wp_parse_args( 
            $settings, 
            $defaults);
    }

    public function get_tab_settings( ) {
        return [
            'title' => $this->title,
            'menu_title' => $this->menu_title,
            'menu_slug' => $this->menu_slug,
            'content' => $this->content
        ];
    }
    
    /**
     * get_id
     * 
     * return the id of a tab
     *
     * @return void
     */
    public function get_id() {
        return $this->id;
    }
    
    public function set_content( $string ) {
        $this->content = $string;
        return $this;
    }

    public function add_content( $string ) {
        $this->content .= $string;
        return $this;
    }
    
    
}
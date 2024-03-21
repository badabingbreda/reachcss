<?php
namespace BeaverCSS\Dashboard;

interface TabInterface {

        
    /**
     * __construct
     * 
     * constructor function, must pass config or use default will be used
     *
     * @param  mixed $config
     * @return void
     */
    public function __construct( $config = [] ); 
    
    /**
     * set_config
     *
     * @param  mixed $config
     * @return void
     */
    public function set_config( $config );
    
    /**
     * get_id
     * 
     * return tab id
     *
     * @return void
     */
    public function get_id();
    
    /**
     * taboutput
     * 
     * return the tab output
     *
     * @return void
     */
    public function taboutput();
}
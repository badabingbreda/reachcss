<?php
namespace BeaverCSS\Dashboard;

abstract class Tab implements TabInterface {

    private $id;

    protected $config = [];
    
    /**
     * __construct
     *
     * @param  mixed $config
     * @return void
     */
    public function __construct( $config = [] ) {
        $this->set_config( $config );
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
    
    /**
     * taboutput
     *
     * @return void
     */
    abstract public function taboutput();
    
}
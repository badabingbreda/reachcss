<?php
namespace BeaverCSS\Dashboard\Controls;

use BeaverCSS\Dashboard\Control;

class ControlSection extends Control {

    public $type = 'section';

    public $defaults = [
        "id" => "",
        "label" => "",
        "class" => null,
        "dashboard" => null,
        "tab" => null,
        "section" => null,
        "priority" => 10,
    ];

    public function controlwrapper( $output ) {

        return $output .=<<<EOL
        <div class="section">
        <h3>{$this->settings[ 'label' ]}</h3>
        {$this->__($output)}
        </div>
        EOL;

    }

    public function __( $output = '' ) {

        // return null if someone is trying to be smart
        if ( $this->settings[ 'section' ] === $this->settings[ 'id' ] ) return '';
        
        return apply_filters( 'beavercss/dashboard/' . $this->settings[ 'dashboard' ] . '/tabs/' . $this->settings[ 'tab' ] . '/' .  $this->settings[ 'id' ]. '/controls' , '' );
    }
}
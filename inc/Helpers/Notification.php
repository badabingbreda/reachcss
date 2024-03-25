<?php
namespace BeaverCSS\Helpers;

const BC_SUCCESS = 200;
const BC_FAILED_NONCE_CHECK = 500;
const BC_FAILED_COMPILE = 504;

class Notification {


    private $defaults = [
        'code' => 200,
        'title' => '',
        'description' => '',
    ];

    private $settings = [];

    private $notification;


    public function __construct( $settings ) {

        $this->settings = $this->parse_settings( $settings , $this->defaults );

        switch ( $this->settings[ 'code' ] ) {
            case BC_SUCCESS:
                $return = [ 
                        'code' => $this->settings[ 'code' ],
                        'success' => true,
                        'title' => $this->settings[ 'title' ],
                        'description' => $this->settings[ 'description' ],
                ];
            break;
            case BC_FAILED_NONCE_CHECK:
                $return = [ 
                        'code' => $this->settings[ 'code' ],
                        'success' => false,
                        'title' => 'Nonce Failed',
                        'description' => 'Failed to verify Nonce',
                ];
            break;
            case BC_FAILED_COMPILE:
                $return = [ 
                        'code' => $this->settings[ 'code' ],
                        'success' => false,
                        'title' => 'Error While Compiling',
                        'description' => 'There was an error while compiling. Please check the settings.',
                ];
            break;
        }
        $this->notification = $return;
    }

    public function get() {
        return $this->notification;
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
    private function parse_settings( $settings , $defaults ) {
        return \wp_parse_args( 
            $settings, 
            $defaults);
    }

}
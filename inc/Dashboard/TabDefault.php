<?php
namespace BeaverCSS\Dashboard;

use BeaverCSS\Dashboard\Tab;    // abstract class

use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlSwitch;
use BeaverCSS\Dashboard\Controls\ControlSubmit;


class TabDefault extends Tab {

    private $admin_dashboard_name;

    public function set_config( $config ) {
        $this->config = $config;
    }

    public function taboutput() {

        $return = <<<EOL
            <div class="jq-tab-content" data-tab="{$this->admin_dashboard_name}">
                <form id="adminoptions-{$this->admin_dashboard_name}" action="<?php echo Dashboard::render_form_action( $admin_dashboard_name ); ?>" method="post">
                    <h3>{$this->config['heading']}</h3>
                    <p class="submit">
            EOL;
        $return .= ControlSubmit::render( [ 'value' => __('Regenerate CSS', 'toolbox') , 'class' => 'button-primary'  ] );
        $return .= wp_nonce_field( $this->admin_dashboard_name, "toolbox-{$this->admin_dashboard_name}-nonce" );
        $return .= <<<EOL
                    </p>
                </form>
            </div>
        EOL;

        return $return;
    }    
}
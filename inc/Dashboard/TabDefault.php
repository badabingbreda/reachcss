<?php
namespace BeaverCSS\Dashboard;
use BeaverCSS\Dashboard\Tab;    // abstract class


class TabDefault extends Tab {

    public function set_config( $config ) {
        $this->config = $config;
    }

    public function taboutput() {
        ?>
        <div class="jq-tab-content" data-tab="<?php echo $admin_dashboard_name; ?>">
            <form id="adminoptions-<?php echo $admin_dashboard_name; ?>" action="<?php echo Dashboard::render_form_action( $admin_dashboard_name ); ?>" method="post">
                <h3><?php _e( 'Main Toolbox settings' , 'toolbox' );?></h3>
                <p class="submit">
                                <?php
                                        AdminControls::submit( [ 'value' => __('Regenerate CSS', 'toolbox') , 'class' => 'button-primary'  ] );
                                ?>
                    <?php wp_nonce_field( $admin_dashboard_name, "toolbox-{$admin_dashboard_name}-nonce" ); ?>
                </p>
            </form>
        </div>
        <?php
    }    
}
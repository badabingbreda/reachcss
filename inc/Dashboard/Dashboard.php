<?php
/**
 *	Dashboard module for settings related stuff
 *
 * 	@package Toolbox
 */

namespace BeaverCSS\Dashboard;

use BeaverCSS\BeaverParser;


/**
 * 	The Dashboard class
 */
class Dashboard {

	/**
	 * errors that can be outputted to the dashboard
	 * @var [type]
	 */
	public $errors = array();

	public $settings = [];

	public $defaults = [
		'id' => '',
		'heading' => 'DASHBOARD TITLE',	// main title in dashboard content
		'title' => 'DASHBOARD TITLE',	// in the sidebar menu
		'menu_title' => 'DASHBOARD MENU TITLE',	// in the sidebar menu
		'capability' => 'delete_users',
		'type' => 'submenu',
		'icon_url' => null,
		'position' => null,
	];


	/**
	 * initialize the dashboard
	 *
	 * @return [type] [description]
	 */
	public function __construct( $settings = [] ) {
		$this->settings = $this->parse_settings( $settings , $this->defaults );
		add_action( 'init', array( $this , 'init_hooks' ), 100 );
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


	/**
	 * Init the correct hooks
	 * @return [type] [description]
	 */
	public function init_hooks() {

		// return early if not executed by admin
		if ( ! is_admin() ) return;

		// add the settings menu
		add_action( 'admin_menu', array( $this , 'add_dashboard_menu' ) );

		// check for save action
		if ( isset( $_REQUEST['page'] ) && $this->settings['id'] == $_REQUEST['page'] ) {
			add_action( 'admin_enqueue_scripts', array( $this , 'dashboard_styles_scripts' ) );
			$this->save();
		}
	}

	/**
	 * Load the styles and scripts for the dashboard
	 * @return [type] [description]
	 */
	public function dashboard_styles_scripts() {

		// load the jquery-tabs css and js
		wp_enqueue_style( 'jquery-tabs'	, BEAVERCSS_URL . 'css/jquery.tabs.min.css'	, array(), BEAVERCSS_VERSION );
		wp_enqueue_script( 'jquery-tabs', BEAVERCSS_URL . 'js/jquery.tabs.min.js'		, array(), BEAVERCSS_VERSION );

		wp_enqueue_style( 'notifications'	, BEAVERCSS_URL . 'css/notifications.css'	, array(), BEAVERCSS_VERSION );
		wp_enqueue_script( 'notifications', BEAVERCSS_URL . 'js/notifications.js'		, array(), BEAVERCSS_VERSION , true );

		// toolbox-dashboard css and js
		wp_enqueue_style( 'toolbox-dashboard'	, BEAVERCSS_URL . 'css/toolbox-dashboard.css'	, array(), BEAVERCSS_VERSION );
		wp_enqueue_script( 'toolbox-dashboard'	, BEAVERCSS_URL . 'js/toolbox-dashboard.js'	, array(), BEAVERCSS_VERSION );

	}


	/**
	 * Show an admin notice on the update
	 * @return [type] [description]
	 */
	public function toolbox_settings_update_notice() {

		if ( 1 == $_REQUEST['status'] ) $class = 'notice notice-success';
		if ( 0 == $_REQUEST['status'] ) $class = 'notice notice-error';
		printf( '<div class="%s is-dismissible"><p>%s</p></div>', esc_attr($class), esc_html($_REQUEST['message']) );
	}

	/**
	 * Add the dashboard menu links and structure
	 */
	public function add_dashboard_menu() {

		// check minimum capability of delete_users
		if( !current_user_can('delete_users') ) return;

		// define as parameters first for better readability

		$parent_slug 	= 'options-general.php';	// settings page

		$page_title 	= $this->settings['title'];
		$menu_title		= $this->settings['menu_title'];
		$capability		= $this->settings['capability'];
		$menu_slug		= $this->settings['id'];
		$callback 		= array( $this , 'render_options' );

		if ( $this->settings[ 'type' ] === 'submenu' ) {
			add_submenu_page( 
				$parent_slug, 
				$page_title, 
				$menu_title, 
				$capability, 
				$menu_slug, 
				$callback 
			);
		} elseif ( $this->settings[ 'type' ] === 'menu' ) {
			add_menu_page( 
				$page_title,
				$menu_title,
				$capability,
				$menu_slug,
				$callback,
				$this->settings[ 'icon_url' ],
				$this->settings[ 'position' ]
			);

		}



	}

	/**
	 * render the options-template to the browser
	 * @return [type] [description]
	 */
	public function render_options() {

		$tabs = apply_filters( 'beavercss/dashboard/' . $this->settings[ 'id' ] . '/tabs', [] );
		?>
		<div class="adminoptions-options">
			<div class="adminoptions-heading">
			<?php $this->render_heading(); ?>
			</div>
			<div class="adminoptions-messages">
				<?php $this->render_update_message(); ?>
			</div>
			<div class="jq-tab-wrapper" id="adminoptions-tab">
				<div class="jq-tab-menu">
					<?php echo $this->render_settings_tabs(); ?>
					<?php echo $this->render_submit_button(); ?>
				</div>
				<div class="jq-tab-content-wrapper">
					<?php echo $this->render_forms() ?>
				</div>
			</div>
		</div>
		<div class="notifications"></div>
		<?php		
	}

	/**
	 * Render the settings tabs
	 * @return [type] [description]
	 */
	public function render_settings_tabs() {

		$tabtemplate = '<div class="jq-tab-title" data-tab="%s">%s</div>';
		$tabtemplate_active = '<div class="jq-tab-title" data-tab="%s">%s</div>';

		$return = '';

		// get the tabs by running the filter
		$tabs = apply_filters( 'beavercss/dashboard/' . $this->settings[ 'id' ] . '/tabs', [] );

		foreach ( $tabs as $tab) {
			$return .= sprintf( $tabtemplate , $tab['menu_slug'], $tab['menu_title'] );
		}

		return $return;
	}

	public function render_submit_button() {
		return "<button class=\"dashboard-save-changes\">Save Changes</button>";
	}

	/**
	 * get the form(s)
	 * @return [type] [description]
	 */
	public function render_forms() {

		// get the tabs by running the filter
		$tabs = apply_filters( 'beavercss/dashboard/' . $this->settings[ 'id' ] . '/tabs', [] );

		$return = '';
		foreach ( $tabs as $tab) {
			$return .= $tab[ 'content' ];
		}
		return $return;
	}

	/**
	 * Render a singular form
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function render_form( $type ) {

		include BEAVERCSS_DIR . 'dashboard/admin-options-' . $type . '.php';
	}

	/**
	 * Render the heading to the browser
	 * @return [type] [description]
	 */
	public function render_heading() {

		echo '<h1>' . esc_attr( $this->settings['heading'] ) . '</h1>';
	}

	/**
	 * Render the action for a form
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	public function render_form_action( $type = '' ) {

		if ( is_network_admin() ) {
			echo network_admin_url( '/settings.php?page=' . $this->settings['id'] . '#' . $type );
		} else {
			echo admin_url( '/options-general.php?page=' . $this->settings['id'] . '#' . $type );
		}
	}

	/**
	 * Render the action for a form
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	public function get_form_action( $type = '' ) {

		if ( is_network_admin() ) {
			return network_admin_url( '/settings.php?page=' . $this->settings['id'] . '#' . $type );
		} else {
			return admin_url( '/options-general.php?page=' . $this->settings['id'] . '#' . $type );
		}
	}

	/**
	 * Render the errors or update message
	 * @return [type] [description]
	 */
	public function render_update_message() {

		if ( !empty( $this->errors ) ) {

			// display the errors
			foreach ( $this->errors as $message ) {
				echo '<div class="error"><p>'.$message.'</p></div>';
			}

		} elseif (! empty( $_POST ) && ! isset( $_POST['email'] ) ){

			echo '<div class="updated"><p>' . __( 'Settings Updated!' , 'toolbox' ) . '<p></div>';

		}
	}

	/**
	 * Add an error to the array
	 * @param [type] $message [description]
	 */
	public function add_error( $message ) {

		$this->errors[] = $message;
	}

	/**
	 * Saves the admin settings.
	 * @return [type] [description]
	 */
	public function save() {

		// Only admins can save settings.
		if ( ! current_user_can( 'delete_users' ) ) {
			return;
		}

		$this->save_toolbox_defaults();

		do_action( 'toolbox_dashboard_on_panel_save' );

	}

	/**
	 * return key => value pairs for wp_parse_args so that no array_key exists
	 *
	 * @param  [type] $keys    [description]
	 * @param  string $default [description]
	 * @return [type]          [description]
	 */
	public function key_defaults( $keys , $default = "" ) {
		$key_pairs = [];
		foreach ($keys as $key ) {

			$key_pairs[ $key ] = $default ;

		}

		return $key_pairs;
	}

	private function save_toolbox_defaults() {

		$admin_dashboard_name = 'default';

		// check our form nonce
		if ( isset( $_POST[ "toolbox-{$admin_dashboard_name}-nonce" ] ) && wp_verify_nonce( $_POST[ "toolbox-{$admin_dashboard_name}-nonce" ], $admin_dashboard_name ) ) {

			BeaverParser::compile();

		}

	}

	/**
	 * check_admin_nonce
	 *
	 * @param  mixed $noncename
	 * @param  mixed $value
	 * @return void
	 */
	private function check_admin_nonce( $noncename , $value ) {
		return ( !isset( $_POST[ $noncename ] ) || !wp_verify_nonce( $_POST[ $noncename ] , $value ) );

	}
	
	/**
	 * update_or_delete_option
	 * 
	 * Test for post variable
	 *
	 * @param  mixed $settings
	 * @return void
	 */
	private function update_or_delete_option( $settings ) {

		$settings = \wp_parse_args( $settings, [
			'option_name' => null,
			'post_var' => null,
		] );

		if ( !$settings[ 'option_name' ] || !$settings[ 'post_var' ] ) return;

		$post_val = filter_input( INPUT_POST , $settings[ 'post_var' ] );


		if ( $post_val && $post_val !== '' ) {
			\update_option( $settings[ 'option_name' ] , $post_val );
		} else {
			\delete_option( $settings[ 'option_name' ] );
		}
		
	}	


}
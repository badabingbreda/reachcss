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
	public static $errors = array();

	private static $dashboard_page = '';
	private static $dashboard_heading = 'DASHBOARD TITLE';				// main title in dashboard content
	private static $dashboard_title = 'DASHBOARD TITLE';				// in the sidebar menu
	private static $dashboard_menu_title = 'DASHBOARD MENU TITLE';		// in the sidebar menu
	private static $dashboard_capbility = 'delete_users';


	/**
	 * initialize the dashboard
	 *
	 * @return [type] [description]
	 */
	public function __construct( $settings = null ) {

		if ( !is_array( $settings ) ) return;

		self::$dashboard_page = $settings[ 'page' ]; 

		if ( isset( $settings[ 'title' ] )) self::$dashboard_title = $settings[ 'title' ]; 
		if ( isset( $settings[ 'menu_title' ] )) self::$dashboard_menu_title = $settings[ 'menu_title' ]; 
		if ( isset( $settings[ 'heading' ] )) self::$dashboard_heading = $settings[ 'heading' ]; 

		add_action( 'after_setup_theme', __CLASS__ . '::init_hooks', 11 );

		add_filter( 'dashboard_settings_tabs', __CLASS__ . '::add_settings_default' , 10 , 1 );
	}

	/**
	 * Init the correct hooks
	 * @return [type] [description]
	 */
	public static function init_hooks() {

		// return early if not executed by admin
		if ( ! is_admin() ) return;

		// add the settings menu
		add_action( 'admin_menu', __CLASS__ . '::add_dashboard_menu' );

		// check for save action
		if ( isset( $_REQUEST['page'] ) && self::$dashboard_page == $_REQUEST['page'] ) {
			add_action( 'admin_enqueue_scripts', __CLASS__ . '::dashboard_styles_scripts' );
			self::save();
		}
	}

	/**
	 * Load the styles and scripts for the dashboard
	 * @return [type] [description]
	 */
	public static function dashboard_styles_scripts() {

		// load the jquery-tabs css and js
		wp_enqueue_style( 'jquery-tabs'	, BEAVERCSS_URL . 'css/jquery.tabs.min.css'	, array(), BEAVERCSS_VERSION );
		wp_enqueue_script( 'jquery-tabs', BEAVERCSS_URL . 'js/jquery.tabs.min.js'		, array(), BEAVERCSS_VERSION );

		// toolbox-dashboard css and js
		wp_enqueue_style( 'toolbox-dashboard'	, BEAVERCSS_URL . 'css/toolbox-dashboard.css'	, array(), BEAVERCSS_VERSION );
		wp_enqueue_script( 'toolbox-dashboard'	, BEAVERCSS_URL . 'js/toolbox-dashboard.js'	, array(), BEAVERCSS_VERSION );

	}


	/**
	 * Show an admin notice on the update
	 * @return [type] [description]
	 */
	public static function toolbox_settings_update_notice() {

		if ( 1 == $_REQUEST['status'] ) $class = 'notice notice-success';
		if ( 0 == $_REQUEST['status'] ) $class = 'notice notice-error';
		printf( '<div class="%s is-dismissible"><p>%s</p></div>', esc_attr($class), esc_html($_REQUEST['message']) );
	}

	/**
	 * Add the dashboard menu links and structure
	 */
	public static function add_dashboard_menu() {

		// check minimum capability of delete_users
		if( !current_user_can('delete_users') ) return;

		// define as parameters first for better readability

		$parent_slug 	= 'options-general.php';	// settings page

		$page_title 	= self::$dashboard_title;
		$menu_title		= self::$dashboard_menu_title;
		$capability		= self::$dashboard_capbility;
		$menu_slug		= self::$dashboard_page;
		$callback 		= __CLASS__ . '::render_options';

		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback );

	}

	/**
	 * render the options-template to the browser
	 * @return [type] [description]
	 */
	public static function render_options() {

		include_once( BEAVERCSS_DIR . 'dashboard/admin-options.php' );
	}

	/**
	 * Render the settings tabs
	 * @return [type] [description]
	 */
	public static function render_settings_tabs() {

		$tabtemplate = '<div class="jq-tab-title" data-tab="%s">%s</div>';
		$tabtemplate_active = '<div class="jq-tab-title" data-tab="%s">%s</div>';

		echo '<div class="jq-tab-menu">';

		// printf( $tabtemplate, 'default', esc_attr__( 'Main' , 'toolbox') );
		// printf( $tabtemplate, 'timber-templates', esc_attr__( 'Timber Templates' , 'toolbox') );
		// printf( $tabtemplate, 'beaverbuilder', esc_attr__( 'Beaver Builder / Beaver Theme' , 'toolbox') );
		// printf( $tabtemplate, 'uikit', esc_attr__( 'UIkit' , 'toolbox') );
		// printf( $tabtemplate, 'cond-filters', esc_attr__( 'Conditional Filters' , 'toolbox') );
		// printf( $tabtemplate, 'license', esc_attr__( 'License' , 'toolbox') );
		// printf( $tabtemplate, 'tools', esc_attr__( 'Tools' , 'toolbox') );

		$tabs = apply_filters( 'dashboard_settings_tabs', [] );

		foreach ( $tabs as $tab) {
			printf( $tabtemplate , $tab['slug'], $tab['name'] );
		}

		echo '</div>';
	}


	public static function add_settings_default( $tabs ) {
		return array_merge( $tabs , array( array( 'slug' => 'default' , 'name' => esc_attr__( 'Main', 'toolbox' ) ) ) );
	}

	/**
	 * get the form(s)
	 * @return [type] [description]
	 */
	public static function render_forms() {


		$tabs = apply_filters( 'dashboard_settings_tabs', [] );
		foreach ( $tabs as $tab) {
			self::render_form( $tab['slug'] );
		}

	}

	/**
	 * Render a singular form
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public static function render_form( $type ) {

		include BEAVERCSS_DIR . 'dashboard/admin-options-' . $type . '.php';
	}

	/**
	 * Render the heading to the browser
	 * @return [type] [description]
	 */
	public static function render_heading() {

		echo '<h1>' . esc_attr( self::$dashboard_heading ) . '</h1>';
	}

	/**
	 * Render the action for a form
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	static public function render_form_action( $type = '' ) {

		if ( is_network_admin() ) {
			echo network_admin_url( '/settings.php?page=' . self::$dashboard_page . '#' . $type );
		} else {
			echo admin_url( '/options-general.php?page=' . self::$dashboard_page . '#' . $type );
		}
	}

	/**
	 * Render the action for a form
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	static public function get_form_action( $type = '' ) {

		if ( is_network_admin() ) {
			return network_admin_url( '/settings.php?page=' . self::$dashboard_page . '#' . $type );
		} else {
			return admin_url( '/options-general.php?page=' . self::$dashboard_page . '#' . $type );
		}
	}

	/**
	 * Render the errors or update message
	 * @return [type] [description]
	 */
	public static function render_update_message() {

		if ( !empty( self::$errors ) ) {

			// display the errors
			foreach ( self::$errors as $message ) {
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
	public static function add_error( $message ) {

		self::$errors[] = $message;
	}

	/**
	 * Saves the admin settings.
	 * @return [type] [description]
	 */
	static public function save() {

		// Only admins can save settings.
		if ( ! current_user_can( 'delete_users' ) ) {
			return;
		}

		self::save_toolbox_defaults();

		do_action( 'toolbox_dashboard_on_panel_save' );

	}

	/**
	 * Helper functions for common input types for the dashboard
	 * @param  [type] $type  [description]
	 * @param  [type] $id    [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public static function input( $type , $options = [] ) {

		$type 	= esc_html( $type );
		$options = array_map( 'esc_attr' , $options );

		switch ($type):
			case "text":

				$options = wp_parse_args( $options ,
											self::key_defaults( [ 'value' , 'id' ] )
				);

				return "<input type=\"{$type}\" id=\"{$options['id']}\" name=\"{$options['id']}\" value=\"{$options['value']}\">";

			break;

			case "checkbox":

				$options = wp_parse_args( $options ,
											self::key_defaults( [ 'value' , 'id' , 'checked' ] )
				);

				return "<input type=\"${type}\" value=\"{$options['value']}\" name=\"{$options['id']}\" id=\"{$options['id']}\" {$options['checked']}>";

			break;

			case "submit":

				$options = wp_parse_args( $options ,
											self::key_defaults( [ 'value' ] )
				);

				return "<input type=\"${type}\" name=\"update\" class=\"button-primary\" value=\"{$options['value']}\" />
";
			break;

		endswitch;

		return void;
	}

	/**
	 * return key => value pairs for wp_parse_args so that no array_key exists
	 *
	 * @param  [type] $keys    [description]
	 * @param  string $default [description]
	 * @return [type]          [description]
	 */
	public static function key_defaults( $keys , $default = "" ) {
		$key_pairs = [];
		foreach ($keys as $key ) {

			$key_pairs[ $key ] = $default ;

		}

		return $key_pairs;
	}

	private static function save_toolbox_defaults() {

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
	private static function check_admin_nonce( $noncename , $value ) {
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
	private static function update_or_delete_option( $settings ) {

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
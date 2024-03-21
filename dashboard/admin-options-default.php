<?php
/**
 * Dashboard Admin Options - Default
 *
 * @package {{plugin.name}}
 * @since 1.0.0
 * @author {{plugin.author}}
 * @link {{plugin.authoruri}}
 * @license {{plugin.license}}
 */

namespace BeaverCSS\Dashboard;
use BeaverCSS\Dashboard\Section;
use BeaverCSS\Dashboard\Controls\ControlColor;
use BeaverCSS\Dashboard\Controls\ControlText;
use BeaverCSS\Dashboard\Controls\ControlSwitch;
use BeaverCSS\Dashboard\Controls\ControlSubmit;

// use variable so we can't forget the replace the name somewhere important
$admin_dashboard_name = 'default';

// prepare the type section for output
$typo_section = (new Section([ 'content' => 'whoop' , 'id' => 'typography' ] ))->prepare();

?>
<div class="jq-tab-content" data-tab="<?php echo $admin_dashboard_name; ?>">
	<form id="adminoptions-<?php echo $admin_dashboard_name; ?>" action="<?php echo Dashboard::render_form_action( $admin_dashboard_name ); ?>" method="post">
		<h3><?php _e( 'Main Toolbox settings' , 'toolbox' );?></h3>
		<p><?php (new ControlSwitch( [ 'value' => 'blue' , 'target' => '#typography' , 'classtoggle' => 'hidden' , 'name' => 'toggle-nice' ] ))->_e(); ?></p>
		<?php $typo_section->start( true ); ?>
		<p><?php (new ControlColor( [ 'value' => 'blue' , 'name' => 'col-action' ] ))->_e( ); ?></p>
		<p><?php (new ControlText( [ 'value' => 'blue' , 'name' => 'random-text' ] ))->_e( ); ?></p>
		<?php $typo_section->end( true ); ?>

		<p class="submit">
						<?php
								(new ControlSubmit([ 'value' => __('Regenerate CSS', 'toolbox') , 'class' => 'button-primary'  ]))->_e(  );
						?>

			<?php wp_nonce_field( $admin_dashboard_name, "toolbox-{$admin_dashboard_name}-nonce" ); ?>
		</p>
	</form>
</div>

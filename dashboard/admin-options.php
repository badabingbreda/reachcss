<?php
/**
 * Dashboard Admin Options
 *
 * @package {{plugin.name}}
 * @since 1.0.0
 * @author {{plugin.author}}
 * @link {{plugin.authoruri}}
 * @license {{plugin.license}}
 */

namespace BeaverCSS\Dashboard;
?>
<div class="adminoptions-options">
	<div class="adminoptions-heading">
	<?php Dashboard::render_heading(); ?>
	</div>
	<div class="adminoptions-messages">
		<?php Dashboard::render_update_message(); ?>
	</div>
	<div class="jq-tab-wrapper" id="adminoptions-tab">
		<div class="jq-tab-menu">
			<?php Dashboard::render_settings_tabs(); ?>
		</div>
		<div class="jq-tab-content-wrapper">
			<?php Dashboard::render_forms() ?>
		</div>
	</div>
</div>


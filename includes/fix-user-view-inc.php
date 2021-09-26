<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
//fix-meu-cadastro-view-inc.php


add_shortcode("fix_user_view", "fix_user_view");
function fix_user_view($param, $content = null){

	if( !is_user_logged_in() ) return;
	$user_id = get_current_user_id();
	$userdata = get_userdata( $user_id );
	$user_meta = get_user_meta( $user_id);	

	ob_start();
	?>
	
	<style type="text/css">
		#fix_meu_cadastro_view{
			background-color: white;
			padding: 10px;
		}
		#fix_meu_cadastro_view th {
			text-align: right;
		}
	</style>

	<div style="background-color:white ;padding: 10px;">
		<div id="fix_meu_cadastro_view">
			<table>
				<tr>
					<th>First name</th>
					<td><?php echo $userdata->first_name ?></td>
				</tr>
				<tr>
					<th>Last name</th>
					<td><?php echo $userdata->last_name ?></td>
				</tr>
			</table>
		</div>
		<div style="height: 30px;"></div>
		<div style="text-align: center;">
			<a id="1629325638_btn_edit" href="/user-edit/">Edit user</a> - 
			<a href="<?php echo site_url() ?>/user-update-password/">Update access password</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

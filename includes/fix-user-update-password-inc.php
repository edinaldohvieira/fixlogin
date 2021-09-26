<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("user_update_password", "user_update_password");
function user_update_password($atts, $content = null){

	if(current_user_can('administrator')) {
		echo "
		<div>Administrators cannot change the access password here.</div>
		";
		return;

	}
	if( !is_user_logged_in() ) {
		echo "
		<div>The option to change password is only available when the user is logged in.</div>
		";
		return;

	}
	?>

		<style type="text/css">
			#fix_1628253480rs {
				display: block;
				position: relative;
				max-width: 300px;
				margin-left: auto;
				margin-right: auto;

			}
			#fix_1628253480rs input {
		    	width: 100%;
		    	/*border: 1px solid #gray;*/
		    	border-radius: 3px;
		    	padding: .5rem 1rem;
		    	-webkit-transition: all .3s;
		    	-o-transition: all .3s;
		    	transition: all .3s;
		    	/*color: var(--paletteColor4);*/
		    	/*border: 1px solid var(--paletteColor1);*/
		    	text-align: center;

			}
			#fix_1628253480rs .dv_label {
				text-align: center;	
			}
			#fix_1628253480rs .fix_group_field {
				margin-bottom: 10px;
			}
			#fix_1628253480rs button {
				min-width: 100%;
				margin-top: 20px;
				display: block;
				padding: 20px;
				/*color: var(--paletteColor8);*/
				/*background-color: var(--paletteColor2);*/
				text-align: center;

			}

			.fix_1628253480rs .fix-msg-cab h2 {
				/*color: var( --e-global-color-primary );*/
				text-align: center;
				margin-bottom: 10px;
			}
			.fix_1628253480rs .fix-msg-cab p {
				/*color: var( --e-global-color-primary );*/
				text-align: center;	
				margin-bottom: 10px;
			}
			#fix_1628253480rs .error {
				color: red;
			}
			.fix_1628253480_retorno {
				text-align: center;
			}
		</style>


		<script type="text/javascript">
			jQuery(function($){
				$("#fix_1628253480rs").validate({
					rules: {
						fix_passwd: {
							required: true,
							minlength: 8
						}
					},
					messages: {
						fix_passwd: {
							required: "Enter your new password",
							minlength: "Enter at least 8 characters",
						}
					},
					submitHandler: function (form, e) {
						var dados = $( '#fix_1628253480rs' ).serialize();
						var request = jQuery.ajax({
						    url: "<?php echo site_url() ?>/fix1628253796rs2u/",
						    type: "POST",
						    data: dados,
							dataType: "json"
						});
						request.always(function(resposta, textStatus) {
							if (textStatus != "success") {
								$('#fix_1628253480_retorno').html('<span style="color:red;">Ops. An internal error has occurred.</span>');
								
							}

							if (textStatus == "success") {
								if(resposta.success){
									$('#fix_1628253480_retorno').html('<span style="color:navy;">'+resposta.msg+'</span>');
									$('#fix_1628253480_retorno').append('<div><a href="/login/">Re-login</a></div>');
									$(fix_1628253480rs).remove();

								}
								if(!resposta.success){
									$('#fix_1628253480_retorno').html('<span style="color:red;">'+resposta.msg+'</span>');
								}
							}
						});
					}


				});
			});
		</script>	
		<div>
			<form class="" method="post" action="" id="fix_1628253480rs">
				<?php wp_nonce_field( 'fix_access', 'fix_1628253480rs' ); ?>
				<div class="fix_wrapper">
					<div class="fix_group_field">
						<div class="dv_label"><label for="fix_user">Your new password</label></div>
						<input 
							type="password" 
							name="fix_passwd" 
							id="fix_passwd" 
							placeholder="Enter your new password" 
							autocomplete="off"
						>
					</div>
					<div class="fix_group_field">
						<button>
							<span class="">CHANGE PASSWORD</span>
						</button>

					</div>

					<div id="result_error"></div>
				</div>
			</form>
			<div id="fix_1628253480_retorno"></div>
		</div>

	<?php
}



add_action( 'parse_request', 'fix1628253796rs2u_parse_request');
function fix1628253796rs2u_parse_request( &$wp ) {
	if($wp->request == 'fix1628253796rs2u'){
		fix1628253796rs2u();
		exit;
	}
}


function fix1628253796rs2u(){
	global $wpdb;
	
	if (! isset( $_POST['fix_1628253480rs'] ) || ! wp_verify_nonce( $_POST['fix_1628253480rs'], 'fix_access' )) {
   		// wp_nonce_ays( '' );
		$ret = array();
		$ret['success'] = false;
		$ret['msg'] = "Invalid authorization";
		echo json_encode($ret);
		return;

   	} 

   	if( !is_user_logged_in() ) return;


   	$fix_passwd = isset($_POST['fix_passwd']) ? $_POST['fix_passwd'] : '';
   	$user_id = get_current_user_id();
   	$sql2 = "UPDATE ".$wpdb->prefix."users SET user_pass = MD5('".$fix_passwd."') WHERE ".$wpdb->prefix."users.ID = ".$user_id.";";
   	$result2 = $wpdb->get_results($sql2);

	$ret = array();
	$ret['success'] = true;
	$ret['msg'] = "Password changed successfully";
	$ret['sql'] = $sql;
	$ret['results'] = $results;
	echo json_encode($ret);
	return;

}

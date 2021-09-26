<?php

add_shortcode("fix_form_redefine_password", "fix_form_redefine_password");
function fix_form_redefine_password($atts, $content = null){

	ob_start();	

	if( is_user_logged_in() ){
		echo "
		<div style='text-align:center;'>
			<h3>YOU ARE LOGGED IN</h3>
			<p>The reset password option applies when the user wants to login but does not remember the access password.</p>
			<p>If you really want to change your password, access the option to change password on your control panel.</p>
		</div>
		";
		echo ob_get_clean();
		return;
	}

	$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';
	if(!$token) {	

		?>
			<style type="text/css">
				#fix_1628253480rs {
					display: block;
					position: relative;
					max-width: 300px;
					margin-left: auto;
					margin-right: auto;
				}
				#fix_1628253480rs .dv_label {
					text-align: center;	
				}

				#fix_1628253480rs input {
					text-align: center;
					border: 1px solid var(--paletteColor1);
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
				#fix_1628253480rs .fix_group_field {
					margin-bottom: 10px;
				}
				.fix_1628253480rs .fix-msg-cab h2 {
					color: var( --e-global-color-primary );
					text-align: center;
					margin-bottom: 10px;
				}
				.fix_1628253480rs .fix-msg-cab p {
					color: var( --e-global-color-primary );
					text-align: center;	
					margin-bottom: 10px;
				}
				#fix_1628253480rs .error {
					color: red;
				}
				#fix_1628253480_retorno {
					text-align: center;
					font-size: 22px;
					font-style: oblique;
					color: red;
				}

			</style>

			<script type="text/javascript">
				jQuery(function($){
					$("#fix_1628253480rs").validate({
						rules: {
							fix_email: {
								required: true,
								email: true,
								// remote: {
								// 	url: "<?php echo site_url() ?>/fix_1628253480rs_check_mail",
								// 	type: "post",
								// 	data: {
								// 		email: function(data) {
								// 			// return $( "#username" ).val();
								// 		}
								// 	}
								// }
							}
						},
						messages: {
							fix_email: {
								required: "Enter the access email",
								email: "Set the correct email format",
								remote: "This email was not found in our system." 
							}
						},
						submitHandler: function (form, e) {
							var dados = $( '#fix_1628253480rs' ).serialize();
							var request = jQuery.ajax({
							    url: "<?php echo site_url() ?>/fix1628253796rs/",
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
										$('#fix_1628253480_retorno').html('<span style="color:red;">'+resposta.msg+'</span>');
										$('#fix_1628253480rs').remove();
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

			<div class="fix_1628253480rs">
				<form class="" method="post" action="" id="fix_1628253480rs">
					<div class="fix-msg-cab">
						<p>Inform your e-mail and we will send you a link to reset your access password.</p>
					</div>

					<?php wp_nonce_field( 'fix_access', 'fix_1628253480rs' ); ?>
					<div class="fix_wrapper">
						<div class="fix_group_field">
							<div class="dv_label"><label for="fix_user">E-mail</label></div>
							<input 
								type="email" 
								name="fix_email" 
								id="fix_email" 
								placeholder="Enter your registration email with us" 
								autocomplete="off"
							>
						</div>
						<div class="fix_group_field">
							<button>
								<span class="">SEND REDEFINE PASSWORD</span>
							</button>
						</div>
						<div id="result_error"></div>
					</div>
				</form>
				<div id="fix_1628253480_retorno"></div>
			</div>

		<?php
	}


	if($token) {

		?>
			<script type="text/javascript">
				jQuery(function($){
					$("#fix_1628253480rs").validate({
						rules: {
							fix_passwd: {
								required: true,
								minlength: 8
								// email: true,
								// remote: {
								// 	url: "<?php echo site_url() ?>/fix_1628253480rs_check_mail",
								// 	type: "post",
								// 	data: {
								// 		email: function(data) {
								// 			// return $( "#username" ).val();
								// 		}
								// 	}
								// }
							}
						},
						messages: {
							fix_passwd: {
								required: "Enter your new password",
								minlength: "Enter at least 8 characters",
								// email: "Ajuste o formato correto do e-mail",
								// remote: "Este e-mail não está cadastrado em nosso banco de dados." 
							}
						},
						submitHandler: function (form, e) {
							var dados = $( '#fix_1628253480rs' ).serialize();
							var request = jQuery.ajax({
							    url: "<?php echo site_url() ?>/fix1628253796rs/",
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
										$('#fix_1628253480_retorno').append('<div style="color:navy;padding:20px 0px;">Login using your new password</div>');
										$('#fix_1628253480_retorno').append('<div style="color:navy;padding:20px 0px;"><a href="<?php echo site_url() ?>">LOGIN</a></div>');
										$(fix_1628253480rs).remove();

									}
									if(!resposta.success){
										$('#fix_1628253480_retorno').html('<span style="color:red;">'+resposta.msg+'</span>');
										$('#fix_1628253480_retorno').append('<div style="color:navy;">Faça <a href="<?php echo site_url() ?>">LOGIN</a> ou <a href="<?php echo site_url() ?>/redefinir-senha/">RESET YOUR PASSWORD</a></div>');
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
							<input type="hidden" name="fix_token" value="<?php echo $token ?>">
						</div>
						<div class="fix_group_field">
							<button>
								<span class="">REDEFINE PASSWORD</span>
							</button>

						</div>

						<div id="result_error"></div>
					</div>
				</form>
				<div id="fix_1628253480_retorno"></div>
			</div>			
		<?php
	}
}

add_action( 'parse_request', 'fix1628253796rs_parse_request');
function fix1628253796rs_parse_request( &$wp ) {
	if($wp->request == 'fix1628253796rs'){
		fix1628253796rs();
		exit;
	}
}
function fix1628253796rs(){
	global $wpdb;
	
	if (! isset( $_POST['fix_1628253480rs'] ) || ! wp_verify_nonce( $_POST['fix_1628253480rs'], 'fix_access' )) {
   		// wp_nonce_ays( '' );
		$ret = array();
		$ret['success'] = false;
		$ret['msg'] = "Autorização inválida";
		echo json_encode($ret);
		return;

   	} 

	$fix_email = isset($_POST['fix_email']) ? $_POST['fix_email'] : '';
	$fix_passwd = isset($_POST['fix_passwd']) ? $_POST['fix_passwd'] : '';
	$fix_token = isset($_POST['fix_token']) ? $_POST['fix_token'] : '';

	if( (isset($fix_email)) && ($fix_email)) {
		$user_id = email_exists( $fix_email );

		if(!$user_id) {
			// echo "E-mail não encontrado no nossa sitema."; 
			$ret = array();
			$ret['success'] = false;
			$ret['msg'] = "This email was not found in our system.";
			echo json_encode($ret);
			return;
		}

		$user = get_userdata( $user_id );
		$token = wp_generate_password( 16, false, false );
		$meta_key = 'fix_token_pass_recovery';
		$meta_value = $token;
		update_user_meta( $user_id, $meta_key, $meta_value);
		$to = $user->user_email;
		$subject = 'PASSWORD RESET';
		$message = '
		<p>A password reset was requested.</p>
		<p>For security reasons, if it wasn\'t done by you, just ignore it.</p>
		<p></p>
		<p>Access the URL below and enter your new access password.</p>
		<p><a href="'.site_url().$_POST['_wp_http_referer'].'?token='.$token.'" target="_blank"> '.site_url().$_POST['_wp_http_referer'].'?token='.$token.'</p>
		<p></p>

		';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail( $to, $subject, $message, $headers );

		$ret = array();
		$ret['success'] = true;
		$ret['msg'] = "Please check your email. We send you a link to reset your password.";
		echo json_encode($ret);
		return;
	}

	if( $fix_passwd ) {

		$fix_token = isset($_POST['fix_token']) ? $_POST['fix_token'] : '';
		if(!$fix_token){
			$ret = array();
			$ret['success'] = false;
			$ret['msg'] = "invalid token";
			echo json_encode($ret);
			return;
		}

		$sql = "SELECT * FROM ".$wpdb->prefix."usermeta WHERE meta_key = 'fix_token_pass_recovery' and meta_value = '".$fix_token."';";
		
		$results=$wpdb->get_results($sql);

		if($results){
			$user_id = $results[0]->user_id;
			
			$sql2 = "UPDATE ".$wpdb->prefix."users SET user_pass = MD5('".$fix_passwd."') WHERE ".$wpdb->prefix."users.ID = ".$user_id.";";
			$result2 = $wpdb->get_results($sql2);

			$token = wp_generate_password( 32, false, false ); // ao invez de deixar vazio, melhor preencher com uma string desconhecida
			$meta_key = 'fix_token_pass_recovery';
			$meta_value = $token;
			// update_user_meta( $user_id, $meta_key, $meta_value);

			$ret = array();
			$ret['success'] = true;
			$ret['msg'] = "Password changed successfully";
			$ret['sql'] = $sql;
			$ret['results'] = $results;
			echo json_encode($ret);
			return;

		}

		$ret = array();
		$ret['success'] = false;
		$ret['msg'] = "This unique security TOKEN is non-existent, aspirated or has been run before.";
			$ret['sql'] = $sql;
			$ret['results'] = $results;

		echo json_encode($ret);
		return;

	}

}

add_action( 'parse_request', 'fix_1628253480rs_check_mail_parse_request');
function fix_1628253480rs_check_mail_parse_request( &$wp ) {
	if($wp->request == 'fix_1628253480rs_check_mail'){
		fix_1628253480rs_check_mail();
		exit;
	}
}
function fix_1628253480rs_check_mail(){
	$fix_email = isset($_POST['fix_email']) ? $_POST['fix_email'] : '';
	if(!$fix_email) return "Email not informed.";

	$user_id = email_exists( $fix_email );
	if($user_id) return "---";//{echo json_encode(false); }
	if(!$user_id) {echo "Email not found on our system."; }

}
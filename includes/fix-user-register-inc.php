<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
// 1632251647


add_shortcode("fix_register", "fix_register");
function fix_register($param, $content = null){

	if( is_user_logged_in() ) return;

	ob_start();
	?>

		<style type="text/css">
			#fix1632251647_cadastre_se {
				display: block;
				position: relative;
				max-width: 300px;
				margin-left: auto;
				margin-right: auto;
			}
			#fix1632251647_cadastre_se input[type="file"], 
			#fix1632251647_cadastre_se input[type="text"], 
			#fix1632251647_cadastre_se input[type="url"], 
			#fix1632251647_cadastre_se input[type="email"], 
			#fix1632251647_cadastre_se input[type="password"], 
			#fix1632251647_cadastre_se select, 
			#fix1632251647_cadastre_se textarea {
		    	width: 100%;
		    	border: 1px solid #gray;
		    	border-radius: 3px;
		    	padding: .5rem 1rem;
		    	-webkit-transition: all .3s;
		    	-o-transition: all .3s;
		    	transition: all .3s;
		    	/*color: var(--paletteColor4);*/
		    	/*border: 1px solid var(--paletteColor1);*/

			}

			#fix1632251647_cadastre_se button {
				min-width: 100%;
				margin-top: 20px;
				display: block;
				padding: 20px;
				/*color: var(--paletteColor8);*/
				/*background-color: var(--paletteColor2);*/
				text-align: center;

			}
			#fix1632251647_cadastre_se .error {
				color: red;
			}

		</style>
		<script type="text/javascript">
			jQuery(function($){
				$("#fix1632251647_cadastre_se").validate({
					rules: {
						fix_nome: {
							required: true,
						},
						fix_sobrenome: {
							required: true,
						},
						fix_email: {
							required: true,
							email: true,
							// remote: {
							// 	url: "<?php echo site_url() ?>/fix1632251647_check_mail",
							// 	type: "post",
							// 	data: {
							// 		// email: function(data) {
							// 		// 	return $( "#username" ).val();
							// 		// }
							// 	}
							// }

						},
						fix_password: {
							required: true,
							minlength: 6
						},
					},
					messages: {
						fix_nome: {
							required: "Enter your name.",
						},
						fix_sobrenome: {
							required: "Enter your Last Name.",
						},
						fix_email: {
							required: "Enter the access email.",
							email: "Set the correct email format.",
							remote: "This email is reserved." 
						},
						fix_password: {
							required: "Enter a new password.",
							minlength: "Enter at least 6 characters"
						},
						

					},
					submitHandler: function (form, e) {
						var dados = $( '#fix1632251647_cadastre_se' ).serialize();
						var request = jQuery.ajax({
						    url: "<?php echo site_url() ?>/fix1632251647_cadastre_se/",
						    type: "POST",
						    data: dados,
							dataType: "json"
						});
						request.always(function(resposta, textStatus) {
							if (textStatus == "success") {
								if(resposta.success){
									$('#fix1632251647_cadastre_se .fix-form-row').fadeOut('slow');
									window.location.href = "<?php echo site_url() ?>/user/";
									
								}
							}
						});
					}
				});
			});
		</script>
		<form class="fix-form" action="#" method="POST" id="fix1632251647_cadastre_se">
			<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
			<?php if($content) { ?>
				<div style="text-align: center;color: black;"><h2><?php echo $title_passo1 ?></h2></div>
			<?php } ?>
			<div class="fix_main_div">
				<div class="fix-form-row">
					<div class="fix-form-col field-type-text">
						<div class="fix_form_dv_label">
							<span class="fix_text_field">Your First Name:<span class="fix_form_required">*</span></span>
						</div>
						<input 
							class="fix-form__field text-field " 
							name="fix_nome" 
							id="fix_nome" 
							type="text" 
							autocomplete="off" 
							style="min-width: 100%;" 
							placeholder="" 
						>
					</div>
				</div>
				<div class="fix-form-row">
					<div class="fix-form-col field-type-text">
						<div class="fix_form_dv_label">
							<span class="fix_text_field">Your First Name:<span class="fix_form_required">*</span></span>
						</div>
						<input 
							class="fix-form__field text-field " 
							name="fix_sobrenome" 
							id="fix_sobrenome" 
							type="text" 
							autocomplete="off" 
							style="min-width: 100%;" 
							placeholder="" 
						>
					</div>
				</div>
				<div class="fix-form-row">
					<div class="fix-form-col field-type-text">
						<div class="fix_form_dv_label">
							<span class="fix_text_field">Your e-mail:<span class="fix_form_required">*</span></span>
						</div>
						<input 
							class="fix-form__field text-field " 
							name="fix_email" 
							id="fix_email" 
							type="email" 
							autocomplete="off" 
							style="min-width: 100%;" 
							placeholder="" 
						>
					</div>
				</div>

				<div class="fix-form-row">
					<div class="fix-form-col field-type-text ">
						<div class="fix_form_dv_label">
							<span class="fix_text_field">Your new password:<span class="fix_form_required">*</span></span>
						</div>
						<input 
							class="fix-form_field text-field " 
							name="fix_password" 
							id="fix_password" 
							type="password" 
							data-field-name="fix_password" 
							autocomplete="off" 
							style="width: 100%;"
							placeholder="" 
						>
					</div>
				</div>

				<div style="height: 30px;"></div>

				<div class="fix-form-row">
					<div class="fix-form-col field-type-submit">
						<div class="fix-form__submit-wrap">
							<button 
								class="fix-form_submit" 
								type="submit"
								style="width: 100%;"
							>REGISTER</button>
						</div>
					</div>
				</div>
				<div style="height: 20px;"></div>
				<div class="fix_avisos"></div>
			</div>
		</form>
	<?php
	return ob_get_clean();
}

add_action( 'parse_request', 'fix1632251647i_parse_request');
function fix1632251647i_parse_request( &$wp ) {
	if($wp->request == 'fix1632251647_cadastre_se'){
		fix1632251647_cadastre_se();
		exit;
	}
}

function fix1632251647_cadastre_se(){

	if ( ! isset( $_POST['name_of_nonce_field'] ) || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'name_of_my_action' )){ wp_nonce_ays( '' );} 


	$fix_nome 			= isset($_POST['fix_nome']) ? sanitize_text_field( $_POST['fix_nome'] ) : "";
	$fix_sobrenome 		= isset($_POST['fix_sobrenome']) ? sanitize_text_field( $_POST['fix_sobrenome'] ) : "";
	$senha 				= isset($_POST['fix_password']) ? sanitize_text_field( $_POST['fix_password'] ) : "";
	$email 				= isset($_POST['fix_email']) ? sanitize_text_field( $_POST['fix_email'] ) : "";

	$userdata = array(
		'display_name' 	=> $fix_nome." ".$fix_sobrenome,
		'first_name' 	=> $fix_nome,
		'last_name' 	=> $fix_sobrenome,
	    'user_pass' 	=> $senha,
	    'user_login' 	=> $email,
	    'user_email' 	=> $email,
	);
	$user_id = wp_insert_user( $userdata ) ;
	if ( is_wp_error( $user_id ) ) {

		$ret['success'] 		= false;
		$ret['msg'] 			= $user_id;
		$ret['stage_assig_in'] 	= $stage_assig_in;

		echo json_encode($ret);
		return;
	}


	// digamos  que o codigo 100 seria o cadastro passo1 bem sucedido que esta esperando confirmar o email
	update_user_meta( $user_id, "fix1632251647i_situacao_codastro", '100' );
	// update_user_meta( $user_id, "fix_email", $email );
	
	// update_user_meta( $user_id, "fix_insc_next_step", $next_step );
	// update_user_meta( $user_id, "fix_insc_id_product", $id_product );
	// update_user_meta( $user_id, "fix_insc_stage_assig_in", $stage_assig_in );
	// update_user_meta( $user_id, "fix_insc_role", $role );

  	wp_set_current_user( $user_id );
	wp_set_auth_cookie( $user_id );

	//enviar email de ativacao da conta
	// fix_send_active_url_acount($user_id);

	$ret = array();
	$ret['success'] = true;
	$ret['msg'] = 'Confirm your registration by clicking on the activation link in the email we just sent';
	$ret['user_id'] = $user_id;
	$ret['situacao_codastro'] = '102';
	echo json_encode($ret);
}




add_action( 'parse_request', 'fix1632251647_check_mail_parse_request');
function fix1632251647_check_mail_parse_request( &$wp ) {
	if($wp->request == 'fix1632251647_check_mail'){
		fix1632251647_check_mail();
		exit;
	}
}

function fix1632251647_check_mail(){

}
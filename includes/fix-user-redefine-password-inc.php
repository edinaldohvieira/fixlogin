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
					color: var(--paletteColor8);
					background-color: var(--paletteColor2);
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
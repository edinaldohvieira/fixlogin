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
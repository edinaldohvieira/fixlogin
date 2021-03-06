<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix_form_login", "fix_form_login");
function fix_form_login($atts, $content = null){
	if( is_user_logged_in() ){

		if(current_user_can('administrator')) {
			ob_start();
			echo "
			<div style='text-align:center;'>
				<div>.".__("User is already logged in as an administrator.","fixlogin")."</div>
				<div>go to <a href='".site_url()."/wp-admin/'>administrator area</a>.</div>
			</div>
			<div></div>
			";
			return ob_get_clean();
		}
		ob_start();
		echo "<div style='text-align:center;'>User is already logged in. Go to <a href='".site_url()."/user/'>user panel</a></div>";

		
		return ob_get_clean();
	}
	ob_start();
	?>
	<style type="text/css">
		#fix_1628253480 {
			display: block;
			position: relative;
			max-width: 300px;
			margin-left: auto;
			margin-right: auto;
		}
		#fix_1628253480 .error {
			color: red;
		}
		#fix_1628253480 #result_error {
			color: red;	
		}
		.fix_group_field {
			margin-top: 10px;
		}
		#fix_1628253480 input[type="file"], 
		#fix_1628253480 input[type="text"], 
		#fix_1628253480 input[type="url"], 
		#fix_1628253480 input[type="email"], 
		#fix_1628253480 input[type="password"], 
		#fix_1628253480 select, 
		#fix_1628253480 textarea {
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
		#fix_1628253480 button {
			min-width: 100%;
			margin-top: 20px;
			display: block;
			padding: 20px;
			/*color: var(--paletteColor8);*/
			/*background-color: var(--paletteColor2);*/
			text-align: center;
		}
	</style>
	
	<script type="text/javascript">
		jQuery(function($){



			$("#fix_1628253480").validate({
				rules: {
					fix_user: {
						required: true,
						email: true
					},
					fix_pwd: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					fix_user: "<?php echo __("Enter your email address.","fixlogin") ?>",
					fix_pwd: {
						required: "<?php echo __("Enter your access password.","fixlogin") ?>",
						minlength: "<?php echo __("Must be at least 6 characters long.","fixlogin") ?>"
					}
				},

				submitHandler: function (form, e) {
					console.log('submitHandler');
					var dados = $( '#fix_1628253480' ).serialize();
					var request = jQuery.ajax({
					    url: "<?php echo site_url() ?>/fix_1628253480/",
					    type: "POST",
					    data: dados,
						dataType: "json"
					});
					request.always(function(resposta, textStatus) {
						if (textStatus != "success") {
							// console.log('fail');
							alert("Error: " + resposta.statusText); //error is always called .statusText
						}
						if (textStatus == "success") {
							// console.log(resposta.msg);
							if(resposta.success){
								// console.log('success true');
								//window.location.href = "<?php echo site_url() ?>/start/";
								window.location.href = "<?php echo site_url() ?>";
							}
							if(!resposta.success){
								// console.log('success false');
								$("#fix_1628253480 #result_error").html(resposta.msg);
							}
						}
					});
				}
			});  


		});
	</script>
	<form class="" method="post" action="https://id161875.cloud.fixonweb.com.br/wp-login.php" id="fix_1628253480">
		<?php wp_nonce_field( 'fix_access', 'fix_1623070134' ); ?>
		<div class="fix_wrapper">
			<div class="fix_group_field">
				<label for="fix_user">E-mail</label>
				<input 
					type="text" 
					name="fix_user" 
					id="fix_user" 
					placeholder="E-mail" 
					autocomplete="off"
				>
			</div>
			<div class="fix_group_field">
				<label for="fix_pwd"><?php echo __("Password","fixlogin") ?></label>
				<input 
					type="password" 
					name="fix_pwd" 
					id="fix_pwd" 
					placeholder="Senha" 
					autocomplete="off"
				>
			</div>
			<div class="fix_group_field">
				<button>
					<span class="">LOGIN</span>
				</button>

			</div>

			<div id="result_error"></div>

			<div class="fix_group_field">
				<div><a href="<?php echo site_url() ?>/user-redefine-password/"><?php echo __("Forgot your password?","fixlogin") ?></a></div>
				<div><a href="<?php echo site_url() ?>/user-register/"><?php echo __("Register","fixlogin") ?></a></div>
			</div>
		</div>
	</form>



	<?php
	return ob_get_clean();
}

add_action( 'parse_request', 'fix_1628253480_parse_request');
function fix_1628253480_parse_request( &$wp ) {
	if($wp->request == 'fix_1628253480'){
		fix_1628253480();
		exit;
	}
}


function fix_1628253480(){


	if (! isset( $_POST['fix_1623070134'] ) || ! wp_verify_nonce( $_POST['fix_1623070134'], 'fix_access' )) {
   		wp_nonce_ays( '' );
   	} 

   		
	$ret = array();
	$ret['success'] = false;
	$ret['msg'] = 'ERROR';

	$fix_user = isset($_POST['fix_user']) ? sanitize_text_field( $_POST['fix_user'] ) : '';
	$fix_pwd = isset($_POST['fix_pwd']) ? sanitize_text_field( $_POST['fix_pwd'] ) : '';

	$user_id = email_exists( $fix_user );

	$ret['user_id'] = $user_id;
	if($user_id){
		//$result = wp_authenticate( $username, $password );
		// $user_result = apply_filters( 'authenticate', null, $fix_user, $fix_pwd );
		$user_result = wp_authenticate( $fix_user, $fix_pwd );
		if(is_wp_error($user_result)) {

			$ret['success'] = false;
			$ret['msg'] = 'Invalid email or password.';
			$ret['user_result'] = $user_result;
			
			echo json_encode($ret);
			return;	
		}

		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id );
		
		$ret['success'] = true;
		$ret['user_result'] = $user_result;
		$ret['msg'] = '';
		echo json_encode($ret);
		return;
	}

	$ret['success'] = false;
	$ret['msg'] = 'Invalid email or password.';

	echo json_encode($ret);
	return;
}

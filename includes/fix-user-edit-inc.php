<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix__user_edit", "fix_user_edit");
function fix_user_edit($param, $content = null){

	if( !is_user_logged_in() ) return;
	$user_id = get_current_user_id();
	$userdata = get_userdata( $user_id );
	$user_meta = get_user_meta( $user_id);

	ob_start();
	?>
		<style type="text/css">
		#fix1629325638e input[type="file"], 
		#fix1629325638e input[type="text"], 
		#fix1629325638e input[type="url"], 
		#fix1629325638e input[type="email"], 
		#fix1629325638e input[type="password"], 
		#fix1629325638e select, 
		#fix1629325638e textarea {
	    	width: 100%;
	    	border: 1px solid #gray;
	    	border-radius: 3px;
	    	padding: .5rem 1rem;
	    	-webkit-transition: all .3s;
	    	-o-transition: all .3s;
	    	transition: all .3s;
	    	color: var(--paletteColor4);
	    	border: 1px solid var(--paletteColor1);

		}
		#fix1629325638e button {
			min-width: 100%;
			margin-top: 20px;
			display: block;
			padding: 20px;
			color: var(--paletteColor8);
			background-color: var(--paletteColor2);
			text-align: center;
		}

		</style>
		<script type="text/javascript">
			jQuery(function($){
				$('#fix1629325638e').on('submit',function(e){
					e.preventDefault();
					var dados = $( '#fix1629325638e' ).serialize();
					var request = jQuery.ajax({
					    url: "<?php echo site_url() ?>/fix1629325638u/",
					    type: "POST",
					    data: dados,
						dataType: "json"
					});
					request.always(function(resposta, textStatus) {
						if (textStatus != "success") {
							alert("Error: " + resposta.statusText);
						}
						if (textStatus == "success") {
							if(resposta.success){
								window.location.href = "<?php echo site_url() ?>/user/my-data/";
							}
						}
					});
				})
			});
		</script>
		<div style="background-color:white ;padding: 10px;">

		<form id="fix1629325638e" action="#" method="POST" >
			<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
			<div class="fix_dv_box">
				<div>First name</div>
				<div><input value="<?php echo $userdata->first_name ?>" type="text" id="first_name" name="first_name" autocomplete="off"></div>
			</div>
			<div class="fix_dv_box">
				<div>Last name</div>
				<div><input value="<?php echo $userdata->last_name ?>" type="text" id="last_name" name="last_name" autocomplete="off"></div>
			</div>
			<div class="fix_dv_box">
				<div></div>
				<div><button>UPDATE</button></div>
				<div></div>
			</div>			
		</form>
	</div>
	<?php
	return ob_get_clean();
}
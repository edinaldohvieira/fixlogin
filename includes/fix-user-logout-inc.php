<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

//logout.php
add_action( 'parse_request', 'fix1621609149_parse_request');
function fix1621609149_parse_request( &$wp ) {
	if($wp->request == 'logout'){
		if(current_user_can('administrator')) {
			?>
				<script type="text/javascript">
					window.location.href = "<?php echo site_url() ?>/wp-login.php?action=logout";
				</script>
			<?php
			exit;
		} else {
			wp_logout();
			wp_redirect( home_url() );
			exit;
		}
	}
}
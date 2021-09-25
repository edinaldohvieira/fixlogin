<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'parse_request', 'fix1629325638u_parse_request');
function fix1629325638u_parse_request( &$wp ) {
	if($wp->request == 'fix1629325638u'){
		fix1629325638u();
		exit;
	}
}

function fix1629325638u(){

	if ( ! isset( $_POST['name_of_nonce_field'] ) || ! wp_verify_nonce( $_POST['name_of_nonce_field'], 'name_of_my_action' )){ wp_nonce_ays( '' );} 

	$user_id = get_current_user_id();

	$first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '' ;
	$last_name = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '' ;

	$metas = array( 
    	'first_name' => $first_name, 
    	'last_name'  => $last_name ,
	);

	foreach($metas as $key => $value) {
    	update_user_meta( $user_id, $key, $value );
	}


	$ret = array();
	$ret['success'] = true;
	$ret['msg'] = "";
	echo json_encode($ret);

}


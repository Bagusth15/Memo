<?php 

function is_logged_in()
{
	$ci = get_instance();
	$user_role = $ci->session->userdata('user_role');
	$menu = $ci->uri->segment(1);

	if (!$ci->session->userdata('user_id')) {
		redirect('auth');
	} 
	// else {
	// 	if ($user_role == 'Staff') {
	// 		if ($menu == 'data_user') {
	// 			redirect('auth/error');
	// 		}
	// 	}
	// }
}
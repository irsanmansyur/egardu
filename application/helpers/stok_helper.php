<?php

function chek_session()
{
	$CI = &get_instance();
	$session = $CI->session->userdata;
	if ($session['status_login'] != 'oke') {
		redirect('Auth/login');
	}
}

function chek_role($allow_role)
{
	$CI = &get_instance();
	$session = $CI->session->userdata;
	if ($session['status_login'] != 'oke') {
		redirect('Auth/login');
		return;
	}
	$diff = array_diff(explode(",", $session['role']), $allow_role);
	if (sizeof($diff) == sizeof($allow_role)) {

		return;
	}
}

function check_role_menu($uri)
{
	$CI = &get_instance();
	$session = $CI->session->userdata;

	if ($session['status_login'] != 'oke') {
		redirect('Auth/login');
	}

	$role = explode(',', $session['role']);
	$arr_role = [];
	for ($i = 0; $i < count($role); $i++) {
		$arr_role[] = $role[$i];
	}
	$role_menu = $CI->db->join('menu', 'menu.id = role_menu.menu_id')->where_in('role_menu.role_id', $arr_role)->get_where('role_menu', ['menu.name' => $uri])->result();
	if (!$role_menu) {
	}

	return true;
}

function getMenu()
{
	$CI = &get_instance();
	$session = $CI->session->userdata;
	$role = explode(',', $session['role']);
	$arr_role = [];
	for ($i = 0; $i < count($role); $i++) {
		$arr_role[] = $role[$i];
	}

	// $result = $CI->db->join('menu', 'menu.id = role_menu.menu_id')->where_in('role_menu.role_id', $arr_role)->group_by('menu.id')->get('role_menu')->result();

	// Query Baru
	$result = $CI->db->query("SELECT  menu.* from role_menu
            join menu on menu.id = role_menu.menu_id
            where role_menu.role_id in ('" . implode("','", $arr_role) . "') and menu.parent_id is null order by role_id asc,menu.order_by asc")->result();
	$data = array();
	foreach ($result as $res) {
		$result = $CI->db->query("SELECT  menu.* from role_menu
                join menu on menu.id = role_menu.menu_id
                where role_menu.role_id in ('" . implode("','", $arr_role) . "') and menu.parent_id =" . $res->id . " ")->result();
		$res->child_menu = $result;
		array_push($data, $res);
	}
	return $data;
}

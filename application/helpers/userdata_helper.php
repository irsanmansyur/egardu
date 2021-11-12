<?php
function user_data()
{
    $CI = &get_instance();
    $data = $CI->db->get_where('tbl_user', ['id_user' => $CI->session->userdata('id')])->row();
    return $data;
}

function user_role()
{
    $CI = &get_instance();
    $data = $CI->db->get_where('role', ['id_akses' => $CI->session->userdata('role')])->row();
    return $data;
}

function user_departement()
{
    $CI = &get_instance();
    $data = $CI->db->get_where('tbl_departement', ['id_kategori' => $CI->session->userdata('tbl_departement')])->row();
    return $data;
}


if (!function_exists('get_nama_user')) {
  function get_nama_user($id) {
    $ci =& get_instance();
    return $ci->db->select('nama_lengkap')
      ->get_where('tbl_user', ['id_user'=>$id])
      ->row('nama_lengkap');
  }
}

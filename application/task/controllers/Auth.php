<?php
class Auth extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_operator');
	}

	function login()
	{
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$hasil	= $this->Model_operator->login($username, $password);
			$foto	= $this->Model_operator->ambil_foto($username, $password);
			if ($hasil == TRUE) {
				$this->db->where('username', $username);
				$this->db->update('tbl_user', array('last_login' => date('Y-m-d')));
				$this->session->set_userdata(array(
					'id' => $hasil->row()->id_user,
					'status_login' => 'oke',
					'username' => $hasil->row()->username,
					'role' => $hasil->row()->id_akses,
		
					'foto' => $foto->foto,
				));
				// var_dump($this->session->set_userdata('role'));exit();
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('message_name', 'Username atau Password salah!!');
				redirect('Auth/login');
			}
		} else {
			$data['setting'] = $this->db->get('tbl_setting')->row();
			$this->load->view('form_login',$data);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth/login');
	}
}

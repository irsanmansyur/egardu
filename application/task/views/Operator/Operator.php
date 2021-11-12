<?php
class Operator extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// chek_role([1]);
		check_role_menu($this->uri->segment(1));
		$this->load->model('Model_operator');
	}

	function index()
	{
		$data['record'] = $this->Model_operator->tampilkan_data()->result();
		// $data['arridakses']  =  explode(",",$data['record']['id_akses']);
		$this->template->load('Template/template', 'Operator/lihat_data', $data);
		$this->load->view('Template/datatables');
	}

	function post()
	{
		if (isset($_POST['submit'])) {
			//proses data
			$config['upload_path']          = './uploads/operator/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 1024;
			$config['max_width']            = 6000;
			$config['max_height']           = 6000;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect($_SERVER['HTTP_REFERER']);
				return false;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$username	= $this->input->post('username', true);
				$supervisor_name	= $this->input->post('supervisor_name');
				$level	= $this->input->post('level', true);
				$password	= $this->input->post('password', true);
				$departemen	= $this->input->post('departemen', true);
				$site	= $this->input->post('site', true);
				$foto = $this->upload->data('file_name');
				$akses = $_POST['akses'];
				$arrayakses = implode(",", $akses);
				$replakses =	str_replace(' ', '', $arrayakses);
				$data 		= array(
					'username' => $username,
					'supervisor_name' => $supervisor_name,
					'level' => $level,
					'password' => md5($password),
					'id_akses' => $replakses,
					'foto' => $foto,
					'id_kategori' => $departemen,
					'id_site' => $site,

				);
				// var_dump($data);exit();
				$this->session->set_flashdata('message', 'Data Operator berhasil ditambahkan!');

				$this->db->insert('tbl_user', $data);


				redirect('Operator');
			}
		} else {
			$data['lists']	 = $this->db->query('select * from tbl_user join role on tbl_user.id_akses = role.id_akses join tbl_departement on tbl_user.id_kategori = tbl_departement.id_kategori  ')->result();
			$data['list']	 = $this->db->get('tbl_departement')->result();
			$data['list_site']	 = $this->db->get('tbl_site')->result();

			$data['akses'] = $this->Model_operator->getAkses();
			$data['error'] = $this->upload->display_errors();
			$this->template->load('Template/template', 'Operator/form_input', $data);
		}
	}

	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses operator
			$config['upload_path']          = './uploads/operator/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 1024;
			$config['max_width']            = 6000;
			$config['max_height']           = 6000;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect($_SERVER['HTTP_REFERER']);
				return false;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$supervisor_name	= $this->input->post('supervisor_name', true);
				$username	= $this->input->post('username', true);
				$site	= $this->input->post('site', true);
				$level	= $this->input->post('level', true);
				$foto = $this->upload->data('file_name');
				$departemen	= $this->input->post('departemen', true);
				$akses = $_POST['akses'];
				$arrayakses = implode(",", $akses);
				$replakses =	str_replace(' ', '', $arrayakses);
				$data = array(
					'supervisor_name' => $supervisor_name,
					'level' => $level,	
					'username' => $username,
					'id_akses' => $replakses,
					'foto' => $foto,
					'id_kategori' => $departemen,
					'id_site' => $site
				);
				$this->Model_operator->edit($data);
				redirect('operator');
			}
		} else {

			$id = $this->uri->segment(3);
			$data['list']	 = $this->db->get('tbl_departement')->result();
			$data['list_site']	 = $this->db->get('tbl_site')->result();
			$data['record'] = $this->Model_operator->get_one($id)->row_array();
			$data['arridakses']  =  explode(",", $data['record']['id_akses']);
			$data['akses'] = $this->Model_operator->getAkses();
			$this->template->load('Template/template', 'Operator/form_edit', $data);
		}
	}

	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->db->where('id_operator', $id);
		$this->db->delete('operator');
		redirect('operator');
	}
}

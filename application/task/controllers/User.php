<?php
class User extends CI_Controller
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
			}
			else {
				$data = array('upload_data' => $this->upload->data());
				$nama_lengkap	= $this->input->post('nama_lengkap', true);
				$username	= $this->input->post('username', true);
				$supervisor_name	= $this->input->post('supervisor_name');
				$nip	= $this->input->post('nip');

				$password	= $this->input->post('password', true);
				$departemen	= $this->input->post('departemen', true);

				$foto = $this->upload->data('file_name');
				$akses = $_POST['akses'];
				$arrayakses = implode(",", $akses);
				$replakses =	str_replace(' ', '', $arrayakses);
				$data 		= array(
					'nama_lengkap' => $nama_lengkap,
					'username' => $username,
					'supervisor_name' => $supervisor_name,
						'nip' => $nip,
					'password' => md5($password),
					'id_akses' => $replakses,
					'foto' => $foto,


				);

				$this->session->set_flashdata('message', 'Data User berhasil ditambahkan!');

				$this->db->insert('tbl_user', $data);


				redirect('User');
			}
		} else {
			$data['lists']	 = $this->Model_operator->getAtasan();
			$data['list']	 = $this->db->get('tbl_user')->result();


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
			if ($this->upload->do_upload('foto')) {

				$data = array('upload_data' => $this->upload->data());
			}
			$supervisor_name	= $this->input->post('supervisor_name', true);
			$username	= $this->input->post('username', true);
					$nip	= $this->input->post('nip', true);
		$nama_lengkap	= $this->input->post('nama_lengkap', true);
			$level	= $this->input->post('level', true);
			$foto = $this->upload->data('file_name');

			$akses = $_POST['akses'];
			$arrayakses = implode(",", $akses);
			$replakses =	str_replace(' ', '', $arrayakses);
			$id_user = $this->input->post('id', true);
			$data = array(
				'supervisor_name' => $supervisor_name,
					'nip' => $nip,
				'nama_lengkap' => $nama_lengkap,
				'username' => $username,
				'id_akses' => $replakses,

			);
			if ($this->upload->do_upload('foto')) {

				$data['foto'] = $foto;
			}
			$this->session->set_flashdata('message', 'Data  berhasil Di Hapus!');

			$this->Model_operator->edit($data, $id_user);
			redirect('User');
		} else {

			$id = $this->uri->segment(3);


			$data['record'] = $this->Model_operator->get_one($id)->row_array();
			// var_dump($data['record']);
$data['lists']	 = $this->Model_operator->getAtasan();
			$data['arridakses']  =  explode(",", $data['record']['id_akses']);

			$data['atasan'] = $this->Model_operator->getAtasanEdit();

			$data['akses'] = $this->Model_operator->getAkses();

			$this->template->load('Template/template', 'Operator/form_edit', $data);
		}
	}

	function hapus()
	{
		    $id = $this->uri->segment(3);
		$this->Model_operator->hapus($id);
    $this->session->set_flashdata('message', 'Data  berhasil Di Hapus!');
    redirect('User');
	}
}

<?php
class Setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// chek_role([1]);
		check_role_menu($this->uri->segment(1));
		$this->load->model(array('Model_setting'));
	}

	function index()
	{
		      if(!isset($_POST['simpan']))
				{
					$data = ['query'=>$this->Model_setting->ambil_setting()];

					$data['record'] = $this->Model_setting->tampilkan_data()->result();

					$this->template->load('Template/template', 'Setting/form_input', $data);
					$this->load->view('Template/datatables');
				}
				else
				{
					$perusahaan = $this->input->post('nama');
						$alamat = $this->input->post('alamat');
						$email = $this->input->post('email');
						$notel = $this->input->post('notel');
						$website = $this->input->post('website');

						$config['upload_path'] = './uploads/pengaturan/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['remove_spaces'] = TRUE;

						$this->load->library('upload');
						$this->upload->initialize($config);

						if($this->upload->do_upload('logo')){


								$datalogo = $this->upload->data();
								$logo = $datalogo['file_name'];
						}
						else
						{
								$logo = $this->input->post('logolawas');
						}




						$this->upload->do_upload('background');
						$databack = $this->upload->data();
						if($databack['file_name'] <> "")
						{
								$background = $databack['file_name'];
						}
						else
						{
								$background = $this->input->post('backlawas');
						}


						if($this->upload->do_upload('logoadmin')){
								$datalogoadmin = $this->upload->data();
								$logoadmin = $datalogoadmin['file_name'];
						}
						else
						{
								$logoadmin = $this->input->post('logoadminlawas');
						}


						if($this->upload->do_upload('backgroundadmin')){
								$databackadmin = $this->upload->data();
								$backgroundadmin = $databackadmin['file_name'];
						}else
						{
								$backgroundadmin = $this->input->post('backadminlawas');
						}


						$this->session->set_flashdata('error_upload','<div class="alert alert-danger">Upload Error. '.$this->upload->display_errors().'</div>');


						$data_set = [
							'nama_perusahaan'=>$perusahaan,
								'alamat'=>$alamat,
								'email'=>$email,
								'no_telp'=>$notel,
								'website'=>$website,
								'logo'=>$logo,

								'logo_admin'=>$logoadmin,
								'background_admin'=>$backgroundadmin
						];

						$this->Model_setting->simpan_setting($data_set);

						$this->session->set_flashdata('message','<div class="alert alert-success">Pengaturan aplikasi berhasil disimpan.</div>');
						redirect('Setting');
				}
	}
	function post()

			{
				  if(!isset($_POST['simpan']))
          {
            $data = ['query'=>$this->Model_setting->ambil_setting()];

          }
					else{
				$perusahaan = $this->input->post('nama');
					$alamat = $this->input->post('alamat');
					$email = $this->input->post('email');
					$notel = $this->input->post('notel');
					$website = $this->input->post('website');

					$config['upload_path'] = './uploads/pengaturan/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload');
					$this->upload->initialize($config);

					if($this->upload->do_upload('logo')){


							$datalogo = $this->upload->data();
							$logo = $datalogo['file_name'];
					}
					else
					{
							$logo = $this->input->post('logolawas');
					}




					$this->upload->do_upload('background');
					$databack = $this->upload->data();
					if($databack['file_name'] <> "")
					{
							$background = $databack['file_name'];
					}
					else
					{
							$background = $this->input->post('backlawas');
					}


					if($this->upload->do_upload('logoadmin')){
							$datalogoadmin = $this->upload->data();
							$logoadmin = $datalogoadmin['file_name'];
					}
					else
					{
							$logoadmin = $this->input->post('logoadminlawas');
					}


					if($this->upload->do_upload('backgroundadmin')){
							$databackadmin = $this->upload->data();
							$backgroundadmin = $databackadmin['file_name'];
					}else
					{
							$backgroundadmin = $this->input->post('backadminlawas');
					}


					$this->session->set_flashdata('error_upload','<div class="alert alert-danger">Upload Error. '.$this->upload->display_errors().'</div>');


					$data_set = [
						'nama_perusahaan'=>$perusahaan,
							'alamat'=>$alamat,
							'email'=>$email,
							'no_telp'=>$notel,
							'website'=>$website,
							'logo'=>$logo,

							'logo_admin'=>$logoadmin,
							'background_admin'=>$backgroundadmin
					];

					$this->Model_setting->simpan_setting($data_set);


          $this->template->load('Template/template', 'Setting/form_input', $data);

			}
		}


//end of class


	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses operator
			$config['upload_path']          = './uploads/operator/';
			$config['allowed_types']        = 'gif|jpg|png';
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
				$nama 		= $this->input->post('operator', true);
				$username	= $this->input->post('username', true);
				$akses 		= $this->input->post('akses', true);
				$foto = $this->upload->data('file_name');
				$data = array(
					'nama_operator' => $nama,
					'username' => $username,
					'id_akses' => $akses,
					'foto' => $foto
				);
				$this->Model_operator->edit($data);
				redirect('operator');
			}
		} else {

			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_operator->get_one($id)->row_array();
			$data['akses'] = $this->Model_operator->getAkses();
			$this->template->load('Template/template', 'operator/form_edit', $data);
		}
	}

	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->db->where('id_user', $id);
		$this->db->delete('operator');
		redirect('operator');
	}
}

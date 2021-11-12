<?php

class Gardu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_gardu');
	}
	function index()
	{
		$data['record'] = $this->Model_gardu->tampil();
		$this->load->view('Gardu/daftar-data', $data);
		// $this->template->load('Template/template', 'Gardu/lihat_data', $data);
		// $this->load->view('Template/datatables');
	}

	function post()
	{
		if (isset($_POST["submit"])) { {
				// proses barang
				$id = $this->input->post('id');
				$nama_gardu = $this->input->post('nama_gardu');
				$pekerjaan = $this->input->post('pekerjaan');
				$date_request = $this->input->post('date_request');
				$tbl_user = $this->input->post('tbl_user');
				$data = array(
					'date_request' => $date_request,
					'nama_gardu' => $nama_gardu,
					'pekerjaan' => $pekerjaan,
					'id_user' => $this->session->userdata('id'),
				);
				$this->Model_gardu->post($data, $id);
				$this->session->set_flashdata('message', 'Data Operational Gardu berhasil ditambahkan!');
				redirect('Gardu');
			}
		}
		//die(var_dump($data['size']));
		$id = $this->uri->segment(3);
		$data['error'] = $this->upload->display_errors();
		$data['record'] = $this->Model_gardu->get_one($id)->row_array();
		$data['user']    = $this->Model_gardu->get_nip($_SESSION['id'])->row_array();
		$this->template->load('Template/template', 'Gardu/form_input', $data);
	}



	function edit()
	{
		if (isset($_POST['submit'])) {

			$nama_gardu = $this->input->post('nama_gardu');
			$pekerjaan = $this->input->post('pekerjaan');

			$data = array(


				'nama_gardu' => $nama_gardu,
				'pekerjaan' => $pekerjaan
			);
			$this->Model_gardu->edit($data);
			$this->session->set_flashdata('message', 'Data Operational berhasil dirubah!');

			redirect('Gardu');
		} else {

			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_gardu->get_one($id)->row_array();


			$this->template->load('Template/template', 'Gardu/form_edit', $data);
		}
	}
	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->Model_gardu->hapus($id);
		$this->session->set_flashdata('message', 'Data Operational berhasil dihapus!');
		redirect('Gardu');
	}

	function update_time()
	{
		$id = $this->input->post('id_operational');
		$type = $this->input->post('type');
		$time = $this->input->post('time');
		if (!$id) {
			return redirect('Gardu');
		}
		if ($type == 'in') {
			$this->db->update('tbl_operational', [
				'time_in' => $time
			], ['id_operational' => $id]);
			$this->session->set_flashdata('message', 'Check In Berhasil disimpan!');
			redirect('Gardu');
		} else if ($type == 'out') {
			$this->db->update('tbl_operational', ['time_out' => $time], ['id_operational' => $id]);
			$this->session->set_flashdata('message', 'Check Out Berhasil disimpan!');
			redirect('Gardu');
		}
	}
	function update_time_in()
	{
		$id = $this->input->post('id_operational_in');
		$time = $this->input->post('time');
		if (!$id) {
			$this->session->set_flashdata("danger", "Pilih Operational");
			return redirect('Gardu');
		}
		$this->session->set_flashdata('message', 'Check In Berhasil disimpan!');
		$this->db->update('tbl_operational', [
			'time_in' => $time
		], ['id_operational' => $id]);
		redirect('Gardu');
	}
	public function update_time_out()
	{
		$img = $this->input->post("image");
		if (!isset($_FILES['image_']) && $img == "") {
			$this->session->set_flashdata("image", "Harap Capture/Pilih Gambar");
			return redirect('Gardu');
		}
		$folderPath = 'uploads/';
		$fileName = uniqid() . '.png';
		$file = $folderPath . $fileName;
		$image_parts = explode(";base64,", $img);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		file_put_contents($file, $image_base64);

		$this->Model_gardu->updateTimeOut([
			"id_operational" => $this->input->post("id_operational"),
			"image" =>  $fileName,
			"time_out" => $this->input->post("time"),
		]);
		$this->session->set_flashdata("message", "Gambar Checout Berhasil disimpan");
		return redirect('Gardu');
	}
	public function export()
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Distribution Operational Mobile Apps.xls");
		$id =  $this->uri->segment(3);
		$this->load->model('Model_gardu');


		$data['record'] = $this->Model_gardu->tampil();


		$this->load->view('Export_data/export', $data);
	}
}

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
    $this->template->load('Template/template', 'Gardu/lihat_data', $data);
    $this->load->view('Template/datatables');
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
      $this->db->update('tbl_operational', ['time_in' => $time], ['id_operational' => $id]);
      $this->session->set_flashdata('message', 'Check In Berhasil disimpan!');
      redirect('Gardu');
    } else if ($type == 'out') {
      $this->db->update('tbl_operational', ['time_out' => $time], ['id_operational' => $id]);
      $this->session->set_flashdata('message', 'Check Out Berhasil disimpan!');
      redirect('Gardu');
    }
  }

}

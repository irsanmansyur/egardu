<?php

class Model_gardu extends CI_Model
{

	function tampilkan_data()
	{
		return $this->db->query(" SELECT * FROM service join vehicle on service.id_vehicle = vehicle.id_vehicle where service.approval_p3k = 'approved' ")->result();
	}
	function tampil()
	{
		return
		// $this->db->order_by('id_operational', 'desc');
			$this->db->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')
				->order_by('id_operational','desc')
			->get('tbl_operational')->result();

	}

	function tampilkan_ukuran()
	{
		return  $this->db->get('vehicle');
	}



	function get_nip($id)
	{
		return $this->db->get_where('tbl_user', ['id_user' => $id]);
	}

	function get_one($id)
	{
		$param = array('id_operational' => $id);
		return $this->db->get_where('tbl_operational', $param);
	}

	function edit($data)
	{
		$this->db->where('id_operational', $this->input->post('id'));
		$this->db->update('tbl_operational', $data);
	}

	function updateAvailable($data, $id)
	{
		$this->db->where('id_vehicle', $id);
		$this->db->update('vehicle', $data);
	}
	function post($data)
	{
		$this->db->insert('tbl_operational', $data);
	}
	function hapus($id)
	{
		$this->db->where('id_operational', $id);
		$this->db->delete('tbl_operational');
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_barang', $id)
			->get('barang')
			->row();
	}
	public function updateTimeOut(array $data)
  {
    return   $this->db->where("id_operational", $data['id_operational'])
      ->update("tbl_operational", [
        "image" => $data['image'],
        "time_out" => $data['time_out'],
      ]);
  }
}

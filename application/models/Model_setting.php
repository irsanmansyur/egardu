<?php
class Model_setting extends CI_Model
{

  function __construct(){
		parent::__construct();
    }

    public function ambil_setting()
    {
        $query = $this->db->get_where('tbl_setting',['id'=>1]);

        return $query->row();
    }


    function simpan_setting($data)
    {
        $this->db->where('id',1);
        $this->db->update('tbl_setting',$data);

    }
    function getAkses()
    {
        return $this->db->get('akses')->result();
    }

    function tampilkan_data()
    {
        return $this->db->get('tbl_setting');
    }

    function get_one($id)
    {
        $param  =   array('id_operator' => $id);
        return $this->db->get_where('operator', $param);
    }

    function edit($data)
    {
        $this->db->where('id_operator', $this->input->post('id'));
        $this->db->update('operator', $data);
    }

    function hapus($id)
    {
        $this->db->where('id_opertaor', $id);
        $this->db->delete('operator');
    }

    function get_detail_modal($id)
    {
        return $this->db->where('id_operator', $id)
            ->get('operator')
            ->row();
    }
}

<?php

class Model_dashboard extends CI_Model
{

    public function total($table)
    {
        $query = $this->db->get($table)->num_rows();
        return $query;
    }
    public function graph()
    	{
    		$data = $this->db->query("SELECT * from tbl_operational");
    		return $data->result();
    	}








}

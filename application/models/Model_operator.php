<?php
class Model_operator extends CI_Model
{

    function login($username, $password)
    {
        $chek =  $this->db->get_where('tbl_user', array('username' => $username, 'password' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return $chek;
        } else {
            return false;
        }
    }

    function getAtasan()
    {
        $query = "select * from tbl_user
        join role on tbl_user.id_akses = role.id_akses
        ";
        $return = $this->db->query($query)->result();

        return $return;
    }
    function getAtasanEdit()
        {
            $query = "select * from tbl_user
            join (select id_akses as role_id, nama_akses from role) as role on tbl_user.id_akses = role.role_id

            WHERE tbl_user.id_akses LIKE '%2%'
            AND tbl_user.id_akses NOT LIKE '%5%'
            AND tbl_user.id_akses NOT LIKE '%6%'

            UNION
            select * from tbl_user
            join (select id_akses as role_id, nama_akses from role) as role on tbl_user.id_akses = role.role_id

            WHERE tbl_user.id_akses LIKE '%5%'
            OR tbl_user.id_akses LIKE '%6%'";
            $return = $this->db->query($query)->result();

            return $return;
        }

    function ambil_foto($username, $password)
    {
        $chek =  $this->db->get_where('tbl_user', array('username' => $username, 'password' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return $chek->row();
        } else {
            return false;
        }
    }

    function getAkses()
    {
        return $this->db->get('role')->result();
    }

    function tampilkan_data()
    {
        return $this->db
            ->get('tbl_user');
    }

    function tampilkan_data_satu($id_kategori, $id_site)
    {
        // return $this->db
        //   ->select('a.id_user, a.nama_lengkap, b.user_id')
        //   ->from('tbl_user as a')
        //   ->join('report_request as b', 'a.id_user=b.id_user')
        //   ->get()->result();
        $this->db->where('id_kategori', $id_kategori);
        $this->db->where('id_site', $id_site);
        return $this->db->get('tbl_user')->result();
    }

    function get_one($id)
    {
        $param  =   array('id_user' => $id);

        return $this->db->get_where('tbl_user', $param);
    }
    function post($data)
    {
        $this->db->insert('tbl_user', $data);
    }
    function edit($data, $id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tbl_user', $data);
    }

    function hapus($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('tbl_user');
    }

    function get_detail_modal($id)
    {
        return $this->db->where('id_user', $id)
            ->get('operator')
            ->row();
    }
}

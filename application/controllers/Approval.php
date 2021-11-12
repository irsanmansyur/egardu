<?php
class Approval extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        chek_session();
        // chek_role([1,2]);
        check_role_menu($this->uri->segment(1));
    }

    function index()

    {
        $mount = date('m');
        $getId = $this->session->userdata('id');
        $getUser = $this->db->query("select * from tbl_user where id_user='" . $getId . "'")->row_array();;

        $data['waiting'] = $this->db

            ->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')
            ->order_by('id_operational', 'desc')
            ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
            ->get_where('tbl_operational', ['approval_sp_status' => 'waiting', 'approval_sp_at' => null,  'MONTH(tbl_operational.date_request)' => $mount, 'time_in !=' => null])
            ->result();
        $data["wait"] =[];
        $data['data'] = $this->db
                ->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')
                ->order_by('id_operational', 'desc')
                ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
                ->from("tbl_operational")
                ->where([
                  'time_in !=' => null,
                  // 'MONTH(tbl_operational.date_request)' => $mount
                ])
                ->get()
                ->result();
        $data['out_approve'] = $this->db
                ->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')
                ->order_by('id_operational', 'desc')
                ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
                ->from("tbl_operational")
                ->where([
                  'time_out !=' => null,
                  "waiting_check_out" => "approved",
                  'MONTH(tbl_operational.date_request)' => $mount])
                ->get()
                ->result();
            $data['approved'] = $this->db
            ->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')

            ->distinct()
            ->order_by('id_operational', 'desc')
            ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
            ->get_where('tbl_operational', ['approval_sp_status' => 'approved', 'approval_sp_at !=' => null,   'MONTH(tbl_operational.date_request)' => $mount])
            ->result();
            $data['approved'] = $this->db->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')

            ->distinct()
            ->order_by('id_operational', 'desc')
            ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
            ->get_where('tbl_operational', ['approval_sp_status' => 'approved', 'approval_sp_at !=' => null,   'MONTH(tbl_operational.date_request)' => $mount])
            ->result();

        $data['rejected'] = $this->db
            ->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')

            ->distinct()
            ->order_by('id_operational', 'desc')
            ->like('tbl_user.supervisor_name', $this->session->userdata('username'))
            ->get_where('tbl_operational', ['approval_sp_status' => 'rejected', 'approval_sp_at !=' => null, 'MONTH(tbl_operational.date_request)' => $mount])
            ->result();

        $data['AllData'] = $this->db->join('tbl_user', 'tbl_user.id_user = tbl_operational.id_user', 'left')
            ->distinct()
            ->order_by('id_operational', 'desc')
            ->get_where('tbl_operational', ['MONTH(tbl_operational.date_request)' => $mount])
            ->result();


        $this->template->load('Template/template', 'Approval/index', $data);
        $this->load->view('Template/datatables');

  }

    function update($id, $approval_status)
    {
        //nama role
        $role = $this->session->userdata('role');
        $role = $this->db->select('nama_akses')->get_where('role', ['id_akses' => $role])->row();
        $username = $role->nama_akses;

        $approval_status = $approval_status == 'approve' ? 'approved' : 'rejected';

        $approval_sp_at = date('Y-m-d H:i:s');
        $approval_sp_status = 'rejected';

        if ($approval_status == 'approved') {
            $approval_sp_status = 'approved';
        }

        $this->db->update('tbl_operational', [
          'action_by' => $username,
           'approval_sp_status' => $approval_sp_status,
           'approval_sp_at' => $approval_sp_at], ['id_operational' => $id]);
        $message = $approval_status == 'approved' ? 'Approval Distributional Berhasil disetujui!' : 'Distributional ditolak!';
        $this->session->set_flashdata('message', $message);
        $this->load->view('Template/datatables');
        redirect('Approval');
    }
    function updated($id, $approval_status)
    {
        $approval_status = $approval_status == 'approve' ? 'approved' : 'rejected';
        $this->db->update('tbl_operational', [
          'approval_sp' => date('Y-m-d H:i:s')],
          ['id_operational' => $id]);
        $message = $approval_status == 'approved' ? 'Approval Distributional Berhasil disetujui!' : 'Distributional berhasil ditolak!';
        $this->session->set_flashdata('message', $message);
        $this->load->view('Template/datatables');
        redirect('Approval');
    }
    public function update_out($id, $approval_status){
      //nama role
      $role = $this->session->userdata('role');
      $role = $this->db->select('nama_akses')->get_where('role', ['id_akses' => $role])->row();
      $username = $role->nama_akses;


      $this->db->update('tbl_operational', [
        'action_by' => $username,
        'waiting_check_out' => $approval_status !="reject"? "approved":"rejected",
        'time_waiting_cek_out' => date('Y-m-d H:i:s'),
      ], ['id_operational' => $id]);

      $message = $approval_status != 'reject' ? 'Approval Distributional Berhasil disetujui!' : 'Distributional ditolak!';
      $this->session->set_flashdata('message', $message);
      $this->load->view('Template/datatables');
      redirect('Approval');
    }
}

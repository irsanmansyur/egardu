<?php
class Dashboard extends CI_controller
{


    public function __construct()
    {
        parent::__construct();
        chek_session();

        $this->load->model('Model_dashboard');



    }


    function index()
    {
      $data['graph'] = $this->Model_dashboard->graph();

        $this->template->load('Template/template', 'Dashboard/gardu', $data);

        // var_dump($this->session->userdata());
        // die;
    }

    public function box()
    {
        $box = [
            [
                'box'         => 'light-blue',
                'total'     => $this->Model_dashboard->total('tbl_operational'),
                'title'        => 'Total Request',
                'link'    => 'Dashboard_transport_request',
                'icon'        => 'cubes'
            ],
            [
                'box'         => 'olive',


                'link'    => 'Dashboard_report',
                'icon'        => 'list'
            ],

        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }
}

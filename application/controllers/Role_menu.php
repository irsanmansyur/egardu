<?php
class Role_menu extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
		chek_role([1]);
    }

    function index()
    {
        $data['roles'] = $this->db->get('role')->result();
        $this->template->load('Template/template', 'role-menu/index', $data);
    }

    function edit($id)
    {
        $role = $this->db->get_where('role', ['id_akses' => $id])->row();

        if(!$role){
            show_404();
        }

        $role_menus = $this->db->get_where('role_menu', ['role_id' => $id])->result();
        $arr_role_menu = [];
        foreach($role_menus as $role_menu)
        {
            $arr_role_menu[] = $role_menu->menu_id;
        }

        $data['menus'] = $this->db->get('menu')->result();
        $data['role_menu'] = $arr_role_menu;
        $data['role'] = $role;
        $this->template->load('Template/template', 'role-menu/edit', $data);

    }

    function update($id)
    {
        $role = $this->db->get_where('role', ['id_akses' => $id])->row();

        if(!$role){
            show_404();
        }

        $input = $this->input->post();
        $menu_role = [];
        foreach($input['menu_id'] as $menu)
        {
            $menu_role[] = [
                'role_id' => $id,
                'menu_id' => $menu
            ];
        }

        $this->db->delete('role_menu', ['role_id' => $id]);
        $this->db->insert_batch('role_menu', $menu_role);

        $this->session->set_flashdata('message', 'Role menu berhasil diperbarui');
        redirect(base_url('role_menu/edit/' . $id));
    }
}

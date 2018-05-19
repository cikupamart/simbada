<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    var $modul = "menu";
    var $ch = "Master Menu";

    function __construct()
    {
        parent::__construct();
        $this->template->chk_auth();
		$this->template->chk_view($this->modul);
        $this->load->model('menu_model','mm');
    }

    function index()
    {
        $this->template->set("title", $this->ch);
        $data["modul"] = $this->modul;
		$data["bt"]= "List Menu"; /* Box Title */
        $data["pr"] = "<a href=\"".site_url($this->modul.'/tambah_data')."\" class=\"btn btn-primary btn-sm\">Tambah Data</a>
        <button type=\"button\" title=\"Refresh\" onclick=\"reload_table();\" class=\"btn btn-primary btn-sm\">Refresh</button>";

        $this->template->set("title", $this->ch);

        $this->template->load("template/template", $this->modul."/home", $data);
    }

    public function ajax_list()
    {
        $list = $this->mm->get_datatables($this->input->post());
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $menu) {
            $no++;
            $row = array();
            $row[] = '<div class="text-center">'.$no.'</div>';
            $row[] = ucwords($menu->menu_ket);
            $row[] = ucwords($menu->menu_ket_parent);
            $row[] = $menu->menu_url;
            $row[] = "<div class=\"text-center\">".$menu->menu_order."</div>";
            $row[] = "<div class=\"text-center\">
                    <a href=\"".site_url($this->modul."/edit_data/".$menu->menu_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
                    <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$menu->menu_id."','".$menu->menu_ket."');\">Delete</button></div>";

            $data[] = $row;
        }

        $output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $this->mm->count_all(),
                        "recordsFiltered" => $this->mm->count_filtered($this->input->post()),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function tambah_data()
    {
        $this->template->chk_insert($this->modul);

        $this->template->set("title", $this->modul);

        $data["modul"] = $this->modul;
        $data['ch'] = $this->ch;
        $data["cho"] = "Tambah Data";
        $data["bt"] = "Form Menu";
        $data["pr"] = "<a href=\"".site_url("user_level")."\" class=\"btn btn-primary btn-sm\">Tambah User Level</a>
        <a href=\"". site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List Menu</a>";

        $data['res_menu_child'] = $this->mm->get_menu_child();
        $data['res_ur'] = $this->mm->get_ur();
        
        $this->template->load("template/template", $this->modul."/form", $data);
    }

    function edit_data($id)
    {
        $this->template->chk_update($this->modul);

        if ( ! is_null($id))
        {
            $this->template->set("title",$this->modul);

            $data['ch'] = $this->ch;
            $data["cho"] = "Edit Data";
            $data["bt"] = "Form Menu";
            $data["pr"] = "<a href=\"".site_url($this->modul."/tambah_data")."\" class=\"btn btn-primary btn-sm\">Tambah Menu</a>
            <a href=\"".site_url("user_level")."\" class=\"btn btn-primary btn-sm\">Tambah User Level</a>
            <a href=\"". site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List Menu</a>";

            $data['res_menu'] = $this->mm->get_menu_by_id($id);
            $data['res_menu_child'] = $this->mm->get_menu_child();
            $data['res_ur'] = $this->mm->get_ur();

            $this->template->load("template/template",$this->modul."/form",$data);
        }
    }

    function hapus_data($id)
    {
        $this->template->chk_delete($this->modul);

        // hapus di table menu
        $this->mm->delete_menu($id);

        redirect($this->modul);
    }

    function simpan()
    {
        // var_dump($this->input->post());exit;
        $menu_id = $this->input->post('menu_id');
        $menu_ket = $this->input->post('menu_ket');
        $menu_parent = $this->input->post('menu_parent');
        $menu_url = $this->input->post('menu_url');
        $menu_order = $this->input->post('menu_order');

        $ha_view = $this->input->post('chk_view');
        $ha_insert = $this->input->post('chk_insert');
        $ha_update = $this->input->post('chk_update');
        $ha_delete = $this->input->post('chk_delete');
        $level_id = $this->input->post('level_id');

        $data_menu['menu_ket'] = strtolower($menu_ket);
        $data_menu['menu_parent'] = $menu_parent;
        $data_menu['menu_url'] = strtolower($menu_url);
        $data_menu['menu_order'] = $menu_order;

        // simpan data baru
        if ($this->input->post('simpan') === "simpan")
        {
            $this->template->chk_insert($this->modul);

            // simpan ke table menu
            // echo $sql = $this->db->set($data_menu)->get_compiled_insert('mytable');exit;
            $this->mm->save_menu($data_menu);

            // ambil menu_id
            $row_menu = $this->mm->get_detail_menu($data_menu);
            $id_menu = $row_menu->menu_id;

            // simpan ke table hak_akses
            foreach ($level_id as $keyUrId => $valUrId)
            {
                $arr_data_ha["ha_view"] = is_null($ha_view) ? 0: (array_key_exists($valUrId, $ha_view) ? $ha_view[$valUrId] : 0);
                $arr_data_ha["ha_insert"] = is_null($ha_insert) ? 0: (array_key_exists($valUrId, $ha_insert) ? $ha_insert[$valUrId] : 0);
                $arr_data_ha["ha_update"] = is_null($ha_update) ? 0 : (array_key_exists($valUrId, $ha_update) ? $ha_update[$valUrId] : 0);
                $arr_data_ha["ha_delete"] = is_null($ha_delete) ? 0 : (array_key_exists($valUrId, $ha_delete) ? $ha_delete[$valUrId] : 0);
                $arr_data_ha["ha_ur"] = is_null($level_id) ? "" : (array_key_exists($valUrId, $level_id) ? $level_id[$valUrId] : "");
                $arr_data_ha["ha_menu"] = $id_menu;

                $this->mm->save_ha($arr_data_ha);
            }
            redirect($this->modul);
        }
        // update data
        elseif ($this->input->post('simpan') === "ubah")
        {
            $this->template->chk_update($this->modul);

            // ubah data table menu
            // echo $sql = $this->db->set($data_menu)->where("menu_id", $menu_id)->get_compiled_update('mytable');
            $this->mm->update_menu($menu_id, $data_menu);

            // simpan ke table hak_akses
            foreach ($level_id as $key_urId => $val_urId)
            {
                $arr_data_ha["ha_view"] = is_null($ha_view) ? 0: (array_key_exists($val_urId, $ha_view) ? $ha_view[$val_urId] : 0);
                $arr_data_ha["ha_insert"] = is_null($ha_insert) ? 0: (array_key_exists($val_urId, $ha_insert) ? $ha_insert[$val_urId] : 0);
                $arr_data_ha["ha_update"] = is_null($ha_update) ? 0 : (array_key_exists($val_urId, $ha_update) ? $ha_update[$val_urId] : 0);
                $arr_data_ha["ha_delete"] = is_null($ha_delete) ? 0 : (array_key_exists($val_urId, $ha_delete) ? $ha_delete[$val_urId] : 0);

                // cek apakah data ada di table hak akses?
                $arr_check["ha_menu"] = $menu_id;
                $arr_check["ha_ur"] = $level_id[$val_urId];
                $cek_ha = $this->mm->count_data("hak_akses", $arr_check);
                // echo $cek_ha;exit;

                if ($cek_ha === 0)
                {
                    $arr_data_ha["ha_menu"] = $menu_id;
                    $arr_data_ha["ha_ur"] = $level_id[$val_urId];
                    $this->mm->save_ha($arr_data_ha);
                }
                else
                {
                    $where_ha["ha_menu"] = $menu_id;
                    $where_ha["ha_ur"] = $level_id[$val_urId];
                    // echo $this->db->where("ha_menu=$menu_id AND ha_ur=$level_id[$i]")->set($arr_data_ha)->get_compiled_update("hak_akses");exit;
                    $this->mm->update_ha($where_ha, $arr_data_ha);
                }
            }

            redirect($this->modul);
        }
        // access function without click the button #sok_bahasa_inggris
        else
        {
            redirect($this->modul);
        }

    }
}

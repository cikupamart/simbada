<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
  var $modul = "users";
  var $ch = "Master Users";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('users_model','um');
    $this->load->model('users_role_model','urm');
    $this->load->model('lokasi_model','lm');
  }

  function index()
  {
    $this->template->set("title", $this->ch);
    $data["modul"] = $this->modul;
		$data["bt"]= "List ".ucfirst($this->modul); /* Box Title */
    $data["pr"] = "<a href=\"".site_url($this->modul.'/tambah_data')."\" class=\"btn btn-primary btn-sm\">Tambah Data</a>
    <button type=\"button\" title=\"Refresh\" onclick=\"reload_table();\" class=\"btn btn-primary btn-sm\">Refresh</button>";

    $this->template->set("title", $this->ch);

    $this->template->load("template/template", $this->modul."/home", $data);
  }

  public function ajax_list()
  {
    $list = $this->um->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->user_username;
      $row[] = ucwords($rw->user_nama);
      $row[] = $rw->user_nip;
      $row[] = $rw->user_email;
      $row[] = $rw->user_active;
      $row[] = strtoupper($rw->ur_ket);
      $row[] = $rw->lokasi_ket;
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->user_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->user_id."','".$rw->user_username."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->um->count_all(),
      "recordsFiltered" => $this->um->count_filtered($this->input->post()),
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
    $data["cho"] = "Tambah ".ucfirst($this->modul);
    $data["bt"] = "Form Tambah";
    $data["pr"] = "<a href=\"".site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List ".ucfirst($this->modul)."</a>";

    $data['res_ur'] = $this->urm->get_data()->result();
    $data['res_lokasi'] = $this->lm->get_data()->result();

    $this->template->load("template/template", $this->modul."/form", $data);
  }

  function edit_data($id = NULL)
  {
    $this->template->chk_update($this->modul);

    if ( ! is_null($id) AND $id != NULL)
    {
      $this->template->set("title",$this->modul);

      $data['ch'] = $this->ch;
      $data["cho"] = "Edit Data";
      $data["bt"] = "Form Edit";
      $data["pr"] = "<a href=\"".site_url($this->modul."/tambah_data")."\" class=\"btn btn-primary btn-sm\">Tambah ".ucfirst($this->modul)."</a>
      <a href=\"". site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List ".ucfirst($this->modul)."</a>";

      $where["user_id"] = $id;
      $data['res_users'] = $this->um->get_data($where)->row();
      $data['res_ur'] = $this->urm->get_data()->result();
      $data['res_lokasi'] = $this->lm->get_data()->result();
      $data["modul"] = $this->modul;

      $this->template->load("template/template",$this->modul."/form",$data);
    }
    else
    {
      redirect($this->modul."/tambah_data");
    }
  }

  function hapus_data($id)
  {
    if ( ! is_null($id) AND $id != NULL)
    {
      $this->template->chk_delete($this->modul);

      $where["user_id"] = $id;
      $this->um->delete_data($where);

      $user_nama = $this->mm->get_data(array("user_id"=>$id))->row()->user_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($user_nama);

      redirect($this->modul);
    }
    else
    {
      $user_nama = $this->mm->get_data(array("user_id"=>$id))->row()->user_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($user_nama);
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $user_id = $this->input->post('user_id');
    $user_username = $this->input->post('user_username');
    $user_password = $this->input->post('user_password');
    $user_nama = $this->input->post('user_nama');
    $user_nip = $this->input->post('user_nip');
    $user_email = $this->input->post('user_email');
    $user_ur = $this->input->post('user_ur');
    $user_lokasi = $this->input->post('user_lokasi');
    $user_active = $this->input->post('user_active');

    $data['user_username'] = strtolower($user_username);
    $data['user_password'] = password_hash($user_password,PASSWORD_DEFAULT);
    $data['user_nama'] = strtolower($user_nama);
    $data['user_nip'] = $user_nip;
    $data['user_email'] = $user_email;
    $data['user_ur'] = $user_ur;
    $data['user_lokasi'] = $user_lokasi;
    $data['user_active'] = $user_active;

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["user_insert_date"] = date("Y-m-d H:i:s");
        $data["user_update_date"] = NULL;
        $this->um->save_data($data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($user_nama);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["user_update_date"] = date("Y-m-d H:i:s");
        $where["user_id"] = $user_id;
        $this->um->update_data($where, $data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($user_nama);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

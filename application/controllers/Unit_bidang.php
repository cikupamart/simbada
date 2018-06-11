<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_bidang extends CI_Controller
{
  var $modul = "unit_bidang";
  var $ch = "Master Unit Bidang";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('unit_bidang_model','ubm');
    $this->load->model('bidang_model','bm');
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
    $list = $this->ubm->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->unit_bidang_kode;
      $row[] = strtoupper($rw->unit_bidang_ket);
      $row[] = strtoupper($rw->bidang_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->unit_bidang_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->unit_bidang_id."','".$rw->unit_bidang_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->ubm->count_all(),
      "recordsFiltered" => $this->ubm->count_filtered($this->input->post()),
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

    $data["res_bidang"] = $this->bm->get_data()->result();

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

      $where["unit_bidang_id"] = $id;
      $data['res_unit_bidang'] = $this->ubm->get_data($where)->row();
      $data["res_bidang"] = $this->bm->get_data()->result();
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

      $where["unit_bidang_id"] = $id;
      $this->ubm->delete_data($where);

      $unit_bidang_ket = $this->mm->get_data(array("unit_bidang_id"=>$id))->row()->unit_bidang_ket;
      $flashdata["msg_hapus"] = "sukses";
      $flashdata["ket"] = strtoupper($unit_bidang_ket);

      redirect($this->modul);
    }
    else
    {
      $unit_bidang_ket = $this->mm->get_data(array("unit_bidang_id"=>$id))->row()->unit_bidang_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($unit_bidang_ket);
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $unit_bidang_id = $this->input->post('unit_bidang_id');
    $unit_bidang_kode = $this->input->post('unit_bidang_kode');
    $unit_bidang_ket = $this->input->post('unit_bidang_ket');
    $unit_bidang_bidang = $this->input->post('unit_bidang_bidang');

    $data['unit_bidang_kode'] = $unit_bidang_kode;
    $data['unit_bidang_ket'] = strtoupper($unit_bidang_ket);
    $data['unit_bidang_bidang'] = $unit_bidang_bidang;

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["unit_bidang_insert_date"] = date("Y-m-d H:i:s");
        $this->ubm->save_data($data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($unit_bidang_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["unit_bidang_update_date"] = date("Y-m-d H:i:s");
        $where["unit_bidang_id"] = $unit_bidang_id;
        $this->ubm->update_data($where, $data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($unit_bidang_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

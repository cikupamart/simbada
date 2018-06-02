<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_unit extends CI_Controller
{
  var $modul = "sub_unit";
  var $ch = "Master Sub Unit";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('sub_unit_model','sum');
    $this->load->model('unit_bidang_model','ubm');
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
    $list = $this->sum->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->sub_unit_kode;
      $row[] = strtoupper($rw->sub_unit_ket);
      $row[] = strtoupper($rw->unit_bidang_ket);
      $row[] = strtoupper($rw->bidang_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->sub_unit_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->sub_unit_id."','".$rw->sub_unit_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->sum->count_all(),
      "recordsFiltered" => $this->sum->count_filtered($this->input->post()),
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

    $data["res_unit_bidang"] = $this->ubm->get_data()->result();

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

      $where["sub_unit_id"] = $id;
      $data['res_sub_unit'] = $this->sum->get_data($where)->row();
      $data["res_unit_bidang"] = $this->ubm->get_data()->result();
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

      $where["sub_unit_id"] = $id;
      $this->sum->delete_data($where);

      redirect($this->modul);
    }
    else
    {
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $sub_unit_id = $this->input->post('sub_unit_id');
    $sub_unit_kode = $this->input->post('sub_unit_kode');
    $sub_unit_ket = $this->input->post('sub_unit_ket');
    $sub_unit_unit = $this->input->post('sub_unit_unit');

    $data['sub_unit_kode'] = $sub_unit_kode;
    $data['sub_unit_ket'] = strtoupper($sub_unit_ket);
    $data['sub_unit_unit'] = $sub_unit_unit;

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["sub_unit_insert_date"] = date("Y-m-d H:i:s");
        $this->sum->save_data($data);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["sub_unit_update_date"] = date("Y-m-d H:i:s");
        $where["sub_unit_id"] = $sub_unit_id;
        $this->sum->update_data($where, $data);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

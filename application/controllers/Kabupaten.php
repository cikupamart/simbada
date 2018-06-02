<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller
{
  var $modul = "kabupaten";
  var $ch = "Master Kabupaten";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('kabupaten_model','km');
    $this->load->model('provinsi_model','pm');
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
    $list = $this->km->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->kabupaten_kode;
      $row[] = strtoupper($rw->kabupaten_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->kabupaten_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->kabupaten_id."','".$rw->kabupaten_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->km->count_all(),
      "recordsFiltered" => $this->km->count_filtered($this->input->post()),
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
    $data["pr"] = "<a href=\"".site_url("provinsi/tambah_data")."\" class=\"btn btn-primary btn-sm\">Tambah Provinsi</a>
    <a href=\"".site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List ".ucfirst($this->modul)."</a>";
    
    $data['res_provinsi'] = $this->pm->get_data()->result();

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
      <a href=\"".site_url("provinsi/tambah_data")."\" class=\"btn btn-primary btn-sm\">Tambah Provinsi</a>
      <a href=\"". site_url($this->modul)."\" class=\"btn btn-primary btn-sm\">List ".ucfirst($this->modul)."</a>";

      $where["kabupaten_id"] = $id;
      $data['res_kabupaten'] = $this->km->get_data($where)->row();
      $data['res_provinsi'] = $this->pm->get_data()->result();
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

      $where["kabupaten_id"] = $id;
      $this->km->delete_data($where);

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
    $kabupaten_id = $this->input->post('kabupaten_id');
    $kabupaten_kode = $this->input->post('kabupaten_kode');
    $kabupaten_ket = $this->input->post('kabupaten_ket');
    $kabupaten_provinsi = $this->input->post('kabupaten_provinsi');

    $data['kabupaten_kode'] = $kabupaten_kode;
    $data['kabupaten_ket'] = strtoupper($kabupaten_ket);
    $data['kabupaten_provinsi'] = strtoupper($kabupaten_provinsi);

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["kabupaten_insert_date"] = date("Y-m-d H:i:s");
        $this->km->save_data($data);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["kabupaten_update_date"] = date("Y-m-d H:i:s");
        $where["kabupaten_id"] = $kabupaten_id;
        $this->km->update_data($where, $data);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

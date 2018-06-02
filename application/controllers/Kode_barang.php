<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kode_barang extends CI_Controller
{
  var $modul = "kode_barang";
  var $ch = "Master Kode Barang";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('kode_barang_model','kbm');
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
    $list = $this->kbm->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->kode_barang_gol;
      $row[] = $rw->kode_barang_bidang;
      $row[] = $rw->kode_barang_kelompok;
      $row[] = $rw->kode_barang_sub_kelompok;
      $row[] = $rw->kode_barang_sub2_kelompok;
      $row[] = ucwords($rw->kode_barang_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->kode_barang_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->kode_barang_id."','".$rw->kode_barang_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->kbm->count_all(),
      "recordsFiltered" => $this->kbm->count_filtered($this->input->post()),
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

      $where["kode_barang_id"] = $id;
      $data['res_kode_barang'] = $this->kbm->get_data($where)->row();
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

      $where["kode_barang_id"] = $id;
      $this->kbm->delete_data($where);

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
    $kode_barang_id = $this->input->post('kode_barang_id');
    $kode_barang_gol = $this->input->post('kode_barang_gol');
    $kode_barang_bidang = $this->input->post('kode_barang_bidang');
    $kode_barang_kelompok = $this->input->post('kode_barang_kelompok');
    $kode_barang_sub_kelompok = $this->input->post('kode_barang_sub_kelompok');
    $kode_barang_sub2_kelompok = $this->input->post('kode_barang_sub2_kelompok');
    $kode_barang_ket = $this->input->post('kode_barang_ket');

    $data['kode_barang_gol'] = $kode_barang_gol;
    $data['kode_barang_bidang'] = $kode_barang_bidang;
    $data['kode_barang_kelompok'] = $kode_barang_kelompok;
    $data['kode_barang_sub_kelompok'] = $kode_barang_sub_kelompok;
    $data['kode_barang_sub2_kelompok'] = $kode_barang_sub2_kelompok;
    $data['kode_barang_ket'] = strtoupper($kode_barang_ket);

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["kode_barang_insert_date"] = date("Y-m-d H:i:s");
        $this->kbm->save_data($data);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["kode_barang_update_date"] = date("Y-m-d H:i:s");
        $where["kode_barang_id"] = $kode_barang_id;
        $this->kbm->update_data($where, $data);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

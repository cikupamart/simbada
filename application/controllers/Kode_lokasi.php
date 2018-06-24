<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kode_lokasi extends CI_Controller
{
  var $modul = "kode_lokasi";
  var $ch = "Master Kode Lokasi";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('kode_lokasi_model','klm');
    $this->load->model('pemilik_barang_model','pbm');
    $this->load->model('provinsi_model','pm');
    $this->load->model('kabupaten_model','km');
    $this->load->model('bidang_model','bm');
    $this->load->model('unit_bidang_model','ubm');
    $this->load->model('sub_unit_model','sum');
    $this->load->model('ssub_unit_model','subm');
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
    $list = $this->subm->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->ssub_unit_kode;
      $row[] = strtoupper($rw->pb_ket);
      $row[] = strtoupper($rw->provinsi_ket);
      $row[] = strtoupper($rw->kabupaten_ket);
      $row[] = strtoupper($rw->bidang_ket);
      $row[] = strtoupper($rw->unit_bidang_ket);
      $row[] = strtoupper($rw->sub_unit_ket);
      $row[] = strtoupper($rw->ssub_unit_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->kode_lokasi_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->kode_lokasi_id."','".$rw->sub_unit_ket." - ".$rw->ssub_unit_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->subm->count_all(),
      "recordsFiltered" => $this->subm->count_filtered($this->input->post()),
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

    $data["res_sub_unit"] = $this->sum->get_data()->result();

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

      $where["ssub_unit_id"] = $id;
      $data['res_ssub_unit'] = $this->subm->get_data($where)->row();
      $data["res_sub_unit"] = $this->sum->get_data()->result();
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

      $where["ssub_unit_id"] = $id;
      $this->subm->delete_data($where);

      $ssub_unit_ket = $this->mm->get_data(array("ssub_unit_id"=>$id))->row()->ssub_unit_ket;
      $flashdata["msg_hapus"] = "sukses";
      $flashdata["ket"] = strtoupper($ssub_unit_ket);

      redirect($this->modul);
    }
    else
    {
      $ssub_unit_ket = $this->mm->get_data(array("ssub_unit_id"=>$id))->row()->ssub_unit_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($ssub_unit_ket);
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $ssub_unit_id = $this->input->post('ssub_unit_id');
    $ssub_unit_kode = $this->input->post('ssub_unit_kode');
    $ssub_unit_ket = $this->input->post('ssub_unit_ket');
    $ssub_unit_sub_unit = $this->input->post('ssub_unit_sub_unit');

    $data['ssub_unit_kode'] = $ssub_unit_kode;
    $data['ssub_unit_ket'] = strtoupper($ssub_unit_ket);
    $data['ssub_unit_sub_unit'] = $ssub_unit_sub_unit;

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["ssub_unit_insert_date"] = date("Y-m-d H:i:s");
        $this->subm->save_data($data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($ssub_unit_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["ssub_unit_update_date"] = date("Y-m-d H:i:s");
        $where["ssub_unit_id"] = $ssub_unit_id;
        $this->subm->update_data($where, $data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($ssub_unit_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

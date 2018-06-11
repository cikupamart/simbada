<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_barang extends CI_Controller
{
  var $modul = "satuan_barang";
  var $ch = "Master Satuan Barang";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('satuan_barang_model','sbm');
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
    $list = $this->sbm->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->satuan_barang_kode;
      $row[] = strtoupper($rw->satuan_barang_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->satuan_barang_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->satuan_barang_id."','".$rw->satuan_barang_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->sbm->count_all(),
      "recordsFiltered" => $this->sbm->count_filtered($this->input->post()),
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

      $where["satuan_barang_id"] = $id;
      $data['res_satuan_barang'] = $this->sbm->get_data($where)->row();
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

      $where["satuan_barang_id"] = $id;
      $this->sbm->delete_data($where);

      $satuan_barang_ket = $this->mm->get_data(array("satuan_barang_id"=>$id))->row()->satuan_barang_ket;
      $flashdata["msg_hapus"] = "sukses";
      $flashdata["ket"] = strtoupper($satuan_barang_ket);

      redirect($this->modul);
    }
    else
    {
      $satuan_barang_ket = $this->mm->get_data(array("satuan_barang_id"=>$id))->row()->satuan_barang_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($satuan_barang_ket);
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $satuan_barang_id = $this->input->post('satuan_barang_id');
    $satuan_barang_kode = $this->input->post('satuan_barang_kode');
    $satuan_barang_ket = $this->input->post('satuan_barang_ket');

    $data['satuan_barang_kode'] = $satuan_barang_kode;
    $data['satuan_barang_ket'] = strtoupper($satuan_barang_ket);

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["satuan_barang_insert_date"] = date("Y-m-d H:i:s");
        $this->sbm->save_data($data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($satuan_barang_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["satuan_barang_update_date"] = date("Y-m-d H:i:s");
        $where["satuan_barang_id"] = $satuan_barang_id;
        $this->sbm->update_data($where, $data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($satuan_barang_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

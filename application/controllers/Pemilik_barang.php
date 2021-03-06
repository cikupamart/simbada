<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik_barang extends CI_Controller
{
  var $modul = "pemilik_barang";
  var $ch = "Master Pemilik Barang";

  function __construct()
  {
    parent::__construct();
    $this->template->chk_auth();
		$this->template->chk_view($this->modul);
    $this->load->model('pemilik_barang_model','pbm');
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
    $list = $this->pbm->get_datatables($this->input->post());
    $data = array();
    $no = $this->input->post('start');
    foreach ($list as $rw) {
      $no++;
      $row = array();
      $row[] = '<div class="text-center">'.$no.'</div>';
      $row[] = $rw->pb_kode;
      $row[] = strtoupper($rw->pb_ket);
      $row[] = "<div class=\"text-center\">
              <a href=\"".site_url($this->modul."/edit_data/".$rw->pb_id)."\" class=\"btn btn-primary btn-flat btn-xs\">Edit</a>
              <button type=\"button\" title=\"Hapus Data\" class=\"btn btn-primary btn-flat btn-xs\" onClick=\"deleteItem('".$rw->pb_id."','".$rw->pb_ket."');\">Delete</button></div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $this->input->post('draw'),
      "recordsTotal" => $this->pbm->count_all(),
      "recordsFiltered" => $this->pbm->count_filtered($this->input->post()),
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

      $where["pb_id"] = $id;
      $data['res_pb'] = $this->pbm->get_data($where)->row();
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

      $where["pb_id"] = $id;
      $this->pbm->delete_data($where);

      $pb_ket = $this->mm->get_data(array("pb_id"=>$id))->row()->pb_ket;
      $flashdata["msg_hapus"] = "sukses";
      $flashdata["ket"] = strtoupper($pb_ket);

      redirect($this->modul);
    }
    else
    {
      $pb_ket = $this->mm->get_data(array("pb_id"=>$id))->row()->pb_ket;
      $flashdata["msg_hapus"] = "gagal";
      $flashdata["ket"] = strtoupper($pb_ket);
      redirect($this->modul);
    }
  }

  function simpan()
  {
    // var_dump($this->input->post());exit;
    $pb_id = $this->input->post('pb_id');
    $pb_kode = $this->input->post('pb_kode');
    $pb_ket = $this->input->post('pb_ket');

    $data['pb_kode'] = $pb_kode;
    $data['pb_ket'] = strtoupper($pb_ket);

    switch ($this->input->post("simpan"))
    {
      case 'simpan':
        $this->template->chk_insert($this->modul);

        // simpan ke table users
        $data["pb_insert_date"] = date("Y-m-d H:i:s");
        $this->pbm->save_data($data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($pb_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      case 'ubah':
        $this->template->chk_update($this->modul);

        // ubah data table users
        $data["pb_update_date"] = date("Y-m-d H:i:s");
        $where["pb_id"] = $pb_id;
        $this->pbm->update_data($where, $data);

        $flashdata["msg_simpan"] = "sukses";
        $flashdata["ket"] = strtoupper($pb_ket);
        $this->session->set_flashdata($flashdata);

        redirect($this->modul);
        break;

      default:
        redirect($this->modul);
        break;
    }
  }
}

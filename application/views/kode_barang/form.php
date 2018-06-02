<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$kode_barang_id = isset($res_kode_barang) ? $res_kode_barang->kode_barang_id : "";
$kode_barang_gol = isset($res_kode_barang) ? $res_kode_barang->kode_barang_gol : "";
$kode_barang_bidang = isset($res_kode_barang) ? $res_kode_barang->kode_barang_bidang : "";
$kode_barang_kelompok = isset($res_kode_barang) ? $res_kode_barang->kode_barang_kelompok : "";
$kode_barang_sub_kelompok = isset($res_kode_barang) ? $res_kode_barang->kode_barang_sub_kelompok : "";
$kode_barang_sub2_kelompok = isset($res_kode_barang) ? $res_kode_barang->kode_barang_sub2_kelompok : "";
$kode_barang_ket = isset($res_kode_barang) ? $res_kode_barang->kode_barang_ket : "";
$btn = isset($res_kode_barang) ? "ubah" : "simpan";
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo isset($bt) ? $bt : ""; ?></h3>
    <div class="box-tools pull-right">
      <?php echo isset($pr) ? $pr : "";?>
    </div>
  </div>

  <div class="box-body">

    <form class="form-horizontal" action="<?php echo site_url($modul.'/simpan'); ?>" method="post">
      <input type="hidden" name="kode_barang_id" value="<?php echo $kode_barang_id; ?>">
      <div class="form-group">
        <label for="kode_barang_gol" class="control-label col-sm-2">Golongan</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_gol" id="kode_barang_gol" value="<?php echo $kode_barang_gol; ?>" placeholder="Golongan" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kode_barang_bidang" class="control-label col-sm-2">Bidang</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_bidang" id="kode_barang_bidang" value="<?php echo $kode_barang_bidang; ?>" placeholder="Bidang" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kode_barang_kelompok" class="control-label col-sm-2">Kelompok</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_kelompok" id="kode_barang_kelompok" value="<?php echo $kode_barang_kelompok; ?>" placeholder="Kelompok" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kode_barang_sub_kelompok" class="control-label col-sm-2">Sub Kelompok</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_sub_kelompok" id="kode_barang_sub_kelompok" value="<?php echo $kode_barang_sub_kelompok; ?>" placeholder="Sub Kelompok" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kode_barang_sub2_kelompok" class="control-label col-sm-2">Sub Sub Kelompok</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_sub2_kelompok" id="kode_barang_sub2_kelompok" value="<?php echo $kode_barang_sub2_kelompok; ?>" placeholder="Sub Sub Kelompok" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kode_barang_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kode_barang_ket" id="kode_barang_ket" value="<?php echo $kode_barang_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name="simpan" value="<?php echo $btn; ?>" class="btn btn-primary btn-flat">Simpan</button>
        </div>
      </div>
    </form>

  </div>
</div>

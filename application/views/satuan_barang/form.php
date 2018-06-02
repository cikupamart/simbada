<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$satuan_barang_id = isset($res_satuan_barang) ? $res_satuan_barang->satuan_barang_id : "";
$satuan_barang_kode = isset($res_satuan_barang) ? $res_satuan_barang->satuan_barang_kode : "";
$satuan_barang_ket = isset($res_satuan_barang) ? $res_satuan_barang->satuan_barang_ket : "";
$btn = isset($res_satuan_barang) ? "ubah" : "simpan";
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
      <input type="hidden" name="satuan_barang_id" value="<?php echo $satuan_barang_id; ?>">
      <div class="form-group">
        <label for="satuan_barang_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="satuan_barang_kode" id="satuan_barang_kode" value="<?php echo $satuan_barang_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="satuan_barang_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="satuan_barang_ket" id="satuan_barang_ket" value="<?php echo $satuan_barang_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
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

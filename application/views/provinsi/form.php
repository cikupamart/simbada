<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$provinsi_id = isset($res_provinsi) ? $res_provinsi->provinsi_id : "";
$provinsi_kode = isset($res_provinsi) ? $res_provinsi->provinsi_kode : "";
$provinsi_ket = isset($res_provinsi) ? $res_provinsi->provinsi_ket : "";
$btn = isset($res_provinsi) ? "ubah" : "simpan";
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
      <input type="hidden" name="provinsi_id" value="<?php echo $provinsi_id; ?>">
      <div class="form-group">
        <label for="provinsi_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="provinsi_kode" id="provinsi_kode" value="<?php echo $provinsi_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="provinsi_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="provinsi_ket" id="provinsi_ket" value="<?php echo $provinsi_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
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

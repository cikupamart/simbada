<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$kabupaten_id = isset($res_kabupaten) ? $res_kabupaten->kabupaten_id : "";
$kabupaten_kode = isset($res_kabupaten) ? $res_kabupaten->kabupaten_kode : "";
$kabupaten_ket = isset($res_kabupaten) ? $res_kabupaten->kabupaten_ket : "";
$kabupaten_provinsi = isset($res_kabupaten) ? $res_kabupaten->kabupaten_provinsi : "";
$btn = isset($res_kabupaten) ? "ubah" : "simpan";
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
      <input type="hidden" name="kabupaten_id" value="<?php echo $kabupaten_id; ?>">
      <div class="form-group">
        <label for="kabupaten_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kabupaten_kode" id="kabupaten_kode" value="<?php echo $kabupaten_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kabupaten_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="kabupaten_ket" id="kabupaten_ket" value="<?php echo $kabupaten_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="kabupaten_provinsi" class="control-label col-sm-2">Provinsi</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <select class="form-control" name="kabupaten_provinsi">
                <option value="">Pilih Provinsi</option>
                <?php
                if ($res_provinsi != NULL)
                {
                  foreach ($res_provinsi as $val_provinsi)
                  {
                    $sel_provinsi = $val_provinsi->provinsi_id == $kabupaten_provinsi ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_provinsi->provinsi_id; ?>" <?php echo $sel_provinsi; ?>><?php echo strtoupper($val_provinsi->provinsi_ket); ?></option>
                    <?php
                  }
                }
                ?>
              </select>
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

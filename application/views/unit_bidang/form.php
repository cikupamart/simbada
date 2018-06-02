<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$unit_bidang_id = isset($res_unit_bidang) ? $res_unit_bidang->unit_bidang_id : "";
$unit_bidang_kode = isset($res_unit_bidang) ? $res_unit_bidang->unit_bidang_kode : "";
$unit_bidang_ket = isset($res_unit_bidang) ? $res_unit_bidang->unit_bidang_ket : "";
$unit_bidang_bidang = isset($res_unit_bidang) ? $res_unit_bidang->unit_bidang_bidang : "";
$btn = isset($res_unit_bidang) ? "ubah" : "simpan";
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
      <input type="hidden" name="unit_bidang_id" value="<?php echo $unit_bidang_id; ?>">
      <div class="form-group">
        <label for="unit_bidang_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="unit_bidang_kode" id="unit_bidang_kode" value="<?php echo $unit_bidang_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="unit_bidang_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="unit_bidang_ket" id="unit_bidang_ket" value="<?php echo $unit_bidang_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="unit_bidang_bidang" class="control-label col-sm-2">Bidang</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <select class="form-control" name="unit_bidang_bidang">
                <option value="">Pilih Bidang</option>
                <?php
                if ($res_bidang != NULL)
                {
                  foreach ($res_bidang as $val_bidang)
                  {
                    $sel_bidang = $val_bidang->bidang_id == $unit_bidang_bidang ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_bidang->bidang_id; ?>" <?php echo $sel_bidang; ?>><?php echo strtoupper($val_bidang->bidang_ket); ?></option>
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

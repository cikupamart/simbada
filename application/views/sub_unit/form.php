<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$sub_unit_id = isset($res_sub_unit) ? $res_sub_unit->sub_unit_id : "";
$sub_unit_kode = isset($res_sub_unit) ? $res_sub_unit->sub_unit_kode : "";
$sub_unit_ket = isset($res_sub_unit) ? $res_sub_unit->sub_unit_ket : "";
$sub_unit_unit = isset($res_sub_unit) ? $res_sub_unit->sub_unit_unit : "";
$btn = isset($res_sub_unit) ? "ubah" : "simpan";
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
      <input type="hidden" name="sub_unit_id" value="<?php echo $sub_unit_id; ?>">
      <div class="form-group">
        <label for="sub_unit_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="sub_unit_kode" id="sub_unit_kode" value="<?php echo $sub_unit_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="sub_unit_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="sub_unit_ket" id="sub_unit_ket" value="<?php echo $sub_unit_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="sub_unit_unit" class="control-label col-sm-2">Unit</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <select class="form-control" name="sub_unit_unit">
                <option value="">Pilih Unit</option>
                <?php
                if ($res_unit_bidang != NULL)
                {
                  foreach ($res_unit_bidang as $val_unit_bidang)
                  {
                    $sel_unit_bidang = $val_unit_bidang->unit_bidang_id == $sub_unit_unit ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_unit_bidang->unit_bidang_id; ?>" <?php echo $sel_unit_bidang; ?>><?php echo strtoupper($val_unit_bidang->unit_bidang_ket); ?></option>
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

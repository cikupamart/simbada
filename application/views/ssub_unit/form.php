<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ssub_unit_id = isset($res_ssub_unit) ? $res_ssub_unit->ssub_unit_id : "";
$ssub_unit_kode = isset($res_ssub_unit) ? $res_ssub_unit->ssub_unit_kode : "";
$ssub_unit_ket = isset($res_ssub_unit) ? $res_ssub_unit->ssub_unit_ket : "";
$ssub_unit_sub_unit = isset($res_ssub_unit) ? $res_ssub_unit->ssub_unit_sub_unit : "";
$btn = isset($res_ssub_unit) ? "ubah" : "simpan";
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
      <input type="hidden" name="ssub_unit_id" value="<?php echo $ssub_unit_id; ?>">
      <div class="form-group">
        <label for="ssub_unit_kode" class="control-label col-sm-2">Kode</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="ssub_unit_kode" id="ssub_unit_kode" value="<?php echo $ssub_unit_kode; ?>" placeholder="Kode" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="ssub_unit_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="ssub_unit_ket" id="ssub_unit_ket" value="<?php echo $ssub_unit_ket; ?>" placeholder="Ket" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="ssub_unit_sub_unit" class="control-label col-sm-2">Sub Unit</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <select class="form-control" name="ssub_unit_sub_unit">
                <option value="">Pilih Sub Unit</option>
                <?php
                if ($res_sub_unit != NULL)
                {
                  foreach ($res_sub_unit as $val_sub_unit)
                  {
                    $sel_unit_bidang = $val_sub_unit->sub_unit_id == $ssub_unit_sub_unit ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_sub_unit->sub_unit_id; ?>" <?php echo $sel_unit_bidang; ?>><?php echo strtoupper($val_sub_unit->sub_unit_ket); ?></option>
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

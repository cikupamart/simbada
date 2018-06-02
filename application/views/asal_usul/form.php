<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$asal_usul_id = isset($res_asal_usul) ? $res_asal_usul->asal_usul_id : "";
$asal_usul_ket = isset($res_asal_usul) ? $res_asal_usul->asal_usul_ket : "";
$btn = isset($res_asal_usul) ? "ubah" : "simpan";
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
      <input type="hidden" name="asal_usul_id" value="<?php echo $asal_usul_id; ?>">
      <div class="form-group">
        <label for="asal_usul_ket" class="control-label col-sm-2">Ket</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="asal_usul_ket" id="asal_usul_ket" value="<?php echo $asal_usul_ket; ?>" placeholder="Ket" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
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

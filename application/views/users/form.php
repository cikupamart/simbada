<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user_id = isset($res_users) ? $res_users->user_id : "";
$user_username = isset($res_users) ? $res_users->user_username : "";
$user_nama = isset($res_users) ? $res_users->user_nama : "";
$user_nip = isset($res_users) ? $res_users->user_nip : "";
$user_email = isset($res_users) ? $res_users->user_email : "";
$user_ur = isset($res_users) ? $res_users->user_ur : "";
$user_lokasi = isset($res_users) ? $res_users->user_lokasi : "";
$user_active = isset($res_users) ? $res_users->user_active : "";
$btn = isset($res_users) ? "ubah" : "simpan";
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
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <div class="form-group">
        <label for="user_username" class="control-label col-sm-2">Username</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="user_username" id="user_username" value="<?php echo $user_username; ?>" placeholder="Username" class="form-control" autofocus="autofocus" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <?php
      if ( ! isset($res_users))
      {
        ?>
        <div class="form-group">
          <label for="user_password" class="control-label col-sm-2">Password</label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-4">
                <input type="password" name="user_password" id="user_password" placeholder="Password" class="form-control" required="required">
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>

      <div class="form-group">
        <label for="user_nama" class="control-label col-sm-2">Nama</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="text" name="user_nama" id="user_nama" value="<?php echo $user_nama; ?>" placeholder="Nama" class="form-control" required="required" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="user_nip" class="control-label col-sm-2">NIP</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3">
              <input type="text" name="user_nip" id="user_nip" value="<?php echo $user_nip; ?>" placeholder="NIP" class="form-control" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="user_email" class="control-label col-sm-2">Email</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-4">
              <input type="email" name="user_email" id="user_email" value="<?php echo $user_email; ?>" placeholder="Email" class="form-control" autocomplete="off">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="user_ur" class="control-label col-sm-2">Role</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-2">
              <select class="form-control" name="user_ur">
                <option value="">Pilih Role</option>
                <?php
                if ( ! empty($res_ur))
                {
                  foreach ($res_ur as $val_ur)
                  {
                    $sel_ur = $val_ur->ur_id == $user_ur ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_ur->ur_id; ?>" <?php echo $sel_ur; ?>> <?php echo strtoupper($val_ur->ur_ket); ?></option>
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
        <label for="user_lokasi" class="control-label col-sm-2">Lokasi</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-2">
              <select class="form-control" name="user_lokasi">
                <option value="">Pilih Lokasi</option>
                <?php
                if ( ! empty($res_lokasi))
                {
                  foreach ($res_lokasi as $val_lokasi)
                  {
                    $sel_lokasi = $val_lokasi->lokasi_id == $user_lokasi ? "selected=\"selected\"" : "";
                    ?>
                    <option value="<?php echo $val_lokasi->lokasi_id; ?>" <?php echo $sel_lokasi; ?>> <?php echo strtoupper($val_lokasi->lokasi_ket); ?></option>
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
        <label for="user_active" class="control-label col-sm-2">Status</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-2">
              <select class="form-control" name="user_active">
                <option value="">Pilih Status</option>
                <option value="1" <?php echo ($user_active == 1) ? "selected=\"selected\"" : ""; ?>>Aktif</option>
                <option value="0" <?php echo ($user_active == 0) ? "selected=\"selected\"" : ""; ?>>Tidak Aktif</option>
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

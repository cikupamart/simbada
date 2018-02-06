<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo isset($bt) ? $bt : ""; ?></h3>
    <div class="box-tools pull-right">
      <?php echo isset($pr) ? $pr : "";?>
    </div>
  </div>
  <div class="box-body">
    <form class="form-horizontal" action="<?php echo site_url("auth/simpan"); ?>" method="post">
      <div class="form-group">
        <label for="txt_password_old" class="col-sm-2 control-label">Password Lama</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-md-4">
              <input type="password" name="txt_password_old" id="txt_password_old" class="form-control" autofocus="autofocus">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="txt_password_new" class="col-sm-2 control-label">Password Baru</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-md-4">
              <input type="password" name="txt_password_new" id="txt_password_new" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name="simpan" value="ubah_password" class="btn btn-primary btn-flat">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
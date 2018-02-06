<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$menu_id = isset($res_menu) ? $res_menu->id : "";
$menu_ket = isset($res_menu) ? $res_menu->menu_ket : "";
$menu_parent = isset($res_menu) ? $res_menu->menu_parent : "";
$menu_url = isset($res_menu) ? $res_menu->menu_url : "";
$menu_order = isset($res_menu) ? $res_menu->menu_order : "";
$btn = isset($res_menu) ? "ubah" : "simpan";
?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo isset($bt) ? $bt : ""; ?></h3>
        <div class="box-tools pull-right">
                <?php echo isset($pr) ? $pr : "";?>
        </div>
    </div>
    <div class="box-body">

<form class="form-horizontal" action="<?php echo site_url('mt_menu/simpan'); ?>" method="post">
    <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>">
    <div class="form-group">
        <label for="menu_ket" class="control-label col-sm-2">Menu Ket</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" name="menu_ket" id="menu_ket" value="<?php echo $menu_ket; ?>" placeholder="Menu Ket" class="form-control" autofocus="autofocus" required="required">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="menu_parent" class="control-label col-sm-2">Parent</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" name="menu_parent" id="menu_parent">
                        <option value="0">Pilih Parent</option>
                        <?php
                        if ($res_menu_child !== FALSE)
                        {
                            foreach ($res_menu_child as $val_menu_child)
                            {
                                $sel_mc = $val_menu_child->menu_id == $menu_parent ? "selected=\"selected\"" : "";
                                ?>
                                <option value="<?php echo $val_menu_child->id; ?>" <?php echo $sel_mc; ?>><?php echo ucwords($val_menu_child->menu_ket); ?></option>
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
        <label for="menu_url" class="control-label col-sm-2">URL</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" name="menu_url" id="menu_url" value="<?php echo $menu_url; ?>" placeholder="URL" class="form-control" required="required">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="menu_order" class="control-label col-sm-2">Order</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" name="menu_order" id="menu_order" value="<?php echo $menu_order; ?>" placeholder="Order" class="form-control" required="required">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Hak Akses</label>
        <div class="col-sm-10">
            <table class="table table-striped table-hover">
                <tr>
                    <th>User Role</th>
                    <th><input type="checkbox" id="chk-all-view"> View</th>
                    <th><input type="checkbox" id="chk-all-insert"> Insert</th>
                    <th><input type="checkbox" id="chk-all-update"> Update</th>
                    <th><input type="checkbox" id="chk-all-delete"> Delete</th>
                </tr>
                <?php
                if ($res_ur !== FALSE)
                {
                    foreach ($res_ur as $val_ur)
                    {
                        $row_ha = 0;
                        if (isset($res_menu))
                        {
                            $sql_ha = "SELECT * FROM hak_akses WHERE ha_menu = ".$menu_id." AND ha_ur = ".$val_ur->level_id;

                            $qry_ha = $this->db->query($sql_ha);
                            $row_ha = $qry_ha->num_rows() > 0 ? $qry_ha->row() : 0;
                        }

                        $ha_view = $row_ha !== 0 ? $row_ha->ha_view : 0;
                        $ha_insert = $row_ha !== 0 ? $row_ha->ha_insert : 0;
                        $ha_update = $row_ha !== 0 ? $row_ha->ha_update : 0;
                        $ha_delete = $row_ha !== 0 ? $row_ha->ha_delete : 0;
                        $ha_proses = $row_ha !== 0 ? $row_ha->ha_proses : 0;

                        $checked_view = $ha_view === "1" ? "checked=\"checked\"" : "";
                        $checked_insert = $ha_insert === "1" ? "checked=\"checked\"" : "";
                        $checked_update = $ha_update === "1" ? "checked=\"checked\"" : "";
                        $checked_delete = $ha_delete === "1" ? "checked=\"checked\"" : "";
                        $checked_proses = $ha_proses === "1" ? "checked=\"checked\"" : "";
                        ?>
                        <tr>
                            <td><?php echo ucwords($val_ur->ur_ket); ?></td>
                            <td><input type="checkbox" name="chk_view[<?php echo $val_ur->id; ?>]" class="view" value="1" <?php echo $checked_view; ?>></td>
                            <td><input type="checkbox" name="chk_insert[<?php echo $val_ur->id; ?>]" class="insert" value="1" <?php echo $checked_insert; ?>></td>
                            <td><input type="checkbox" name="chk_update[<?php echo $val_ur->id; ?>]" class="update" value="1" <?php echo $checked_update; ?>></td>
                            <td><input type="checkbox" name="chk_delete[<?php echo $val_ur->id; ?>]" class="delete" value="1" <?php echo $checked_delete; ?>></td>
                            <input type="hidden" name="level_id[<?php echo $val_ur->id; ?>]" value="<?php echo $val_ur->id; ?>" <?php echo $checked_view; ?>>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <div class="form-group">
        <label for="" class="control-label col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="simpan" value="<?php echo $btn; ?>" class="btn btn-primary btn-flat">Simpan</button>
        </div>
    </div>
</form>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //check all
        $("#chk-all-view").click(function () {
            $(".view").prop('checked', $(this).prop('checked'));
        });
        $("#chk-all-insert").click(function () {
            $(".insert").prop('checked', $(this).prop('checked'));
        });
        $("#chk-all-update").click(function () {
            $(".update").prop('checked', $(this).prop('checked'));
        });
        $("#chk-all-delete").click(function () {
            $(".delete").prop('checked', $(this).prop('checked'));
        });
    });
</script>

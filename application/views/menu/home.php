<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo isset($bt) ? $bt : ""; ?></h3>
        <div class="box-tools pull-right">
                <?php echo isset($pr) ? $pr : "";?>
        </div>
    </div>
    <div class="box-body">

        <?php
        if ( ! is_null($this->session->flashdata('msg_simpan')) AND $this->session->flashdata('msg_simpan') == "sukses")
        {
          ?>
          <div class="alert alert-success" id="success-alert" role="alert">Data <?php echo $this->session->flashdata('ket'); ?> berhasil disimpan</div>
          <?php
        }

        if ( ! is_null($this->session->flashdata('msg_hapus')) || $this->session->flashdata('msg_hapus') == "sukses")
        {
          ?>
          <div class="alert alert-warning" id="success-alert" role="alert">Data <?php echo $this->session->flashdata('ket'); ?> berhasil dihapus</div>
          <?php
        }
        else if ( ! is_null($this->session->flashdata('msg_hapus')) || $this->session->flashdata('msg_hapus') == "gagal")
        {
          ?>
          <div class="alert alert-warning" id="success-alert" role="alert">Data <?php echo $this->session->flashdata('ket'); ?> gagal dihapus</div>
          <?php
        }
        ?>

        <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Menu Ket</th>
                    <th class="text-center">Menu Parent</th>
                    <th class="text-center">Menu URL</th>
                    <th class="text-center">Menu Order</th>
                    <th class="text-center" style="width:150px;">Action</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    //datatables
    var table = $('#table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url($modul.'/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],

    });

    //check all
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });

    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });
});

function deleteItem(i,a)
{
    if (confirm("Anda yakin menghapus data "+a+"?"))
    {
        window.location = "<?php echo site_url($modul.'/hapus_data/'); ?>"+i;
    }
    return false;
}

function reload_table()
{
    $('#table').DataTable().ajax.reload(); //reload datatable ajax
}
</script>

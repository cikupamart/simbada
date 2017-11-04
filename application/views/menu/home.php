<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo isset($bt) ? $bt : ""; ?></h3>
        <div class="box-tools pull-right">
                <?php echo isset($pr) ? $pr : "";?>
        </div>
    </div>
    <div class="box-body">

<table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Menu Ket</th>
            <th>Menu Parent</th>
            <th>Menu URL</th>
            <th>Menu Order</th>
            <th style="width:150px;">Action</th>
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
    table.ajax.reload(null,false); //reload datatable ajax
}
</script>

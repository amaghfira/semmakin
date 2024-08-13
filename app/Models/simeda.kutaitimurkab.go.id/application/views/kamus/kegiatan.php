<div class="box box-body">
    <table class="table" id="main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Kegiatan</th>
                <th>Nama Instansi</th>
                <th>Wilayah</th>
                <th>Tahun</th>
                <th>Approval</th>
            </tr>
        </thead>
        <tbody>
<?php
$no=1;
foreach($this->mskegiatan_model->all() as $row){
    echo "<tr key='".$row->id_ms_keg."'>".
    "<td>".($no++)."</td>".
    "<td>".$row->judul_kegiatan."</td>".
    "<td>".$row->instansi."</td>".
    "<td>".$row->id_wilayah."</td>".
    "<td>".$row->tahun."</td>".
    "<td>".(substr($row->approval_on,0,4)=='0000'?'':'1')."</td>".
    "</tr>\n";
}
?>
        </tbody>
    </table>
</div>


<style>
    tbody tr:hover {background:#ccc;};
    tbody tr td:last-child {text-align:center; color:darkgreen};
</style>

<!-- <link rel="stylesheet/css" href="<?=base_url('assets/datatables/datatables.min.css');?>">
<script src="<?=base_url('assets/datatables/datatables.min.js');?>"></script>
-->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script>
$('#main-table').DataTable({buttons: ['copy', 'csv', 'excel', 'pdf', 'print']});
<?php if($this->session->userdata('role')==2 && substr($this->session->userdata('id_wilayah'),2,2)=='00') { ?>
$('tbody tr').each(function(){
    var key = $(this).attr('key');
    var td = $(this).find('td:nth-child(2)');
    td.html('<a href="<?=base_url('v_kegiatan/edit/');?>'+key+'">'+td.text()+'</a>');
});
<?php } ?>
</script>

<!--<?php // print_r($this->session->userdata());?> -->
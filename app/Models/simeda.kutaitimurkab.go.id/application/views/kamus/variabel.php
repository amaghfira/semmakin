<div class="box box-body">
    <table class="table" id="main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Variabel</th>
                <th>Konsep</th>
                <th>Definisi</th>
                <th>Tipe Data</th>
                <th>Judul Kegiatan</th>
<?php if($this->session->userdata('role')>=9) { ?>
                <th>Cek</th>
                <th>Umum</th>
<?php } ?>
            </tr>
        </thead>
        <tbody>
<?php
$i = 1;
foreach($this->mskegiatan_model->get_all_variabel() as $row){
    echo '<tr><td>'.($i++).'</td>'.
    '<td>'.$row->nama_variabel.'</td>'.
    '<td>'.$row->konsep.'</td>'.
    '<td>'.$row->definisi.'</td>'.
    '<td>'.$row->tipe_data.'</td>'.
    '<td>'.$row->id_wilayah.' - '.$row->judul_kegiatan.'</td>'.
    ($this->session->userdata('role')<9? '' : 
    '<td>'.$row->checklist.'</td>'.
    '<td>'.substr($row->dapat_diakses_umum,2).'</td>').
    '</tr>';
}
?>
        </tbody>
    </table>
</div>

<i>*) Hanya ditampilkan variabel yang dapat diakses umum dan telah mendapat approval checklist</i>

<style>
#main-table thead th {position: sticky; top: 0}
</style>

<link rel="stylesheet/css" href="<?=base_url('assets/datatables/datatables.min.css');?>">
<script src="<?=base_url('assets/datatables/datatables.min.js');?>"></script>
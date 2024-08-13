<div class="box box-body">
    <table class="table" id="main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Indikator</th>
                <th>Konsep</th>
                <th>Definisi</th>
                <th>Satuan</th>
                <th>Judul Kegiatan</th>
            </tr>
        </thead>
        <tbody>
<?php
$i = 1;
foreach($this->mskegiatan_model->get_all_indikator() as $row){
    echo '<tr><td>'.($i++).'</td>'.
    '<td>'.$row->nama_indikator.'</td>'.
    '<td>'.$row->konsep.'</td>'.
    '<td>'.$row->definisi.'</td>'.
    '<td>'.$row->satuan.'</td>'.
    '<td>'.$row->id_wilayah.' - '.$row->judul_kegiatan.'</td>'.
    '</tr>';
}
?>
        </tbody>
    </table>
</div>

<i>*) Hanya ditampilkan indikator yang dapat diakses umum dan telah mendapat approval checklist</i>

<link rel="stylesheet/css" href="<?=base_url('assets/datatables/datatables.min.css');?>">
<script src="<?=base_url('assets/datatables/datatables.min.js');?>"></script>
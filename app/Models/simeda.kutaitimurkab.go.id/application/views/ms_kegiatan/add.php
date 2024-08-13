<form method="post">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-10">
				<label>Judul Kegiatan</label>
				<input class="form-control" name="input[judul_kegiatan]" required>
			</div>
			<div class="col-sm-2">
				<label>Tahun</label>
				<input class="form-control" name="input[tahun]" required>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>Kode Kegiatan (diisi oleh petugas)</label>
				<input class="form-control" disabled="">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Cara Pengumpulan Data</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" name="input[cara_pengumpulan_data]" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Pencacahan Lengkap <span class="pull-right">- 1</span></li>
				<li>Survei <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-5">
				<li>Kompilasi Produk Administrasi <span class="pull-right">- 3</span></li>
				<li>Cara Lain Sesuai Perkembangan TI <span class="pull-right">- 4</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Sektor Kegiatan</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" name="input[sektor_kegiatan]" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Pertanian dan Perikanan<span class="pull-right">- 1</span></li>
				<li>Demografi dan Kependudukan<span class="pull-right">- 2</span></li>
				<li>Pembangunan<span class="pull-right">- 3</span></li>
				<li>Proyeksi Ekonomi<span class="pull-right">- 4</span></li>
				<li>Pendidikan dan Pelatihan<span class="pull-right">- 5</span></li>
				<li>Lingkungan<span class="pull-right">- 6</span></li>
				<li>Keuangan<span class="pull-right">- 7</span></li>
				<li>Globalisasi<span class="pull-right">- 8</span></li>
				<li>Kesehatan<span class="pull-right">- 9</span></li>
				<li>Industri dan Jasa<span class="pull-right">- 10</span></li>
				<li>Teknologi Informasi dan Komunikasi<span class="pull-right">- 11</span></li>
			</div>
			<div class="col-sm-5">
				<li>Perdagangan Internasional dan Neraca Perdagangan<span class="pull-right">- 12</span></li>
				<li>Ketenagakerjaan<span class="pull-right">- 13</span></li>
				<li>Neraca Nasional<span class="pull-right">- 14</span></li>
				<li>Indikator Ekonomi Bulanan<span class="pull-right">- 15</span></li>
				<li>Produktivitas<span class="pull-right">- 16</span></li>
				<li>Harga dan Paritas Daya Beli<span class="pull-right">- 17</span></li>
				<li>Sektor Publik, Perpajakan, dan Regulasi Pasar<span class="pull-right">- 18</span></li>
				<li>Perwilayahan dan Perkotaan<span class="pull-right">- 19</span></li>
				<li>Ilmu Pengetahuan dan Hak Paten<span class="pull-right">- 20</span></li>
				<li>Perlindungan Sosial dan Kesejahteraan<span class="pull-right">- 21</span></li>
				<li>Transportasi<span class="pull-right">- 22</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Jika survei statistik sektoral, apakah mendapatkan rekomendasi kegiatan statistik dari BPS?</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" name="input[apakah_mendapat_rekomendasi]" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Ya <span class="pull-right">- 1</span></li>
				<li>Tidak <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-12">
				Jika Ya, Identitas Rekomendasi
				<input class="form-control" name="input[identitas_rekomendasi]">
			</div>
		</div>
	</div>

</div>

<!-- Pagination -->
<div class="col-sm-2">
</div>
<div class="col-sm-8" style="text-align: center">
</div>
<div class="col-sm-2">
	<button class="btn btn-primary btn-sm btn-flat pull-right" name="next" value="next">Selanjutnya <i class="fa fa-chevron-right"></i></button>
</div>
<!-- Pagination -->

</div>
</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>
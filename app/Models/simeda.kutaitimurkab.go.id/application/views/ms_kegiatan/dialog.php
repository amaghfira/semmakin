<input type="hidden" id="blok">
<input type="hidden" id="field">
<div class="row">
	<label>Hasil Pemeriksaan</label>
	<select class="form-control" id="approval" disabled>
		<option value=''>- Belum Approval -</option>
		<option value='1'>Terisi, sesuai</option>
		<option value='2'>Terisi, tidak sesuai</option>
		<option value='3'>Tidak terisi</option>
	</select>
</div>
<div class="row">
	<label>Feedback BPS</label>
	<textarea id="feedback" class="form-control" rows="4" disabled></textarea>
</div>
<div class="row">
	<label>Feedback Walidata</label>
	<textarea id="feedback_2" class="form-control" rows="4" disabled></textarea>
</div>
<div class="row">
	<label>Respon OPD</label>
	<textarea id="respon" class="form-control" rows="4" required></textarea>
</div>
<div class="row">
	<button id="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
</div>

<input type="hidden" id="blok">
<input type="hidden" id="field">
<div class="row">
	<label>Hasil Pemeriksaan</label>
	<div class="radio">
		<label>
	    	<input type="radio" name="approval" id="approval_1" value="1">
			Terisi, sesuai
	    </label>
	</div>
	<div class="radio">
		<label>
	    	<input type="radio" name="approval" id="approval_2" value="2">
			Terisi, tidak sesuai
	    </label>
	</div>
	<div class="radio">
		<label>
	    	<input type="radio" name="approval" id="approval_3" value="3"> 
			Tidak terisi
	    </label>
	</div>
</div>
<div class="row">
	<label>Feedback BPS</label>
	<textarea id="feedback" class="form-control" rows="4" required></textarea>
</div>
<div class="row">
	<label>Feedback Walidata</label>
	<textarea id="feedback_2" class="form-control" rows="4" required></textarea>
</div>
<div class="row">
	<label>Respon OPD</label>
	<textarea id="respon" class="form-control" rows="4" disabled></textarea>
</div>
<div class="row">
	<button id="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
</div>

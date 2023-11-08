<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Entri P3KE</h5>
                <form class="hidden">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun" aria-describedby="emailHelp" required>
                        <div id="tahunHelp" class="form-text">contoh: 2022</div>
                    </div>
                    <div class="mb-3">
                        <label for="prov" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="prov" required>
                        <div id="provHelp" class="form-text">Contoh: Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="kab" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" id="kab" required>
                        <div id="kabHelp" class="form-text">Contoh: Kutai Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="kec" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kec" required>
                        <div id="kecHelp" class="form-text">Contoh: Sangatta</div>
                    </div>
                    <div class="mb-3">
                        <label for="desa" class="form-label">Desa/Kelurahan</label>
                        <input type="text" class="form-control" id="desa" required>
                        <div id="desaHelp" class="form-text">Contoh: Sangatta Utara</div>
                    </div>
                    <div class="mb-3">
                        <label for="desil" class="form-label">Desil</label>
                        <select name="desil" id="desil" class="form-control form-select" required>
                            <option value="" selected>Pilih Desil...</option>
                            <?php foreach ($desil as $d) : ?>
                                <option value="<?= $d['value'] ?>"><?= $d['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kk" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control" id="kk" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="padan_dukcapil" class="form-label">padan dukcapil</label>
                        <select name="padan_dukcapil" id="padan_dukcapil" class="form-control form-select" required>
                            <option value="" selected>Pilih Isian...</option>
                            <?php foreach ($padan as $p) : ?>
                                <option value="<?= $p['value'] ?>"><?= $p['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jk">
                        <div id="jkHelp" class="form-text">Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tgl_lahir">
                        <div id="tgl_lahirHelp" class="form-text">Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan">
                        <div id="pekerjaanHelp" class="form-text">Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <input type="text" class="form-control" id="pendidikan">
                        <div id="pendidikanHelp" class="form-text">Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="rumah" class="form-label">Kepemilikan Rumah</label>
                        <select name="rumah" id="rumah" class="form-control form-select">
                            <option value="1">Milik Sendiri</option>
                            <option value="2">Menumpang</option>
                            <option value="3">Dinas</option>
                            <option value="4">Kontrak/Sewa</option>
                            <option value="5">Bebas Sewa</option>
                            <option value="6">Lainnya</option>
                        </select>
                        <div id="rumahHelp" class="form-text">Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="simpanan" class="form-label">Memiliki Simpanan Uang/Perhiasan/Ternak/Lainnya</label>
                        <select name="simpanan" id="simpanan" class="form-control form-select">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Saya yakin data yang diisikan sudah benar dan dapat dipertanggung jawabkan.</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
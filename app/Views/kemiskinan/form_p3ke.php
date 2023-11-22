<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Entri P3KE</h5>
                <form action="<?= base_url(); ?>/FormController/insert" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" aria-describedby="emailHelp" required>
                        <div id="tahunHelp" class="form-text">contoh: 2022</div>
                    </div>
                    <div class="mb-3">
                        <label for="prov" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="prov" name="prov" required>
                        <div id="provHelp" class="form-text">Contoh: Kalimantan Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="kab" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" id="kab" name="kab" required>
                        <div id="kabHelp" class="form-text">Contoh: Kutai Timur</div>
                    </div>
                    <div class="mb-3">
                        <label for="kec" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kec" name="kec" required>
                        <div id="kecHelp" class="form-text">Contoh: Sangatta</div>
                    </div>
                    <div class="mb-3">
                        <label for="desa" class="form-label">Desa/Kelurahan</label>
                        <input type="text" class="form-control" id="desa" name="desa" required>
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
                        <textarea name="alamat" id="alamat" cols="20" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kk" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control" id="kk" name="kk" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="padan_dukcapil" class="form-label">Padan Dukcapil</label>
                        <select name="padan_dukcapil" id="padan_dukcapil" class="form-control form-select" required>
                            <option value="" selected>Pilih Isian...</option>
                            <?php foreach ($padan as $p) : ?>
                                <option value="<?= $p['value'] ?>"><?= $p['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control form-select" required>
                            <option value="" selected>Pilih Isian...</option>
                            <?php foreach ($jk as $j) : ?>
                                <option value="<?= $j['value'] ?>"><?= $j['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir">
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <select name="pekerjaan" id="pekerjaan" class="form-control form-select" required>
                            <option value="" selected>Pilih Pekerjaan...</option>
                            <?php foreach ($pekerjaan as $p) : ?>
                                <option value="<?= $p['value'] ?>"><?= $p['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <select name="pendidikan" id="pendidikan" class="form-control form-select" required>
                            <option value="" selected>Pilih Isian...</option>
                            <?php foreach ($pendidikan as $pd) : ?>
                                <option value="<?= $pd['value'] ?>"><?= $pd['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rumah" class="form-label">Kepemilikan Rumah</label>
                        <select name="rumah" id="rumah" class="form-control form-select" required>
                            <option value="" selected>Pilih Jenis Kepemilikan...</option>
                            <?php foreach ($rumah as $r) : ?>
                                <option value="<?= $r['value'] ?>"><?= $r['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="simpanan" class="form-label">Memiliki Simpanan Uang/Perhiasan/Ternak/Lainnya</label>
                        <select name="simpanan" id="simpanan" class="form-control form-select" required>
                            <option value="" selected>Pilih Isian...</option>
                            <?php foreach ($simpanan as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="atap" class="form-label">Jenis Atap</label>
                        <select name="atap" id="atap" class="form-control form-select" required>
                            <option value="" selected>Pilih Jenis Atap...</option>
                            <?php foreach ($atap as $a) : ?>
                                <option value="<?= $a['value'] ?>"><?= $a['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dinding" class="form-label">Jenis Dinding</label>
                        <select name="dinding" id="dinding" class="form-control form-select" required>
                            <option value="" selected>Pilih jenis dinding...</option>
                            <?php foreach ($dinding as $d) : ?>
                                <option value="<?= $d['value'] ?>"><?= $d['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lantai" class="form-label">Jenis Lantai</label>
                        <select name="lantai" id="lantai" class="form-control form-select" required>
                            <option value="" selected>Pilih jenis lantai...</option>
                            <?php foreach ($lantai as $l) : ?>
                                <option value="<?= $l['value'] ?>"><?= $l['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="penerangan" class="form-label">Jenis Penerangan</label>
                        <select name="penerangan" id="penerangan" class="form-control form-select" required>
                            <option value="" selected>Pilih jenis penerangan...</option>
                            <?php foreach ($penerangan as $p) : ?>
                                <option value="<?= $p['value'] ?>"><?= $p['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bahanbakar" class="form-label">Jenis Bahan Bakar</label>
                        <select name="bahanbakar" id="bahanbakar" class="form-control form-select" required>
                            <option value="" selected>Pilih jenis bahan bakar...</option>
                            <?php foreach ($bahanbakar as $bb) : ?>
                                <option value="<?= $bb['value'] ?>"><?= $bb['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="airminum" class="form-label">Jenis Air Minum</label>
                        <select name="airminum" id="airminum" class="form-control form-select" required>
                            <option value="" selected>Pilih air minum...</option>
                            <?php foreach ($airminum as $a) : ?>
                                <option value="<?= $a['value'] ?>"><?= $a['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bab" class="form-label">Jenis BAB</label>
                        <select name="bab" id="bab" class="form-control form-select" required>
                            <option value="" selected>Pilih jenis...</option>
                            <?php foreach ($bab as $b) : ?>
                                <option value="<?= $b['value'] ?>"><?= $b['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bnpt" class="form-label">Apakah menerima BNPT?</label>
                        <select name="bnpt" id="bnpt" class="form-control form-select" required>
                            <option value="" selected>Pilih jawaban...</option>
                            <?php foreach ($bnpt as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bpum" class="form-label">Apakah menerima BPUM?</label>
                        <select name="bpum" id="bpum" class="form-control form-select" required>
                            <option value="" selected>Pilih jawaban...</option>
                            <?php foreach ($bpum as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bst" class="form-label">Apakah menerima BST? </label>
                        <select name="bst" id="bst" class="form-control form-select" required>
                            <option value="" selected>Pilih jawaban...</option>
                            <?php foreach ($bst as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pkh" class="form-label">Apakah menerima PKH? </label>
                        <select name="pkh" id="pkh" class="form-control form-select" required>
                            <option value="" selected>Pilih jawaban...</option>
                            <?php foreach ($pkh as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sembako" class="form-label">Apakah menerima sembako? </label>
                        <select name="sembako" id="sembako" class="form-control form-select" required>
                            <option value="" selected>Pilih jawaban...</option>
                            <?php foreach ($sembako as $s) : ?>
                                <option value="<?= $s['value'] ?>"><?= $s['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payload extends CI_Controller {
	var $userkab = array(
		'6404' => 'diskominfokutim@gmail.com',		
	);

	public function __construct()
	{
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		$this->load->model('wilayah_model','wilayah');
		$this->load->model('user_model','user');
		$this->load->model('mskegiatan_model','mskeg');
	}

	public function mskeg($id_wilayah=null,$id_kegiatan=null)
	{	//sleep(1);
		if(!$id_wilayah || !$id_kegiatan) exit();

		$mskeg = $this->mskeg->get($id_kegiatan);
		if(!$mskeg || $mskeg->id_wilayah != $id_wilayah || $mskeg->id_indah)
			exit();

		$user = $this->user->get($mskeg->userid);
		
		foreach(array('i','ii','iii','iv','v','vi','vii','viii') as $b)
			$blok[$b] = $this->mskeg->get_blok($id_kegiatan, $b);

		if(array_key_exists($mskeg->id_wilayah, $this->userkab))
			$created_by = $this->userkab[$mskeg->id_wilayah];
		else
			$created_by = $mskeg->created_by;



		$result = array (
		'base_id'=> null,
		'submission_period' => 2023,
		'data' => array (),
		'reviews'=> null,
		'status' => 'DRAFT', // $mskeg->id_wilayah=='3300'? 'DRAFT' : 'SUBMITTED',
		'rejection_note'=> null,
		'submitter'=> array (
			'username' => 'kominfokutim',
			'name'=> 'Diskominfo Perstik Kutim',
			'email'=> 'kominfokutim@gmail.com',
			'organization'=> array (
				'id'=> 16542,
				'name'=> 'Dinas Komunikasi dan Informatika, Persandian dan Statistik Kabupaten Kutai Timur',
				'address'=> 'Komplek Perkantoran Pemerintah Daerah, Bukit Pelangi',
				'province'=> array (
					'code'=> '64',
					'name'=> 'KALIMANTAN TIMUR'
				),
				'city' => array (
					'code'=> '6404',
					'name'=>  'KUTAI TIMUR'
				)
			)
		  ),
		'produsen_data'=> array (
			'id'=> $user->id_indah,
			'name'=> $blok['i']->instansi_penyelenggara,
			'province_code'=> '64',
			'city_code'=> '6404'
		),
		'walidata_pusat'=> null,
		'version'=> 'v2',
		'changes'=> null,
	// 	'jenis_statistik' => 'STATISTIK_SEKTORAL',
	// 	'kode_provinsi' => '64',
	// 	'kode_kabupaten_kota' => $mskeg->id_wilayah,
	// 	'note' => '',
	// 	'created_by' => $created_by, 
		);

		$result['data'] = 
		  array (
		    'judul_kegiatan' => $mskeg->judul_kegiatan,
		    'tahun' => intval($mskeg->tahun),
			'jenis_statistik' => 'STATISTIK_SEKTORAL',
		    'cara_pengumpulan_data' => $this->get_enum('cara_pengumpulan_data',$mskeg->cara_pengumpulan_data),
		    'sektor_kegiatan' => $this->get_enum("sektor_kegiatan",$mskeg->sektor_kegiatan),
		    'identitas_rekomendasi' => $this->get_data_null($mskeg->identitas_rekomendasi),
		    'blok_i' => 
    		    array (
    		      'instansi_penyelanggara' => $blok['i']->instansi_penyelenggara,
    		      'alamat_instansi_penyelenggara' => array (
				  	'alamat'=> $blok['i']->alamat_lengkap_instansi_penyelenggara,
    		      	'telepon' => $blok['i']->telepon,
    		      	'faksimile' => $blok['i']->faksimile? $blok['i']->faksimile : '-',
    		      	'email' => $blok['i']->email,
					)
    		    ),
		    'blok_ii' => 
    		    array (
    		      'unit_penanggung_jawab' => array (
				  'eselon1' => $blok['ii']->unit_penanggung_jawab_eselon1? $blok['ii']->unit_penanggung_jawab_eselon1 : '-',
    		      'eselon2' => $blok['ii']->unit_penanggung_jawab_eselon2
				  ),
				  'penanggung_jawab_teknis' => array(
    		      'nama' => $blok['ii']->nama_penanggung_jawab_teknis? $blok['ii']->nama_penanggung_jawab_teknis : $blok['ii']->jabatan_penanggung_jawab_teknis,
    		      'jabatan' => $blok['ii']->jabatan_penanggung_jawab_teknis,
    		      'alamat' => $blok['ii']->alamat_penanggung_jawab_teknis,
    		      'telepon' => $blok['ii']->telepon_penanggung_jawab_teknis,
    		      'email' => $blok['ii']->email_penanggung_jawab_teknis,
    		      'faksimile' => $blok['ii']->faksimile_penanggung_jawab_teknis?$blok['ii']->faksimile_penanggung_jawab_teknis:'-',
				  )
				),
		    'blok_iii' => 
    		    array (
		      'latar_belakang_kegiatan' => $blok['iii']->latar_belakang_kegiatan,
		      'tujuan_kegiatan' => $blok['iii']->tujuan_kegiatan,
		      'rencana_jadwal_kegiatan' => 
		      array (
		        'perencanaan_kegiatan' => 
		        array (
		          array (
		            'awal' => $blok['iii']->perencanaan_kegiatan_awal,
		            'akhir' => $blok['iii']->perencanaan_kegiatan_akhir,
		          ),
		        ),
		        'desain' => 
		        array (
		          array (
		            'awal' => $blok['iii']->desain_awal,
		            'akhir' => $blok['iii']->desain_akhir,
		          ),
		        ),
		        'pengumpulan_data' => 
		        array (
		          array (
		            'awal' => $blok['iii']->pengumpulan_data_awal,
		            'akhir' => $blok['iii']->pengumpulan_data_akhir,
		          ),
		        ),
		        'pengolahan_data' => 
		        array (
		          array (
		            'awal' => $blok['iii']->pengolahan_data_awal,
		            'akhir' => $blok['iii']->pengolahan_data_akhir,
		          ),
		        ),
		        'analisis' => 
		        array (
		          array (
		            'awal' => $blok['iii']->analisis_awal,
		            'akhir' => $blok['iii']->analisis_akhir,
		          ),
		        ),
		        'diseminasi_hasil' => 
		        array (
		          array (
		            'awal' => $blok['iii']->diseminasi_hasil_awal,
		            'akhir' => $blok['iii']->diseminasi_hasil_akhir,
		          ),
		        ),
		        'evaluasi' => 
		        array (
		          array (
		            'awal' => $blok['iii']->evaluasi_awal,
		            'akhir' => $blok['iii']->evaluasi_akhir,
		          ),
		        ),
		      ),
		      'variabel_yang_dikumpulkan' => 
		      array (
		      ),
		    ),
		    'blok_iv' => 
    		    array (
		      'kegiatan_ini_dilakukan' => $this->get_enum("kegiatan_ini_dilakukan", $blok['iv']->kegiatan_ini_dilakukan),
		      'frekuensi_penyelanggara' => $this->get_enum("frekuensi_penyelanggara", $blok['iv']->frekuensi_penyelenggaraan),
		      'tipe_pengumpulan_data' => $this->get_enum("tipe_pengumpulan_data", $blok['iv']->tipe_pengumpulan_data),
		      'cakupan_wilayah_pengumpulan_data' => $this->get_enum("cakupan_wilayah_pengumpulan_data", $blok['iv']->cakupan_wilayah_pengumpulan_data),
		      'sebagian_cakupan_wilayah_pengumpulan_data' => 
		      array (
		      ),
		      'metode_pengumpulan_data' => 
		      array (
		        'wawancara' => $this->get_data_null($this->in_multi($blok['iv']->metode_pengumpulan_data, 1)),
		        'mengisi_kuesioner_sendiri' => $this->get_data_null($this->in_multi($blok['iv']->metode_pengumpulan_data, 2)),
		        'pengamatan' => $this->get_data_null($this->in_multi($blok['iv']->metode_pengumpulan_data, 4)),
		        'pengumpulan_data_sekunder' => $this->get_data_null($this->in_multi($blok['iv']->metode_pengumpulan_data, 8)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['iv']->metode_pengumpulan_data, 16)),
		        'metode_pengumpulan_lainnya' => $this->get_data_null($blok['iv']->metode_pengumpulan_data_lainnya),
		      ),
		      'sarana_pengumpulan_data' => 
		      array (
		        'papi' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 1)),
		        'capi' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 2)),
		        'cati' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 4)),
		        'cawi' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 8)),
		        'mail' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 16)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['iv']->sarana_pengumpulan_data, 32)),
		        'sarana_pengumpulan_lainnya' => $this->get_data_null($blok['iv']->sarana_pengumpulan_data_lainnya),
		      ),
		      'unit_pengumpulan_data' => 
		      array (
		        'individu' => $this->get_data_null($this->in_multi($blok['iv']->unit_pengumpulan_data, 1)),
		        'rumah_tangga' => $this->get_data_null($this->in_multi($blok['iv']->unit_pengumpulan_data, 2)),
		        'usaha_atau_perusahaan' => $this->get_data_null($this->in_multi($blok['iv']->unit_pengumpulan_data, 4)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['iv']->unit_pengumpulan_data, 8)),
		        'unit_pengumpulan_data_lainnya' => $this->get_data_null($blok['iv']->unit_pengumpulan_data_lainnya),
		      ),
		    ),
		    'blok_v' => 
    		    array (
		      'jenis_rancangan_sampel' => $this->get_data_null($this->get_enum("jenis_rancangan_sampel", $blok['v']->jenis_rancangan_sampel)),
		      'metode_pemilihan_sampel_tahap_terakhir' => $this->get_data_null($this->get_enum("metode_pemilihan_sampel_terakhir", $blok['v']->metode_pemilihan_sampel_tahap_terakhir)),
		      'metode_yang_digunakan' => $this->get_data_null($this->get_enum("metode_yang_digunakan", $blok['v']->metode_yang_digunakan)),
		      'kerangka_sampel_tahap_terakhir' => $this->get_data_null($this->get_enum("kerangka_sampel_tahap_terakhir", $blok['v']->kerangka_sampel_tahap_terakhir)),
		      'fraksi_sampel_keseluruhan' => $this->get_data_null($blok['v']->fraksi_sampel_keseluruhan),
		      'nilai_perkiraan_sampling_error_variabel_utama' => $this->get_data_null($blok['v']->nilai_perkiraan_sampling_error_variabel_utama),
		      'unit_sampel' => $this->get_data_null($blok['v']->unit_sampel),
		      'unit_observasi' => $this->get_data_null($blok['v']->unit_observasi),
		    ),
		    'blok_vi' => 
    		    array (
		      'apakah_melakukan_uji_coba' => $blok['vi']->apakah_melakukan_uji_coba=='1',
		      'metode_pemeriksaan_kualitas_pengumpulan_data' => 
		      array (
		        'kunjungan_kembali' => $this->get_data_null($this->in_multi($blok['vi']->metode_pemeriksaan_kualitas_pengumpulan_data, 1)),
		        'supervisi' => $this->get_data_null($this->in_multi($blok['vi']->metode_pemeriksaan_kualitas_pengumpulan_data, 2)),
		        'taskforce' => $this->get_data_null($this->in_multi($blok['vi']->metode_pemeriksaan_kualitas_pengumpulan_data, 4)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['vi']->metode_pemeriksaan_kualitas_pengumpulan_data, 8)),
		        'metode_pemeriksaan_kualitas_pengumpulan_data_lainnya' => $this->get_data_null($blok['vi']->metode_pemeriksaan_kualitas_pengumpulan_data_lainnya),
		      ),
		      'apakah_melakukan_penyesuaian_nonrespon' => $blok['vi']->apakah_melakukan_penyesuaian_nonrespon=='1',
		      'petugas_pengumpulan_data' => $this->get_enum("petugas_pengumpulan_data", $blok['vi']->petugas_pengumpulan_data),
		      'persyaratan_pendidikan_terendah_petugas_pengumpulan_data' => $this->get_enum("persyaratan_pendidikan_terendah_petugas_pengumpulan_data", $blok['vi']->persyaratan_pendidikan_terendah_petugas_pengumpulan_data),
		      'jumlah_petugas_supervisor' => intval($blok['vi']->jumlah_petugas_supervisor),
		      'jumlah_petugas_enumerator' => intval($blok['vi']->jumlah_petugas_enumerator),
		      'apakah_melakukan_pelatihan_petugas' => $blok['vi']->apakah_melakukan_pelatihan_petugas=='1',
		    ),
		    'blok_vii' => 
    		    array (
		      'tahapan_pengolahan_data' => 
		      array (
		        'editing' => $this->get_data_null($blok['vii']->tahapan_pengolahan_data_editing=='1'),
		        'coding' => $this->get_data_null($blok['vii']->tahapan_pengolahan_data_coding=='1'),
		        'data_entry' => $this->get_data_null($blok['vii']->tahapan_pengolahan_data_entry=='1'),
		        'validasi' => $this->get_data_null($blok['vii']->tahapan_pengolahan_data_validasi=='1'),
		      ),
		      'metode_analisis' => $this->get_enum("metode_analisis", $blok['vii']->metode_analisis),
		      'unit_analsis' => 
		      array (
		        'individu' => $this->get_data_null($this->in_multi($blok['vii']->unit_analisis,1)),
		        'rumah_tangga' => $this->get_data_null($this->in_multi($blok['vii']->unit_analisis,2)),
		        'usaha_atau_perusahaan' => $this->get_data_null($this->in_multi($blok['vii']->unit_analisis,4)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['vii']->unit_analisis,8)),
		        'unit_analisis_lainnya' => $this->get_data_null($blok['vii']->unit_analisis_lainnya),
		      ),
		      'tingkat_penyajian_hasil_analisis' => 
		      array (
		        'nasional' => $this->get_data_null($this->in_multi($blok['vii']->tingkat_penyajian_hasil_analisis,1)),
		        'provinsi' => $this->get_data_null($this->in_multi($blok['vii']->tingkat_penyajian_hasil_analisis,2)),
		        'kabupaten_atau_kota' => $this->get_data_null($this->in_multi($blok['vii']->tingkat_penyajian_hasil_analisis,4)),
		        'kecamatan' => $this->get_data_null($this->in_multi($blok['vii']->tingkat_penyajian_hasil_analisis,8)),
		        'lainnya' => $this->get_data_null($this->in_multi($blok['vii']->tingkat_penyajian_hasil_analisis,16)),
		        'tingkat_penyajian_hasil_analisis_lainnya' => $this->get_data_null($blok['vii']->tingkat_penyajian_hasil_analisis_lainnya),
		      ),
		    ),
		    'blok_viii' => 
    		    array (
		      'ketersediaan_produk_tercetak' => $blok['viii']->ketersediaan_produk_tercetak=='1',
		      'ketersediaan_produk_digital' => $blok['viii']->ketersediaan_produk_digital=='1',
		      'ketersediaan_produk_mikrodata' => $blok['viii']->ketersediaan_produk_mikrodata=='1',
		      'rencana_jadwal_rilis_produk_tercetak' => 	
		        array (
					$this->get_data_empty($blok['viii']->rencana_jadwal_rilis_produk_tercetak)
		        ),
		      'rencana_jadwal_rilis_produk_digital' => 
		        array (
					$this->get_data_empty($blok['viii']->rencana_jadwal_rilis_produk_digital)
		        ),
		      'rencana_jadwal_rilis_produk_mikrodata' => 
		        array (
					$this->get_data_empty($blok['viii']->rencana_jadwal_rilis_produk_mikrodata)
		        ),
		    ),
		);

		foreach($this->mskeg->get_variabel($id_kegiatan) as $v) {
			$result["data"]["blok_iii"]["variabel_yang_dikumpulkan"][] = array(
				"nama" => $v->nama_variabel,
				"konsep" => $v->konsep,
				"definisi" => $v->definisi,
				"referensi_waktu" => $v->referensi_waktu,
			);
		}

		foreach($this->mskeg->get_iv_wilayah($id_kegiatan) as $w){
			$result['data']['blok_iv']['sebagian_cakupan_wilayah_pengumpulan_data'][] = array(
				'kode_provinsi' => 23,
				'nama_provinsi' => $w->provinsi,
				'kode_kabupaten_kota' => '6404',
				'nama_kabupaten_kota' => $w->kabupaten,
			);
		}

		$this->output
			->set_content_type('application/json')
	        ->set_output(json_encode($result));
	}

	public function msvar($id_wilayah, $id_kegiatan)
	{	//sleep(1);
		if(!$id_wilayah || !$id_kegiatan) exit();

		$mskeg = $this->mskeg->get($id_kegiatan);
		if(!$mskeg || $mskeg->id_wilayah != $id_wilayah || !$mskeg->id_indah)
			exit();

		if(array_key_exists($mskeg->id_wilayah, $this->userkab))
			$created_by = $this->userkab[$mskeg->id_wilayah];
		else
			$created_by = $mskeg->created_by;

		$user = $this->user->get($mskeg->userid);
		
		foreach(array('i','ii','iii','iv','v','vi','vii','viii') as $b)
				$blok[$b] = $this->mskeg->get_blok($id_kegiatan, $b);

		foreach($this->mskeg->get_variabel($id_kegiatan) as $v) {
		  if(!$v->id_indah) {
			$result[] = array(
				array('id_var'=>$v->id),
				array (
			  'ms_keg_id' => $mskeg->id_indah,
			  "submission_period" => 2023,
			  'data' => 
			  array (
			  'nama' => $v->nama_variabel,
			  'alias' => $v->alias,
			  'definisi' => $v->definisi,
			  'konsep' => array ($v->konsep),
			  'referensi_pemilihan' => array (),
			  'referensi_waktu' => $v->referensi_waktu,
			  'ukuran' => null,
			  'satuan' => null,
			  'tipe_data' => $v->tipe_data,
			  'klasifikasi_rujukan_value_domain' => $v->klasifikasi_isian? $v->klasifikasi_isian : '-',
			  'value_domain' => 
			  array (
				array (                
				"kode" => null,
                "nilai" => null
				)
			  ),
			  'aturan_validasi' => 
			  array (
				  $v->aturan_validasi
			  ),
			  'kalimat_pertanyaan' => $v->kalimat_pertanyaan,
			  'apakah_variabel_bisa_diakses_umum' => substr($v->dapat_diakses_umum,0,1)=='1',
			  "id_sds"=> null
			),
				"reviews"=> array (),
				"changes"=> array (),
			  	'status' => 'SUBMITTED', // $mskeg->id_wilayah=='3300'? 'DRAFT' : 'SUBMITTED',
				"rejection_note"=> null,
				"submitter"=> array (
					"username"=> "kominfokutim",
					"name"=> "Diskominfo Perstik Kutim",
					"email"=> "kominfokutim@gmail.com",
					"organization"=> array (
						"id"=> 16542,
						"name"=> "Dinas Komunikasi dan Informatika, Persandian dan Statistik Kabupaten Kutai Timur",
						"address"=> "Komplek Perkantoran Pemerintah Daerah, Bukit Pelangi",
						"province"=> array (
							"code"=>"64",
							"name"=> "KALIMANTAN TIMUR"
						),
						"city"=> array (
							"code"=> "6404",
							"name"=> "KUTAI TIMUR"
						)
					)
				),
				"produsen_data"=> array (
					'id'=> $user->id_indah,
					'name'=> $blok['i']->instansi_penyelenggara,
					"province_code"=> "64",
					"city_code"=> "6404"
				),
				"walidata_pusat"=> array (
					"id"=> null,
					"name"=> null
				),
				"version"=> "v2"
			)
			);
		  }
		}

		$this->output
			->set_content_type('application/json')
	        ->set_output(json_encode($result));

	}

	public function msind($id_wilayah, $id_kegiatan)
	{	sleep(3);
		if(!$id_wilayah || !$id_kegiatan) exit();

		$mskeg = $this->mskeg->get($id_kegiatan);
		if(!$mskeg || $mskeg->id_wilayah != $id_wilayah || !$mskeg->id_indah)
			exit();

		if(array_key_exists($mskeg->id_wilayah, $this->userkab))
			$created_by = $this->userkab[$mskeg->id_wilayah];
		else
			$created_by = $mskeg->created_by;

		$user = $this->user->get($mskeg->userid);
		
		foreach(array('i','ii','iii','iv','v','vi','vii','viii') as $b)
					$blok[$b] = $this->mskeg->get_blok($id_kegiatan, $b);

		$result = array();
		foreach($this->mskeg->get_indikator($id_kegiatan) as $i) {
		  if(!$i->id_indah) {
			$res = 
			array(
				array('id_ind'=>$i->id),
			array (
			'ms_keg_id' => $mskeg->id_indah,
			'submission_period' => date("Y"),
			'data' => 
			  array (
			    'nama' => $i->nama_indikator,
			    'konsep' => array ($i->konsep),
			    'definisi' => $i->definisi,
			    'interpretasi' => $i->interpretasi,
			    'metode_perhitungan' => $i->metode,
				'rumus' => '',
			    'ukuran' => $i->ukuran,
			    'satuan' => $i->satuan,
			    'variabel_disaggregasi' => 
			    array (
					array (
				'nama' => $i->klasifikasi,
				'sumber' => 'input-manual',
			    )
				),
			    'apakah_indikator_komposit' => substr($i->indikator_komposit,0,1)=='1',
			    'indikator_pembangun' => 
			    array (
			    ),
			    'variabel_pembangun' => 
			    array (
			    ),
			    'level_estimasi' => $i->level_estimasi? $i->level_estimasi : '-',
			    'apakah_indikator_bisa_diakses_umum' => substr($i->dapat_diakses_umum,0,1)=='1',
				'id_sls' => null
			  ),
			'reviews' => array(),
			'changes' => array(),
			'status' => 'SUBMITTED',
			'rejection_note' => null,
			'submitter'=> array(
				"username"=> "kominfokutim",
				"name"=> "Diskominfo Perstik Kutim",
				"email"=> "kominfokutim@gmail.com",
				"organization"=> array(
					"id"=> 16542,
					"name"=> "Dinas Komunikasi dan Informatika, Persandian dan Statistik Kabupaten Kutai Timur",
					"address"=> "Komplek Perkantoran Pemerintah Daerah, Bukit Pelangi",
					"province"=> array(
						"code"=> "64",
						"name"=> "KALIMANTAN TIMUR"
					),
					"city"=> array(
						"code"=> "6404",
						"name"=> "KUTAI TIMUR"
					)
				)
			),
			"produsen_data"=> array(
				'id'=> $user->id_indah,
				'name'=> $blok['i']->instansi_penyelenggara,
				"province_code"=> "64",
				"city_code"=> "6404"
			),
			"walidata_pusat"=> array(
				"id"=> null,
				"name"=> null
			),
			"version"=> "v2"
			)
		);

			if($res[1]['data']['apakah_indikator_komposit'])
				$res[1]['data']['indikator_pembangun'][] = array(
			    		'nama'=>$i->indikator_pembangun_nama,
			    		'ketersediaan_publikasi'=>array(
			    			array(
			    				'nama'=>$i->indikator_pembangun_publikasi,
			    				'link_eksternal_yang_bisa_diakses'=>null,
			    				'file'=>array(
			    					'nama'=>null,
			    					'ekstensi'=>null,
			    					'url_download'=>null
			    				)
			    			)
			    		)
			    	);
			else
				$res[1]['data']['variabel_pembangun'][] = array (
			        'nama' => $i->variabel_pembangun_nama,
			        'kegiatan_penghasil' => 
			        array (
			          $i->variabel_pembangun_kegiatan,
			        ),
			      );

			$result[] = $res;
		  }
		}

		$this->output
			->set_content_type('application/json')
	        ->set_output(json_encode($result));

	}
	
	public function index()
	{

	}

	private function in_multi($nilai, $pilihan)
	{
		$array = array('32'=>false, '16'=>false, '8'=>false, '4'=>false, '2'=>false, '1'=>false);

		foreach($array as $key=>$stat){
			if($nilai >= $key){
				$array[$key] = true;
				$nilai -= (int)$key;
			}
		}

		return $array[$pilihan];
	}

	private function get_data_null($value)
	{
		if($value == '' || $value == false) return null;
		else return $value;

	}

	private function get_data_empty($value)
	{
		if($value == '0000-00-00' || $value == false) return "";
		else return $value;

	}

	private function get_enum($var_name, $value)
	{
		$master = array(
			'cara_pengumpulan_data' => array(
			 	'1' => "PENCACAHAN_LENGKAP",
			 	'2' => "SURVEI",
			 	'3' => "KOMPILASI_PRODUK_ADMINISTRASI",
			 	'4' => "CARA_LAIN_SESUAI_DENGAN_PERKEMBANGAN_TI",
			 ),
			'sektor_kegiatan' => array(
				'1' => "PERTANIAN_DAN_PERIKANAN",
				'2' => "DEMOGRAFI_DAN_KEPENDUDUKAN",
				'3' => "PEMBANGUNAN",
				'4' => "PROYEKSI_EKONOMI", 
				'5' => "PENDIDIKAN_DAN_PELATIHAN",			 
				'6' => "LINGKUNGAN", 
				'7' => "KEUANGAN", 
				'8' => "GLOBALISASI", 
				'9' => "KESEHATAN", 
				'10' => "INDUSTRI_DAN_JASA", 
				'11' => "TEKNOLOGI_INFORMASI_DAN_KOMUNIKASI", 
				'12' => "PERDAGANGAN_INTERNASIONAL_DAN_NERACA_PERDAGANGAN", 
				'13' => "KETENAGAKERJAAN", 
				'14' => "NERACA_NASIONAL", 
				'15' => "INDIKATOR_EKONOMI_BULANAN", 
				'16' => "PRODUKTIVITAS", 
				'17' => "HARGA_DAN_PARITAS_DAYA_BELI", 
				'18' => "SEKTOR_PUBLIK_PERPAJAKAN_DAN_REGULASI_PASAR", 
				'19' => "PERWILAYAHAN_DAN_PERKOTAAN", 
				'20' => "ILMU_PENGETAHUAN_DAN_HAK_PATEN", 
				'21' => "PERLINDUNGAN_SOSIAL_DAN_KESEJAHTERAAN", 
				'22' => "TRANSPORTASI",
			),
			'kegiatan_ini_dilakukan' => array(
				'1' => "HANYA_SEKALI",
				'2' => "BERULANG",
			),
			'frekuensi_penyelanggara' => array(
				'1' => "HARIAN",
				'2' => "MINGGUAN",
				'3' => "BULANAN",
				'4' => "TRIWULANAN", 
				'5' => "EMPAT_BULANAN",			 
				'6' => "SEMESTERAN", 
				'7' => "TAHUNAN", 
				'8' => "LEBIH_DARI_DUA_TAHUNAN", 
			),
			'tipe_pengumpulan_data' => array(
				'1' => "LONGITUDINAL_PANEL",
				'2' => "CROSS_SECTIONAL",
				'3' => "LONGITUDINAL_CROSS_SECTIONAL",
			),
			'cakupan_wilayah_pengumpulan_data' => array(
				'1' => "SELURUH_WILAYAH_INDONESIA",
				'2' => "SEBAGIAN_WILAYAH_INDONESIA",
			),
			'metode_pengumpulan_data' => array(
				'1' => "WAWANCARA",
				'2' => "MENGISI_KUESIONER_SENDIRI_ATAU_SWACACAH",
				'4' => "PENGAMATAN_ATAU_OBSERVASI",
				'8' => "PENGUMPULAN_DATA_SEKUNDER",
				'16' => "LAINNYA",
			),
			'sarana_pengumpulan_data' => array(
				'1' => "PAPER_ASSISTED_PERSONAL_INTERVIEWING_ATAU_PAPI",
				'2' => "COMPUTER_ASSISTED_PERSONAL_INTERVIEWING_ATAU_CAPI",
				'4' => "PAPER_ASSISTED_TELEPHONES_INTERVIEWING_ATAU_CATI",
				'8' => "PAPER_AIDED_WEB_INTERVIEWING_ATAU_CAWI",
				'16' => "MAIL",
				'32' => "LAINNYA"
			),
			'unit_pengumpulan_data' => array(
				'1' => "Individu",
				'2' => "Rumah Tangga",
				'4' => "Usaha/perusahaan",
				'8' => "Lainnya",
			),
			'jenis_rancangan_sampel' => array(
				'1' => "SINGLE_STAGE_ATAU_PHASE",
				'2' => "MULTI_STAGE_ATAU_PHASE"
			),
			'metode_pemilihan_sampel_terakhir' => array(
				'1' => "SAMPEL_PROBABILITAS",
				'2' => "SAMPEL_NONPROBABILITAS"
			),
			'metode_yang_digunakan' => array(
				'1' => "SIMPLE_RANDOM_SAMPLING",
				'2' => "SYSTEMATIC_RANDOM_SAMPLING",
				'3' => "STRATIFIED_RANDOM_SAMPLING",
				'4' => "CLUSTER_SAMPLING",
				'5' => "MULTI_STAGE_SAMPLING",
				'6' => "QUOTA_SAMPLING",
				'7' => "ACCIDENTAL_SAMPLING",
				'8' => "PURPOSIVE_SAMPLING",
				'9' => "SNOWBALL_SAMPLING",
				'10' => "SATURATION_SAMPLING",
			),
			'kerangka_sampel_tahap_terakhir' => array(
				'1' => "LIST_FRAME", 
				'2' => "AREA_FRAME",
			),
/*			'apakah_melakukan_uji_coba' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
*/			'metode_pemeriksaan_kualitas_pengumpulan_data' => array(
				'1' => "KUNJUNGAN_KEMBALI_ATAU_REVISIT",
				'2' => "SUPERVISI",
				'4' => "TASK_FORCE",
				'8' => "LAINNYA",
			),
/*			'apakah_melakukan_penyesuaian_nonrespon' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
*/			'petugas_pengumpulan_data' => array(
				'1' => "STAF_INSTANSI_PENYELENGGARA",
				'2' => "MITRA_ATAU_TENAGA_KONTRAK",
				'3' => "STAF_INSTANSI_PENYELENGGARA_DAN_MITRA_ATAU_TENAGA_KONTRAK",
			),
			'persyaratan_pendidikan_terendah_petugas_pengumpulan_data' => array(
				'1' => "KURANG_DARI_ATAU_SAMA_DENGAN_SMP",
				'2' => "SMA_ATAU_SMK",
				'3' => "DIPLOMA_I_ATAU_II_ATAU_III",
				'4' => "DIPLOMA_IV_ATAU_S1_ATAU_S2_ATAU_S3",
			),
/*			'apakah_melakukan_pelatihan_petugas' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
			'editing' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
			'coding' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
 			'entry' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
 			'validasi' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
*/			'metode_analisis' => array(
				'1' => "DESKRIPTIF",
				'2' => "INFERENSIA", 
				'3' => "DESKRIPTIF_DAN_INFERENSIA",
			),
			'unit_analsis' => array(
				'1' => "Individu",
				'2' => "Rumah Tangga",
				'4' => "Usaha/perusahaan",
				'8' => "Lainnya",
			),
			'tingkat_penyajian_hasil_analisis' => array(
				'1' => "Nasional",
				'2' => "Provinsi",
				'4' => "Kabupaten/Kota",
				'8' => "Kecamatan",
				'16' => "Lainnya",
			),
/*			'tercetak' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
			'digital' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
			'data_mikro' => array(
				'1' => "Ya",
				'2' => "Tidak"
			),
*/		);

		return !empty($master[$var_name][$value])? $master[$var_name][$value] : null;
	}

	
}

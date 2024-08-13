<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ms_kegiatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');

		$this->load->model('mskegiatan_model');
    }

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Metadata Kegiatan Statistik',
			'_breadcrumbs'=>array('ms_kegiatan'=>'MS Kegiatan'),
			'_view'=> $this->router->class.'/index',

		));
	}

	public function add()
	{
		if($this->input->post('input')){
			$input = $this->input->post('input');
			$input['id_wilayah'] = $this->session->userdata('id_wilayah');
			$input['userid'] = $this->session->userdata('userid');
			$input['instansi'] = $this->session->userdata('instansi');
			$input['approval_on'] = '';
			$id = $this->mskegiatan_model->add($input);
			if($id){
				$input['id_ms_keg'] = $id;
				$input['blok'] = '';
				$this->mskegiatan_model->add_checklist($input);

				//kirim notifikasi
				$this->load->library('sinotif');
				$this->sinotif->kirim(array(
				    // ganti dengan niplama penerima notifikasi => atasan, es3, kepegawaian, dll
				    'nip'=>array('198010022002121005'), 
				    'subject'=>'OMAE '.$input['id_wilayah'].' - '.$input['instansi'],
				    'message'=>$input['judul_kegiatan'],
				));

			}
			redirect($this->router->class.'/edit/'.$id.'/2');
		}

		$this->load->view('template', array(
			'_title'=> 'Metadata Kegiatan Statistik',
			'_breadcrumbs'=>array('ms_kegiatan'=>'MS Kegiatan','Input Baru'),
			'_view'=> $this->router->class.'/add',
		));
	}

	public function edit($id,$page=null)
	{
		$row = $this->mskegiatan_model->get($id);
		if(!$page) $page = 1;

	    if(!$row->sedang_verifikasi && $row->approval_on=='0000-00-00 00:00:00'){
			if($this->input->post('input'))
				$this->mskegiatan_model->update($id,$this->input->post('input'));

			if($this->input->post('blok_i'))
				$this->mskegiatan_model->update_blok($id,'i',$this->input->post('blok_i'));

			if($this->input->post('blok_ii'))
				$this->mskegiatan_model->update_blok($id,'ii',$this->input->post('blok_ii'));

			if($this->input->post('blok_iii'))
				$this->mskegiatan_model->update_blok($id,'iii',$this->input->post('blok_iii'));

			if($this->input->post('blok_iv'))
				$this->mskegiatan_model->update_blok($id,'iv',$this->input->post('blok_iv'));

			if($this->input->post('blok_v'))
				$this->mskegiatan_model->update_blok($id,'v',$this->input->post('blok_v'));

			if($this->input->post('blok_vi'))
				$this->mskegiatan_model->update_blok($id,'vi',$this->input->post('blok_vi'));

			if($this->input->post('blok_vii'))
				$this->mskegiatan_model->update_blok($id,'vii',$this->input->post('blok_vii'));

			if($this->input->post('blok_viii'))
				$this->mskegiatan_model->update_blok($id,'viii',$this->input->post('blok_viii'));
		}

		if(!$this->input->is_ajax_request()){
			if($this->input->post('prev'))
				redirect($this->router->class.'/edit/'.$id.'/'.($page-1));
			else if($this->input->post('next'))
				redirect($this->router->class.'/edit/'.$id.'/'.($page+1));
			else if($this->input->post('selesai'))
				redirect($this->router->class);

			$this->load->view('template', array(
				'_title' => $page==1? 'Metadata Kegiatan Statistik' : $row->judul_kegiatan,
				'_breadcrumbs' => array('ms_kegiatan'=>'MS Kegiatan','Update'),
				'_view' => $this->router->class.'/edit_'.$page,
				'page' => $page,
				'data' => $this->mskegiatan_model->get($id),
				'error'=>$this->mskegiatan_model->get_validasi($id),
			));
		}
	}

	public function save_variabel($id)
	{
		$row = $this->mskegiatan_model->get($id);
		if($row){
			$data = $this->input->post();
			$result = $this->mskegiatan_model->save_variabel($id, $data);
		} 

		if($this->input->is_ajax_request())
			echo json_encode(array('id'=>$result));
		else
			redirect($this->router->class.'/edit/'.$row->id_ms_keg.'/3');
	}

	public function del_variabel($id_ms_keg, $id)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		if($this->mskegiatan_model->del_variabel($id_ms_keg, $id))
			redirect($this->router->class.'/edit/'.$id_ms_keg.'/3');
	}

	public function save_wilayah($id)
	{
		$row = $this->mskegiatan_model->get($id);
		if($row){
			$data = $this->input->post();
			$result = $this->mskegiatan_model->save_wilayah($id, $data);
		} 
		
		if($this->input->is_ajax_request())
			echo json_encode(array('id'=>$result));
		else
			redirect($this->router->class.'/edit/'.$row->id_ms_keg.'/4');
	}

	public function del_wilayah($id_ms_keg, $id)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		if($this->mskegiatan_model->del_wilayah($id_ms_keg, $id))
			redirect($this->router->class.'/edit/'.$id_ms_keg.'/4');
	}

// respon approval
	public function approval_dialog($id=null)
	{
		$this->load->view($this->router->class.'/dialog');
	}
	
	public function approval()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('field')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$data = array(
				'blok' => $this->input->post('blok'),
				'field' => $this->input->post('field'),
				'checklist' => '',
				'respon' => $this->input->post('respon'),
			);  

//			if($this->mskegiatan_model->save_check_field($id_ms_keg, $data))
			$this->mskegiatan_model->save_check_field($id_ms_keg, $data);
				$return = array('success' => 1, 'field' => $data['field']);
//			else
//				$return['message'] = 'Unknown error';

		} else 
			$return['message'] = 'Data tidak ditemukan';

		echo json_encode($return);
	}

	public function get_check_field()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('field')){
			$row = $this->mskegiatan_model->get_check_field(
				$this->input->post('id_ms_keg'), 
				$this->input->post('blok'), 
				$this->input->post('field')
			);

			if($row)
				$return = array ('success' => 1, 'data'=>$row);
			else
				$return = array ('success' => 1, 'data'=>null);

		} else 
			$return['message'] = 'Data tidak ditemukan-2';

		echo json_encode($return);
	}

	public function master_provinsi()
	{
		$result = array(''=>'- Pilih -');
		//$this->db->order_by('nama_prov');
		foreach($this->db->get('master_provinsi')->result() as $row)
			$result[$row->kode_prov] = $row->nama_prov;

		echo json_encode($result);
	}

	public function master_kabupaten($kode_provinsi)
	{
		$result = array(''=>'- Pilih -');
		if($kode_provinsi){
			$this->db->where('kode_prov', $kode_provinsi);
			//$this->db->order_by('nama_kab');
			foreach($this->db->get('master_kabupaten')->result() as $row)
				$result[$row->kode_kab] = $row->nama_kab;
		}

		echo json_encode($result);
	}

	public function validasi($id,$page=null)
	{
		echo json_encode($this->mskegiatan_model->get_validasi($id,$page));
	}

	public function checklist_by_status($id_ms_keg, $status)
	{
		$result = array('success'=>false);
		$data = $this->mskegiatan_model->get_checklist_by_status($id_ms_keg, $status);
		if($data) {
			$result['success']=true;
			foreach($data as $row)
				$result['data'][] = ($row->blok? $row->blok.'. ' : '') . $row->field;
		} else 
			$result['message']='Data tidak ditemukan';

		echo json_encode($result);
	}

	public function get_cek_provinsi($id)
	{
	    $result = $this->mskegiatan_model->get_cek_provinsi($id);
	    if($result)
            echo json_encode(array('result'=>1, 
                'cek_kegiatan'=>$result->cek_keg,
                'cek_variabel'=>$result->cek_var,
                'cek_indikator'=>$result->cek_ind,
                'catatan'=>$result->catatan,
                'pemeriksa'=>$result->approved_by,
            ));
	    else
	        echo json_encode(array('result'=>0, 'message'=>'Belum diperiksa oleh BPS Provinsi'));
	}

}

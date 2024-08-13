<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_kegiatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if($this->session->userdata('role')<2)
			show_404();

		$this->load->model('mskegiatan_model');
    }

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Verifikasi Metadata Kegiatan',
			'_breadcrumbs'=>array('Verifikasi','Kegiatan'),
			'_view'=> $this->router->class.'/index',
		));
	}
	
	public function instansi($userid=null)
	{
		if(!$userid)
			redirect($this->router->class);
		
		$this->load->model('user_model');
		$user = $this->user_model->get($userid);
		if(!$user)
			redirect($this->router->class);

		$this->load->view('template', array(
			'_title'=> $user->instansi,
			'_breadcrumbs'=>array('Verifikasi','ap_kegiatan'=>'Kegiatan'),
			'_view'=> $this->router->class.'/index',
			'userid'=>$userid
		));
	}
	
	public function tahun($tahun=null)
	{
		if(!$tahun || $tahun>date('Y') || $tahun<2019)
			redirect($this->router->class);
		
		$this->load->view('template', array(
			'_title'=> 'Tahun '.urldecode($tahun),
			'_breadcrumbs'=>array('Verifikasi','ap_kegiatan'=>'Kegiatan'),
			'_view'=> $this->router->class.'/index',
			'tahun'=>$tahun
		));
	}
	
	public function dialog()
	{
		$this->load->view($this->router->class.'/dialog');
	}
	
	public function edit($id,$page=null)
	{
		$row = $this->mskegiatan_model->get($id);
		
        if(($this->session->userdata('id_wilayah')!=$row->id_wilayah && substr($this->session->userdata('id_wilayah'),2,2)!='00') || (substr($this->session->userdata('id_wilayah'),2,2)=='00' && $this->session->userdata('role')!=2))
            redirect('v_kegiatan');


		if(!$page) $page = 1;

		if(empty($this->input->post('selesai'))){
			$this->db->where('id_ms_keg',$id);
			$this->db->update('ms_keg', array('sedang_verifikasi'=>1));
		}

		if($this->input->post('prev'))
			redirect($this->router->class.'/edit/'.$id.'/'.($page-1));
		else if($this->input->post('next'))
			redirect($this->router->class.'/edit/'.$id.'/'.($page+1));
		else if($this->input->post('selesai'))
			redirect($this->router->class);

		$this->load->view('template', array(
			'_title' => $page==1? 'Verifikasi Metadata Kegiatan' : $row->judul_kegiatan,
			'_breadcrumbs' => array($this->router->class=>'MS Kegiatan','Update'),
			'_view' => $this->router->class.'/edit_'.$page,
			'page' => $page,
			'data' => $row,
			'error'=>$this->mskegiatan_model->get_validasi($id),
			'viewonly'=>false
		));
	}

	public function view($id,$page=null)
	{
		$row = $this->mskegiatan_model->get($id);
		
        if(($this->session->userdata('id_wilayah')!=$row->id_wilayah && substr($this->session->userdata('id_wilayah'),2,2)!='00') || (substr($this->session->userdata('id_wilayah'),2,2)=='00' && $this->session->userdata('role')!=2))
            redirect('v_kegiatan');


		if(!$page) $page = 1;

		if(empty($this->input->post('selesai'))){
			$this->db->where('id_ms_keg',$id);
			$this->db->update('ms_keg', array('sedang_verifikasi'=>1));
		}

		if($this->input->post('prev'))
			redirect($this->router->class.'/edit/'.$id.'/'.($page-1));
		else if($this->input->post('next'))
			redirect($this->router->class.'/edit/'.$id.'/'.($page+1));
		else if($this->input->post('selesai'))
			redirect($this->router->class);

		$this->load->view('template', array(
			'_title' => $page==1? 'Verifikasi Metadata Kegiatan' : $row->judul_kegiatan,
			'_breadcrumbs' => array($this->router->class=>'MS Kegiatan','Update'),
			'_view' => $this->router->class.'/edit_'.$page,
			'page' => $page,
			'data' => $row,
			'error'=>$this->mskegiatan_model->get_validasi($id),
			'viewonly'=>true
		));
	}

	public function approval()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('field')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$data = array(
				'blok' => $this->input->post('blok'),
				'field' => $this->input->post('field'),
				'checklist' => $this->input->post('value'),
				'feedback' => $this->input->post('feedback'),
				'feedback_2' => $this->input->post('feedback_2'),
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

	public function sedang_verifikasi()
	{
		if($this->input->is_ajax_request() && $this->input->post('id_ms_keg')){
			$value = $this->input->post('value')=='true'? 1 : 0;
			$this->db->where('id_ms_keg',$this->input->post('id_ms_keg'));
			$this->db->update('ms_keg', array('sedang_verifikasi'=>$value));
			echo json_encode(array('affected_rows'=>$this->db->affected_rows()));
		}
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_provinsi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if($this->session->userdata('role')!=2 || substr($this->session->userdata('id_wilayah'),2,2)!='00')
			show_404();

		$this->load->model('wilayah_model');
		$this->load->model('mskegiatan_model');
    }

	public function index($id_wilayah=null)
	{
		$this->load->view('template', array(
			'_title'=> 'Verifikasi oleh BPS Provinsi',
			'_breadcrumbs'=>array('Verifikasi Provinsi'),
			'_view'=> $this->router->class.'/index'.($id_wilayah?'_kab':''),
			'id_wilayah' => $id_wilayah
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
			'_title' => $page==1? 'Verifikasi BPS Provinsi' : $row->judul_kegiatan,
			'_breadcrumbs' => array($this->router->class=>'Verifikasi Provinsi',$this->router->class.'/index/'.$row->id_wilayah=>$row->id_wilayah),
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

	public function variabel($id_ms_keg)
	{
		$k = $this->mskegiatan_model->get($id_ms_keg);
		if(!$k)
			show_404();

		$v = $this->mskegiatan_model->get_variabel($id_ms_keg);

		if($this->input->post('id_ms_keg')!==null){
			$k = $this->mskegiatan_model->get($this->input->post('id_ms_keg'));
			if($k){
				$data = array();
				//if($this->input->post('cek_var')!==null)
					$data['cek_var'] = $this->input->post('cek_var')!==null && $this->input->post('cek_var')=='on'?1:0;
				if($this->input->post('approved_by')!==null)
					$data['approved_by'] = $this->input->post('approved_by');
				if($this->input->post('catatan')!==null)
					$data['catatan'] = $this->input->post('catatan');

				$this->mskegiatan_model->save_cek_provinsi($k->id_ms_keg, $data);
				redirect($this->router->class.'/index/'.$k->id_wilayah);
			}
		}

		$this->load->view('template', array(
			'_title'=> 'Verifikasi Variabel oleh BPS Provinsi',
			'_breadcrumbs'=>array(
				base_url('v_provinsi')=>'Verifikasi Provinsi',
				base_url('v_provinsi/index/'.$k->id_wilayah)=>$k->id_wilayah,
			),
			'_view'=> $this->router->class.'/variabel',
			'row' => $k
		));
	}
		
	public function indikator($id_ms_keg)
	{
		$k = $this->mskegiatan_model->get($id_ms_keg);
		if(!$k)
			show_404();

		$v = $this->mskegiatan_model->get_indikator($id_ms_keg);

		if($this->input->post('id_ms_keg')!==null){
			$k = $this->mskegiatan_model->get($this->input->post('id_ms_keg'));
			if($k){
				$data = array();
				//if($this->input->post('cek_ind')!==null)
					$data['cek_ind'] = $this->input->post('cek_ind')!==null && $this->input->post('cek_ind')=='on'?1:0;
				if($this->input->post('approved_by')!==null)
					$data['approved_by'] = $this->input->post('approved_by');
				if($this->input->post('catatan')!==null)
					$data['catatan'] = $this->input->post('catatan');

				$this->mskegiatan_model->save_cek_provinsi($k->id_ms_keg, $data);
				redirect($this->router->class.'/index/'.$k->id_wilayah);
			}
		}

		$this->load->view('template', array(
			'_title'=> 'Verifikasi Indikator oleh BPS Provinsi',
			'_breadcrumbs'=>array(
				base_url('v_provinsi')=>'Verifikasi Provinsi',
				base_url('v_provinsi/index/'.$k->id_wilayah)=>$k->id_wilayah,
			),
			'_view'=> $this->router->class.'/indikator',
			'row' => $k
		));
	}
		
	public function submit()
	{
		//print_r($this->input->post()); exit();
		if($this->input->post('id_ms_keg')!==null){
			$k = $this->mskegiatan_model->get($this->input->post('id_ms_keg'));
			if($k){
				$data = array();
				//if($this->input->post('cek_keg')!==null)
					$data['cek_keg'] = $this->input->post('cek_keg')!==null && $this->input->post('cek_keg')=='on'?1:0;
				if($this->input->post('approved_by')!==null)
					$data['approved_by'] = $this->input->post('approved_by');
				if($this->input->post('catatan')!==null)
					$data['catatan'] = $this->input->post('catatan');

				$this->mskegiatan_model->save_cek_provinsi($k->id_ms_keg, $data);
				redirect($this->router->class.'/index/'.$k->id_wilayah);
			}
		}
	}

    public function get($id_wilayah, $id_ms_keg)
	{
		$result = array('success'=>0);
		$k = $this->mskegiatan_model->get($id_ms_keg);
		if($k->id_wilayah==$id_wilayah){
			$cek = $this->mskegiatan_model->get_cek_provinsi($id_ms_keg);
			if($cek)
				$result = array(
					'success'=>1,
					'cek_keg'=>$cek->cek_keg,
					'cek_var'=>$cek->cek_var,
					'cek_ind'=>$cek->cek_ind,
					'cek_catatan'=>$cek->catatan?$cek->catatan:'-',
					'cek_pemeriksa'=>$cek->approved_by?$cek->approved_by:'-',
				);
		}
		echo json_encode($result);
	}

}

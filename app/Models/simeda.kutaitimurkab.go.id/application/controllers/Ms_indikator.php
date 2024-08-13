<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ms_indikator extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');

		$this->load->model('mskegiatan_model');
//		$this->load->model('msvariabel_model');
    }

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Metadata Indikator',
			'_breadcrumbs'=>array('MS Indikator'),
			'_view'=> $this->router->class.'/index',

		));
	}

	public function edit($id_ms_keg)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		$this->load->view('template', array(
			'_title' => $row->judul_kegiatan,
			'_breadcrumbs' => array('ms_indikator'=>'MS Indikator','Edit'),
			'_view' => $this->router->class.'/edit',
			'row' => $row,
		));
	}

    function save()
    {
    	$data = $this->input->post();
        if(isset($data['id_indikator']) && $data['id_indikator']){
            $data['id'] = $data['id_indikator'];
            unset($data['id_indikator']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $data['id_ms_keg']);
            $this->db->update('ms_ind', $data);
            //return $this->db->affected_rows();
        } else {
            unset($data['id_indikator']);
            $this->db->insert('ms_ind', $data);
            //return $this->db->insert_id();            
        }
	    redirect($this->router->class.'/edit/'.$data['id_ms_keg']);
    }

	public function del($id_ms_keg, $id)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		if($this->mskegiatan_model->del_indikator($id_ms_keg, $id))
			redirect($this->router->class.'/edit/'.$id_ms_keg);
	}

	public function get_checklist()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('id_indikator')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$id_indikator= $this->input->post('id_indikator') ;
			$row = $this->mskegiatan_model->get_checklist_indikator($id_ms_keg, $id_indikator);
			$data = array(
				'checklist' => $row->checklist,
				'feedback'  => $row->feedback,
				'respon'    => $row->respon,
			);
			$return = array('success' => 1, 'data' => $data);
		} else 
			$return['message'] = 'Data tidak ditemukan';

		echo json_encode($return);
	}

	public function save_checklist()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('id_indikator')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$id_variabel= $this->input->post('id_indikator') ;
			$data = array(
    			'id_ms_keg' => $this->input->post('id_ms_keg'),
	    		'id_indikator'=> $this->input->post('id_indikator'),
				'checklist' => '0',
				'respon' => $this->input->post('respon'),
			);  

			$this->mskegiatan_model->approval_indikator($id_ms_keg, $data);
			$return = array('success' => 1);

		} else 
			$return['message'] = 'Data tidak ditemukan';

		echo json_encode($return);
	}

}
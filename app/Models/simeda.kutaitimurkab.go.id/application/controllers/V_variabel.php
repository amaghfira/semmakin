<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_variabel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if($this->session->userdata('role')<2)
			show_404();

		$this->load->model('mskegiatan_model');
//		$this->load->model('msvariabel_model');
    }

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Verifikasi Metadata Variabel',
			'_breadcrumbs'=>array('Verifikasi','Variabel'),
			'_view'=> $this->router->class.'/index',

		));
	}

	public function edit($id_ms_keg)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		$this->load->view('template', array(
			'_title' => $row->judul_kegiatan,
			'_breadcrumbs' => array('ms_variabel'=>'MS Variabel','Edit'),
			'_view' => $this->router->class.'/edit',
			'row' => $row,
		));
	}

    function save()
    {
    	$data = $this->input->post();
        if(isset($data['id_variabel']) && $data['id_variabel']){
            $data['id'] = $data['id_variabel'];
            unset($data['id_variabel']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $data['id_ms_keg']);
            $this->db->update('ms_var', $data);
            //return $this->db->affected_rows();
        } else {
            unset($data['id_variabel']);
            $this->db->insert('ms_var', $data);
            //return $this->db->insert_id();            
        }
	    redirect($this->router->class.'/edit/'.$data['id_ms_keg']);
    }

	public function del($id_ms_keg, $id)
	{
		$row = $this->mskegiatan_model->get($id_ms_keg);
		if($this->mskegiatan_model->del_variabel($id_ms_keg, $id))
			redirect($this->router->class.'/edit/'.$id_ms_keg);
	}

	public function get_checklist()
	{
		$return = array('success'=>0);
		if($this->input->post('id_ms_keg') && $this->input->post('id_variabel')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$id_variabel= $this->input->post('id_variabel') ;
			$row = $this->mskegiatan_model->get_checklist_variabel($id_ms_keg, $id_variabel);
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
		if($this->input->post('id_ms_keg') && $this->input->post('id_variabel')){
			$id_ms_keg = $this->input->post('id_ms_keg') ;
			$id_variabel= $this->input->post('id_variabel') ;
			$data = array(
    			'id_ms_keg' => $this->input->post('id_ms_keg'),
	    		'id_variabel'=> $this->input->post('id_variabel'),
				'checklist' => $this->input->post('checklist'),
				'feedback' => $this->input->post('feedback'),
			);  

			$this->mskegiatan_model->approval_variabel($id_ms_keg, $data);
			$return = array('success' => 1);

		} else 
			$return['message'] = 'Data tidak ditemukan';

		echo json_encode($return);
	}

}
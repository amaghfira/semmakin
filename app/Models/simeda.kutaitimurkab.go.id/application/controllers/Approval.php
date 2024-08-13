<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if($this->session->userdata('role')<3)
			show_404();

		$this->load->model('mskegiatan_model');
    }

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Approval MS Kegiatan',
			'_breadcrumbs'=>array('Approval'),
			'_view'=> $this->router->class.'/index',
		));
	}
		
	public function dialog()
	{
		$this->load->view($this->router->class.'/dialog');
	}
	
	public function view($id,$page=null)
	{
		$row = $this->mskegiatan_model->get($id);
		if(!$page) $page = 1;

		if($this->input->post('prev'))
			redirect($this->router->class.'/view/'.$id.'/'.($page-1));
		else if($this->input->post('next'))
			redirect($this->router->class.'/view/'.$id.'/'.($page+1));
		else if($this->input->post('selesai'))
			redirect($this->router->class);

		$this->load->view('template', array(
			'_title' => $page==1? 'Metadata Kegiatan Statistik' : $row->judul_kegiatan,
			'_breadcrumbs' => array($this->router->class=>'MS Kegiatan','Update'),
			'_view' => $this->router->class.'/view_'.$page,
			'page' => $page,
			'data' => $row,
		));
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
				$return = array ('success' => 1, 'data'=>array('checklist'=>'', 'feedback'=>'', 'respon'=>''));

		} else 
			$return['message'] = 'Data tidak ditemukan-2';

		echo json_encode($return);
	}

	public function submit()
	{
		if($this->input->post('id_ms_keg') && $this->input->post('approval')){
			$result = $this->mskegiatan_model->set_approval_kegiatan($this->input->post('id_ms_keg'), $this->input->post('approval'));
			if($result)
			    redirect('approval');
			else
			    redirect('approval/view/'.$this->input->post('id_ms_keg').'/7');
		}
	}

	public function delete_kegiatan($id_ms_keg)
	{
		if($this->session->userdata('role')!=9)
			show_404();

		$this->db->where('id_ms_keg',$id_ms_keg);
		$this->db->delete('ms_keg');

		redirect($this->router->class);
	}
}

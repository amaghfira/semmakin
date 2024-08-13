<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if(!in_array($this->session->userdata('role'),array('2','9')))
			show_404();

		$this->load->model('user_model');
    }

	public function user($wilayah=null)
	{
		if(!$wilayah || substr($this->session->userdata('id_wilayah'),2,2)!='00')
			$wilayah = $this->session->userdata('id_wilayah');

		$this->load->model('wilayah_model');
		$this->load->helper('form');
		$this->load->view('template', array(
			'_title'=> 'Manajemen Pengguna',
			'_breadcrumbs'=>array('Admin','User'),
			'_view'=> $this->router->class.'/user',
			'id_wilayah'=>$wilayah,
		));
	}
	
	public function user_save()
	{
		$data = $this->input->post();
		if(empty($data['password'])) unset($data['password']);

		if(isset($data['userid']) && $this->user_model->get($data['userid'])){
			$result = $this->user_model->edit($data['userid'], $data);
		} else {
			$result = $this->user_model->add($data);
		}
		redirect($this->router->class.'/user/'.$data['id_wilayah']);
	}

	public function user_del($id)
	{
		$row = $this->user_model->get($id);
		if($this->user_model->del($id))
			redirect($this->router->class.'/user');
	}

	public function json_instansi()
	{
		$term = $_GET['term'];
		echo json_encode($this->user_model->arr_instansi($term));
	}
	
	public function delete($id_wilayah=null, $id_instansi=null, $id_ms_keg=null)
	{
		if(!in_array($this->session->userdata('role'),array('2','9')))
			show_404();
        if($this->session->userdata('role')=='2' && substr($this->session->userdata('id_wilayah'),2,2)!='00')
            $id_wilayah=$this->session->userdata('id_wilayah');

		$this->load->model('wilayah_model');
		$this->load->view('template', array(
			'_title'=> 'Manage MS Kegiatan',
			'_breadcrumbs'=>array('Admin','Manage'),
			'_view'=> $this->router->class.'/delete',
			'id_wilayah'=>$id_wilayah,
			'id_instansi'=>$id_instansi,
			'id_ms_keg'=>$id_ms_keg,
		));
	}
	
	public function confirm_delete($id)
	{
		if(!in_array($this->session->userdata('role'),array('2','9')))
			show_404();

        $this->load->model('mskegiatan_model');
        $keg = $this->mskegiatan_model->get($id);
        if(!$keg) show_404();
        else if(substr($this->session->userdata('id_wilayah'),2,2)!='00' && $keg->id_wilayah!=$this->session->userdata('id_wilayah'))
            show_404();
        
        echo anchor('admin/do_delete/'.$id, '<center>Ya, hapus kegiatan ini:<br>'.$keg->judul_kegiatan.'</center>');
	}
	
	public function do_delete($id)
	{
		if(!in_array($this->session->userdata('role'),array('2','9')))
			show_404();

//	    if($this->input->is_ajax_request() && !empty($this->input->post('input'))){
//	        $input = $this->input->post('input');
	        $this->load->model('mskegiatan_model');
	        $keg = $this->mskegiatan_model->get($id);
	        if(!$keg) show_404();
            else if(substr($this->session->userdata('id_wilayah'),2,2)!='00' && $keg->id_wilayah!=$this->session->userdata('id_wilayah'))
                show_404();
	        
	        
	        $tabel = array('ms_ind', 'ms_var', 'ms_keg_blok_i', 'ms_keg_blok_ii', 'ms_keg_blok_iii',
	            'ms_keg_blok_iv', 'ms_keg_blok_v', 'ms_keg_blok_vi', 'ms_keg_blok_vi', 'ms_keg_blok_viii', 
	            'ms_keg_blok_iv_wilayah','ms_keg_checklist', 'ms_keg_checklist_awal', 'ms_keg');
	       foreach($tabel as $t){
	           $this->db->where('id_ms_keg',$id);
	           $this->db->delete($t);
	       }
	       
	       redirect('admin/delete/'.$keg->id_wilayah.'/'.$keg->id_instansi);
//	    }
	}
	
	public function lock()
	{
		if(!$this->input->is_ajax_request() || !in_array($this->session->userdata('role'),array('2','9')))
			show_404();

	    if($this->input->is_ajax_request() && !empty($this->input->post('key'))){
	        $id = $this->input->post('key');
	        $lock = $this->input->post('lock');
	        
	        $this->load->model('mskegiatan_model');
	        $keg = $this->mskegiatan_model->get($id);

	        if(!$keg) show_404();
            else if(substr($this->session->userdata('id_wilayah'),2,2)!='00' && $keg->id_wilayah!=$this->session->userdata('id_wilayah'))
                show_404();

            $this->mskegiatan_model->update($id, array('sedang_verifikasi'=>!$lock));
	        $keg = $this->mskegiatan_model->get($id);
            echo json_encode(array('result'=>$keg->sedang_verifikasi?'lock':'unlock'));
	    }
	}
	
	public function move($id,$userid)
	{   
		//if(!$this->input->is_ajax_request() || !in_array($this->session->userdata('role'),array('2','9')))
		//	show_404();

	    //if($this->input->is_ajax_request() && !empty($this->input->post('key'))){
	        //$id = $this->input->post('key');
	        //$userid = $this->input->post('userid');
	        
	        $this->load->model('user_model');
	        $user = $this->user_model->get($userid);
	        if(!$user) show_404();
            else if(substr($this->session->userdata('id_wilayah'),2,2)!='00' && $user->id_wilayah!=$this->session->userdata('id_wilayah'))
                show_404();

	        $this->load->model('mskegiatan_model');
	        $keg = $this->mskegiatan_model->get($id);
	        if(!$keg) show_404();
            else if(substr($this->session->userdata('id_wilayah'),2,2)!='00' && $keg->id_wilayah!=$this->session->userdata('id_wilayah'))
                show_404();

            $this->mskegiatan_model->update($id, array('userid'=>$userid, 'instansi'=>$user->instansi));
	        $keg = $this->mskegiatan_model->get($id);
            echo json_encode(array('result'=>$keg->userid==$userid?'success':'error'));
	    //}
	}
	
}

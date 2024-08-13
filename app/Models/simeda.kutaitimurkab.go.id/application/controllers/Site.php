<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()
	{
		if(!$this->session->userdata('login'))
			redirect('login');

		$this->load->model('mskegiatan_model');

		if($this->session->userdata('role')==1)
			$this->load->view('template', array('_view'=>'dashboard_opd'));
		else
			$this->load->view('template', array('_view'=>'dashboard'));
	}

	public function login()
	{
		if($this->input->is_ajax_request()){
			$this->load->model('user_model');
			$row = $this->user_model->login($this->input->post('username'),$this->input->post('password'));
			if($row){
				$this->session->set_userdata(array(
					'login' => TRUE,
					'foto' => base_url('assets/theme/img/user2-160x160.jpg'),
					'id_wilayah' => $row->id_wilayah,
					'userid' => $row->userid,
					'username' => $row->username,
	 				'instansi' => $row->instansi,
	 				'role' => $row->role,
				));
				
				echo json_encode(array('login'=>TRUE));
			} else
				echo json_encode(array('login'=>FALSE, 'message'=>'User tidak dikenal'));
			exit();
		}

		if($this->session->userdata('login'))
			redirect();

		$this->load->view('login');
	}

	public function logout()
	{
		session_destroy();
		redirect();
	}

	public function error_log($file=null, $clear=null)
	{
         if(!is_file(APPPATH.'/logs/'.$file.'.php'))
            $file = null;
         elseif($clear && is_file(APPPATH.'/logs/'.$file.'.php')){
            unlink(APPPATH.'/logs/'.$file.'.php');
            redirect('site/error_log');
         }

		$this->load->view('template', array(
			'_title' => 'Error Log'.($file?' : '.$file:''),
			'_view' => 'error_log',
            'file'=>$file,
 		));
	}

	public function profil()
	{
	    if($this->input->post('password')){
    		$this->load->model('user_model');
    		$this->user_model->update_password($this->session->userdata('userid'),$this->input->post('password'));
	    }
	    
		$this->load->model('wilayah_model');
		$this->load->view('template', array(
			'_title' => 'Profil Pengguna',
			'_view' => 'profil',
 		));
	}
	
}

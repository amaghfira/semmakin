<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	var $token = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJicHMzMzAwIiwiUk9MRVMiOlsiUk9MRV9NU19PUEVSQVRPUiJdLCJleHAiOjE2MzcxMTcxNDEsImlhdCI6MTYzNzAzMDc0MX0.4U_KzvnntHsSvBk3hhPB3rm9L3KMu4X2ArHU702Jcu6kuRzCylNX2usMQZvxqv4RDGmfX0Pk1Kv_TVAvOBe5Sw1';

	public function __construct()
	{
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		if($this->session->userdata('id_wilayah')!='6404' || $this->session->userdata('role')!=9)
		    show_404();
		    
		$this->load->model('wilayah_model','wilayah');
		$this->load->model('user_model','user');
		$this->load->model('mskegiatan_model','mskeg');
	}

	public function index()
	{
		$this->load->view('template', array(
			'_title'=> 'Upload ke INDAH',
			'_breadcrumbs'=>array('Upload INDAH'),
			'_view'=> $this->router->class.'/index',
		));
	}

	public function kab($id_wilayah)
	{
		$this->load->view('template', array(
			'_title'=> 'Upload ke INDAH',
			'_breadcrumbs'=>array($this->router->class=>'Upload INDAH',$id_wilayah),
			'_view'=> $this->router->class.'/kab',
			'id_wilayah'=>$id_wilayah
		));
	}

	public function reupload($id_wilayah)
	{
		$this->load->view('template', array(
			'_title'=> 'Reupload ke INDAH',
			'_breadcrumbs'=>array($this->router->class=>'Reupload INDAH',$id_wilayah),
			'_view'=> $this->router->class.'/reupload',
			'id_wilayah'=>$id_wilayah
		));
	}

	public function set_mskeg($id_wilayah,$id_kegiatan,$id_indah)
	{
		$mskeg = $this->mskeg->get($id_kegiatan);
		if($mskeg && $mskeg->id_wilayah==$id_wilayah && !$mskeg->id_indah && $id_indah) {
			$this->db->where('id_ms_keg',$id_kegiatan);
			$this->db->update('omae_ms_keg', array('id_indah'=>$id_indah));
			echo $this->db->affected_rows();
		}
	}

	public function set_msvar($id_wilayah,$id_kegiatan,$id_var,$id_indah)
	{
		$mskeg = $this->mskeg->get($id_kegiatan);
		if($mskeg && $mskeg->id_wilayah==$id_wilayah && $mskeg->id_indah && $id_var && $id_indah) {
			$this->db->where('id',$id_var);
			$this->db->update('omae_ms_var', array('id_indah'=>$id_indah));
			echo $this->db->affected_rows();
		}
	}

	public function set_msind($id_wilayah,$id_kegiatan,$id_ind,$id_indah)
	{
		$mskeg = $this->mskeg->get($id_kegiatan);
		if($mskeg && $mskeg->id_wilayah==$id_wilayah && $mskeg->id_indah && $id_indah) {
			$this->db->where('id',$id_ind);
			$this->db->update('omae_ms_ind', array('id_indah'=>$id_indah));
			echo $this->db->affected_rows();
		}
	}

    public function set_bearer()
    {
        $this->session->set_userdata('bearer', $this->input->post('bearer'));
    }
    
    public function get_bearer()
    {
        echo $this->session->userdata('bearer');
    }
    
    public function script($id_wilayah)
    {
        $this->load->view('upload/script', array('id_wilayah'=>$id_wilayah));
    }
    
    public function credential()
    {
        echo json_encode(array(
            "username" => "kominfokutim",
            "password" => "PpoWORmO8D"
          ));
    }
}

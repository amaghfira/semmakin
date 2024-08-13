<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	var $_model;

	public function __construct()
	{
        	parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
		$this->load->model('mskegiatan_model');
		$this->_model = $this->mskegiatan_model;
		$this->load->model('wilayah_model');
	}

	public function wilayah()
	{
		$this->load->view('template', array(
			'_title'=> 'Rekap Menurut Wilayah',
			'_breadcrumbs'=>array('Report'),
			'_view'=> $this->router->class.'/wilayah',

		));
	}

	public function instansi($id_wilayah=null)
	{
		if(!$id_wilayah)
			$id_wilayah = $this->session->userdata('id_wilayah');

		$this->load->view('template', array(
			'_title'=> 'Rekap Menurut Instansi',
			'_breadcrumbs'=>array('Report'),
			'_view'=> $this->router->class.'/instansi',
			'id_wilayah'=>$id_wilayah,
		));
	}

	public function pertanyaan($id_wilayah=null, $id_instansi=null, $id_ms_keg=null)
	{
		if(!$id_wilayah && substr($this->session->userdata('id_wilayah'),2,2)!='00')
			$id_wilayah = $this->session->userdata('id_wilayah');

		$this->load->view('template', array(
			'_title'=> 'Rekap Menurut Pertanyaan',
			'_breadcrumbs'=>array('Report'),
			'_view'=> $this->router->class.'/pertanyaan',
			'id_wilayah'=>$id_wilayah,
			'id_instansi'=>$id_instansi,
			'id_ms_keg'=>$id_ms_keg,
		));
	}

	public function feedback_pertama($id_wilayah=null, $id_instansi=null, $id_ms_keg=null)
	{
		if(!$id_wilayah && substr($this->session->userdata('id_wilayah'),2,2)!='00')
			$id_wilayah = $this->session->userdata('id_wilayah');

		$this->load->view('template', array(
			'_title'=> 'Rekap Menurut Feedback Pertama',
			'_breadcrumbs'=>array('Report'),
			'_view'=> $this->router->class.'/feedback_pertama',
			'id_wilayah'=>$id_wilayah,
			'id_instansi'=>$id_instansi,
			'id_ms_keg'=>$id_ms_keg,
		));
	}
}
	
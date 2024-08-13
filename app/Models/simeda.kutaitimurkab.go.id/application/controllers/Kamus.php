<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamus extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');

		$this->load->model('mskegiatan_model');
    }

	public function index()
	{

	}
			
	public function kegiatan()
	{
		$this->load->view('template', array(
			'_title' => 'Kamus Metadata Kegiatan',
			'_breadcrumbs' => array('Kamus','MS Kegiatan'),
			'_view' => $this->router->class.'/kegiatan',
		));
	}

	public function variabel()
	{
		$this->load->view('template', array(
			'_title' => 'Kamus Metadata Variabel',
			'_breadcrumbs' => array('Kamus','MS Variabel'),
			'_view' => $this->router->class.'/variabel',
		));
	}

	public function indikator()
	{
		$this->load->view('template', array(
			'_title' => 'Kamus Metadata Indikator',
			'_breadcrumbs' => array('Kamus','MS Indikator'),
			'_view' => $this->router->class.'/indikator',
		));
	}

}

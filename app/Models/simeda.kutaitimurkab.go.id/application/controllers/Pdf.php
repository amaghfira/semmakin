<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

	public function index()
	{
	}

	public function view($hash=null)
	{
		if(!$hash) 
			show_404();

		$this->load->model('mskegiatan_model');	
		$this->load->library('qr_creator');
		$this->load->library('pdf_creator');	

		$qr_file = 'assets/qrcode/'.$hash.'.png';
		$this->qr_creator->generate(array(
			'data' => base_url().'pdf/'.$hash,
			'savename' => $qr_file
		));

      $data = array(
      	'data' => $this->mskegiatan_model->get_by_hash($hash),
      	'qr_file' => $qr_file,
      );
		$html = $this->load->view('download_pdf', $data, true);

      $this->pdf_creator->generate($html, 'MS Kegiatan');
	}

	public function variabel($hash=null)
	{
		if(!$hash) 
			show_404();

		$this->load->model('mskegiatan_model');	
		$this->load->library('qr_creator');
		$this->load->library('pdf_creator');	

		$qr_file = 'assets/qrcode/'.$hash.'.png';
		$this->qr_creator->generate(array(
			'data' => base_url().'pdf/'.$hash,
			'savename' => $qr_file
		));

      $data = array(
      	'data' => $this->mskegiatan_model->get_by_hash($hash),
      	'qr_file' => $qr_file,
      );
		$html = $this->load->view('download_var', $data, true);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ms-var.xls"');
header('Cache-Control: max-age=0');
echo $html;

//      $this->pdf_creator->generate($html, 'MS Variabel', 'A4', 'landscape');
	}

	public function indikator($hash=null)
	{
		if(!$hash) 
			show_404();

		$this->load->model('mskegiatan_model');	
		$this->load->library('qr_creator');
		$this->load->library('pdf_creator');	

		$qr_file = 'assets/qrcode/'.$hash.'.png';
		$this->qr_creator->generate(array(
			'data' => base_url().'pdf/'.$hash,
			'savename' => $qr_file
		));

      $data = array(
      	'data' => $this->mskegiatan_model->get_by_hash($hash),
      	'qr_file' => $qr_file,
      );
		$html = $this->load->view('download_ind', $data, true);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ms-ind.xls"');
header('Cache-Control: max-age=0');
echo $html;
//      $this->pdf_creator->generate($html, 'MS Indikator', 'A4', 'landscape');
	}

}
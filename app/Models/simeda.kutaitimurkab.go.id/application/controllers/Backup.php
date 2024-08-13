<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	var $backup_dir = '_backup';
	var $backup_name = 'db';

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->has_userdata('username')){
        	redirect('site/login'); 
        }

    }

	public function index()
	{	
		$this->load->view('template', array(
			'_view'=>'backup',
			'title'=>'Backup Database'
		));
	}

	public function create()
	{	
		$basename = $this->backup_name . '_' . date('Y-m-d_H-i-s');
		$this->load->dbutil();
		$prefs = array(
		        'tables'        => array(),   
		        'ignore'        => array(),
		        'format'        => 'zip',
		        'filename'      => $basename . '.sql',
		        'add_drop'      => TRUE,
		        'add_insert'    => TRUE,
		        'newline'       => "\n"
		);
		$backup = $this->dbutil->backup($prefs);

		$this->load->helper('file');
		$output = $this->backup_dir . '/' . $basename . '.zip';
		write_file($output, $backup);

		redirect($this->router->fetch_class());
	}

	public function get($file)
	{	
		$file = $this->backup_dir.'/'.urldecode($file);
		if(is_file($file)){
			header('Content-type: application/zip;');
			header('Content-Transfer-Encoding: Binary');
			header('Content-length: '.filesize($file).';');
			header('Content-disposition: attachment; filename="'.basename($file).'"');
			readfile($file);
			exit();
		} else
			show_404();
	}

	public function del($file)
	{	
		$file = $this->backup_dir.'/'.urldecode($file);
		if(is_file($file)){
			unlink($file);
			redirect($this->router->fetch_class());
		} else
			show_404();
	}

}
	
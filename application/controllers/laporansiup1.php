<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporansiup1 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->view_data['base_url']=base_url();
		//$this->load->library('grocery_CRUD');	
		$this->load->library('table');
		$this->load->library('calendar');
	}
	
	public function index()
    {
        $this->load->view('tes-excel.php');
    }

}
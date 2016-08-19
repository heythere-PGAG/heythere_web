<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function index()
	{
		$this->load->view('test');
	}	
	
	public function work(){
		$this->load->view('work');
	}	
	public function about(){
		$this->load->view('about');
	}
	public function contact(){
		$this->load->view('contact');
	}
}
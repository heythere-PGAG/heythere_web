<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
class api extends CI_Controller {
	
	public function contactUs(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->contactUsModel($jsonRequest));
		
	}
	
	public function processLogin(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->processLoginModel($jsonRequest));
	}
	
	public function profileDetails(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->profileDetailsModel($jsonRequest));
	}
	
	public function fbAuthProcess(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->fbAuthProcessModel($jsonRequest));
	}
	
	public function processSignup(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->processSignupModel($jsonRequest));
	}
	
	public function getEvents(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->getEventsModel($jsonRequest->heythere_user_id));
	}
	
	public function getEventsForMap(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->getEventsForMapModel($jsonRequest));
	}
	
	public function getEventDetail(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->getEventDetailModel($jsonRequest));
	}
	
	public function getEventsCategory(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->getEventsCategoryModel($jsonRequest));
	}
	
	public function likeEvent(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->likeEventModel($jsonRequest));
	}	
	
	public function dislikeEvent(){
		$jsonRequest = json_decode(file_get_contents('php://input'));
		$this->load->model('api_models');
		echo json_encode($this->api_models->dislikeEventModel($jsonRequest));
	}
	
}
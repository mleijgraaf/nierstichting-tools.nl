<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	var $json_data= array(
	
		'error' => true,
		'html' => 'Ajax Error: Invalid Request'
		
	);
	

	function __construct() 
	{
	
		parent::__construct();
		
		
		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Expires: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		
		//$this->load->model('image_model');
		
	}
	
	public function index()
	{
		// is niet benaderbaar via de browser
		exit;
	}	
	
	
	public function postform()
	{


		
		if($this->input->get('voornaam') == '') { exit; }
		if($this->input->get('achternaam') == '') { exit; }
		if($this->input->get('email') == '') { exit; }
		if($this->input->get('geslacht') == '') { exit; }

		// check if email exists
		$this->db->where('email', $this->input->get('email'));
		$this->db->get('deelnemers');

		if ($this->db->affected_rows() > 0) {
			$this->json_data['error'] = true;
			$this->json_data['html'] = "bestaat_al";
			
		} else {
		
		
			$insert = $this->input->get();
	
			$insert['date'] = date('Y-m-d H:i:s');
			$insert['optin'] = 1; // vast want verplicht
			$insert['utm_source'] = $this->session->userdata('utm_source');
			$insert['utm_campaign'] = $this->session->userdata('utm_campaign');
			$insert['utm_content'] = $this->session->userdata('utm_content');
			$insert['utm_medium'] = $this->session->userdata('utm_medium');
			$insert['unique_id'] = $this->site_model->unique_id(10);
	
				
			if( $this->db->insert('deelnemers', $insert) )
			{
				
				$insert_id = $this->db->insert_id();
				//$this->session->set_userdata('insert_id', $insert_id);
				//$this->session->set_userdata('unique_id', $insert['unique_id']);
				$this->tasks_model->add_task('send_to_clang', $insert_id);
				$this->json_data['error'] = false;
				$this->json_data['html'] = '';

			}
			else
			{
				$this->json_data['error'] = true;
			}
		
		}

	}	
	
	function _output($output) 
	{
		echo json_encode($this->json_data);
		exit;
	}



}
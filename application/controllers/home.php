<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

	$utm_codes = $this->site_model->getUtmCodes();
	
	
	
	if ($utm_codes != false) {
		$this->session->set_userdata('utm_source', @$utm_codes['utm_source']);
		$this->session->set_userdata('utm_medium', @$utm_codes['utm_medium']);
		$this->session->set_userdata('utm_campaign', @$utm_codes['utm_campaign']);
		$this->session->set_userdata('utm_content', @$utm_codes['utm_content']);		
	} else {
		$this->session->set_userdata('utm_source', @$_GET['utm_source']);
		$this->session->set_userdata('utm_medium', @$_GET['utm_medium']);
		$this->session->set_userdata('utm_campaign', @$_GET['utm_campaign']);
		$this->session->set_userdata('utm_content', @$_GET['utm_content']);		
	}
	

		if (array_key_exists("signed_request", $_REQUEST))
		{
			$signed_request = $_REQUEST["signed_request"] ;
			list($encoded_sig, $payload) = explode(".", $signed_request, 2);
			$decodedata = json_decode(base64_decode(strtr($payload, "-_", "+/")), true) ;

			if(isset($decodedata['app_data']))
			{
				$jsondata = json_decode($decodedata['app_data']);

				$this->session->set_userdata('utm_source', @$jsondata->utm_source);
				$this->session->set_userdata('utm_medium', @$jsondata->utm_medium);
				$this->session->set_userdata('utm_campaign', @$jsondata->utm_campaign);
				$this->session->set_userdata('utm_content', @$jsondata->utm_content);
			}

		}
		
		
		
		/*
		*	Met 'page' de view aangeven, views in folders; folder/view
		*	de rest van de content in de content array, deze wordt automatisch doorgezet naar de view.
		*/			
		$data['page'] = 'home';
		$data['content']['title'] = '';
		$data['content']['tekst'] = '';
		$this->load->view('template/template', $data);
	}

}

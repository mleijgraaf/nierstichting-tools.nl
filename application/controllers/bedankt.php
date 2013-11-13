<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bedankt extends CI_Controller {

	public function index()
	{

		
		
		
		/*
		*	Met 'page' de view aangeven, views in folders; folder/view
		*	de rest van de content in de content array, deze wordt automatisch doorgezet naar de view.
		*/			
		$data['page'] = 'bedankt';
		$data['content']['title'] = '';
		$data['content']['tekst'] = '';
		$this->load->view('template/template', $data);
	}

}

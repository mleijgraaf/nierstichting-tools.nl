<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class redirect extends CI_Controller {



	public function index()
	{

		$utm_codes = ltrim($_SERVER['REQUEST_URI'], '/redirect');

		$facebook_tab = 'https://www.facebook.com/nierstichting/app_571854966196684';

		$this->load->library('user_agent');

		// als het mobiel is
		if ($this->agent->is_mobile()) 
		{
			redirect('/'.$utm_codes);
		}

		else 
		{
			$utm_codes = ltrim($utm_codes, '?');
			$utm_arr = parse_str($utm_codes, $utms);
			$utm_string = json_encode($utms);
			redirect($facebook_tab.'?app_data='.$utm_string);
		}


	}

}


// https://www.facebook.com/dialog/pagetab?app_id=571854966196684&next=https://nierstichting-tools.nl/
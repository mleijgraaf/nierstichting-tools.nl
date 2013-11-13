<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model 
{

	var $user_info;
	

    public function __construct()
    {
        parent::__construct();

    }
    

    function check_login()
    {
	    if($this->session->userdata('loggedin') !== true)
	    {
		    redirect('/');
	    }
    }
    
    
    
    function try_login()
    {
	    
		$fb_login = $this->facebook_model->user_info();

		$fb_perms = $this->facebook_model->check_permissions();		
		
		$this->session->set_userdata('fbdata', $fb_login);

				
		
		if($fb_login == false || $fb_perms == false)
		{
			$this->session->set_flashdata('error', '1');
			redirect('/');
		}

		else
		{
			$this->session->set_userdata('loggedin', true);
			
			$image = $this->facebook_model->get_pic();
			
		}
	    
    }
    
      function unique_id($length) {
    
	//set the random id length 
	$random_id_length = $length; 
	
	//generate a random id encrypt it and store it in $rnd_id 
	$rnd_id = crypt(uniqid(rand(),1)); 
	
	//to remove any slashes that might have come 
	$rnd_id = strip_tags(stripslashes($rnd_id)); 
	
	//Removing any . or / and reversing the string 
	$rnd_id = str_replace(".","",$rnd_id); 
	$rnd_id = strrev(str_replace("/","",$rnd_id)); 
	
	//finally I take the first 10 characters from the $rnd_id 
	$rnd_id = substr($rnd_id,0,$random_id_length); 
	
	return $rnd_id;
	}  
    
    function getUtmCodes() {
    // haalt utm codes en andere variabelen uit parent url 
    $parent = explode("?",@$_SERVER['HTTP_REFERER']);
    
    
    if (!empty($parent[1])) {
    $utm_codes_total = explode("&",$parent[1]);
    $utm_codes = array();
    foreach($utm_codes_total as $key) {
        $string = explode("=",$key);
        $utm_codes[$string[0]] = $string[1];
    }
    
     return $utm_codes;
    } else {
        return false;
    }
    
}
}
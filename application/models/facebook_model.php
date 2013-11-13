<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Facebook_model extends CI_Model {
 
    
    
    
    public function __construct()
    {
        parent::__construct();
 
        $config = array(
            'appId'  => $this->config->item('app_id'),
            'secret' => $this->config->item('app_secret'),
            'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
            'cookie' => true
        );
 
        
        $this->load->library('Facebook', $config);
        
 
    }
    
    // user gegevens ophalen
    public function user_info() 
    {
        $user = $this->facebook->getUser();
        
        $data = array();
        
        if($user)
        {         
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $data = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                log_message('error', $e->getMessage());
            }  
            
            
        }
        
        else
        {
	        $data = false;
        }  

        return $data;
        
    }
    
    
    
    
    // profiel picture van persoon krijgen.
    function get_pic()
    {
    
	    try {
	    
	    	$opt = array(
	    		'fields' => 'picture'
	    	);
	    
	    	$data = $this->facebook->api("/me", 'get', $opt);
	    	
	    
	    } catch (FacebookApiException $e) {
	    
		    $data = false;
		    
	    }	
	    
	    return $data;  	    
    }
    
    
    // meeste apps posten iets op de wall, meer niet. Voor meer permissies:
    // http://developers.facebook.com/docs/reference/login/
    public function check_permissions()
    {
    
	    try {
	    	$app_permission = $this->facebook->api("/me/permissions");
	    } catch (FacebookApiException $e) {
		    $app_permission = false;
	    }
	    
	    $permission = $app_permission['data'][0];
	    
	    
	    if( 
	    	!isset($permission['installed']) || 
	    	!isset($permission['publish_stream'])
	    )
	    {
		    return false;
	    }
	    
	    else
	    {
		    return true;
	    }
	    
	    
	    return $app_permission;
	    
    }
    
    
    

    
    
    
    // Foto upload 
    public function photo_to_wall()
    {
    	
    	
    	try {
		    
		    $data = array(
		    	'name' => 'tekst bij foto',
		    	'source' => '@' . realpath('./root/pad/van/plaatje')
		    );
		    
		    
		    $this->facebook->api('/me/photos', 'post', $data);
		    	    	
    	}
    	
	    catch(Exception $e)
	    {
		    log_message('error', $e->getMessage());
	    }
	    
	    
    }


    // standaard post naar eigen wall
    public function post_to_wall()
    {
	    try
	    {
		    $data = array(
		    	'message' => '',
		    	'picture' => '',
		    	'name' => '',
		    	'caption' => '',
		    	'link' => '',
		    	'description' => ''
		    );
		    
		    $this->facebook->api('/me/feed/', 'post', $data);
	    } 
	    
	    catch(Exception $e)
	    {
		    log_message('error', $e->getMessage());
	    }
	    
    }
    
    
    

    
    
}
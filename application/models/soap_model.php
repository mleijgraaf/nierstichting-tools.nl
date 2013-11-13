<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soap_model extends CI_Model {



	var $token;
	var $client;
	var $soapConfig;
	
	

    function __construct()
    {
        parent::__construct();
        
    	$this->soapConfig = array(
	    	'trace' 		=> true,
	    	'exceptions'	=> true,
	    	"uri" 			=> "urn:xmethods-delayed-quotes",
			"style"    		=> SOAP_RPC,
			"use"      		=> SOAP_ENCODED	
    	);
    
		//SOAP Client instellen
		$this->client = new SoapClient("https://secure.myclang.com/app/api/soap/public/wsdl/index.php?wsdl&version=1.0-edm", $this->soapConfig);
		
		//CLANG Token
		$this->token = $this->config->item('token');  
        
    }
    
    
    
	/*
	*	Het recursive aantal van een groep ophalen uit Clang.
	*/	    
    function get_groupSize($groupId)
    {
    	
    	// GET GROUP SIZE
		$getGroupSize = array(
	        "uuid" => $this->token, 
	        "groupId" => $groupId
    	);
		
		try { 
		    $result        =   $this->client->group_getById($getGroupSize);       
		    $customerCount  =   $result->msg->customerCountRecursive;  // telt alles in groep inclusief subgroepen!
		} catch (Exception $e) {
		    echo $e->getMessage();
		}    
		
		return $customerCount;
    
    }
    
 	/*
	*	Standaard campaign execute.
	*/	   
    function campaign_execute($campagne_clang_id, $data)
    {
	    
		$send_data = array(
			"uuid" => $this->token,
			"campaignId" => $campagne_clang_id,
			"options" => $data
		);
		
		//echo "<pre>";
		//var_dump($send_data);
		//exit;
		
		try { 
		
			$this->client->campaign_execute($send_data);
			
			
		} catch (Exception $e) {
		
		    echo "Clang: ".$e->getMessage();
		    
		} 
		
			    
    }
    
    
    
    
    
}
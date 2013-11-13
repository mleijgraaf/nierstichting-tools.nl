<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {


	public function add_task($type, $uuid)
	{
		
		$insert_data = array(
			'type' => $type,
			'uuid' => $uuid
		);
		
		$this->db->insert('tasks', $insert_data);
		
	}
	
	
	public function script_busy($num_tasks)
	{
		
		$data = array(
			'tasks' => $num_tasks,
			'start' => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('tasks_manager', $data);
		
		
		return $this->db->insert_id();
		
	}
	
	public function script_finished($id)
	{
		$data = array(
			'end' => date('Y-m-d H:i:s'),
			'finished' => 1
		);
		
		$this->db->where('id', $id);
		$this->db->update('tasks_manager', $data);
		
	}
	
	
	public function finish_task($task_id)
	{
		
		$data = array(
			'sync_date' => date('Y-m-d H:i:s')
		);
		
		$this->db->where('id', $task_id);
		$this->db->update('tasks', $data);
		
	}
	
	
	
	public function script_in_use()
	{
		
		$this->db->where('finished', 0);
		$query = $this->db->get('tasks_manager');
		
		if($query->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
	}




	public function unfinished_task_manager_data()
	{
		$query = $this->db->query("SELECT * FROM tasks_manager WHERE finished = '0' order by id DESC limit 0,1");

		return $query->row(0);
	}


	public function last_task_data()
	{
		$query = $this->db->query('SELECT * FROM tasks WHERE sync_date IS NOT NULL order by id DESC limit 0,1');

		return $query->row(0);

	}
	
	
	
	
	// ===================================================================================
	// 	TAKEN
	// ===================================================================================	
 	
	// voorbeeld van data op basis van uniek id ophalen, meeste apps hebben maar één
	// database dus dan is één functie genoeg.
 	function get_uuid_info($uuid)
 	{
	    $this->db->where('id', $uuid);
	    $query = $this->db->get('deelnemers');
	    
	    return $query->row(0);	    
 	}   	


	function send_to_clang($uuid) {
		// Voorbeeld data van een campaign execute.
		// Taken worden altijd ingeschoten met hun inieke, deze kun je dan gebruiken om data uit DB te trekken.

	    $data = $this->get_uuid_info($uuid);
	    
	    $exec_data[] = array('name' => 'soap_uniqueid', 'value' => $data->unique_id);
	    $exec_data[] = array('name' => 'soap_geslacht', 'value' => $data->geslacht);
	    $exec_data[] = array('name' => 'soap_email', 'value' => $data->email);
	    $exec_data[] = array('name' => 'soap_voornaam', 'value' => $data->voornaam);
	    $exec_data[] = array('name' => 'soap_tussenvoegsel', 'value' => $data->tussenvoegsel);
	    $exec_data[] = array('name' => 'soap_achternaam', 'value' => $data->achternaam);
	    $exec_data[] = array('name' => 'soap_postcode', 'value' => $data->postcode);
	    $exec_data[] = array('name' => 'soap_adres', 'value' => $data->adres);
	    $exec_data[] = array('name' => 'soap_huisnummer', 'value' => $data->huisnummer);
	    $exec_data[] = array('name' => 'soap_plaats', 'value' => $data->plaats);
	    $exec_data[] = array('name' => 'soap_utm_bron', 'value' => $data->utm_source);
	    $exec_data[] = array('name' => 'soap_utm_medium', 'value' => $data->utm_medium);
	    $exec_data[] = array('name' => 'soap_utm_campaign', 'value' => $data->utm_campaign);
	    $exec_data[] = array('name' => 'soap_utm_content', 'value' => $data->utm_content);
	    $exec_data[] = array('name' => 'soap_utm_timestamp', 'value' => $data->date);
	    $exec_data[] = array('name' => 'soap_optin', 'value' => $data->optin);
	    $exec_data[] = array('name' => 'soap_datum', 'value' => $data->date);
	    
	    $this->soap_model->campaign_execute(5, $exec_data);
	}


	
	

    
}
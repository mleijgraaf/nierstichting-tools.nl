<?php
class Dotasks extends CI_Controller {
	

	public function __construct()
	{
		parent::__construct();

		$this->load->model('tasks_model');
		$this->load->model('soap_model');
		
		if($this->tasks_model->script_in_use())
		{

			$taskman_data = $this->tasks_model->unfinished_task_manager_data();

			$task_data = $this->tasks_model->last_task_data();

			$task_synced = strtotime($task_data->sync_date);
			$now = strtotime('now');

			$diff = $now - $task_synced;

			// als script in gebruik is en de laatste taak is 5 minuten geleden afgerond, dan het script op finished zetten zodat deze wel blijft lopen
			if($diff > 300) // 5 min
			{
				$this->tasks_model->script_finished($taskman_data->id);
			}
			else
			{
				echo 'Script currently in use'; exit;
			}

		}
		
	}
	
	
	public function index()
	{
		// alle niet gesyncte taken ophalen
		$this->db->where('sync_date', NULL);
		$this->db->order_by('prio', 'asc');
		$query = $this->db->get('tasks');
		$tasks = $query->result();
		$num_tasks = count($tasks);
		
		// Sync incl subtaken in project manager zetten.
		$task_manager = $this->tasks_model->script_busy($num_tasks);
		
		// als er taken zijn.
		if(count($tasks) > 0)
		{
			foreach($tasks as $task)
			{
				
				$function = $task->type;
				
				// de functienaam van de taak moet overeen komen met de ingeschoten taak.
				$task_status = $this->tasks_model->$function($task->uuid);
				
				// als taak voltooid is, finishen.
				$this->tasks_model->finish_task($task->id);
				
			}			
		}

		else
		{
			// als er geen taken zijn, het script weer vrijgeven in de database.
			$this->tasks_model->script_finished($task_manager);
			echo 'no-tasks'; exit;
		}

		
		// na alle taken script klaar.
		$this->tasks_model->script_finished($task_manager);
		
		
	}
	
	
	
}
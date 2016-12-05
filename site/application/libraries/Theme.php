<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme {

	private $CI;

	private $templates = array();

	private $head_view = array();
	private $data_passed_to_head_view = array(); // parallel arrays

	private $body_view = array();
	private $data_passed_to_body_view = array(); // parallel arrays

	private $alert_type_array = array();
	private $alert_array = array(); // parallel arrays

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->templates['header_template'] = 'theme/header';
		$this->templates['head_body_seporator'] = 'theme/head_body_seporator.php';
		$this->templates['footer_template'] = 'theme/footer';

		$this->templates['alert_template'] = 'theme/alert';
	}

	public function add_head_view($view_to_add, $data_passed = NULL)
	{
		$this->head_view[] = $view_to_add;
		$this->data_passed_to_head_view[] = $data_passed;
	}

	public function add_body_view($view_to_add, $data_passed = NULL)
	{
		$this->body_view[] = $view_to_add;
		$this->data_passed_to_body_view[] = $data_passed;
	}

	public function add_alert($alert_type, $alert_message)
	{
		$this->alert_type_array[] = $alert_type;
		$this->alert_array[] = $alert_message;
	}

	public function display($data)
	{
		$this->CI->load->view($this->templates['header_template'], $data);

		foreach($this->head_view as $i => $head_view_to_display)
		{
			if($this->data_passed_to_head_view[$i] != NULL)
			{
				$this->CI->load->view($head_view_to_display, $this->data_passed_to_body_view[$i]);
			}
			else
			{
				$this->CI->load->view($head_view_to_display);
			}
		}

		$this->CI->load->view($this->templates['head_body_seporator']);

		foreach($this->alert_array as $i => $alert_message)
		{
			$alert_data['alert_type_class'] = $this->alert_type_array[$i];
			$alert_data['alert_message'] = $alert_message;
			$this->CI->load->view($this->templates['alert_template'], $alert_data);
		}

		foreach($this->body_view as $i => $body_view_to_display)
		{
			if($this->data_passed_to_body_view[$i] != NULL)
			{
				$this->CI->load->view($body_view_to_display, $this->data_passed_to_body_view[$i]);
			}
			else
			{
				$this->CI->load->view($body_view_to_display);
			}
		}

		$this->CI->load->view($this->templates['footer_template']);
	}
}

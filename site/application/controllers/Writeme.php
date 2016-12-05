<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Writeme extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library(array('form_validation', 'theme'));
		$this->load->model(array('main_model', 'writeme_model'));
	}


	/**
	 * Writeme module
	 *
	 * @author Vasilesk
	 **/
	public function index()
	{
		$data = [
			'title' => 'Write me',
			'description' => 'Write me smth pls'
		];

		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'writeme']);

		$this->form_validation->set_rules('sender_name', 'Name', 'required');
		$this->form_validation->set_rules('message_text', 'Message', 'required');
		$this->form_validation->set_message('required', '<blockquote class="lead bg-danger">Required field: %s</blockquote>');

		if ($this->form_validation->run() === FALSE)
		{
			//
		}
		else
		{
			$this->writeme_model->send_email();
			$this->theme->add_body_view('writeme/success');
		}

		$this->theme->add_body_view('writeme/main', $this->writeme_model->get_writeme_form_data());
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coding extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('theme'));
		$this->load->model(array('main_model', 'coding_model'));
	}


	/**
	 * Coding page
	 *
	 * @author Vasilesk
	 **/
	public function index()
	{
		$data = [
			'title' => 'My code - Vasilesk World',
			'description' => 'The code I wrote'
		];

		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'coding']);
		$this->theme->add_body_view('coding/main', $this->coding_model->get_coding_data());
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}
}

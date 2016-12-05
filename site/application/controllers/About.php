<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('theme'));
		$this->load->model(array('main_model', 'about_model'));
	}


	/**
	 * About Me page
	 *
	 * @author Vasilesk
	 **/
	public function index()
	{
		$data = [
			'title' => 'About me',
			'description' => 'Some info about me'
		];

		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'about']);
		$this->theme->add_body_view('about/main', $this->about_model->get_about_data());
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('main_model');
		$this->load->library(array('theme'));
	}


	/**
	 * Main page
	 *
	 * @author Vasilesk
	 **/
	public function index()
	{
		$data = [
			'title' => 'My precious site',
			'description' => 'My precious site is here'
		];

		$this->theme->add_head_view('theme/head/captionhovereffects');
		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'main']);
		$this->theme->add_body_view('theme/body/title_tabs', $this->main_model->get_title_tabs_data() + ['is_portable' => FALSE]);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}
}

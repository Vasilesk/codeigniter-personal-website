<?php
class Override404 extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->load->library('theme');
       $this->load->model('main_model');
    }

    /**
     * 404 page
     *
     * @author Vasilesk
     **/
    public function index()
    {
        $this->output->set_status_header('404');
        $data['title'] = 'Error 404: page was not found.';
        $data['header1'] = ':-(';
        $data['text'] = '<p>Sorry, the page was not found.<br /> Go to <a href="/">main page</a>.</p>';

        $this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => '']);
        $this->theme->add_body_view('override404', $data);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
    }
}

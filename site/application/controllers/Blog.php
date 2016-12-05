<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('theme', 'pagination', 'ion_auth'));
		$this->load->model(array('main_model', 'blog_model'));
	}

	/**
	 * Blog page. Default for /blog/ in routes.php
	 *
	 * @author Vasilesk
	 **/
	public function page($page_number = 1)
	{
		$page_number = intval($page_number);
		if($page_number < 1)
		{
			show_404();
		}

		$data = [
			'title' => 'My blog',
			'description' => 'The blog I love'
		];

		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'blog']);
		$this->theme->add_body_view('blog/page', $this->blog_model->get_page_data($page_number) + ['pagination' => $this->blog_model->get_pagination()]);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}

	/**
	 * Blog post
	 *
	 * @author Vasilesk
	 **/
	public function post($post_id = 0)
	{
		$post_id = intval($post_id);
		if($post_id < 1)
		{
			show_404();
		}

		$post_data = $this->blog_model->get_post_data($post_id, FALSE);
		if(empty($post_data['post']))
		{
			show_404();
		}

		$data = [
			'title' => $post_data['post']['title'] . ' - Blog - Vasilesk World',
			'description' => strip_tags($post_data['post']['text_summary'])
		];

		if($this->ion_auth->is_admin())
		{
			$post_data['edit_href'] = '/blog/' . $post_id . '/edit';
		}
		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'blog']);
		$this->theme->add_body_view('blog/post', $post_data);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}

	/**
	 * Blog post edition page
	 *
	 * @author Vasilesk
	 **/
	public function edit($post_id = 0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$is_admin = $this->ion_auth->is_admin();
		$post_id = intval($post_id);

		if(! $is_admin || $post_id < 1)
		{
			show_404();
		}

		$post_data = $this->blog_model->get_edit_data($post_id);
		if(empty($post_data['post']))
		{
			show_404();
		}

		$data = [
			'title' => 'Редактирование: ' . $post_data['post']['title'],
			'description' => strip_tags($post_data['post']['text_summary'])
		];

		$this->form_validation->set_rules('field_title', 'Header', 'required');
		$this->form_validation->set_rules('field_text', 'Post text', 'required');
		$this->form_validation->set_message('required', '<blockquote class="lead bg-danger">Required field: %s</blockquote>');


		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'blog']);

		if ($this->form_validation->run() === FALSE)
		{
			// smth may be placed here in future
		}
		else
		{
			$this->blog_model->edit_post($post_id);
			$this->theme->add_body_view('blog/success');
		}

		$this->theme->add_body_view('blog/edit', $post_data);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}

	/**
	 * Blog post creation page
	 *
	 * @author Vasilesk
	 **/
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$is_admin = $this->ion_auth->is_admin();

		if(! $is_admin)
		{
			show_404();
		}

		$post_data = $this->blog_model->get_edit_data(FALSE);

		$data = [
			'title' => 'New post creation',
			'description' => strip_tags($post_data['post']['text_summary'])
		];

		$this->form_validation->set_rules('field_title', 'Заголовок', 'required');
		$this->form_validation->set_rules('field_text', 'Текст поста', 'required');
		$this->form_validation->set_message('required', '<blockquote class="lead bg-danger">Required field: %s</blockquote>');

		$this->theme->add_body_view('theme/body/title_header');
		$this->theme->add_body_view('theme/body/block_title_buttons', $this->main_model->get_title_tabs_data() + ['active' => 'blog']);

		if ($this->form_validation->run() === FALSE)
		{
			// smth may be placed here in future
		}
		else
		{
			$this->blog_model->edit_post(FALSE);
			$this->theme->add_body_view('blog/success');
		}

		$this->theme->add_body_view('blog/edit', $post_data);
		$this->theme->add_body_view('theme/body/block_copyright', $this->main_model->get_copyright_data());
		$this->theme->display($data);
	}
}

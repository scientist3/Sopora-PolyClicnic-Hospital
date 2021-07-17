<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/setting_model'
		));

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 
	}
 

	public function index()
	{
		$data['title'] = display('website_setting');
		#-------------------------------#
		//check setting table row if not exists then insert a row
		$this->check_setting();
		#-------------------------------#
		$data['setting'] = $this->setting_model->read();
		$data['content'] = $this->load->view('website/pages/setting',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create()
	{
		$data['title'] = display('website_setting');
		#-------------------------------# 
		$this->form_validation->set_rules('title', display('website_title'),'required|max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'max_length[255]');
		$this->form_validation->set_rules('meta_tag', display('meta_tag'),'max_length[255]');
		$this->form_validation->set_rules('meta_keyword', display('meta_keyword'),'max_length[255]');
		$this->form_validation->set_rules('email', display('email'),'required|max_length[100]|valid_email');
		$this->form_validation->set_rules('phone', display('phone'),'required|max_length[20]');
		$this->form_validation->set_rules('address', display('address'),'required|max_length[255]'); 
		$this->form_validation->set_rules('twitter_api', display('twitter_api'),'max_length[1000]'); 
		$this->form_validation->set_rules('google_map', display('google_map'),'max_length[1000]'); 
		$this->form_validation->set_rules('copyright_text', display('copyright_text'),'max_length[255]');  
		$this->form_validation->set_rules('facebook', display('facebook_url'),'valid_url|max_length[100]');
		$this->form_validation->set_rules('twitter', display('twitter_url'),'valid_url|max_length[100]');
		$this->form_validation->set_rules('vimeo',display('vimeo_url'),'valid_url|max_length[100]');
		$this->form_validation->set_rules('instagram', display('instagram_url'),'valid_url|max_length[100]');
		$this->form_validation->set_rules('dribbble', display('dribbble_url'),'valid_url|max_length[100]');
		$this->form_validation->set_rules('skype', display('skype_url'),'valid_url|max_length[100]');
		#-------------------------------#
		//logo upload
		$logo = $this->fileupload->do_upload(
			'assets_web/images/icons/',
			'logo'
		);
		// if logo is uploaded then resize the logo
		if ($logo !== false && $logo != null) {
			$this->fileupload->do_resize(
				$logo, 
				285,
				73
			);
		}
		//if logo is not uploaded
		if ($logo === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}

		//favicon upload
		$favicon = $this->fileupload->do_upload(
			'assets_web/images/icons/',
			'favicon'
		);
		// if favicon is uploaded then resize the favicon
		if ($favicon !== false && $favicon != null) {
			$this->fileupload->do_resize(
				$favicon, 
				32,
				32
			);
		}
		//if favicon is not uploaded
		if ($favicon === false) {
			$this->session->set_flashdata('exception', display('invalid_favicon'));
		}
		#-------------------------------# 

		$data['setting'] = (object)$postData = [
			'id'  		  => $this->input->post('id'),
			'title' 	  => $this->input->post('title'),
			'description' => $this->input->post('description',false),
			'meta_tag' 	  => $this->input->post('meta_tag'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'email' 	  => $this->input->post('email'),
			'address'     => $this->input->post('address'),
			'phone' 	  => $this->input->post('phone'),
			'logo' 	      => (!empty($logo)?$logo:$this->input->post('old_logo')),
			'favicon' 	  => (!empty($favicon)?$favicon:$this->input->post('old_favicon')),
			'copyright_text' => $this->input->post('copyright_text',false),
			'twitter_api' => $this->input->post('twitter_api',false),
			'google_map'  => $this->input->post('google_map',false),
			'facebook'    => $this->input->post('facebook'),
			'twitter'     => $this->input->post('twitter'),
			'vimeo'       => $this->input->post('vimeo'),
			'instagram'   => $this->input->post('instagram'),
			'dribbble'    => $this->input->post('dribbble'),
			'skype'       => $this->input->post('skype'),
			'google_plus' => $this->input->post('google_plus'),
			'status'      => $this->input->post('status'),
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->setting_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			} else {
				if ($this->setting_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			}

			redirect('website/setting');

		} else { 
			$data['content'] = $this->load->view('website/pages/setting',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

	//check setting table row if not exists then insert a row
	public function check_setting()
	{
		if ($this->db->count_all('ws_setting') == 0) {
			$this->db->insert('ws_setting',[
				'title' => 'Demo Hospital Limited',
				'address' => '123/A, Street, State-12345, Demo',
				'email' => 'demo@hospital.com',
				'phone' => '(732) 803-010-03',
				'copyright_text' => '© 2016 <a title="BdTask" href="http://bdtask.com" target="_blank">bdtask</a>. All rights reserved',
				'status' => 1
			]);
		}
	}


}

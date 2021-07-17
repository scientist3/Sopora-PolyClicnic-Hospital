<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array( 
            'website/section_model',
            'website/home_model',
            'website/item_model',
            'website/appointment_model',
            'website/setting_model'
        ));  
    } 
 
    public function index()
    {
        $data['title'] = display('website_setting'); 
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting();
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        #-----------Section-------------# 
        $sections = $this->home_model->sections();
        $dataSection = array();
        if(!empty($sections)):
            foreach ($sections as $section) {
                $dataSection[$section->name] = array(
                    'name'  => $section->name,
                    'title' => $section->title,
                    'description'     => $section->description,
                    'featured_image'  => $section->featured_image,
                );
            }
        endif; 
        $data['section'] = $dataSection;

        #----------Section Item---------# 
        $items = $this->home_model->items();
        $dataItem = array();
        if(!empty($items)):
            $sl = 0;
            foreach ($items as $item) {
                $dataItem[$item->name][$sl++] = array(
                    'id'          => $item->id,
                    'name'        => $item->name,
                    'title'       => $item->title,
                    'description' => $item->description,
                    'icon_image'  => $item->icon_image,
                    'position'    => $item->position,
                    'status'      => $item->status,
                    'counter'     => $item->counter,
                    'date'        => $item->date
                );
            }
        endif;
        $data['items'] = $dataItem; 

        #-------------All Data-----------#  
        $data['latest_news'] = $this->home_model->latest_news(3); 
        $data['sliders'] = $this->home_model->sliders(); 
        $data['doctors'] = $this->home_model->doctors();
        $data['departments'] = $this->home_model->departments();
        $data['department_list'] = $this->appointment_model->department_list(); 
        $data['comments'] = $this->home_model->comments();
        #-------------------------------#       

        $this->load->view('website/main_wrapper',$data);
    }
 
    //all post details without slider
    public function details($id = null)
    { 
        $data['title'] = display('details');  
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting();
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        #-------------------------------#    
        //set items two times for details and pagination 
        $data['item'] = $this->home_model->blog_details($id);
        $data['comments'] = $this->home_model->comments_details($id);
            //update item view counter  
            $this->home_model->update_counter($id);
        $data['latest_news'] = $this->home_model->latest_news(3); 
        $data['recent_news'] = $this->home_model->recent_news(20);    
        #-------------------------------#  
        $this->load->view('website/details_wrapper',$data);
    } 

    //slider post details
    public function slider($id = null)
    {
        $data['title'] = display('details');
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting();
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        #-------------------------------#   
        $data['item'] = $this->home_model->slider_details($id); 
        $data['latest_news'] = $this->home_model->latest_news(3);  
        #-------------------------------#   
        $this->load->view('website/slider_wrapper',$data);
    }


}

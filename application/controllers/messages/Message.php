<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'messages/message_model' 
		));

        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 1
        ) 
        redirect('login'); 
	}
 
    public function index()
    {
        $data['title']    =  display('inbox');
        $user_id = $this->session->userdata('user_id'); 
        #-------------------------------#
        $data['messages'] = $this->message_model->inbox($user_id);
        $data['content']  = $this->load->view('messages/inbox' ,$data,true);
        $this->load->view('layout/main_wrapper',$data);
    } 
 
	public function sent()
	{
        $data['title']    =  display('sent');
        $user_id = $this->session->userdata('user_id'); 
		#-------------------------------#
		$data['messages'] = $this->message_model->sent($user_id);
		$data['content'] = $this->load->view('messages/sent' ,$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function inbox_information($id = null, $sender_id = null)
    {  
        $data['title'] = display('messages');
        $receiver_id = $this->session->userdata('user_id'); 
        #-------------------------------#
        $this->message_model->update(
            array(
                'id' => $id, 
                'receiver_status' => 1
            )
        );
        #-------------------------------#
        $data['message'] = $this->message_model->inbox_information($id, $sender_id, $receiver_id);
        $data['content'] = $this->load->view('messages/inbox_information',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    }

    public function sent_information($id = null, $receiver_id = null)
    {  
        $data['title'] = display('messages');
        $sender_id = $this->session->userdata('user_id'); 
        #-------------------------------#
        $data['message'] = $this->message_model->sent_information($id, $sender_id, $receiver_id);
        $data['content'] = $this->load->view('messages/sent_information',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    }
 

    public function new_message()
    { 
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('receiver_id', display('receiver_name') ,'required|max_length[11]');
        $this->form_validation->set_rules('subject', display('subject'),'required|max_length[255]');
        $this->form_validation->set_rules('message', display('message'),'required|trim');
        /*-------------STORE DATA------------*/
        $user_id = $this->session->userdata('user_id');
        $date    = $this->input->post('date');

        $data['message'] = (object)$postData = array( 
            'id'          => $this->input->post('id'),
            'sender_id'   => $user_id,
            'receiver_id' => $this->input->post('receiver_id'),
            'subject'     => $this->input->post('subject'),
            'message'     => $this->input->post('message', true),
            'datetime'    => date("Y-m-d h:i:s"),
            'sender_status'   => 1, 
            'receiver_status' => 0, 
        );  

        /*-----------CREATE A NEW RECORD-----------*/
        if ($this->form_validation->run() === true) { 
            if ($this->message_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('message_sent'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('messages/message/new_message');
        } else {
            $data['title'] = display('new_message');
            $data['user_list'] = $this->message_model->user_list($user_id);
            $data['content'] = $this->load->view('messages/new_message',$data,true);
            $this->load->view('layout/main_wrapper',$data);
        }  
    }
 

    public function delete($id = null, $sender_id = null, $receiver_id = null) 
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id == $sender_id) {
            $condition = "sender_status";
            $this->message_model->delete($id, $condition);
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else if ($user_id == $receiver_id) {
            $condition = "receiver_status";
            $this->message_model->delete($id, $condition);
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($_SERVER['HTTP_REFERER']); 
    }
  
	
}

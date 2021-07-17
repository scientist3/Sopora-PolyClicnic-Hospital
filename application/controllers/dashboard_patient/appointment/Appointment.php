<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'dashboard_doctor/appointment/appointment_model',
            'dashboard_doctor/appointment/department_model'
        ));
 
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 2) 
            redirect('login'); 
    }
 
    public function index()
    { 
        $data['title'] = display('appointment');
        /* ------------------------------- */
        $data['appointments'] = $this->appointment_model->read();
        $data['content'] = $this->load->view('dashboard_doctor/appointment/appointment',$data,true);
        $this->load->view('dashboard_doctor/main_wrapper',$data);
    } 

    public function create()
    {
        $data['title'] = display('add_appointment');
        /* ------------------------------- */
        $this->form_validation->set_rules('patient_id', display('patient_id'),'required|max_length[50]');
        $this->form_validation->set_rules('department_id', display('department_name'),'required|max_length[50]');
        $this->form_validation->set_rules('doctor_id', display('doctor_name') ,'required|max_length[50]');
        $this->form_validation->set_rules('schedule_id', display('appointment_date') ,'required|max_length[10]'); 
        $this->form_validation->set_rules('serial_no', display('serial_no') ,'required|max_length[10]');
        $this->form_validation->set_rules('problem', display('problem'),'max_length[255]');
        $this->form_validation->set_rules('status',display('status'),'required');
        /* ------------------------------- */
        $data['appointment'] = (object)$postData = [
            'appointment_id' => 'A'.$this->randStrGen(2, 7),
            'patient_id'     => $this->input->post('patient_id',true), 
            'department_id'  => $this->input->post('department_id',true), 
            'doctor_id'      => $this->input->post('doctor_id',true), 
            'schedule_id'    => $this->input->post('schedule_id',true), 
            'serial_no'      => $this->input->post('serial_no',true), 
            'problem'        => $this->input->post('problem',true), 
            'date'           => date('Y-m-d',strtotime($this->input->post('date',true))),
            'created_by'     => $this->session->userdata('user_id'), 
            'create_date'    => date('Y-m-d'),
            'status'         => $this->input->post('status',true)
        ]; 
        /* ------------------------------- */
        //check patient id
        $check_patient_id = json_decode($this->check_patient(true));

        //check appointment exists
        $check_appointment_exists = $this->check_appointment_exists(
            $this->input->post('patient_id',true), 
            $this->input->post('doctor_id',true), 
            $this->input->post('schedule_id',true), 
            date('Y-m-d',strtotime($this->input->post('date',true)))
        );
        if ($check_appointment_exists === false) {
            $this->session->set_flashdata('exception',display('you_are_already_registered')); 
        } 
        /* ------------------------------- */
        if ($this->form_validation->run() === true && $check_patient_id->status === true && $check_appointment_exists === true) {

            /*if empty $id then insert data*/
            if ($this->appointment_model->create($postData)) {
                /*set success message*/
                $this->session->set_flashdata('message',display('save_successfully'));
            } else {
                /*set exception message*/
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('dashboard_doctor/appointment/appointment/view/'.$postData['appointment_id']);

        } else {
            $data['department_list'] = $this->department_model->department_list(); 
            $data['content'] = $this->load->view('dashboard_doctor/appointment/appointment_form',$data,true);
            $this->load->view('dashboard_doctor/main_wrapper',$data);
        } 
    }
 

      public function view($appointment_id = null)
      {  
        $data['title'] = display('appointment');
        /* ------------------------------- */
        $data['appointment'] = $this->appointment_model->read_by_id($appointment_id);
        $data['content'] = $this->load->view('dashboard_doctor/appointment/appointment_view',$data,true);
        $this->load->view('dashboard_doctor/main_wrapper',$data);
      } 


    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randStrGen($mode = null, $len = null)
    {
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */


    public function check_patient($mode = null)
    {
        $patient_id = $this->input->post('patient_id');

        if (!empty($patient_id)) {
            $query = $this->db->select('firstname,lastname')
                ->from('patient')
                ->where('patient_id',$patient_id)
                ->where('status',1)
                ->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $data['message'] = $result->firstname . ' ' . $result->lastname;
                $data['status'] = true;
            } else {
                $data['message'] = display('invalid_patient_id');
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invlid_input');
            $data['status'] = null;
        }

        //return data
        if ($mode === true) {
            return json_encode($data);
        } else {
            echo json_encode($data);
        }

    }
 

    public function doctor_by_department()
    {
        $department_id = $this->input->post('department_id');

        if (!empty($department_id)) {
            $query = $this->db->select('user_id,firstname,lastname')
                ->from('user')
                ->where('department_id',$department_id)
                ->where('user_role',2)
                ->where('status',1)
                ->get();

            $option = "<option value=\"\">".display('select_option')."</option>"; 
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $doctor) {
                    $option .= "<option value=\"$doctor->user_id\">$doctor->firstname $doctor->lastname</option>";
                } 
                $data['message'] = $option;
                $data['status'] = true;
            } else {
                $data['message'] = display('no_doctor_available');
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invalid_department');
            $data['status'] = null;
        }

        echo json_encode($data);
    }


    public function schedule_day_by_doctor()
    {
        $doctor_id = $this->input->post('doctor_id');

        if (!empty($doctor_id)) {
            $query = $this->db->select('available_days,start_time,end_time')
                ->from('schedule')
                ->where('doctor_id',$doctor_id) 
                ->where('status',1)
                ->order_by('available_days','desc')
                ->get();

            $list = null;
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $value) {
                    $list .= "<span><i class='fa fa-calendar'></i> $value->available_days [$value->start_time - $value->end_time]</span><br>";
                } 
                $data['message'] = $list;
                $data['status'] = true;
            } else {
                $data['message'] = display('no_schedule_available');
                $data['status'] = false;
            } 
        } else { 
            $data['status']  = null;
        }

        echo json_encode($data);
    }


    public function serial_by_date()
    {
        $patient_id = $this->input->post('patient_id');
        $doctor_id  = $this->input->post('doctor_id');
        $date       = date("Y-m-d", strtotime($this->input->post('date'))); 
        $day        = date("l", strtotime($this->input->post('date'))); 

        if (!empty($doctor_id) && !empty($patient_id) && !empty($day)) {
            $query = $this->db->select('*')
                ->from('schedule')
                ->where('doctor_id',$doctor_id) 
                ->where('available_days',$day) 
                ->where('status',1)
                ->order_by('available_days','desc')
                ->get();
 
            if ($query->num_rows() > 0) {
                $result = $query->row();
                /*--------- ------------------------------- */
                /*get start and end time*/
                $start_time   = strtotime($result->start_time);
                $end_time     = strtotime($result->end_time);

                /*convert per patient time to minute*/
                $time_parse = date_parse($result->per_patient_time);
                $minute = $time_parse['hour'] * 60 + $time_parse['minute'];

                /*count total minute*/
                $total_minute = round(abs($end_time - $start_time) / 60,2); 
                /*total serial*/  
                $total_serial = round(abs($total_minute / $minute));

                /*--------- ------------------------------- */ 
                $serial = null; 

                if ($result->serial_visibility_type == 2) {
                    /*set sequential */
                    $seq = 1;
                    $timestamp = strtotime($result->start_time);
                    while ($seq <= $total_serial) {
                        $time_from = date('H:i',$timestamp); 
                        $timestamp = strtotime("+$minute minutes" , $timestamp); 
                        $time_to   = date('H:i',$timestamp);

                        /*check time sequence*/
                        if ($this->check_time_sequence($doctor_id, $result->schedule_id, $seq, $date) === true) {
                            //store time sequential
                            $serial .= "<button type=\"button\" data-item=\"$seq\" class=\"serial_no slbtn btn btn-success btn-sm\">$time_from - $time_to</button>";
                        } else {
                            /*store time sequential*/
                            $serial .= "<div class=\"slbtn btn btn-danger disabled btn-sm\">$time_from - $time_to</div>";
                        }

                        $seq++;
                    } 
                    $data['type'] = display('sequential');
                } else {
                    /*set timestamp*/
                    $ts = 1;   
                    while ($ts <= $total_serial) {

                        /*check time sequence*/
                        if ($this->check_time_sequence($doctor_id, $result->schedule_id, $ts, $date) === true) {
                            //store timestamp
                            $serial .= "<button type=\"button\" data-item=\"$ts\" class=\"serial_no slbtn btn btn-success btn-sm\">".(($ts<=9)?"0$ts":$ts)."</button>";
                        } else {
                            /*store timestamp*/
                            $serial .= "<div class=\"slbtn btn btn-danger disabled btn-sm\">".(($ts<=9)?"0$ts":$ts)."</div>";
                        }

                        $ts++;
                    }
                    $data['type'] = display('timestamp');
                } 
                $data['schedule_id'] = $result->schedule_id;
                $data['message']     = $serial;
                $data['status']      = true;
                /*--------- ------------------------------- */  
            } else {
                $data['message'] = display('no_schedule_available');
                $data['status'] = false;
            } 
        } else { 
            $data['message'] = display('please_fillup_all_required_fields');
            $data['status']  = null;
        }

        echo json_encode($data);
    }
 

    public function check_time_sequence(
        $doctor_id  = null,
        $schedule_id  = null,
        $serial_no  = null,
        $date  = null
    ) {
        $num_rows = $this->db->select('*')
            ->from('appointment')
            ->where('doctor_id', $doctor_id)
            ->where('schedule_id', $schedule_id)
            ->where('serial_no', $serial_no)
            ->where('date', $date)
            ->get()
            ->num_rows();
            
        if ($num_rows == 0) {
            return true;
        } else {
            return false; 
        }
    }


    public function check_appointment_exists(
        $patient_id  = null,
        $doctor_id  = null,
        $schedule_id  = null,
        $date  = null 
    ) {
        if (!empty($patient_id) && !empty($doctor_id) && !empty($schedule_id)) {
            $num_rows = $this->db->select('*')
                ->from('appointment')
                ->where('patient_id', $patient_id)
                ->where('doctor_id', $doctor_id)
                ->where('schedule_id', $schedule_id) 
            ->where('date', $date)
                ->get()
                ->num_rows();
                
            if ($num_rows > 0) {
                return false;
            } else {
                return true; 
            }
        } else {
            return null; 
        }
    }

}

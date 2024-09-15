<?php

class User extends CI_Controller{
  
    public function __construct() {
        parent::__construct();
        // Load the User_model
        $this->load->model('UserModel');
    }
    
    public function listUser(){
        $limit = (!empty($_REQUEST['length']) ? $_REQUEST['length'] : null);
        $start = (!empty($_REQUEST['start']) ? $_REQUEST['start'] : 0);
        $draw = (!empty($_REQUEST['draw']) ? $_REQUEST['draw'] : '');

        $data = array();
        $condition = array('status');
        if(!empty($limit)){
            $user_data = $this->UserModel->getUsers($start,$limit, $condition);
            $all_data = $this->UserModel->count_all_users();

            if(!empty($user_data)){
                foreach($user_data as $key=>$val){
                    $data['data'][$key]['user_id'] = $val['user_id'];
                    $data['data'][$key]['username'] = $val['username'];
                    $data['data'][$key]['status'] = (!empty($val['status']) && $val['status']=='1' ? 'Active' : 'Soft Deletd');
                }
                $data['recordsFiltered'] = $all_data;
                $data['recordsTotal'] = $all_data;
                $data['draw'] = $draw;
            }
            else{
                $data['data'] = array();
                $data['recordsFiltered'] = 0;
                $data['recordsTotal'] = 0;
                $data['draw'] = $draw;

            }
            echo json_encode($data);
        }
        else{
            $this->load->view('listUser');
        }
    }

    public function sendEmail(){
        $this->load->library('email');
        $this->email->from('your_email@example.com', 'Your Name');
        $this->email->to('prasadwaghmare6@gmail.com');
        $this->email->subject('Test Email from CodeIgniter 3');
        $this->email->message('<p>This is a test email sent from CodeIgniter 3 using the SMTP settings configured in email.php.</p>');
        if ($this->email->send()) {
            echo 'Email sent successfully!';
        } else {
            // Display the error if email sending fails
            echo 'Failed to send email.';
            echo $this->email->print_debugger();  // Print debugging information
        }
    }
}

?>
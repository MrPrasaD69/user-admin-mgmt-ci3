<?php

class Admin extends CI_Controller{

    public function __construct() {
        parent::__construct();
        
        $this->load->model('UserModel');
        $this->load->library('session');
        $this->load->database();
    }

    public function login(){
        $this->load->view('login');
    }

    public function loginSubmit(){
        $mode = (!empty($_REQUEST['mode']) ? $_REQUEST['mode'] : '');
        $username = (!empty($_REQUEST['username']) ? $_REQUEST['username'] : '');
        $password = (!empty($_REQUEST['password']) ? $_REQUEST['password'] : '');

        if(empty($mode)){
            echo "400::Mode not found!";
            exit;
        }

        if($mode=='L'){
            $check = $this->db->get_where('tbl_admin', array('username'=>$username,'status'=>'1'));
            $row = $check->row_array();
            if(empty($row)){
                echo "400::Invalid Username";
                exit;
            }

            if($row['password'] != md5($password)){
                echo "400::Invalid Password";
                exit;
            }
            
            $this->session->set_userdata('admin_id',$row['admin_id']);
            
            echo "200::Login Success!";
            exit;
        }
        else{

        }
        
    }

    public function dashboard(){
        $this->load->view('admin/dashboard');
    }

    public function listUser(){
        $limit = (!empty($_REQUEST['length']) ? $_REQUEST['length'] : null);
        $start = (!empty($_REQUEST['start']) ? $_REQUEST['start'] : 0);
        $draw = (!empty($_REQUEST['draw']) ? $_REQUEST['draw'] : '');

        $data = array();
        
        if(!empty($limit)){
            $user_data = $this->UserModel->getUsers($start,$limit);
            $all_data = $this->UserModel->count_all_users();

            if(!empty($user_data)){
                foreach($user_data as $key=>$val){
                    $data['data'][$key]['user_id'] = (!empty($val['user_id']) ? $val['user_id'] : '');
                    $data['data'][$key]['username'] = (!empty($val['username']) ? $val['username'] : '');
                }
                $data['recordsFiltered'] = $all_data;
                $data['recordsTotal'] = $all_data;
                $data['draw'] = $draw;
            }
            else{
                $data['data'] = array();
                $data['recordsTotal'] = 0;
                $data['recordsFiltered'] = 0;
                $data['draw'] = $draw;                               
            }
            echo json_encode($data);
            exit;
            
        }
        
        $this->load->view('admin/listUser');
    }

    public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->sess_destroy();

        return redirect('admin/login');
    }
}


?>
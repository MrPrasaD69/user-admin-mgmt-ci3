<?php

class UserModel extends CI_Model{

    public function __construct() {
        // Load the database library
        $this->load->database();
    }

    public function getUsers($start, $length){
        $this->db->limit($length,$start);
        $query = $this->db->get('tbl_users');
        return $query->result_array();
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('tbl_users', array('user_id' => $id));
        return $query->row_array(); // Returns a single row as an associative array
    }
    
    public function count_all_users() {
        return $this->db->count_all('tbl_users');
    }

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
    public function login($username){
        $this->db->where('username',$username);
        return $this->db->get('users')->row_array();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {
    public function login($username){
        $this->db->select('*');
        $this->db->from('users as a');
        $this->db->join('mt_role as b','a.id=b.id_user');
        $this->db->where('a.username',$username);
        return $this->db->get()->row_array();
    }
}
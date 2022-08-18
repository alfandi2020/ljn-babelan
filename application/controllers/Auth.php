<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_Auth');
    }
        function index(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = $this->M_Auth->login($username);
            if ($password == true) {
                if ($username == $data['username']) {
                        if (password_verify($password, $data['password'])) {
                            $datax = [
                                'id_user' => $data['id'],
                                'username' => $data['username'],
                                'role' => $data['role'],
                                'kode_group' => $data['kode_group']
                            ];
                            $this->session->set_userdata($datax);
                            $this->session->set_flashdata("msg", "<div class='alert alert-success'>Login Berhasil</div>");
                            redirect('dashboard');
                        } else {
                            $this->session->set_flashdata("msg", "<div class='alert alert-danger'>Password salah !</div>");
                            redirect('auth');
                        }
                } else {
                    $this->session->set_flashdata("msg", "<div class='alert alert-danger'>User tidak ada</div>");
                    redirect('auth');
                }
            }
            $this->load->view('Sign_in');
        }
        function logout(){
            $array_items = array('id_user', 'username');
            $this->session->unset_userdata($array_items);
            redirect('auth');
        }
    }
    

?>
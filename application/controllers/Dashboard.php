<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
		}
	}
	public function index()
	{
		$total_client = $this->db->query("SELECT COUNT(id) as pelanggan from dt_registrasi where status='Aktif'")->row_array();
		$free = $this->db->query("SELECT COUNT(id) as pelanggan from dt_registrasi where status='Free'")->row_array();
		$off = $this->db->query("SELECT COUNT(id) as pelanggan from dt_registrasi where status='Off'")->row_array();
		$total = $this->db->query("SELECT COUNT(id) as pelanggan from dt_registrasi")->row_array();
		$data = [
			"title" => "Dashboard",
			'total' => $total_client,
			'free' => $free,
			'tidak_aktif' => $off,
			'semua' => $total
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/dashboard');
		$this->load->view('temp/footer');
	}
    public function jam()
    {
        date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal
        echo date('H:i:s'); //Menampilkan Jam Sekarang
    }
	public function menu()
	{
		$this->load->view('temp/sidebar');
	}
	function profile(){
		$this->load->view('body/profile');
	}
	public function filter(){
        if($this->uri->segment(3)){
            $filter = $this->uri->segment(3);
            $this->session->set_userdata('menu-footer', $filter);
            redirect('home/'.$this->uri->segment(3));
        }
    }
}

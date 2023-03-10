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
		$group_sess = explode(',',$this->session->userdata('kode_group'));
		$condition_group = $this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin';
		//total aktif
		$this->db->select('COUNT(id) as pelanggan');
		$this->db->where('status','Aktif');
		if ($condition_group) {
			$this->db->where_in('group',$group_sess);
		}
		$total_client = $this->db->get('dt_registrasi')->row_array();
		//total pelanggan free
		$this->db->select('COUNT(id) as pelanggan');
		$this->db->where('status','Free');
		if ($condition_group) {
			$this->db->where_in('group',$group_sess);
		}
		$free = $this->db->get('dt_registrasi')->row_array();
		//total pelanggan off
		$this->db->select('COUNT(id) as pelanggan');
		$this->db->where('status','Off');
		if ($condition_group) {
			$this->db->where_in('group',$group_sess);
		}
		$off = $this->db->get('dt_registrasi')->row_array();
		//total pelanggan total
		$this->db->select('COUNT(id) as pelanggan');
		// $this->db->where('status','Off');
		if ($condition_group) {
			$this->db->where_in('group',$group_sess);
		}
		$total = $this->db->get('dt_registrasi')->row_array();
		// $total = $this->db->query("SELECT COUNT(id) as pelanggan from dt_registrasi")->row_array();
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

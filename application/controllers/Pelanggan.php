<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
		}
		$this->load->model(array('M_Registrasi'));

	}
	public function index()
	{
		// $this->load->view('body/header');
		$this->load->view('body/dashboard');
		// $this->load->view('body/footer');
	}
	public function registrasi()
	{
		$data = [
			'title' => 'Registrasi',
			'mt_alamat' => $this->db->get('mt_alamat')->result()
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/registrasi');
		$this->load->view('temp/footer');
	}
	function submit_registrasi(){
		$media = $this->input->post('media');
		$speed = $this->input->post('speed');
		$router = $this->input->post('router');
		$cpe = $this->input->post('cpe');
		$nama = $this->input->post('nama');
		$nomor_ktp = $this->input->post('nomor');
		$npwp = $this->input->post('npwp');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$email = $this->input->post('email');
		$tindakan = $this->input->post('tindakan');
		$t_nama = $this->input->post('t_nama');
		$t_nomor_ktp = $this->input->post('t_nomor');
		$t_npwp = $this->input->post('t_npwp');
		$t_telp = $this->input->post('t_telp');
		$t_email = $this->input->post('t_email');
		$tgl_installasi = $this->input->post('tanggal_installasi');
		if ($nama) {
			$insert = [
				"media" => $media,
				"speed" => $speed,
				"cpe" => $cpe,
				"router" => $router,
				"nama" => $nama,
				"nomor_ktp" => $nomor_ktp,
				"npwp" => $npwp,
				"alamat" => $alamat,
				"telp" => $telp,
				"email" => $email,
				"tindakan" => $tindakan,
				"t_nama" => $t_nama,
				"t_nomor_ktp" => $t_nomor_ktp,
				"t_npwp" => $t_npwp,
				"t_telp" => $t_telp,
				"t_email" => $t_email,
				"aktif" => $tgl_installasi
			];
			$data = $this->db->insert('dt_registrasi',$insert);
			echo json_encode($data);
		}

	}
	function alamat(){
        $kode_alamat = strtoupper($this->input->post('kode_alamat'));
		$user = $this->input->post('user');
        $alamat = $this->input->post('alamat');
        if ($kode_alamat == true || $alamat == true) {
            $insert = [
                "kode_alamat" => $kode_alamat,
                "alamat" => $alamat,
				"id_user" => $user
            ];
            $this->db->insert('mt_alamat',$insert);
            redirect('pelanggan/alamat','<div class="alert alert-primary mb-2" role="alert">Tambah alamat berhasil</div>');
        }
		$data = [
			'title' => 'Alamat',
            'alamat' =>  $this->db->query('SELECT * FROM users as a left join mt_alamat as b on(a.id = b.id_user) where a.role!=1')->result()
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/alamat');
		$this->load->view('temp/footer');
	}
	function paket(){
		$id = $this->input->post('id');
		$data = $this->M_Registrasi->get_paket($id);
		echo json_encode($data);
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

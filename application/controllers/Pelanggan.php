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
			'mt_role' => $this->db->get('mt_alamat')->result()
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
		$group = $this->input->post('group');
		$teknisi = $this->input->post('teknisi');
		$alamat = $this->input->post('alamat');
		$kode_pelanggan = $this->input->post('kode_pelanggan');
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
					"kode_pelanggan" => $kode_pelanggan,
					"alamat" => $alamat,
					"ktp" => $nomor_ktp,
					"npwp" => $npwp,
					"telp" => $telp,
					"email" => $email,
					"tindakan" => $tindakan,
					"t_nama" => $t_nama,
					"t_nomor_ktp" => $t_nomor_ktp,
					"t_npwp" => $t_npwp,
					"t_telp" => $t_telp,
					"t_email" => $t_email,
					"aktif" => $tgl_installasi,
					"teknisi" => $teknisi,
					"group" => $group,
					"status"=> 'Aktif'
				];
				$this->db->insert('dt_registrasi',$insert);
				// $msg = [
				// 	"message" => 'Berhasil di input',
				// 	"status" => "success"
				// ];
				echo json_encode('Registrasi Berhasil');
		}

	}
	function pembayaran(){

		$id_user = $this->session->userdata('id_user');
        $alamat_get = $this->db->query("SELECT * FROM users where id='$id_user'")->row_array();
		$arr = explode(',',$alamat_get['group']);
        if ($this->session->userdata('role') != 'Super Admin') {
			$this->db->where_in('group',$arr);
		}
		$this->db->where('status','Aktif');
		$data_client =  $this->db->get('dt_registrasi')->result();
		$data = [
			'client' =>  $data_client,
			'title' => 'Buat Pembayaran',
			
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/pembayaran',$data);
		$this->load->view('temp/footer');
	}
	function getclient_pembayaran()
	{
		$id = $this->input->post('id');
		$this->db->from('dt_registrasi as a');
		$this->db->join('mt_paket as b','a.speed=b.id_paket');
		$this->db->where('a.alamat',$id);
		$data = $this->db->get()->result();
		echo json_encode($data);
	}
	function buat_pembayaran(){
		
		$id_paket = $this->input->post('p_paket');
		$get_paket = $this->db->query("SELECT * FROM mt_paket  where id_paket ='$id_paket'")->row_array();
		$nama = $this->input->post('nama');
		$id_registrasi = $this->input->post('p_client');
		$tagihan = $this->input->post('p_tagihan');
		$penerima = $this->input->post('p_penerima');
		$bulan = $this->input->post('p_bulan');
		$tahun = $this->input->post('p_tahun');
		$tgl_bayar = $this->input->post('tgl_pembayaran');
		$cek_tagihan = $this->db->query("SELECT * FROM dt_cetak where periode='$bulan' and tahun='$tahun' and id_registrasi='$id_registrasi' ")->num_rows();
		if ($tagihan == true) {
			if ($cek_tagihan != true) {
				$data = [
					"id_registrasi" => $id_registrasi,
					"nama" => $nama,
					"mbps" => $get_paket['mbps'],
					"tagihan" => $tagihan,
					"penerima" => $penerima,
					"periode" => $bulan,
					"tahun" => $tahun,
					"tanggal_pembayaran" => $tgl_bayar
				];
				$this->db->insert('dt_cetak',$data);
				$this->session->set_flashdata("msg", "<div class='alert alert-success'>Cetak Pembayaran berhasil</div>");
				redirect('pelanggan/pembayaran');
			}else{
				$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Buat pembayaran tidak boleh dobel nama $nama bulan $bulan tahun $tahun</div>");
				redirect('pelanggan/pembayaran');
			}
		}else{
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Paket Internet Kosong</div>");
			redirect('pelanggan/pembayaran');
		}

		// $msg = [
		// 	"response" => "success",
		// 	"message" => "Data user sudah ada"
		// ];
		// echo json_encode($msg);
	}
	function status(){
		$data = [
			'pelanggan' => $this->db->get('dt_registrasi')->result(),
			'title' => 'List Pelanggan'
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/status',$data);
		$this->load->view('temp/footer');
	}
	function status_pembayaran()
	{
        $postData = $this->input->post();
        $data = $this->M_Registrasi->status_payment($postData);
        echo json_encode($data);
	}
	function getClient(){
        $postData = $this->input->post();
        $data = $this->M_Registrasi->list_client($postData);
        echo json_encode($data);
    }
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('dt_registrasi');
		redirect('pelanggan/list');
	}
	function delete_group($id){
		$this->db->where('id_alamat',$id);
		$this->db->delete('mt_alamat');
		redirect('pelanggan/alamat');
	}
	function change_status($id){
		$data = [
			"status" => 'Off'
		];
		$this->db->where('id',$id);
		$this->db->update('dt_registrasi',$data);
		redirect('pelanggan/list');
	}
	function aktif($id){
		$data = [
			"status" => 'Aktif'
		];
		$this->db->where('id',$id);
		$this->db->update('dt_registrasi',$data);
		redirect('pelanggan/list');
	}
	function list(){
		$data = [
			'pelanggan' => $this->db->get('dt_registrasi')->result(),
			'title' => 'List Pelanggan'
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/list',$data);
		$this->load->view('temp/footer');
	}
	function update(){
		$id = $this->uri->segment(3);
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
		$t_nama = $this->input->post('t_nama');
		$t_nomor_ktp = $this->input->post('t_nomor');
		$t_npwp = $this->input->post('t_npwp');
		$t_telp = $this->input->post('t_telp');
		$t_email = $this->input->post('t_email');
		if($nama){
			$id_update = $this->input->post('id_update');
			$update = [
				"media" => $media,
				"speed" => $speed,
				"cpe" => $cpe,
				"router" => $router,
				"nama" => $nama,
				"ktp" => $nomor_ktp,
				"npwp" => $npwp,
				"alamat" => $alamat,
				"telp" => $telp,
				"email" => $email,
				"t_nama" => $t_nama,
				"t_nomor_ktp" => $t_nomor_ktp,
				"t_npwp" => $t_npwp,
				"t_telp" => $t_telp,
				"t_email" => $t_email,
			];
			$this->db->where('id',$id_update);
			$data = $this->db->update('dt_registrasi',$update);
			$this->session->set_userdata('msg', 'update');
			redirect('pelanggan/update/'.$id_update);
		}

		$this->db->select('*');
		$this->db->from('dt_registrasi as a');
		$this->db->join('mt_paket as b','a.speed=b.id_paket','left');
		$this->db->where('a.id',$id);

		$pelanggan = $this->db->get()->row_array();
		$data = [
			'title' => 'Update Pelanggan',
			'mt_role' => $this->db->get('mt_alamat')->result(),
			'pelanggan' => $pelanggan
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/update');
		$this->load->view('temp/footer');
	}
	function alamat(){
        $kode_group = strtoupper($this->input->post('kode_group'));
		$user = $this->input->post('user');
        $alamat = $this->input->post('kode_alamat');
        if ($kode_group == true || $alamat == true) {
			$this->db->where('group',$kode_group);
			$cek = $this->db->get('mt_alamat')->num_rows();
			if ($cek != true) {
				$insert = [
					"group" => $kode_group,
					"alamat" => $alamat,
					// "id_user" => $user
				];
				$this->db->insert('mt_alamat',$insert);
				$this->session->set_flashdata("msg", "<div class='alert alert-success'>Tambah group berhasil</div>");
				redirect('pelanggan/alamat');
			}else{
				$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Group Sudah ada</div>");
				redirect('pelanggan/alamat');
			}
        }
		$data = [
			'title' => 'Alamat',
            'alamat' =>  $this->db->get('mt_alamat')->result()
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/alamat',$data);
		$this->load->view('temp/footer');
	}
	function role(){
		$data = [
			'title' => 'Perizinan',
            'alamat' =>  $this->db->get('users')->result(),
			'group' => $this->db->get('mt_alamat')->result()
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/perizinan',$data);
		$this->load->view('temp/footer');
	}
	function change_role(){
			$id = $this->uri->segment(3);
				$role = $this->input->post('role');
				$update = [
					"role" => $role[0]
				];
				$this->db->where('id',$id);
				echo $this->db->update('users',$update);
				redirect('pelanggan/role');
		
	}
	function change_group(){
			$id = $this->uri->segment(3);
				$group = $this->input->post('group');
				$imp_group = implode(',',$group);
				$update = [
					"group" => $imp_group
				];
				$this->db->where('id',$id);
				echo $this->db->update('users',$update);
				redirect('pelanggan/role');
		
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

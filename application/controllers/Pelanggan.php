<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
		}
		$this->load->model(array('M_Registrasi'));
        $this->load->library('api_whatsapp');

	}
	public function index()
	{
		// $this->load->view('body/header');
		$this->load->view('body/dashboard');
		// $this->load->view('body/footer');
	}
	function remove_special($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
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
		$kd_unik = $this->input->post('kode_unik');
		$t_nama = $this->input->post('t_nama');
		$t_nomor_ktp = $this->input->post('t_nomor');
		$t_npwp = $this->input->post('t_npwp');
		$t_telp = $this->input->post('t_telp');
		$t_email = $this->input->post('t_email');
		$tgl_installasi = $this->input->post('tanggal_installasi');
		$add_on1 = $this->input->post('addon1');
		$add_on2 = $this->input->post('addon2');
		$add_on3 = $this->input->post('addon3');
		$diskon = $this->input->post('diskon');
		$tempo = $this->input->post('tempo');
		// if ($nama) {
			$nama_cek =  $this->db->get_where('dt_registrasi',['kode_pelanggan' => $kode_pelanggan])->num_rows();
			if ($nama_cek == true) {
				echo json_encode(['code' => 'nama_double','status' => 'Kode pelanggan sudah ada..!']);
			}else{
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
					"status"=> 'Aktif',
					"addon1"=> $add_on1,
					"addon2"=> $add_on2,
					"addon3"=> $add_on3,
					"diskon"=> $diskon,
					"tempo"=> $tempo,
				];
				$this->db->insert('dt_registrasi',$insert);
				// $msg = [
				// 	"message" => 'Berhasil di input',
				// 	"status" => "success"
				// ];
				echo json_encode(['code' => 'berhasil','status' => 'Registrasi '.$nama.' berhasil..!']);
			}
		// }

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
	function reset_url()
	{
		$this->session->unset_userdata('sort_group');
		$this->session->unset_userdata('sort_status');
		redirect('pelanggan/list');
	}
	function sort()
	{
		$uri = $this->uri->segment(3);
		$thn = $this->input->post('tahun_t');
		if ($uri == 'bulan') {
			$bulan = $this->input->post('bulan');
			$tgl_t = $this->input->post('tgl_t');
			$this->session->set_userdata('filterBulan',$bulan);
			$this->session->set_userdata('filterTgl_tempo',$tgl_t);
			$this->session->set_userdata('filterTahun',$thn);
			if ($this->input->post('cetak') == 'cetak') {
				redirect('pelanggan/cetak');
			} else {
				redirect('pelanggan/status');
			}
		}else{
			$status = $this->input->post('status');
			$this->session->set_userdata('sort_status',$status);
			redirect('pelanggan/list');
		}
	}
	public function indonesian_date($timestamp = '', $date_format = 'd F Y', $suffix = '')
    {
        date_default_timezone_set("Asia/Jakarta");
        if ($timestamp == null) {
            return '-';
        }

        if ($timestamp == '1970-01-01' || $timestamp == '0000-00-00' || $timestamp == '-25200') {
            return '-';
        }


        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array(
            'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
    }
	function getclient_pembayaran()
	{
		$id = $this->input->post('id');
		$this->db->from('dt_registrasi as a');
		$this->db->join('mt_paket as b','a.speed=b.id_paket');
		$this->db->where('a.kode_pelanggan',$id);
		$data = $this->db->get()->result();

		$tanggal = time();
        $bulan = $this->indonesian_date($tanggal, 'F');
		
		$cek = $this->db->query("SELECT * FROM dt_cetak where id_registrasi='$id' and periode='$bulan' ");
		echo json_encode($data);
	}
	function buat_pembayaran(){
		
		$id_paket = $this->input->post('p_paket');
		$get_paket = $this->db->query("SELECT * FROM mt_paket  where id_paket ='$id_paket'")->row_array();
		$nama = $this->input->post('nama');
		$id_registrasi = $this->input->post('p_client');
		$tagihan = $this->remove_special($this->input->post('p_tagihan'));
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
	function cetak()
	{
		$data = [
			'pelanggan' => $this->db->get('dt_registrasi')->result(),
			'title' => 'List Pelanggan'
		];
		$this->load->view('temp/header', $data);
		$this->load->view('body/pelanggan/cetak', $data);
		$this->load->view('temp/footer');
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
	function cetak_struk()
	{
        $postData = $this->input->post();
        $data = $this->M_Registrasi->cetak_struk2($postData);
        echo json_encode($data);
	}
	function getClient(){
        $postData = $this->input->post();
        $data = $this->M_Registrasi->list_client($postData);
        echo json_encode($data);
    }
	function privilage(){
		$id_user = $this->session->userdata('id_user');
		$this->db->where('id',$id_user);
		$cek_s = $this->db->get('users')->row_array();
		if ($cek_s['role'] == 'Super Admin') {
			return 1;
		}else{
			return 0;
		}
	}
	// function update_kode()
	// {
	// 	$client = $this->db->get('dt_registrasi')->result();
	
	// 	// $count_12 = strlen($client['telp']);
	// 	foreach ($client as $x) {
	// 		$phone_13 = substr($x->telp,10);//13
	// 		$phone_12 = substr($x->telp,9);//12
	// 		$phone_11 = substr($x->telp,8);//11
	// 		$phone_10 = substr($x->telp,7);//10

	// 		$phone = strlen(preg_replace('/\s+/', '', $x->telp));
	// 		$this->db->where('id',$x->id);
	// 		if ($phone == '13') {
	// 			$this->db->set('kode_unik',$phone_13);
	// 		}elseif ($phone == '12') {
	// 			$this->db->set('kode_unik',$phone_12);
	// 		}elseif ($phone == '11') {
	// 			$this->db->set('kode_unik',$phone_11);
	// 		}elseif ($phone == '10') {
	// 			$this->db->set('kode_unik',$phone_10);
	// 		}else{
	// 			$this->db->set('kode_unik','');
	// 		}
	// 		$this->db->update('dt_registrasi');
	// 	}
	// }
	function send_notif22()
	{
		$id = $this->uri->segment(3);
		$this->db->where('a.id',$id);
		$this->db->join('mt_paket as b','a.speed = b.id_paket');
		$get_client = $this->db->get('dt_registrasi as a')->row_array();


		$addon1 = $this->db->get_where('addon',['id' => $get_client['addon1']])->row_array();
        $addon2 = $this->db->get_where('addon',['id' => $get_client['addon2']])->row_array();
        $addon3 = $this->db->get_where('addon',['id' => $get_client['addon3']])->row_array();
		if ($addon1 == true) { 
            $addon1_biaya = $addon1['biaya'];
			$ad1 = ".: Add on " . $addon1['nama']. " = " . 'Rp.' . number_format($addon1['biaya'],0,'.','.');
		}else{
            $addon1_biaya = 0;
			$ad1 = null;
        } 
		if ($addon2 == true) { 
            $addon2_biaya = $addon2['biaya'];
			$ad2 = ".: Add on " . $addon2['nama']. " = " . 'Rp.' . number_format($addon2['biaya'], 0, '.', '.');
		}else{
            $addon2_biaya = 0;
			$ad2 = null;

		} 
		if ($addon3 == true) { 
            $addon3_biaya = $addon3['biaya'];
			$ad3 = ".: Add on " . $addon3['nama']. " = " . 'Rp.' . number_format($addon3['biaya'], 0, '.', '.');
		}else{
            $addon3_biaya = 0;
			$ad3 = null;

		} 


		if ($get_client['diskon'] == true) {
			$diskonnnn = $get_client['diskon'];
			$diskon_x = ".: Diskon =" . number_format($get_client['diskon'],0,'.','.');
		}else{
			$diskonnnn = 0;
			$diskon_x = null;
		}
		$xx = $get_client['harga']+$addon1_biaya+$addon2_biaya+$addon3_biaya-$diskonnnn; 
		$ppn = floor($get_client['harga'] * 11 / 100);

		// $ppn = $get_client['harga'] * 11 / 100;
		$hargaa = $get_client['harga'];
		$bulan = $this->session->userdata('filterBulan');
		$tahun = $this->session->userdata('filterTahun');
		$kd_unik_in = $get_client['id'];
		$kd_unik_in = sprintf('%04d',$kd_unik_in);

		$rincian = $ad1;

		$msg = 
"Kepada yth 
*Bpk/Ibu ".$get_client['nama']."*
ID : ".$get_client['kode_pelanggan']."

Terimakasih sudah menggunakan layanan *Lintas.Net (LJN)*
		
Kami informasikan jumlah tagihan sebagai berikut :
.: Biaya Langganan ". $get_client['mbps'] ." Mbps Periode ".$bulan." $tahun = Rp ".number_format(floor($hargaa + $ppn),0,'.','.').",-
*Total Tagihan = Rp ".number_format(floor($xx + $ppn -$kd_unik_in),0,'.','.')."*,-

.: _Dimohon transfer tepat sesuai nominal tagihan untuk memudahkan verifikasi_
.: Jatuh tempo pembayaran *tanggal ".$this->session->userdata('filterTgl_tempo')." bulan tagihan*.
.: Wajib mengirimkan bukti transfer ke WhatsApp *087883973151* sebelum jatuh tempo demi kelancaran bersama.

.: Pembayaran ditujukan ke : 
1. *BCA 2761446578 an Mahfudin*
2. *Mandiri 1560016047112 an Mahfudin*

Demikian disampaikan terima kasih atas kerjasamanya..
		
Regards
Lintas.Net (LJN)
*PT Lintas Jaringan Nusantara*
Layanan Teknis	: 
0821-1420-9923
0819-3380-3366";
		$data_z = $this->api_whatsapp->wa_notif($msg,$get_client['telp']);
		$o = json_decode($data_z);
		if (json_encode($o->status) == true){
			redirect('pelanggan/status');
		}else{
			redirect('pelanggan/status');
		}
	}
	function send_notif()
	{

		$id = $this->uri->segment(3);
		$this->db->where('a.id',$id);
		$this->db->join('mt_paket as b','a.speed = b.id_paket');
		$get_client = $this->db->get('dt_registrasi as a')->row_array();


		$addon1 = $this->db->get_where('addon',['id' => $get_client['addon1']])->row_array();
        $addon2 = $this->db->get_where('addon',['id' => $get_client['addon2']])->row_array();
        $addon3 = $this->db->get_where('addon',['id' => $get_client['addon3']])->row_array();
		if ($addon1 == true) { 
            $addon1_biaya = $addon1['biaya'];
			$ad1 = ".: Add on " . $addon1['nama']. " = " . 'Rp.' . number_format($addon1['biaya'],0,'.','.');
		}else{
            $addon1_biaya = 0;
			$ad1 = null;
        } 
		if ($addon2 == true) { 
            $addon2_biaya = $addon2['biaya'];
			$ad2 = ".: Add on " . $addon2['nama']. " = " . 'Rp.' . number_format($addon2['biaya'], 0, '.', '.');
		}else{
            $addon2_biaya = 0;
			$ad2 = null;

		} 
		if ($addon3 == true) { 
            $addon3_biaya = $addon3['biaya'];
			$ad3 = ".: Add on " . $addon3['nama']. " = " . 'Rp.' . number_format($addon3['biaya'], 0, '.', '.');
		}else{
            $addon3_biaya = 0;
			$ad3 = null;

		} 


		if ($get_client['diskon'] == true) {
			$diskonnnn = $get_client['diskon'];
			$diskon_x = ".: Diskon =" . number_format($get_client['diskon'],0,'.','.');
		}else{
			$diskonnnn = 0;
			$diskon_x = null;
		}
		$xx = $get_client['harga']+$addon1_biaya+$addon2_biaya+$addon3_biaya-$diskonnnn; 
		$ppn = floor($get_client['harga'] * 11 / 100);

		// $ppn = $get_client['harga'] * 11 / 100;
		$hargaa = $get_client['harga'];
		$bulan = $this->session->userdata('filterBulan');
		$tahun = $this->session->userdata('filterTahun');
		$kd_unik_in = $get_client['id'];
		$kd_unik_in = sprintf('%04d',$kd_unik_in);

		$rincian = $ad1;

		$curl = curl_init();
		$curl2 = curl_init();
		$curl3 = curl_init();
		$token = "bzqjLpzxGwUwP7qJRdIRxcjMktOHBdggf3lnfB6Dsew"; 
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode([
				'to_number' => "62".substr($get_client['telp'],1),
				'to_name' => $get_client['nama'],
				'message_template_id' => 'e6711677-dc7c-4313-8f57-66555fc0f6aa',
				'channel_integration_id' => 'c7b25ef0-9ea4-4aff-9536-eb2eadae3400',
				'room' => [
					'tags' => ['mahfud'],
				],
				'language' => [
					'code' => 'id'
				],
				'parameters' => [
					'body' => [
						[
							'key' => '1', //{{ buat key 1,2,3,4 }}
							'value' => 'name', //field di excel contact
							'value_text' => $get_client['nama'] //value
						],
						[
							'key' => '2', //{{ buat key 1,2,3,4 }}
							'value' => 'company', //kode pelanggan
							'value_text' => $get_client['kode_pelanggan'] //value
						],
						[
							'key' => '3', //{{ buat key 1,2,3,4 }}
							'value' => '165000', //tagihan
							'value_text' => number_format(floor($xx + $ppn)) //value
						],
						[
							'key' => '4', //{{ buat key 1,2,3,4 }}
							'value' => '124', //kode unik
							'value_text' => $kd_unik_in //value
						],
						[
							'key' => '5', //{{ buat key 1,2,3,4 }}
							'value' => '150000', //total tagihan
							'value_text' => number_format(floor($xx + $ppn -$kd_unik_in)) //value
						],
						[
							'key' => '6', //{{ buat key 1,2,3,4 }}
							'value' => '1231310', //paket
							'value_text' =>  $get_client['mbps']  //value
						],
						[
							'key' => '7', //{{ buat key 1,2,3,4 }}
							'value' => '10', //bulan tahun
							'value_text' => $bulan ." ". $tahun  //value
						],
						[
							'key' => '8', //{{ buat key 1,2,3,4 }}
							'value' => '12310', //bulan tahun
							'value_text' => $get_client['tempo']  //value
						]
					]
				]
			]),
			CURLOPT_HTTPHEADER => [
				"Authorization: Bearer ".$token."",
				"Content-Type: application/json"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		echo $response;
		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// curl_setopt_array($curl2, [
			// 	CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/rooms?limit=1",
			// 	CURLOPT_RETURNTRANSFER => true,
			// 	CURLOPT_ENCODING => "",
			// 	CURLOPT_MAXREDIRS => 10,
			// 	CURLOPT_TIMEOUT => 30,
			// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 	CURLOPT_CUSTOMREQUEST => "GET",
			// 	CURLOPT_HTTPHEADER => [
			// 		"Authorization: Bearer ".$token.""
			// 	],
			// ]);

			// $response2 = curl_exec($curl2);
			// $err2 = curl_error($curl2);

			// curl_close($curl2);

			if ($err) {
				// echo "cURL Error #:" . $err2;
			} else {
				// $x = json_decode($response2);
				// $id_room = json_encode($x->data[0]->id);

				// curl_setopt_array($curl3, array(
				// 	CURLOPT_URL => 'https://service-chat.qontak.com/api/open/v1/rooms/'.$this->remove_special($id_room).'/tags',
				// 	CURLOPT_RETURNTRANSFER => true,
				// 	CURLOPT_ENCODING => '',
				// 	CURLOPT_MAXREDIRS => 10,
				// 	CURLOPT_TIMEOUT => 0,
				// 	CURLOPT_FOLLOWLOCATION => true,
				// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// 	CURLOPT_CUSTOMREQUEST => 'POST',
				// 	CURLOPT_POSTFIELDS => array('tag' => 'mahfud'),
				// 	CURLOPT_HTTPHEADER => array(
				// 	  'Authorization: Bearer '.$token.'',
				// 	),
				//   ));
				  
				//   $response3 = curl_exec($curl3);
				//   curl_close($curl3);
				  $k = json_decode($response);
				  echo json_encode($k->status);
				  if (json_encode($k->status == 'success')) {
					redirect('pelanggan/status');
				  }
			}
			// echo ($response) ;
		}
	}
	function send_notif_pdf()
	{

		$mpdf = new \Mpdf\Mpdf([
			'tempDir' => '/tmp',
			'mode' => '',
			'format' => 'A4',
			'default_font_size' => 0,
			'default_font' => '',
			'margin_left' => 15,
			'margin_right' => 15,
			'margin_top' => 5,
			'margin_bottom' => 10,
			'margin_header' => 10,
			'margin_footer' => 5,
			'orientation' => 'L',
			'showImageErrors' => true
		]);
		$this->db->where('a.id', $this->uri->segment(3));
		$this->db->join('mt_paket as b', 'a.speed = b.id_paket');
		$data['x'] = $this->db->get("dt_registrasi as a")->row_array();
		$no_invoice = 'INV' . date('y') . date('m') . date('d') . $data['x']['id'];
		$html = $this->load->view('body/pelanggan/notif_pdf', $data, true);
		$mpdf->defaultfooterline = 0;
		// $mpdf->setFooter('<div style="text-align: left;">F.7.1.1</div>');
		$mpdf->WriteHTML($html);
		$mpdf->Output('/home/billing.lintasmediadata.net/invoice/' . $no_invoice . '.pdf', 'F');
		// chmod($no_invoice . ".pdf", 0777);
		// $mpdf->Output();
		$imagick = new Imagick();
		$imagick->setResolution(200, 200);
		$imagick->readImage("invoice/$no_invoice.pdf");
		$imagick->writeImages("invoice/image/$no_invoice.jpg", true);
		// if (file_exists('invoice/image/'.$no_invoice.'-0.jpg')) {
		// 	$no_invoice = $no_invoice . '-0.jpg';
		// }else if (file_exists('invoice/image/' . $no_invoice . '-1.jpg')) {
		// 	$no_invoice = $no_invoice . '-1.jpg';
		// }else{
		// 	$no_invoice = $no_invoice . '.jpg';
		// }
		$url_img = "https://billing.lintasmediadata.net/invoice/image/$no_invoice.jpg";
		// $url_img = "https://billing.lintasmediadata.net/invoice/image/INV2308051069.jpg";
			//end create image
		$id = $this->uri->segment(3);
		$this->db->where('a.id', $id);
		$this->db->join('mt_paket as b', 'a.speed = b.id_paket');
		$get_client = $this->db->get('dt_registrasi as a')->row_array();
			

		$addon1 = $this->db->get_where('addon', ['id' => $get_client['addon1']])->row_array();
		$addon2 = $this->db->get_where('addon', ['id' => $get_client['addon2']])->row_array();
		$addon3 = $this->db->get_where('addon', ['id' => $get_client['addon3']])->row_array();
		if ($addon1 == true) {
			$addon1_biaya = $addon1['biaya'];
			$ad1 = ".: Add on " . $addon1['nama'] . " = " . 'Rp.' . number_format($addon1['biaya'], 0, '.', '.');
		} else {
			$addon1_biaya = 0;
			$ad1 = null;
		}
		if ($addon2 == true) {
			$addon2_biaya = $addon2['biaya'];
			$ad2 = ".: Add on " . $addon2['nama'] . " = " . 'Rp.' . number_format($addon2['biaya'], 0, '.', '.');
		} else {
			$addon2_biaya = 0;
			$ad2 = null;

		}
		if ($addon3 == true) {
			$addon3_biaya = $addon3['biaya'];
			$ad3 = ".: Add on " . $addon3['nama'] . " = " . 'Rp.' . number_format($addon3['biaya'], 0, '.', '.');
		} else {
			$addon3_biaya = 0;
			$ad3 = null;

		}


		if ($get_client['diskon'] == true) {
			$diskonnnn = $get_client['diskon'];
			$diskon_x = ".: Diskon =" . number_format($get_client['diskon'], 0, '.', '.');
		} else {
			$diskonnnn = 0;
			$diskon_x = null;
		}
		$xx = $get_client['harga'] + $addon1_biaya + $addon2_biaya + $addon3_biaya - $diskonnnn;
		$ppn = floor($get_client['harga'] * 11 / 100);

		// $ppn = $get_client['harga'] * 11 / 100;
		$hargaa = $get_client['harga'];
		$bulan = $this->session->userdata('filterBulan');
		$tahun = $this->session->userdata('filterTahun');
		$kd_unik_in = $get_client['id'];
		$kd_unik_in = sprintf('%04d', $kd_unik_in);

		$rincian = $ad1;
		$curl = curl_init();
		$curl2 = curl_init();
		$curl3 = curl_init();
		$token = "gYGG2YKTv9odqMHhyi2PFIFo2eMSrCom9wVAJmVpLi8";
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode([
				'to_number' => "62" . substr($get_client['telp'], 1),
				'to_name' => $get_client['nama'],
				'message_template_id' => '497be8a5-e266-4a85-8b95-a62098c2bf02',
				'channel_integration_id' => 'c7b25ef0-9ea4-4aff-9536-eb2eadae3400',
				'room' => [
					'tags' => ['mahfud'],
				],
				'language' => [
					'code' => 'id'
				],
				'parameters' => [
					'header' => [
						'format' => 'IMAGE',
						'params' => [
							[
								'key' => 'url',
								'value' => $url_img
							]
						]
					],
					'body' => [
						[
							'key' => '1', //{{ buat key 1,2,3,4 }}
							'value' => 'name', //field di excel contact
							'value_text' => $get_client['nama'] //value
						],
						[
							'key' => '2', //{{ buat key 1,2,3,4 }}
							'value' => 'company', //kode pelanggan
							'value_text' => $get_client['kode_pelanggan'] //value
						],
						[
							'key' => '3', //{{ buat key 1,2,3,4 }}
							'value' => '165000', //tagihan
							'value_text' => number_format(floor($xx + $ppn)) //value
						],
						[
							'key' => '4', //{{ buat key 1,2,3,4 }}
							'value' => '124', //kode unik
							'value_text' => $kd_unik_in //value
						],
						[
							'key' => '5', //{{ buat key 1,2,3,4 }}
							'value' => '150000', //total tagihan
							'value_text' => number_format(floor($xx + $ppn - $kd_unik_in)) //value
						],
						[
							'key' => '6', //{{ buat key 1,2,3,4 }}
							'value' => '1231310', //paket
							'value_text' => $get_client['mbps']  //value
						],
						[
							'key' => '7', //{{ buat key 1,2,3,4 }}
							'value' => '10', //bulan tahun
							'value_text' => $bulan . " " . $tahun  //value
						],
						[
							'key' => '8', //{{ buat key 1,2,3,4 }}
							'value' => 'awd', //bulan tahun
							'value_text' => $get_client['tempo']  //value
						]
					]
				]
			]),
			CURLOPT_HTTPHEADER => [
				"Authorization: Bearer " . $token . "",
				"Content-Type: application/json"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		echo $response;
		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// curl_setopt_array($curl2, [
			// 	CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/rooms?limit=1",
			// 	CURLOPT_RETURNTRANSFER => true,
			// 	CURLOPT_ENCODING => "",
			// 	CURLOPT_MAXREDIRS => 10,
			// 	CURLOPT_TIMEOUT => 30,
			// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 	CURLOPT_CUSTOMREQUEST => "GET",
			// 	CURLOPT_HTTPHEADER => [
			// 		"Authorization: Bearer " . $token . ""
			// 	],
			// ]);

			// $response2 = curl_exec($curl2);
			// $err2 = curl_error($curl2);

			// curl_close($curl2);

			if ($err) {
				// echo "cURL Error #:" . $err2;
			} else {
				// $x = json_decode($response2);
				// $id_room = json_encode($x->data[0]->id);

				// curl_setopt_array($curl3, array(
				// 	CURLOPT_URL => 'https://service-chat.qontak.com/api/open/v1/rooms/' . $this->remove_special($id_room) . '/tags',
				// 	CURLOPT_RETURNTRANSFER => true,
				// 	CURLOPT_ENCODING => '',
				// 	CURLOPT_MAXREDIRS => 10,
				// 	CURLOPT_TIMEOUT => 0,
				// 	CURLOPT_FOLLOWLOCATION => true,
				// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// 	CURLOPT_CUSTOMREQUEST => 'POST',
				// 	CURLOPT_POSTFIELDS => array('tag' => 'mahfud'),
				// 	CURLOPT_HTTPHEADER => array(
				// 		'Authorization: Bearer ' . $token . '',
				// 	),
				// )
				// );

				// $response3 = curl_exec($curl3);
				// curl_close($curl3);
				$k = json_decode($response);
				echo json_encode($k->status);
				if (json_encode($k->status == 'success')) {
					redirect('pelanggan/status');
				}
			}
			// echo ($response) ;
		}
	}
	function send_notif_pdf2()
	{
		// if($this->uri->segment(3)){
            $mpdf = new \Mpdf\Mpdf([
				'tempDir' => '/tmp',
                'mode' => '',
                'format' => 'A4',
                'default_font_size' => 0,
                'default_font' => '',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 5,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 5,
                'orientation' => 'L',
				'showImageErrors' => true
            ]);
			$this->db->where('a.id',$this->uri->segment(3));
			$this->db->join('mt_paket as b','a.speed = b.id_paket');
            $data['x'] = $this->db->get("dt_registrasi as a")->row_array();
			$no_invoice = 'INV' . date('y').date('m').date('d').$data['x']['id'];
            $html = $this->load->view('body/pelanggan/notif_pdf', $data, true);
            $mpdf->defaultfooterline=0;
            // $mpdf->setFooter('<div style="text-align: left;">F.7.1.1</div>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('/home/billing.lintasmediadata.net/invoice/'.$no_invoice.'.pdf','F');
			chmod($no_invoice.".pdf", 0777);
            // $mpdf->Output();
			$imagick = new Imagick();
            $imagick->setResolution(200, 200);
            $imagick->readImage("invoice/$no_invoice.pdf");
            $imagick->writeImages("invoice/image/$no_invoice.jpg", true);
			// if (file_exists('invoice/image/'.$no_invoice.'-0.jpg')) {
			// 	$no_invoice = $no_invoice . '-0.jpg';
			// }else if (file_exists('invoice/image/' . $no_invoice . '-1.jpg')) {
			// 	$no_invoice = $no_invoice . '-1.jpg';
			// }else{
			// 	$no_invoice = $no_invoice . '.jpg';
			// }
			$url_img = "https://billing.lintasmediadata.net/invoice/image/$no_invoice.jpg";
			// $url_img = "https://billing.lintasmediadata.net/invoice/image/INV2308051069.jpg";

			//send wa
			$id = $this->uri->segment(3);
			$this->db->where('a.id',$id);
			$this->db->join('mt_paket as b','a.speed = b.id_paket');
			$get_client = $this->db->get('dt_registrasi as a')->row_array();
	

			$addon1 = $this->db->get_where('addon',['id' => $get_client['addon1']])->row_array();
			$addon2 = $this->db->get_where('addon',['id' => $get_client['addon2']])->row_array();
			$addon3 = $this->db->get_where('addon',['id' => $get_client['addon3']])->row_array();
			if ($addon1 == true) {
				$addon1_biaya = $addon1['biaya'];
				$ad1 = ".: Add on " . $addon1['nama'] . " = " . 'Rp.' . number_format($addon1['biaya'], 0, '.', '.');
			} else {
				$addon1_biaya = 0;
				$ad1 = null;
			}
			if ($addon2 == true) {
				$addon2_biaya = $addon2['biaya'];
				$ad2 = ".: Add on " . $addon2['nama'] . " = " . 'Rp.' . number_format($addon2['biaya'], 0, '.', '.');
			} else {
				$addon2_biaya = 0;
				$ad2 = null;

			}
			if ($addon3 == true) {
				$addon3_biaya = $addon3['biaya'];
				$ad3 = ".: Add on " . $addon3['nama'] . " = " . 'Rp.' . number_format($addon3['biaya'], 0, '.', '.');
			} else {
				$addon3_biaya = 0;
				$ad3 = null;

			}


			if ($get_client['diskon'] == true) {
				$diskonnnn = $get_client['diskon'];
				$diskon_x = ".: Diskon =" . number_format($get_client['diskon'], 0, '.', '.');
			} else {
				$diskonnnn = 0;
				$diskon_x = null;
			}
			$rincian = $ad1;
			$xx = $get_client['harga']+$addon1_biaya+$addon2_biaya+$addon3_biaya-$diskonnnn;
			$ppn = floor($get_client['harga'] * 11 / 100);
			// $ppn = floor($get_client['harga'] * 11 / 100);
			$hargaa = $get_client['harga'];
			$bulan = $this->session->userdata('filterBulan');
			$tahun = $this->session->userdata('filterTahun');
			$kd_unik_in = $get_client['id'];
			$kd_unik_in = sprintf('%04d',$kd_unik_in);
			$tanggal_t = $this->session->userdata('filterTgl_tempo') == null ? 10 : $this->session->userdata('filterTgl_tempo');    
			$msg = 
"Kepada yth 
*Bpk/Ibu ".trim($get_client['nama'])."*
ID : ".$get_client['kode_pelanggan']."
				
Terimakasih sudah menggunakan layanan *Lintas.Net (LJN)*
			
Kami informasikan jumlah tagihan sebagai berikut :
.: Biaya Langganan " . $get_client['mbps'] . " Mbps Periode " . $bulan . " $tahun = Rp " . number_format(floor($hargaa + $ppn), 0, '.', '.') . ",-
$rincian
.: Discount Unik = " . $kd_unik_in . "
*Total Tagihan = Rp " . number_format(floor($xx + $ppn - $kd_unik_in), 0, '.', '.') . "*,-
	
.: _Dimohon transfer tepat sesuai nominal tagihan untuk memudahkan verifikasi_
.: Jatuh tempo pembayaran *tanggal ".$tanggal_t." bulan tagihan*.
.: Wajib mengirimkan bukti transfer ke WhatsApp *087883973151* sebelum jatuh tempo demi kelancaran bersama.
	
Pembayaran ditujukan ke : 	
1. *BCA 2761446578 an Mahfudin*
2. *Mandiri 1560016047112 an Mahfudin*
	
Demikian disampaikan terima kasih atas kerjasamanya..
		
Regards
Lintas.Net (LJN)
*PT Lintas Jaringan Nusantara*
Layanan Teknis	: 
0821-1420-9923
0819-3380-3366";
			// if (file_exists($url_img)) {
				$c =  $this->api_whatsapp->wa_notif_doc($msg,$get_client['telp'],$url_img);
			// }else{
			// 	echo 1;
			// }
				redirect('pelanggan/status');

	}
	// }
	function info()
	{
		echo phpinfo();
	}

	function delete($id){
		if ($this->privilage() == true) {
			$this->db->where('id',$id);
			$this->db->delete('dt_registrasi');
			redirect('pelanggan/list');
		}else{
			redirect('pelanggan/list');
		}
	}
	function delete_struk(){
		// if ($this->privilage() == true) {
			$id = $this->uri->segment(3);
			$this->db->where('id_cetak',$id);
			$this->db->delete('dt_cetak');
			redirect('pelanggan/cetak');
		// }else{
		// 	redirect('pelanggan/list');
		// }
	}
	function delete_group($id){
		$this->db->where('id_alamat',$id);
		$this->db->delete('mt_alamat');
		redirect('pelanggan/alamat');
	}
	function change_status(){
		$id_user = $this->input->post('id');
		$history = [
			"id_user" => $id_user,
			"status" => $this->input->post('status'), //off
			"tanggal" => $this->input->post('tgl_nonaktif'),
			"note" => $this->input->post('note'),
		];

		$data2 = [
			"off" => date('Y-m-d'),
			"status" => 'Off'
		];
		$this->db->where('id',$id_user);
		$this->db->update('dt_registrasi',$data2);

		$this->db->insert('dt_registrasi_history',$history);
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
		$speed = $this->input->post('speed_x');
		$router = $this->input->post('router');
		$cpe = $this->input->post('cpe');
		$nama = $this->input->post('nama');
		$nomor_ktp = $this->input->post('nomor');
		$npwp = $this->input->post('npwp');
		$alamat = $this->input->post('alamat');
		$teknisi = $this->input->post('teknisi');
		$telp = $this->input->post('telp');
		$email = $this->input->post('email');
		$t_nama = $this->input->post('t_nama');
		$t_nomor_ktp = $this->input->post('t_nomor');
		$t_npwp = $this->input->post('t_npwp');
		$t_telp = $this->input->post('t_telp');
		$t_email = $this->input->post('t_email');
		$kode_unik = $this->input->post('kode_unik');
		$group = $this->input->post('group');
		$kd_plg = $this->input->post('kode_pelanggan');
		$tindakan = $this->input->post('tindakan');
		$add_on1 = $this->input->post('addon1');
		$add_on2 = $this->input->post('addon2');
		$add_on3 = $this->input->post('addon3');
		$diskon = $this->input->post('diskon');
		$tempo = $this->input->post('tempo');
		
		if($nama){
			$id_update = $this->input->post('id_update');
			$update = [
				"nama" => $nama,
				"alamat" => $alamat,
				"media" => $media,
				"speed" => $speed,
				"cpe" => $cpe,
				"router" => $router,
				"ktp" => $nomor_ktp,
				"npwp" => $npwp,
				"telp" => $telp,
				"email" => $email,
				"group" => $group,
				"kode_pelanggan" => $kd_plg,
				"t_nama" => $t_nama,
				"t_nomor_ktp" => $t_nomor_ktp,
				"t_npwp" => $t_npwp,
				"t_telp" => $t_telp,
				"t_email" => $t_email,
				"teknisi" => $teknisi,
				"kode_unik" => $kode_unik,
				"tindakan" => $tindakan,
				"aktif" => $this->input->post('aktif'),
				"addon1"=> $add_on1,
				"addon2"=> $add_on2,
				"addon3"=> $add_on3,
				"diskon"=> $diskon,
				"tempo"=> $tempo,
			];
			$this->db->where('id',$id_update);
			$data = $this->db->update('dt_registrasi',$update);
			$this->session->set_flashdata('msg', 'update');
			redirect('pelanggan/update/'.$id_update);
		}

		$this->db->select('*,a.media as layanan');
		$this->db->from('dt_registrasi as a');
		$this->db->join('mt_paket as b','a.speed=b.id_paket','left');
		$this->db->where('a.id',$id);

		$pelanggan = $this->db->get()->row_array();
		
		$this->db->select('*');
		$this->db->from('dt_registrasi as a');
		$this->db->join('dt_registrasi_history as b','a.id=b.id_user','left');
		$this->db->where('a.id',$id);

		$history = $this->db->get()->result();

		$data = [
			'title' => 'Update Pelanggan',
			'mt_role' => $this->db->get('mt_alamat')->result(),
			'pelanggan' => $pelanggan,
			'history' => $history
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/pelanggan/update');
		$this->load->view('temp/footer');
	}
	function alamat(){
        $kode_group = strtoupper($this->input->post('kode_group'));
		$user = $this->input->post('user');
        $alamat = $this->input->post('kode_alamat');
        $status = $this->input->post('status');
        $id_alamat = $this->input->post('id_alamat');
        if ($kode_group == true && $alamat == true && $status != 'update') {
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
        }elseif ($kode_group == true && $alamat == true && $status == 'update') {
			$insert = [
				"group" => $kode_group,
				"alamat" => $alamat,
			];
			$this->db->where('id_alamat',$id_alamat);
			$this->db->update('mt_alamat',$insert);
			$this->session->set_flashdata("msg", "<div class='alert alert-success'>Update group berhasil</div>");
			redirect('pelanggan/alamat');
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
	function get_pelanggan()
	{
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$this->db->join('mt_paket as b','a.speed = b.id_paket');
		$data = $this->db->get('dt_registrasi as a')->row_array();
		echo json_encode($data);
	}
	function profile(){
		$this->load->view('body/profile');
	}
	function addon(){
		$data = [
			'title' => 'Add on',
			'addon' => $this->db->get('addon')->result(),
		];
		$nama = $this->input->post('nama');
		$harga = $this->input->post('harga');
		$action = $this->input->post('action');
		if ($nama == true && $harga == true) {
			$d = [
				"nama" => $nama,
				"biaya" => $this->remove_special($harga)
			];
			$this->db->insert('addon',$d);
			redirect('pelanggan/addon');
		}
		$this->load->view('temp/header', $data);
		$this->load->view('body/pelanggan/addon', $data);
		$this->load->view('temp/footer');
	}
	function delete_addon()
	{
		$id = $this->uri->segment(3);
		$this->db->where('id', $id);
		$this->db->delete('addon');
		redirect('pelanggan/addon');
	}
	public function filter(){
        if($this->uri->segment(3)){
            $filter = $this->uri->segment(3);
            $this->session->set_userdata('menu-footer', $filter);
            redirect('home/'.$this->uri->segment(3));
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		$this->load->library('api_xendit');
		if ($this->session->userdata('id_user') == false) {
			$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
            redirect('auth');
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
	public function index()
	{
		$tanggal = time();
        $bulan = $this->indonesian_date($tanggal, 'F');
		$tahun = $this->session->userdata('filterTahun');
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
		// $this->db->select('*');
		
		if ($condition_group) {
			$this->db->where_in('a.group',$group_sess);
		}
		$this->db->where('b.periode',$bulan);
		$this->db->where('b.tahun',$tahun);
		$this->db->join('dt_registrasi as a','a.kode_pelanggan = b.id_registrasi');
		$payment = $this->db->get('dt_cetak as b')->result();

		$arraydata = implode(',',$group_sess);

		// $this->db->select('*,a.id as id_client');
		if ($condition_group) {
			// $this->db->where_in('a.group',$group_sess);
			$group_session = 'AND a.group in('.trim(json_encode($group_sess),'[]').')';
		}else{
			$group_session = '';
		}
		
		// $this->db->from('dt_registrasi as a');
		// $this->db->join('mt_paket as b','a.speed=b.id_paket');
		// $belum_bayar = $this->db->get()->result();
		$belum_bayar = $this->db->query("SELECT
                            *,
                            FLOOR(((b.harga + COALESCE (c.biaya * 11 /100 + c.biaya  * c.qty, 0 ) + COALESCE (d.biaya * 11 /100 + d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * 11 /100 + f.biaya* f.qty, 0 ) - COALESCE(a.diskon,0)) * 11 / 100) + b.harga + COALESCE ( c.biaya * 11 /100 + c.biaya * c.qty, 0 ) + COALESCE (d.biaya * 11 /100 + d.biaya  * d.qty, 0 ) + COALESCE (f.biaya * 11 /100 + f.biaya  * f.qty, 0 ) - COALESCE(a.diskon,0) - a.id)  AS tagihan,c.biaya AS biaya1,d.biaya AS biaya2,f.biaya AS biaya3,a.nama AS nama_pelanggann,a.id AS id_client
                        FROM
                            dt_registrasi AS a
                            LEFT JOIN mt_paket AS b ON ( a.speed = b.id_paket )
                            LEFT JOIN addon AS c ON ( c.id = a.addon1 )
                            LEFT JOIN addon AS d ON ( d.id = a.addon2 )
                            LEFT JOIN addon AS f ON ( f.id = a.addon3 )
                        WHERE
                            STATUS = 'Aktif' $group_session")->result();

		//get saldo xendit
		$d = $this->api_xendit->get_balance();

		$data = [
			"title" => "Dashboard",
			'total' => $total_client,
			'free' => $free,
			'tidak_aktif' => $off,
			'semua' => $total,
			'payment' => $payment,
			'belum_bayar' => $belum_bayar,
			'saldo_xendit' => $d
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

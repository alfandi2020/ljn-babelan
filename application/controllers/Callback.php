<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {
	// private $param;

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library(array('form_validation'));
            $this->load->library('api_whatsapp');
        }
        function mutasi(){
            $data = json_decode(file_get_contents('php://input'), true);

            //TOKEN ANDA YANG ANDA DAPATKAN DI MUTASIBANK.CO.ID
            $api_token = "N2lYREgzV3lJdGNzdzVGNVRyVVVLZ2YxdjNRSDVCTlA0UWdBS2FHUkJLcm5YQTlzck9QZTJmZ2F4TE5Q6562dc5bb59f8";
            $token = $data['api_key'];
            if ($api_token != strval($token)) {
                echo "invalid api token";
                exit;
            }

            //MODULE BANK (bca,bri,bni,mandiri)
            $module = $data['module'];

            //DATA MUTASI
            foreach ($data['data_mutasi'] as $dtm) {
                //Tanggal Transaksi terjadi di bank
                $date = $dtm['transaction_date'];

                //Note atau deskripsi dari bank
                $note = $dtm['description'];

                //Tipe transaksi (DB ATAU CR)
                $type = $dtm['type'];

                //Jumlah Dana
                $amount = $dtm['amount'];

                //Saldo saat ini
                $saldo = $dtm['balance'];

                //ID Transaksi Mutasi
                $id = $dtm['id'];

                //Module Bank
                $module = $data['module'];

                $headers = [
                    "Authorization: $api_token",
                    'Content-Type: application/json'
                ];
                //validate transaction =
                $result_v = $this->http_get("https://mutasibank.co.id/api/v1/validate/$id", $headers);
                $data_r = json_decode($result_v);
                if ($data_r->valid && $data_r->data->amount == $amount) {
                $unik = substr($amount,-3);
                    if ($unik != 000) {
                        $client = $this->db->query('SELECT *,floor(b.harga * 11 / 100 + b.harga - a.id) as tagihan FROM dt_registrasi as a LEFT JOIN mt_paket as b on(a.speed=b.id_paket) where status="Aktif" and floor(b.harga * 11 / 100 + b.harga - a.id)='.$amount.'');
                        $get_client = $client->row_array();
                    $wa = "Kepada pelanggan yth,
*Bapak/Ibu ".$get_client['nama']."*
ID Pel : ".$get_client['kode_pelanggan']."
                    
Pembayaran tagihan anda *BERHASIL* 
                    
Tanggal Verifikasi : ".date('d-m-Y')."
Periode Pembayaran : ".date('M')." " . date('Y') ."
*Total Pembayaran : Rp ".number_format($amount,0,'.','.').",-*
                    
Terima kasih atas kerjasamanya.
                    
Salam
MD.Net
_Supported by :_
*PT Lintas Jaringan Nusantara*
Kantor Layanan Babelan
Layanan Teknis	: 
0821-1420-9923
0819-3380-3366";
                    // foreach ($client->result() as $x) {
                    //     $ppn = $x->harga * 11 / 100;
                    //     $hargaa = $x->harga + $ppn;
                    //     $cek_unik = $hargaa - $x->id;
                        $get_cetak = $this->db->get_where('dt_cetak',['periode' => date('F'),'tahun' => date('Y'),'id_registrasi' => $get_client['kode_pelanggan'] ])->num_rows();
                        // if ($get_cetak == false) {
                            if ($get_client['tagihan'] == $amount) {
                                $paket = $this->db->get_where('mt_paket',['id_paket' => $get_client['speed']])->row_array();
                                $data2 = [
                                    "id_registrasi" => $get_client['kode_pelanggan'],
                                    "nama" => $get_client['nama'],
                                    "mbps" => $paket['mbps'],
                                    "tagihan" => $amount,
                                    "penerima" => "admin",
                                    "periode" => date('F'),
                                    "tahun" => date('Y'),
                                    "tanggal_pembayaran" => date('Y-m-d H:i:s')
                                ];
                                $this->db->insert('dt_cetak',$data2);
                                if ($get_client['telp'] != "") {
                                    $this->api_whatsapp->wa_notif($wa,$get_client['telp']);
                                }
                            }
                        // }else{
                        //     echo 'error2';
                        // }
                    // }

                    }else{
                        echo "error1";
                    }
                }else {
                    echo "Tansaksi $id not valid ";
                }
            }
        }
        function mutasi_moota()
        {
            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://app.moota.co/api/v2/auth/login',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS =>'{
            //         "email" : "mahfud612@gmail.com",
            //         "password" : "#BESI1meter",
            //         "scopes" : ["api"]
            //     }',
            //     CURLOPT_HTTPHEADER => array(
            //         'Accept: application/json',
            //         'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJucWllNHN3OGxsdyIsImp0aSI6ImFkMDI0MDk4ZWNmZTFjNDdhMzA0YmZmMjJmMjViMDVjYzFkZTc4OTRhMDg0NTI4MzNlM2FkYWY4MDM2MjBiNGUzYjcwYjM4N2FkODJlMDY3IiwiaWF0IjoxNzAxMjU5NjUyLjQ0MTQ5NywibmJmIjoxNzAxMjU5NjUyLjQ0MTUwMywiZXhwIjoxNzMyODgyMDUyLjE4NzQxOCwic3ViIjoiMzEyNjciLCJzY29wZXMiOlsiYXBpIiwibXV0YXRpb25fcmVhZCIsIm11dGF0aW9uIiwidXNlciIsInVzZXJfcmVhZCIsImJhbmsiLCJiYW5rX3JlYWQiXX0.TjAYbcMFcyoBjzHkh6_UU1_Bx1PT3rzLG687qUxr2WudRUFqBgGdj6WjKCcY0GOTCTnOC8y-9OPGgSEDuiOjSxLxNXc39NZ3mCQgtYAJ_ktLjX1jea14XlqnJZtHXXSoSyKFDyJx21SddcLL9zCsW601mnGTZtrrTVx_QwDQbDpxorSz2Q8FIsH8yVRCh1x6xF1BhOVOTJc9ok3xDuDKwrEx6y5V_90GW6ZMVcY3c79JW7Y7xVdNZs8xBUN_3DoxrIbXmwxMp6VKh9FEuSDWkSUZgyQmBo2-1UUU9rGbaP4bxleotcTPn78cuEjofvNEnLwQE2URc8flh24zwcXY2O-9sXMSJjsbvJmbkk02rVAC5OAI9QpNKlPZhWGUVgvYdFNOHNxSuH51acbb65EP4nW6VvRUcYAUutTsJvqfvC66yy8U3_G2rEs8we7Z04BP-HNcptmMLhMM1JfRv-Yl9OAq8w8FeTo60yWNxunHbmeLcjU6U2XIYOxJqwsLE_9FZz7bSBMBWnmN0Y8rGh7Yz8cRBuayfny7CQhq5qfVVnZ4U4Z5rulfWZdwYYMEhUyeOXFvAQk45NIq5kv9HLD0E7xE0vqHVrPYRa1KVhYdWvmphdHfM9g5IRTizcHRPTz8mnCjhE0I1bWTEGoIuUaSIxqk8HQZVWQxPbleumlwJXA',
            //         'Content-Type: application/json'
            //     ),
            // ));
            // $token = curl_exec($curl);

            $curl2 = curl_init();

            curl_setopt_array($curl2, array(
                CURLOPT_URL => 'https://app.moota.co/api/v1/bank/{bank_id}/mutation/search/222',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJucWllNHN3OGxsdyIsImp0aSI6IjUxZDg2ZWZiMDQ3NGNlMjQ3NTkyOWI3ODcwOTQ5OTZkOGQyYTQ4N2U2YmM3MDMxMWU0MzExYjBkNDkxNWM2YzY2ZGQ1NzdkMzQ3NDZiYmM2IiwiaWF0IjoxNzAxMjY0MTMwLjU1MDMwMiwibmJmIjoxNzAxMjY0MTMwLjU1MDMwNiwiZXhwIjoxNzMyODg2NTMwLjQ3ODk4Mywic3ViIjoiMzEyNjciLCJzY29wZXMiOlsiYXBpIiwidXNlciIsInVzZXJfcmVhZCIsImJhbmsiLCJiYW5rX3JlYWQiLCJtdXRhdGlvbiIsIm11dGF0aW9uX3JlYWQiXX0.bfwnOzHgX7kAz3isgAVNQnnUw8pBzv21dDahFlzcRJf3vaEkDH1ILwJJqPvIMjZcEe80Z_PoTE7uTrRtnu2T9GpeqfUgMV0hOCt3IM26RYO1CxRMXtnQvr30QAjKvMTYUxa7v1p4Mqr8mqfwctM7lFW00_9MW4urd960jD1VhhNDcrBImAprmsE04hlktjNcus-wsqTpuvTPl2YKZxvADDKLcUDJaNzJzVai8P71W_26bM7QDHqST0_e4eIUhio7jxYlfcy6GQvRyxskBsOg1TSK9omU60gVtcCZP0ggJargJ3ib1xa0LZtvToWasAQiwIAaAZ7H8B1hM66w2QN8NJb_rPrpYKbAhpH9nJj7Dvg0Gstj9ha3V8z97c5nkgoIQN1n6Yq2aVIUrBwZFF7WgWljEs6G2EWgOO--WMU-ADjEN0X-lafqyZ9o25re0cH4tQslmOBsEZLHpqReYZ63stC3Uy54TifqJIhSxwFPN3V-y1RZLEH5OCRW4RurMU1GtgAHBIOWlt024yUvfQPOEkerHaVhnL7-DqYOCJDvmgX0pAfexzTLf639xUb47sbTBVUF1rJoOOHJS6Ce0obq1qb-mbSxlwqPRKgtGeuIMM-Rc19jD_l5lvrNcQ8wGGb5TLEiVzu05e5s93Y1K_rVEmIVvPMx4T3W__RfyHXmrxE',
                    'Content-Type: application/json'
                ),
            ));
            $xx = curl_exec($curl2);
            echo $xx;
            // echo json_decode($token)->access_token;

        }
      
        public function index()
        {
            // Tangkap webhook dari moota METHOD POST
            // notifikasi ini berbentuk json
            $notifications = file_get_contents("php://input");
               
            $neko = json_decode($notifications, TRUE);
            // Cek notif
            if ($neko) {
                // Looping hasil array dan isert ke database 
                foreach($neko as $jquin) {
                    // Buat kode unik untuk membandingkan
                    // update status pembayaran
                    $kode_unik = substr($jquin['amount'], -3);
                    // Cari data yang sama di table detail order
                    // $jOrder = $this->Order_model->jGetDataOrder($kode_unik);
                    // $idOrder = $jOrder->id_order;
                    // Tampung data response dari moota
                    // Perlu diketahui value Sandbox Webhook dan value
                    // webhook original berbeda.
                    // $client = $this->db->query('SELECT *,floor(b.harga * 11 / 100 + b.harga - a.id) as tagihan FROM dt_registrasi as a LEFT JOIN mt_paket as b on(a.speed=b.id_paket) left join mt_paket as c on(a.speed=c.id_paket) where status="Aktif" and floor(b.harga * 11 / 100 + b.harga - a.id)='.$jquin['amount'].'');
                    $client = $this->db->query('SELECT *,floor(b.harga * 11 / 100 + b.harga - a.id) as tagihan FROM dt_registrasi as a LEFT JOIN mt_paket as b on(a.speed=b.id_paket) left join mt_paket as c on(a.speed=c.id_paket) where status="Aktif"');
                    $get_client = $client->row_array();
                    $wa = "Kepada pelanggan yth,
*Bapak/Ibu ".$get_client['nama']."*
ID Pel : ".$get_client['kode_pelanggan']."
                    
Pembayaran tagihan anda *BERHASIL* 
                    
Tanggal Verifikasi : ".date('d-m-Y')."
Periode Pembayaran : ".date('M')." " . date('Y') ."
*Total Pembayaran : Rp ".number_format($jquin['amount'],0,'.','.').",-*
                    
Terima kasih atas kerjasamanya.
                    
Salam
MD.Net
_Supported by :_
*PT Lintas Jaringan Nusantara*
Kantor Layanan Babelan
Layanan Teknis	: 
0821-1420-9923
0819-3380-3366";
                    if ($get_client['tagihan'] == $jquin['amount']) {
                        if ($kode_unik != 000) {
                            $data = array(
                                'bank_id' => $jquin['bank_id'],
                                'account_number' => $jquin['account_number'],
                                'bank_type' => $jquin['bank_type'],
                                'date' => date( 'Y-m-d H:i:s'),
                                'amount' => $jquin['amount'],
                                'description' => $jquin['description'],
                                'type' => $jquin['type'],
                                'balance' => $jquin['balance'],
                                'kode_unik' => $kode_unik,
                                'id_order' => '13',
                                'nama_penerima'  => 'asep',
                                'nama_pengirim' => 'waaw'
                            );
                            $store = $this->db->insert('mutasi',$data);
                            $tanggal2 = time();
                            $bulan2 = $this->indonesian_date($tanggal2, 'F');
                            $data_cetak = [
                                "id_registrasi" => $get_client['kode_pelanggan'],
                                "nama" => $get_client['nama'],
                                "mbps" => $get_client['mbps'],
                                "tagihan" => $get_client['tagihan'],
                                "penerima" => 'admin',
                                "periode" => $bulan2,
                                "tahun" => date('Y'),
                                "tanggal_pembayaran" => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('dt_cetak',$data_cetak);
                            $this->api_whatsapp->wa_notif($wa,$get_client['telp']);
                        }
                    }else{
                        $wa_2 = "Notifkasi Pembayaran
Bank : ".$jquin['bank']->bank_type."
Tanggal : ".date( 'Y-m-d H:i:s')."
Jumlah : "."Rp.". number_format($jquin['amount'],0,'.','.')."
Deskripsi : ".$jquin['description']."
                        ";
                        $this->api_whatsapp->wa_notif($wa_2,'081933803366');
                    }
                }
            }else{
                $this->api_whatsapp->wa_notif('notif','083897943785');
            }
        }
        public static function http_get($url, $headers = array())
        {

            // is cURL installed yet?
            if (!function_exists('curl_init')) {
                die('Sorry cURL is not installed!');
            }

            // OK cool - then let's create a new cURL resource handle
            $ch = curl_init();

            // Now set some options (most are optional)

            // Set URL to download
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // Set a referer
            curl_setopt($ch, CURLOPT_REFERER, $url);

            // User agent
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");

            // Include header in result? (0 = yes, 1 = no)
            curl_setopt($ch, CURLOPT_HEADER, 0);

            // Should cURL return or print out the data? (true = return, false = print)
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Timeout in seconds
            curl_setopt($ch, CURLOPT_TIMEOUT, 240);

            // Download the given URL, and return output
            $output = curl_exec($ch);

            // Close the cURL resource, and free system resources
            curl_close($ch);

            return $output;
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
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {
	// private $param;

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library(array('form_validation'));
            $this->load->library('api_whatsapp');
            $this->load->library('api_xendit');

    }
    function tes2()
    {
        $cek_plg = $this->db->get_where('dt_cetak', ['id_registrasi' => str_replace(' ', '', 'GAK0616'), 'periode' => str_replace(' ', '', 'September'), 'tahun' => '2024'])->num_rows();
        echo $cek_plg;
    }
      function buat_va()
      {
        $db2 = $this->db->query('SELECT
	*,
	FLOOR(((
				b.harga + COALESCE ( c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 )) * 11 / 100 
			) + b.harga + COALESCE ( c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 ) - a.id 
	) AS tagihan,
	c.biaya AS biaya1,
	d.biaya AS biaya2,
	f.biaya AS biaya3,
	a.nama AS nama_pelanggann,
	a.id AS id_client 
FROM
	dt_registrasi AS a
	LEFT JOIN mt_paket AS b ON ( a.speed = b.id_paket )
	LEFT JOIN addon AS c ON ( c.id = a.addon1 )
	LEFT JOIN addon AS d ON ( d.id = a.addon2 )
	LEFT JOIN addon AS f ON (
	f.id = a.addon3 
	)
    left join mt_payment as g on(a.id = g.id_pelanggan)
	where status="Aktif" and a.id in("754") 
                        ')->result();
        foreach ($db2 as $x) {
            // echo $x->id_cl;exit;
            // echo ($x->nama_pelanggann);
  
            $cek_pay = $this->db->get_where('mt_payment',['id_pelanggan' => $x->id_client])->num_rows();
            if ($cek_pay == false) {
                $mandiri = 1013000000 + $x->id_client;
                $data = '{"external_id": "VA_fixed-'.time().'",
                        "bank_code": "MANDIRI",
                        "name": "'.$x->nama_pelanggann.'",
                        "expected_amount": "'.$x->tagihan.'",
                        "virtual_account_number" : "'. $mandiri .'",
                        "is_single_use": false,
                        "is_closed": true
                    }';
                $d = $this->api_xendit->create_va($data);
                $p = json_decode($d);
                echo $d;
                $data_in = [
                    "id_pelanggan" => $x->id_client, //id_pelanggan
                    "company" => $p->bank_code,
                    "va" => $p->account_number,
                    "id_va" => $p->id,
                    'external_id' => $p->external_id,
                    'json_va' => $d
                ];
                $this->db->insert('mt_payment',$data_in);
            }

        }
      }
        public function index()
        {
            // Tangkap webhook dari moota METHOD POST
            // notifikasi ini berbentuk json
            $notifications = file_get_contents("php://input");
            $token = "bzqjLpzxGwUwP7qJRdIRxcjMktOHBdggf3lnfB6Dsew";
            $curl = curl_init();
            $curl2 = curl_init();
            $curl3 = curl_init();
            $neko = json_decode($notifications, TRUE);
            // Cek notif
            if ($neko) {
                if (is_array($neko)){
                    $datax = $neko;
                }else{
                    $datax = json_decode($neko, true);
                }  
                    foreach($datax as $jquin) {
                        $kode_unik = substr($jquin['amount'], -3);
                        // $client = $this->db->query('SELECT *,floor(b.harga * 11 / 100 + b.harga - a.id) as tagihan FROM dt_registrasi as a LEFT JOIN mt_paket as b on(a.speed=b.id_paket) left join mt_paket as c on(a.speed=c.id_paket) where status="Aktif" and floor(b.harga * 11 / 100 + b.harga - a.id)='.$jquin['amount'].'');
                            $client = $this->db->query('SELECT
	*,
	FLOOR(((
				b.harga - COALESCE ( a.diskon, 0 )) * 11 / 100 
			) + b.harga + COALESCE ( c.biaya * 11 / 100 + c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * 11 / 100 + d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * 11 / 100 + f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 ) - a.id 
	) AS tagihan,
	c.biaya AS biaya1,
	d.biaya AS biaya2,
	f.biaya AS biaya3,
	a.nama AS nama_pelanggann,
	a.id AS id_client 
FROM
	dt_registrasi AS a
	LEFT JOIN mt_paket AS b ON ( a.speed = b.id_paket )
	LEFT JOIN addon AS c ON ( c.id = a.addon1 )
	LEFT JOIN addon AS d ON ( d.id = a.addon2 )
	LEFT JOIN addon AS f ON ( f.id = a.addon3 ) 
WHERE
	STATUS = "Aktif" 
	AND FLOOR(((
				b.harga - COALESCE ( a.diskon, 0 )) * 11 / 100 
		) + b.harga + COALESCE ( c.biaya * 11 / 100 + c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * 11 / 100 + d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * 11 / 100 + f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 ) - a.id 
	)= '.$jquin['amount'].'');
                        $get_client = $client->row_array();
                        $tanggal2 = time();
                        $bulan2 = $this->indonesian_date($tanggal2, 'F');
                        $cek_bulan = $this->db->get_where('dt_cetak', ['id_registrasi' => str_replace(' ','',$get_client['kode_pelanggan']), 'periode' => $bulan2, 'tahun' => date('Y')])->num_rows();
                        // if ($cek_bulan == true) {
                        //     //jika sudah bayar maka bayar di bulan berikut nya 
                        //     $effectiveDate = strtotime("+1 months", strtotime(date("Y-m-d")));
                        //     $bln_ad2 = date("Y-m-d H:i:s", $effectiveDate);
                        //     $str_bln = strtotime($bln_ad2);
                        //     $bulan_fix = $this->indonesian_date($str_bln, 'F');
                        //     $thn_fix = date('Y', $str_bln);
                        // } else {
                            $bulan_fix = $bulan2;
                            $thn_fix = date('Y');
                        // }
                        if ($client->num_rows() == true) {
                            if ($kode_unik != 000) {
                                $data = array(
                                    'bank_id' => $jquin['bank_id'],
                                    'account_number' => $jquin['account_number'],
                                    'bank_type' => json_decode(json_encode($jquin['bank']))->label,
                                    'date' => date( 'Y-m-d H:i:s'),
                                    'amount' => $jquin['amount'],
                                    'description' => $jquin['description'],
                                    'type' => $jquin['type'],
                                    'balance' => $jquin['balance'],
                                    'kode_unik' => $kode_unik,
                                    'id_order' => '13',
                                    'nama_penerima'  => 'superadmin',
                                    'nama_pengirim' => $get_client['nama_pelanggann'],
                                    'id_pelanggan' => str_replace(' ', '', $get_client['kode_pelanggan'])
                                );
                                $this->db->insert('mutasi',$data);
                                $cek_plg = $this->db->get_where('dt_cetak',['id_registrasi' => str_replace(' ','',$get_client['kode_pelanggan']),'periode' => str_replace(' ', '', $bulan_fix) ,'tahun' => $thn_fix])->num_rows();
                                //create image
                                $mpdf = new \Mpdf\Mpdf([
                                    // 'tempDir' => '/tmp',
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
                                $this->db->where('a.id', $get_client['id_client']);
                                $this->db->join('mt_paket as b', 'a.speed = b.id_paket');
                                $data['x'] = $this->db->get("dt_registrasi as a")->row_array();
                                $no_invoice = 'INV' . date('y') . date('m') . date('d') . $data['x']['id'];
                                $html = $this->load->view('body/pelanggan/struk', $data, true);
                                $mpdf->defaultfooterline = 0;
                                // $mpdf->setFooter('<div style="text-align: left;">F.7.1.1</div>');
                                $mpdf->WriteHTML($html);
                                $mpdf->Output('/home/billing.lintasmediadata.net/invoice/struk/' . $no_invoice . '.pdf', 'F');
                                // chmod($no_invoice . ".pdf", 0777);
                                // $mpdf->Output();
                                sleep(2);

                                $imagick = new Imagick();
                                $imagick->setResolution(200, 200);
                                $imagick->readImage("invoice/struk/$no_invoice.pdf");
                                $imagick->writeImages("invoice/struk/image/$no_invoice.jpg", true);
                                $url_img = "https://billing.mediadata.id/invoice/struk/image/$no_invoice.jpg";
                                //end create image
                                if ($cek_plg == false) {
                                    $data_cetak = [
                                        "id_registrasi" => str_replace(' ','',$get_client['kode_pelanggan']),
                                        "nama" => $get_client['nama_pelanggann'],
                                        "mbps" => $get_client['mbps'],
                                        "tagihan" => $get_client['tagihan'],
                                        "penerima" => 'admin',
                                        "periode" => str_replace(' ', '', $bulan_fix),
                                        "tahun" => str_replace(' ', '', $thn_fix),
                                        "tanggal_pembayaran" => date('Y-m-d H:i:s')
                                    ];
                                    $this->db->insert('dt_cetak', $data_cetak);
                                
                                    curl_setopt_array($curl, [
                                    CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 3000,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "POST",
                                    CURLOPT_POSTFIELDS => json_encode([
                                        'to_number' => "62" . substr($get_client['telp'], 1),
                                        'to_name' => $get_client['nama_pelanggann'],
                                        'message_template_id' => '0d7aee00-0f10-4db6-82d3-c596f8491fee',
                                        'channel_integration_id' => 'c7b25ef0-9ea4-4aff-9536-eb2eadae3400',
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
                                            'value_text' => $get_client['nama_pelanggann'] //value
                                            ],
                                            [
                                            'key' => '2', //{{ buat key 1,2,3,4 }}
                                            'value' => 'company', //kode pelanggan
                                            'value_text' => $get_client['kode_pelanggan'] //value
                                            ],
                                            [
                                            'key' => '3', //{{ buat key 1,2,3,4 }}
                                            'value' => '165000', //tagihan
                                            'value_text' => date('d-m-Y') //value
                                            ],
                                            [
                                            'key' => '4', //{{ buat key 1,2,3,4 }}
                                            'value' => '124', //kode unik
                                            'value_text' => $bulan_fix . " " . $thn_fix //periode
                                            ],
                                            [
                                            'key' => '5', //{{ buat key 1,2,3,4 }}
                                            'value' => '150000', //total tagihan
                                            'value_text' => number_format($jquin['amount'], 0, '.', '.') //total_pembayaran
                                            ],
                                            [
                                            'key' => '6', //{{ buat key 1,2,3,4 }}
                                            'value' => 'awawdd', //no telp
                                            'value_text' => '0877-8619-9004'  //value
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
                                    echo $response;
                                }
                            }else{
                            echo 'eror2';
                            }
                        }else{// kirim untuk selain kode unik

                            curl_setopt_array($curl, [
                                CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 3000,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => json_encode([
                                    'to_number' => "6287786199005",
                                    'to_name' => 'mahfud',
                                    'message_template_id' => '3a58a7f1-4831-43e5-ab78-74e852e578a8',
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
                                                'value' => 'name', //bank
                                                'value_text' => json_decode(json_encode($jquin['bank']))->label //value
                                            ],
                                            [
                                                'key' => '2', //{{ buat key 1,2,3,4 }}
                                                'value' => 'company', //kode pelanggan
                                                'value_text' => date('Y-m-d H:i:s') //value
                                            ],
                                            [
                                                'key' => '3', //{{ buat key 1,2,3,4 }}
                                                'value' => '165000', //tagihan
                                                'value_text' => "Rp.".number_format($jquin['amount'], 0, '.', '.') //value
                                            ],
                                            [
                                                'key' => '4', //{{ buat key 1,2,3,4 }}
                                                'value' => '124', //kode unik
                                                'value_text' => $jquin['description'] //periode
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
                            curl_close($curl);
                            echo $response;
                        }
                    }
                // }else{
                // echo "array eror";
                // }
            }else{
            echo 'eror';
                //$this->api_whatsapp->wa_notif('notif','083897943785');
            }
        curl_close($curl);

        }
        function paid_va()
        {
        $xenditXCallbackToken = 'R9XoKSUvS79dokcq2BYRh4UOQnQHTtzgyi0DBSDNGCOPvLyj';

        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders["X-Callback-Token"]) ? $reqHeaders["X-Callback-Token"] : "";

        if ($xIncomingCallbackTokenHeader === $xenditXCallbackToken) {
            $rawRequestInput = file_get_contents("php://input");
            // Baris ini melakukan format input mentah menjadi array asosiatif
            $arrRequestInput = json_decode($rawRequestInput, true);
            // $payload2 = [
            //         "id" => $id,
            //         "payment_id" => "1487156512722",
            //         "callback_virtual_account_id" => "58a434ba39cc9e4a230d5a2b",
            //         "owner_id" => "5824128aa6f9f9b648be9d76",
            //         "external_id" => "fixed-va-1487156410",
            //         "account_number" => "1001470126",
            //         "bank_code" => "MANDIRI",
            //         "amount" => 80000,
            //         "transaction_timestamp" => "2017-02-15T11:01:52.722Z",
            //         "merchant_code" => "88464",
            //     ];
            $api_key = 'xnd_production_IciBYQPfQ819WW5bP7x31pOSZVl6Nn6P1NiVwabystIa9TOv9B7lQvw2tWA';
            $token = "bzqjLpzxGwUwP7qJRdIRxcjMktOHBdggf3lnfB6Dsew";

            $id = $arrRequestInput['callback_virtual_account_id'];
            $query = $this->db->query("SELECT
                    *,
                    FLOOR(((
                                b.harga + COALESCE ( c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 )) * 11 / 100 
                            ) + b.harga + COALESCE ( c.biaya * c.qty, 0 ) + COALESCE ( d.biaya * d.qty, 0 ) + COALESCE ( f.biaya * f.qty, 0 ) - COALESCE ( a.diskon, 0 ) - a.id 
                    ) AS tagihan,
                    c.biaya AS biaya1,
                    d.biaya AS biaya2,
                    f.biaya AS biaya3,
                    a.nama AS nama_pelanggann,
                    a.id AS id_client 
                FROM
                    dt_registrasi AS a
                    LEFT JOIN mt_paket AS b ON ( a.speed = b.id_paket )
                    LEFT JOIN addon AS c ON ( c.id = a.addon1 )
                    LEFT JOIN addon AS d ON ( d.id = a.addon2 )
                    LEFT JOIN addon AS f ON ( f.id = a.addon3 )
                    LEFT JOIN mt_payment AS g ON ( a.id = g.id_pelanggan ) 
                WHERE
                    g.id_va = '$id'")->row_array();
            // $id_va = isset($query['id_va']) ? $query['id_va'] : "";
            // if ( $id_va ==  true) {
            $end_point = 'https://api.xendit.co/callback_virtual_accounts/' . $query['id_va'];
            $curl2 = curl_init();
            $curl = curl_init();

            curl_setopt_array($curl2, array(
                CURLOPT_URL => $end_point,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                // CURLOPT_POSTFIELDS =>'{
                //     "expected_amount": "10000",
                //     "is_single_use": true
                // }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode("$api_key:"),
                ),
            )
            );

            $response2 = curl_exec($curl2);

            
            curl_close($curl2);
            // $data = array(
            //     'bank_id' => $jquin['bank_id'],
            //     'account_number' => $jquin['account_number'],
            //     'bank_type' => json_decode(json_encode($jquin['bank']))->label,
            //     'date' => date('Y-m-d H:i:s'),
            //     'amount' => $jquin['amount'],
            //     'description' => $jquin['description'],
            //     'type' => $jquin['type'],
            //     'balance' => $jquin['balance'],
            //     'kode_unik' => 0,
            //     'id_order' => '13',
            //     'nama_penerima' => 'xendit',
            //     'nama_pengirim' => $query['nama'],
            //     'id_pelanggan' => str_replace(' ', '', $query['kode_pelanggan'])
            // );
            // $this->db->insert('mutasi', $data);
            $tanggal2 = time();
            $bulan2 = $this->indonesian_date($tanggal2, 'F');
            $cek_bulan = $this->db->get_where('dt_cetak', ['id_registrasi' => str_replace(' ', '', $query['kode_pelanggan']), 'periode' => $bulan2, 'tahun' => date('Y')])->num_rows();
            // if ($cek_bulan == true) {
            //     //jika sudah bayar maka bayar di bulan berikut nya 
            //     $effectiveDate = strtotime("+1 months", strtotime(date("Y-m-d")));
            //     $bln_ad2 = date("Y-m-d H:i:s", $effectiveDate);
            //     $str_bln = strtotime($bln_ad2);
            //     $bulan_fix = $this->indonesian_date($str_bln, 'F');
            //     $thn_fix = date('Y', $str_bln);
            // } else {
            $bulan_fix = $bulan2;
            $thn_fix = date('Y');
            // }
            $cek_plg = $this->db->get_where('dt_cetak', ['id_registrasi' => str_replace(' ', '', $query['kode_pelanggan']), 'periode' => str_replace(' ', '', $bulan_fix), 'tahun' => $thn_fix])->num_rows();
            //create image
            $mpdf = new \Mpdf\Mpdf([
                // 'tempDir' => '/tmp',
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

            $this->db->where('a.id', $query['id_client']);
            $this->db->join('mt_paket as b', 'a.speed = b.id_paket');
            $data['x'] = $this->db->get("dt_registrasi as a")->row_array();
            $no_invoice = 'INV' . date('y') . date('m') . date('d') . $data['x']['id'];
            $html = $this->load->view('body/pelanggan/struk', $data, true);
            $mpdf->defaultfooterline = 0;
            // $mpdf->setFooter('<div style="text-align: left;">F.7.1.1</div>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('/home/billing.lintasmediadata.net/invoice/struk/' . $no_invoice . '.pdf', 'F');
            // chmod($no_invoice . ".pdf", 0777);
            // $mpdf->Output();

            $imagick = new Imagick();
            $imagick->setResolution(200, 200);
            $imagick->readImage("invoice/struk/$no_invoice.pdf");
            $imagick->writeImages("invoice/struk/image/$no_invoice.jpg", true);
            $url_img = "https://billing.mediadata.id/invoice/struk/image/$no_invoice.jpg";
            //end create image
            if ($cek_plg == false) {
                $data_cetak = [
                    "id_registrasi" => str_replace(' ', '', $query['kode_pelanggan']),
                    "nama" => $query['nama_pelanggann'],
                    "mbps" => $query['mbps'],
                    "tagihan" => $query['tagihan'],
                    "penerima" => 'xendit',
                    "periode" => str_replace(' ', '', $bulan_fix),
                    "tahun" => str_replace(' ', '', $thn_fix),
                    "tanggal_pembayaran" => date('Y-m-d H:i:s')
                ];
                $this->db->insert('dt_cetak', $data_cetak);

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://service-chat.qontak.com/api/open/v1/broadcasts/whatsapp/direct",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 3000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode([
                        'to_number' => "62" . substr($query['telp'], 1),
                        'to_name' => $query['nama_pelanggann'],
                        'message_template_id' => '0d7aee00-0f10-4db6-82d3-c596f8491fee',
                        'channel_integration_id' => 'c7b25ef0-9ea4-4aff-9536-eb2eadae3400',
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
                                    'value_text' => $query['nama_pelanggann'] //value
                                ],
                                [
                                    'key' => '2', //{{ buat key 1,2,3,4 }}
                                    'value' => 'company', //kode pelanggan
                                    'value_text' => $query['kode_pelanggan'] //value
                                ],
                                [
                                    'key' => '3', //{{ buat key 1,2,3,4 }}
                                    'value' => '165000', //tagihan
                                    'value_text' => date('d-m-Y') //value
                                ],
                                [
                                    'key' => '4', //{{ buat key 1,2,3,4 }}
                                    'value' => '124', //kode unik
                                    'value_text' => $bulan_fix . " " . $thn_fix //periode
                                ],
                                [
                                    'key' => '5', //{{ buat key 1,2,3,4 }}
                                    'value' => '150000', //total tagihan
                                    'value_text' => number_format($query['tagihan'], 0, '.', '.') //total_pembayaran
                                ],
                                [
                                    'key' => '6', //{{ buat key 1,2,3,4 }}
                                    'value' => 'awawdd', //no telp
                                    'value_text' => '0877-8619-9004'  //value
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
                // echo $response;
            echo json_encode($response2);

            }

            
        } else {
            echo json_encode([
                "error" => 404,
                "message" => "Toke not found"
            ]);
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
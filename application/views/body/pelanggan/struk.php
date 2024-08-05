<?php

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        /* body {
            font-family: Arial, Helvetica, sans-serif;
        } */
        body{
            font-family: "Poppins", sans-serif;
        }
       
        #table_tagihan {
            border-collapse: collapse;
            width: 100%;
        }

        #table_tagihan td,
        #table_tagihan th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        #table_tagihan tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* #table_tagihan tr:hover {background-color: #ddd;} */

        #table_tagihan th {
            font-size: 12px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #dd6d14;
            color: white;
        }
    </style>
</head>

<body style="background-color: white;">
    <table style="background-color: white;">
        <tr>
            <td>
                <img width="120" src="./assets/images/logo/ljn2.png" alt="">
            </td>
            <td><b style="font-size: 20px;"> PT Lintas Jaringan Nusantara </b> <br> <i>Internet Service Provider & IT
                    Solution</i> <br><br>Kantor Layanan Babelan <br> Perum Wahana Pondok Ungu</td>
        </tr>
        <tr>
            <td> <br><br></td>
        </tr>
    </table>
    <?php
    if ($this->uri->segment(2) == 'index') {//index callback moota, note : kondisi 2x bayar belum dibuat
        $pay = 'PAID';
        $pay_css = '#10c245';
        $bulan = date('m');
        $tahun = date('Y');
        $tanggal_t = date('d');
    }else if ($this->uri->segment(2) == 'buat_pembayaran'){
        $pay = 'PAID';
        $pay_css = '#10c245';
        $bulan = $x['periode'];
        $tahun = $x['tahun'];
        $tanggal_t = date('d');
    }else {
        $pay = 'INVOICE';
        $pay_css = '#e67217';
        $bulan = $this->session->userdata('filterBulan');
        $tahun = $this->session->userdata('filterTahun');
        $tanggal_t = $this->session->userdata('filterTgl_tempo') == null ? 10 : $this->session->userdata('filterTgl_tempo');

    }

    if ($bulan == 'Januari') {
        $bln_conv = '01';
    } elseif ($bulan == 'Februari') {
        $bln_conv = '02';
    } elseif ($bulan == 'Maret') {
        $bln_conv = '03';
    } elseif ($bulan == 'April') {
        $bln_conv = '04';
    } elseif ($bulan == 'Mei') {
        $bln_conv = '05';
    } elseif ($bulan == 'Juni') {
        $bln_conv = '06';
    } elseif ($bulan == 'Juli') {
        $bln_conv = '07';
    } elseif ($bulan == 'Agustus') {
        $bln_conv = '08';
    } elseif ($bulan == 'September') {
        $bln_conv = '09';
    } elseif ($bulan == 'Oktober') {
        $bln_conv = '10';
    } elseif ($bulan == 'November') {
        $bln_conv = '11';
    } elseif ($bulan == 'Desember') {
        $bln_conv = '12';
    }else {
        $bln_conv = date('m');
    }

    ?>
    <table style="background-color:white">
       <!--#10c245 paid -->
       <!--#e67217 invoice -->

        <tr>
            <td colspan="1"></td>
            <td class="poppins-thin" style="text-align:center;font-size:35px;color:<?= $pay_css ?>;border-radius:2px;border: 5px solid <?= $pay_css ?>;font-family: 'Poppins-bold', sans-serif"><?= $pay ?></td>
        </tr>
        <tr>
            <td width="800">Kepada Yth. : <?= $x['nama'] ?></td>
            <td>INV<?= $tahun . $bln_conv . $tanggal_t . $x['id'] ?></td>
            <!-- <td><h4> INVOICE </h4></td> -->
        </tr>
        <tr>
            <td>ID Pelanggan : <?= $x['kode_pelanggan'] ?></td>
            <td>Tanggal : <?= date('d') ?> <?= date('m') ?> <?= date('Y') ?></td>
            <!-- <td><h4> INVOICE </h4></td> -->
        </tr>
        <tr>
            <td>Alamat : <?= $x['alamat'] ?></td>
            <td>Jatuh Tempo : <?= $x['tempo'] ?> <?= $bulan ?> <?= $tahun ?></td>
        </tr>
        <!-- <tr>
            <td><?= $x['nama'] ?></td> 
            <td>No Invoice : INV<?= $tahun . $bln_conv . $tanggal_t . $x['id'] ?></td>
        </tr> -->

        <tr>
            <td><br><br></td>
            <td>Periode : <?= $bulan ?> <?= $tahun ?></td>
        </tr>
        <!-- <tr>
            <td>Phone : <?= $x['telp'] ?></td>
            <td>Jatuh Tempo : <?= $x['tempo'] ?> <?= $bulan ?> <?= $tahun ?></td>
        </tr> -->
        <!-- <tr>
            <td>Email : <?= $x['email'] ?></td>
        </tr> -->
    </table>
    <table id="table_tagihan">
        <tr>
            <th>Jumlah</th>
            <th>Uraian</th>
            <th>Harga @</th>
            <th>Harga</th>
        </tr>
        <tr>
            <?php
            $kd_unik_in = $x['id'];
            $kd_unik_in = sprintf('%04d', $kd_unik_in);
            ?>
            <?php $kd_unik = $kd_unik_in == '' ? 0 : $kd_unik_in; ?>
            <td>1 Paket</td>
            <td>Biaya langganan internet <?= $x['mbps'] ?> mbps</td>
            <td><?php
            echo 'Rp.' . number_format($x['harga'], 0, '.', '.') ?></td>
            <td><?= 'Rp.' . number_format($x['harga'], 0, '.', '.') ?></td>
        </tr>
        <?php
        $addon1 = $this->db->get_where('addon', ['id' => $x['addon1']])->row_array();
        $addon2 = $this->db->get_where('addon', ['id' => $x['addon2']])->row_array();
        $addon3 = $this->db->get_where('addon', ['id' => $x['addon3']])->row_array();
        ?>
        <?php if ($addon1 == true) {
            $addon1_biaya = $addon1['biaya'];
            ?>
            <tr>
                <td></td>
                <td>Add on <?= $addon1['nama'] ?></td>
                <td><?= 'Rp.' . number_format($addon1['biaya'], 0, '.', '.') ?></td>
                <td><?= 'Rp.' . number_format($addon1['biaya'], 0, '.', '.') ?></td>
            </tr>
        <?php } else {
            $addon1_biaya = 0;
        } ?>
        <?php if ($addon2 == true) {
            $addon2_biaya = $addon2['biaya'];
            ?>
            <tr>
                <td></td>
                <td>Add on <?= $addon2['nama'] ?></td>
                <td><?= 'Rp.' . number_format($addon2['biaya'], 0, '.', '.') ?></td>
                <td><?= 'Rp.' . number_format($addon2['biaya'], 0, '.', '.') ?></td>
            </tr>
        <?php } else {
            $addon2_biaya = 0;
        } ?>
        <?php if ($addon3 == true) {
            $addon3_biaya = $addon3['biaya'];
            ?>
            <tr>
                <td></td>
                <td>Add on <?= $addon3['nama'] ?></td>
                <td><?= 'Rp.' . number_format($addon3['biaya'], 0, '.', '.') ?></td>
                <td><?= 'Rp.' . number_format($addon3['biaya'], 0, '.', '.') ?></td>
            </tr>
        <?php } else {
            $addon3_biaya = 0;
        }
        // $xx = $x['harga']+$addon1_biaya+$addon2_biaya+$addon3_biaya;
        

        ?>
        <!--diskon -->
        <?php if ($x['diskon'] == true) {
            $diskonnn = $x['diskon'];
            ?>
            <!-- <tr>
            <td></td>
            <td>Diskon</td>
            <td><?= 'Rp.' . number_format($x['diskon'], 0, '.', '.') ?></td>
            <td><?= 'Rp.' . number_format($x['diskon'], 0, '.', '.') ?></td>
        </tr> -->
        <?php } else {
            $diskonnn = 0;
        }
        // $xx = $x['harga']+$addon1_biaya+$addon2_biaya+$addon3_biaya-$diskonnn;


        ?>
        <!-- <tr style="background-color: #d0cece;">
            <td colspan="2">
                Keterangan : 
            </td>
            <td>Harga Total</td>
            <td><?= 'Rp.' . number_format($x['harga'], 0, '.', '.') ?></td>
        </tr> -->
        <tr>
            <td colspan="2" rowspan="6">
                .: Pembayaran ditujukan ke : <br>
                BCA 2761446578 an Mahfudin <br>
                <?php $pay = $this->db->get_where('mt_payment',['id_pelanggan' => $x['id'] ]);
                $paymentt = '';
                    if ($pay->num_rows() >= 1) {
                        foreach ($pay->result() as $k) {
                            $paymentt .= $k->company . ' ' . $k->va . ' an' . $x['nama'] . "<br>" ;
                        }
                    }else{
                        $paymentt .= 'MANDIRI 1560016047112 an Mahfudin';
                    }
                echo $paymentt;
                ?>
                <!-- 2. MANDIRI 1560016047112 an Mahfudin -->
            </td>
            <?php if ($x['diskon'] > 0) { ?>
                <td>Diskon</td>
                <td>Rp.<?= number_format($x['diskon']) ?></td>
            <?php } ?>
        </tr>
        <!-- <tr style="background-color: #d0cece;">
            <td>PPN 11%</td>
            <td>Rp.<?= number_format($ppn, 0, '.', '.') ?></td>
        </tr> -->
        <!-- <tr>
            <td>Biaya Pengirim</td>
            <td>Rp.0</td>
        </tr> -->
        <!-- <tr style="background-color: #d0cece;">
            <td>Uang Muka (DP)</td>
            <td>Rp.0</td>
        </tr> -->
        <tr>
            <td>Discount</td>
            <td><?= $kd_unik ?></td>
        </tr>
        <tr style="background-color: #d0cece;">
            <td rowspan="7"><b>Grand Total</b></td>
            <td>
                <?php
                $tt_h = $x['harga'] + $addon1_biaya + $addon2_biaya + $addon3_biaya - $diskonnn;
                $ppn = floor($tt_h * 11 / 100);
                if ($pay->num_rows() >= 1) { //menggunakan va
                    $totalll = floor($x['harga'] + $addon1_biaya + $addon2_biaya + $addon3_biaya + $ppn - $diskonnn);
                }else{ //menggunakan kode unik
                    $totalll = floor($x['harga'] + $addon1_biaya + $addon2_biaya + $addon3_biaya + $ppn - $kd_unik_in - $diskonnn);
                }
                ?>
                
                <b><?= 'Rp.' . number_format($totalll, 0, '.', '.') ?></b>
            </td>
        </tr>
    </table>
    <table id="table_tagihan">
        <tr style="background-color: #d0cece;">
            <td>Terbilang : <i> <?= terbilang($totalll) ?> rupiah</i></td>
        </tr>
    </table>
</body>

</html>
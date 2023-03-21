<?php

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
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
    <title>Document</title>
    <style>
        /* body {
            font-family: Arial, Helvetica, sans-serif;
        } */
        #table_tagihan {
            font-family: 'open-sans';
            border-collapse: collapse;
            width: 100%;
            }

            #table_tagihan td, #table_tagihan th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
            }

            #table_tagihan tr:nth-child(even){background-color: #f2f2f2;}

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
<body>
    <table style="background-color: #f7f7f7;">
        <tr>
            <td>
                 <img width="120" src="<?= base_url() ?>assets/images/logo/ljn.png" alt="">
            </td>
            <td><b style="font-size: 20px;"> PT Lintas Jaringan Nusantara </b> <br> <i>Internet Service Provider & IT Solution</i> <br><br>Kantor Layanan Babelan <br> Perum Wahana Pondok Ungu</td>
        </tr>
        <tr>
            <td> <br><br></td>
        </tr>
    </table>
    <table style="background-color:#f7f7f7">
        <tr>
            <td><b style="background-color: #f2f2f2;width:90px;">Kepada : </b></td>
            <td><h4> INVOICE </h4></td>
        </tr>
        <tr>
            <td><?= $x['nama'] ?></td> 
            <td>No Invoice : INV<?= date('y').date('m').date('d').$x['id'] ?></td>
        </tr>
        <tr>
            <td width="400"><?= $x['alamat'] ?></td> 
            <td>Tanggal : 11 Maret 2023</td>
        </tr>
        <tr>
            <td><br><br></td>
            <td>Periode : Maret 2023</td>
        </tr>
        <tr>
            <td>Phone : <?= $x['telp'] ?></td>
            <td>Jatuh Tempo : 20 Maret 2023</td>
        </tr>
        <tr>
            <td>Email : <?= $x['email'] ?></td>
        </tr>
    </table>
    <table id="table_tagihan">
        <tr>
            <th>Jumlah</th>
            <th>Uraian</th>
            <th>Harga @</th>
            <th>Harga</th>
        </tr>
        <tr>
            <td>1 Paket</td>
            <td>Biaya langganan internet <?= $x['mbps'] ?> mbps</td>
            <td><?php 
		    $ppn = $x['harga'] * 11 / 100;
            echo 'Rp.'. number_format($x['harga'],0,'.','.') ?></td>
            <td><?= 'Rp.'. number_format($x['harga'],0,'.','.') ?></td>
        </tr>
        <tr style="background-color: #d0cece;">
            <td colspan="2">
                Keterangan : 
            </td>
            <td>Harga Total</td>
            <td><?= 'Rp.'. number_format($x['harga'],0,'.','.') ?></td>
        </tr>
        <tr>
            <td colspan="2" rowspan="6">
                .: Pembayaran dapat di transfer ke BCA 2761446578 an Mahfudin
            </td>
            <td>Diskon</td>
            <td>Rp.0</td>
        </tr>
        <tr style="background-color: #d0cece;">
            <td>PPN 11%</td>
            <td>Rp.<?= number_format($ppn,0,'.','.') ?></td>
        </tr>
        <tr>
            <td>Biaya Pengirim</td>
            <td>Rp.0</td>
        </tr>
        <tr style="background-color: #d0cece;">
            <td>Uang Muka (DP)</td>
            <td>Rp.0</td>
        </tr>
        <tr>
            <td rowspan="7"><b>Grand Total</b></td>
            <td >
                <b><?= 'Rp.'. number_format($x['harga']+ $ppn,0,'.','.') ?></b>
            </td>
        </tr>
    </table>
    <table id="table_tagihan">
        <tr style="background-color: #d0cece;">
            <td>Terbilang : <i> <?= terbilang(232400) ?> rupiah</i></td>
        </tr>
    </table>
</body>
</html>
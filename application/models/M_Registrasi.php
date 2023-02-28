<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Registrasi extends CI_Model {
    function get_paket($id){
        return $this->db->query("SELECT * FROM mt_paket where media='$id'")->result();
    }
    function list_client($postData){
        $response = array();
        
        //value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = 'a.nama';
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        //search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or alamat like '%".$searchValue."%' or telp like'%".$searchValue."%' ) ";
        }
        $id_user = $this->session->userdata('id_user');
        $alamat_get = $this->db->query("SELECT * FROM users where id='$id_user'")->row_array();
        $arr = explode(',',$alamat_get['group']);
        $this->db->select('count(*) as allcount');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->order_by('a.id', 'desc');
        // $this->db->where('a.status','Aktif');
        if ($this->session->userdata('sort_group')) {
            $this->db->where('a.group',$this->session->userdata('sort_group'));
        }
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',$arr);
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount,nama');
        if($searchQuery != '')
            $this->db->where($searchQuery);
            // $this->db->like('nama',$searchValue);
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        // $this->db->where('a.status','Aktif');
        if ($this->session->userdata('sort_group')) {
            $this->db->where('a.group',$this->session->userdata('sort_group'));
        }
        $this->db->order_by('a.id', 'desc');
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',$arr);
        }
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        if($searchQuery != '')
        $this->db->select('*');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->order_by('a.id', 'desc');
        if ($this->session->userdata('sort_group')) {
            $this->db->where('a.group',$this->session->userdata('sort_group'));
        }
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',$arr);
        }
        $this->db->like('a.nama',$searchValue);
        // $this->db->or_like('a.alamat',$searchValue);
        // $this->db->or_like('a.tanggal',$searchValue);
        //  $this->db->order_by('tanggal', 'desc');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        //  $records = $this->db->query("SELECT a.id_cetak,a.nama,b.paket,a.tagihan,a.penerima,a.periode,a.tanggal,a.nomor_struk FROM dt_registrasi as a left join mt_paket as b on(a.internet = b.id_wireless) where '$searchQuery' order by '$columnName' asc limit $rowperpage")->result();
        $records = $this->db->get()->result();
        $data = array();
        $no =1;
        foreach($records as $record ){
            if ($record->status == "Aktif") {
                $status = '<span class="badge badge-glow badge-success">'.$record->status.'</span>';
            }else if($record->status == "Free"){
                $status = '<span class="badge badge-glow badge-primary">'.$record->status.'</span>';
            }else{
                $status = '<span class="badge badge-glow badge-danger">'.$record->status.'</span>';
            }
            if ($this->session->userdata('role') == 'Koordinator' || $this->session->userdata('role') == 'Sub Koordinator') {
                $disabled = 'disabled';
            }else{
                $disabled = '';
            }
            if ($this->session->userdata('role') == 'Admin') {
                $disabled_admin = 'disabled';
            }else{
                $disabled_admin ='';
            }
            $action = '<a target="_blank" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light '.$disabled.'" href="pdf/'. $record->id . '"><i class="feather icon-eye"></i></a> 
            <a class="btn btn-icon btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light '.$disabled.'" href="update/' . $record->id . '" class="url"><i class="feather icon-edit"></i></a>
            <a href="#" id="' .$record->id . '" class="btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light '.$disabled.' change_status"><i class="feather icon-refresh-ccw"></i></a>
            <a href="#" id="'.$record->id.'" class="btn btn-icon btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light '.$disabled.' '.$disabled_admin.' del_client"><i class="feather icon-trash-2"></i></a>';

            $data[] = array(
            "no"=>$no++,
            "id"=> $record->id,
            "nama"=>$record->nama,
            "kode_pelanggan"=>$record->kode_pelanggan,
            "action" => $action,
            "status"=>$status,
            "email"=>$record->email,
            "alamat"=> $record->alamat,
            "telp"=>$record->telp,
            "group"=>$record->group,
            );
        }

        //response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    function status_payment($postData){
        $response = array();
        
        //value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = 'a.nama';
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        //search
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = " (nama like '%".$searchValue."%' or alamat like '%".$searchValue."%' or telp like'%".$searchValue."%' ) ";
        }

        $this->db->select('count(*) as allcount');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->where('a.status','Aktif');
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where('a.group',$this->session->userdata('kode_group'));
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount,nama');
        if($searchQuery != '')
            $this->db->where($searchQuery);
            // $this->db->like('nama',$searchValue);
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->where('a.status','Aktif');
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where('a.group',$this->session->userdata('kode_group'));
        }
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        if($searchQuery != '')
        $this->db->select('*');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->where('a.status','Aktif');
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where('a.group',$this->session->userdata('kode_group'));
        }
        $this->db->like('a.nama',$searchValue);
        // $this->db->or_like('a.alamat',$searchValue);
        // $this->db->or_like('a.tanggal',$searchValue);
        //  $this->db->order_by('tanggal', 'desc');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        //  $records = $this->db->query("SELECT a.id_cetak,a.nama,b.paket,a.tagihan,a.penerima,a.periode,a.tanggal,a.nomor_struk FROM dt_registrasi as a left join mt_paket as b on(a.internet = b.id_wireless) where '$searchQuery' order by '$columnName' asc limit $rowperpage")->result();
        $records = $this->db->get()->result();
        $data = array();
        $no =1;
        foreach($records as $record ){
            $cek = $this->db->query("SELECT * FROM dt_cetak where id_registrasi='$record->alamat'")->num_rows();
            if ($cek == true) {
                $status = '<span class="badge badge-glow badge-success">Sudah Bayar</span>';
            }else{
                $status = '<span class="badge badge-glow badge-danger">Belum Bayar</span>';
            }
            $data[] = array(
            "no"=>$no++,
            "id"=> $record->id,
            "nama"=>$record->nama,
            "alamat"=> $record->alamat,
            "group"=>$record->group,
            "status"=>$status,
            );
        }

        //response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

}
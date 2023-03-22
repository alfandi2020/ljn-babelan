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
            $searchQuery = " (nama like '%".$searchValue."%' or a.alamat like '%".$searchValue."%' or telp like'%".$searchValue."%' ) ";
        }
        $id_user = $this->session->userdata('id_user');
        $alamat_get = $this->db->query("SELECT * FROM users where id='$id_user'")->row_array();
        $arr = explode(',',$alamat_get['group']);
        $this->db->select('count(*) as allcount');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->order_by('a.id', 'desc');
        // $this->db->where('a.status','Aktif');
        if ($this->session->userdata('sort_status')) {
            $this->db->where('a.status',$this->session->userdata('sort_status'));
        }
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
            $this->db->like('nama',$searchValue);
            $this->db->or_like('a.kode_pelanggan',$searchValue);
            $this->db->or_like('a.t_telp',$searchValue);
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        // $this->db->where('a.status','Aktif');
        if ($this->session->userdata('sort_status')) {
            $this->db->where('a.status',$this->session->userdata('sort_status'));
        }
        if ($this->session->userdata('sort_group')) {
            $this->db->where('a.group',$this->session->userdata('sort_group'));
        }
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',$arr);
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
        if ($this->session->userdata('sort_status')) {
            $this->db->where('a.status',$this->session->userdata('sort_status'));
        }
        if ($this->session->userdata('sort_group')) {
            $this->db->where('a.group',$this->session->userdata('sort_group'));
        }
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',$arr);
        }
        $this->db->like('a.nama',$searchValue);
        $this->db->or_like('a.kode_pelanggan',$searchValue);
        $this->db->or_like('a.t_telp',$searchValue);
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
            if ($record->status == 'Aktif') {
                $change = '<a href="#" id="' .$record->id . '" class="btn btn-icon btn-icon rounded-circle btn-success mr-1 mb-1 waves-effect waves-light '.$disabled.' change_status"><i class="feather icon-refresh-ccw"></i></a>';
            }else{
                $change = '<a href="#" id="' .$record->id . '" class="btn btn-icon btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light '.$disabled.' change_status_aktif"><i class="feather icon-refresh-ccw"></i></a>';
            }
            $action = '<button type="button" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light '.$disabled.'" data-toggle="modal" data-target="#modalClient'.$record->id.'"><i class="feather icon-eye"></i></button> 
            <div class="modal fade" id="modalClient'.$record->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Paket Internet</h6>
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Media</label>
                                <input class="form-control" disabled value="'.$record->media.'">
                            </div>
                            <div class="col-xl-6">
                                <label>Paket Internet</label>
                                <input class="form-control" disabled value="'.$record->mbps.' Mbps - Rp.'.number_format($record->harga,0,'.','.').' - '.$record->paket_internet.'">
                            </div>
                        </div>
                        <hr>
                        <h6>Inventory</h6>
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Router</label>
                                <input class="form-control" disabled value="'.$record->router.'">
                            </div>
                            <div class="col-xl-6">
                                <label>CPE</label>
                                <input class="form-control" disabled value="'.$record->cpe.'">
                            </div>
                        </div>
                        <hr>
                        <h6>Data</h6>
                        <div class="row mt-2">
                            <div class="col-xl-4">
                                <label>Nama</label>
                                <input class="form-control" disabled value="'.$record->nama.'">
                            </div>
                            <div class="col-xl-4">
                                <label>Nomor KTP</label>
                                <input class="form-control" disabled value="'.$record->ktp.'">
                            </div>
                            <div class="col-xl-4">
                                <label>Nomor NPWP</label>
                                <input class="form-control" disabled value="'.$record->npwp.'">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xl-4">
                                <label>Group</label>
                                <input class="form-control" disabled value="'.$record->group.'">
                            </div>
                            <div class="col-xl-4">
                                <label>Alamat</label>
                                <input class="form-control" disabled value="'.$record->alamat.'">
                            </div>
                            <div class="col-xl-4">
                                <label>Kode Pelanggan</label>
                                <input class="form-control" disabled value="'.$record->kode_pelanggan.'">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xl-4">
                                <label>Teknisi</label>
                                <input class="form-control" disabled value="'.$record->teknisi.'">
                            </div>
                            <div class="col-xl-4">
                                <label>Kontak Handphone</label>
                                <input class="form-control" disabled value="'.$record->telp.'">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-icon btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light '.$disabled.'" href="update/' . $record->id . '" class="url"><i class="feather icon-edit"></i></a>
            '.$change.'
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
            $this->db->where_in('a.group',explode(',',$this->session->userdata('kode_group')));
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
            $this->db->where_in('a.group',explode(',',$this->session->userdata('kode_group')));
        }
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        if($searchQuery != '')
        $this->db->select('*');
        $this->db->from('dt_registrasi as a');
        $this->db->join('mt_paket as b', 'a.speed = b.id_paket','left');
        $this->db->where('a.status','Aktif');
        if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
            $this->db->where_in('a.group',explode(',',$this->session->userdata('kode_group')));
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
            $cek = $this->db->query("SELECT * FROM dt_cetak where id_registrasi='$record->id'")->num_rows();
            if ($cek == true) {
                $status = '<span class="badge badge-glow badge-success">Sudah Bayar</span>';
            }else{
                $status = '<span class="badge badge-glow badge-danger">Belum Bayar</span>';
            }
           $tagihan =  '<a href="#" id="'.$record->id.'" class="notif-confirm btn btn-icon btn-icon rounded-circle btn-success waves-effect waves-light"><i class="feather icon-send"></i></a> &nbsp;
           <a href="#" id="'.$record->id.'" class="notif-confirm2 btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-light"><i class="feather icon-file-text"></i></a>';

            $data[] = array(
            "no"=>$no++,
            "id"=> $record->id,
            "nama"=>$record->nama,
            "alamat"=> $record->alamat,
            "group"=>$record->group,
            "tagihan"=>$tagihan,
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
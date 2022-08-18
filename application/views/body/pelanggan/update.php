<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="<?= base_url('pelanggan/list') ?>"> <i class="feather icon-arrow-left"></i></a>
                    <h3 class="card-title">Update Pelanggan</h3>
                </div>
                <?php
                    if ($this->session->userdata('msg') == "update") { ?>
                    <script>
                        Swal.fire({
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                    </script>
                <?php }else{ ?>
                    <script>
                        Swal.fire({
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                    </script>  
                <?php } ?>
                <form method="POST" action="<?= base_url('pelanggan/update') ?>">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl">
                                    <div class="divider divider-left divider-primary">
                                        <div class="divider-text">
                                            <h4> Layanan </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="id_update" type="hidden" value="<?= $this->uri->segment(3) ?>">
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Media layanan</span>
                                        <select  name="media" class="select2 form-control">
                                            <option <?= $pelanggan['media'] == 'Wireless' ? 'selected' : '' ?> value="Wireless">Wireless</option>
                                            <option <?= $pelanggan['media'] == 'LAN' ? 'selected' : '' ?> value="LAN">LAN</option>
                                            <option <?= $pelanggan['media'] == 'Fiber Optik' ? 'selected' : '' ?> value="Fiber Optik">Fiber Optik</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Media Kecepatan</span>
                                        <select  name="speed" class="select2 form-control">
                                            <option disabled selected>Pilih Kecepatan</option>
                                            <option <?= $pelanggan['mbps'] == true ? 'selected' : '' ?> value="<?= $pelanggan['id_paket'] ?>"><?= $pelanggan['mbps'] .' Mbps - Rp.' . number_format($pelanggan['harga'],0,'.','.') . ' - '. $pelanggan['paket_internet'] ?></option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4">
                                    <?php 
                                    $idd = $this->uri->segment(3);
                                    $cek =  $this->db->query("SELECT * FROM dt_registrasi as a left join mt_paket as b on(a.speed = b.id_paket) where id='$idd'")->row_array();
                                        if ($cek['mbps'] == false) {
                                            echo '<labe>Status Paket Internet</label> <br>';
                                            echo '<p class="btn btn-danger">tidak ada paket internet</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl">
                                    <div class="divider divider-left divider-primary">
                                        <div class="divider-text">
                                            <h4> Inventory </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Router</span>
                                        <input type="text" value="<?=$pelanggan['router'] ?>"  name="router" class="form-control" placeholder="Router Huawei">
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>CPE</span>
                                        <input type="text" value="<?=$pelanggan['cpe'] ?>"  name="cpe" class="form-control" placeholder="Ubiqity">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl">
                                    <div class="divider divider-left divider-primary">
                                        <div class="divider-text">
                                            <h4> Data Pelanggan </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Nama</span>
                                        <input type="text" value="<?=$pelanggan['nama'] ?>" name="nama" class="form-control" placeholder="asep" >
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-4">
                                    <span>Nomor KTP</span>
                                    <input type="number" value="<?=$pelanggan['ktp'] ?>" name="nomor" class="form-control" placeholder="3175">
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>No NPWP</span>
                                        <input type="number" value="<?=$pelanggan['npwp'] ?>" name="npwp" class="form-control" placeholder="123" >
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Alamat</span>
                                    <select name="alamat" id="" class="select2">
                                        <?php foreach ($mt_alamat as $x) {?> 
                                            <option value="<?= $x->kode_group ?>"><?= $x->kode_group . ' - ' .$x->alamat ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xl-4">
                                    <span>Kontak Handphone / Telp</span>
                                    <input type="number"  name="telp" value="<?=$pelanggan['telp'] ?>" class="form-control" placeholder="081111">
                                </div>
                                <div class="col-xl-4">
                                    <span>Email</span>
                                    <input type="email" name="email" value="<?=$pelanggan['email'] ?>" class="form-control" placeholder="info@gmail.com">
                                </div>
                            </div>
                            <br>
                            
                            <hr class="divider-primary">
                            <div class="row">
                                <div class="col-xl-6">
                                    <h4>Dalam hal ini bertindak untuk dan atas nama : </h4>
                                </div>
                                <div class="col-xl">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-primary">
                                            <input <?= $pelanggan['tindakan'] == 'Pribadi' ? 'checked' : '' ?> type="radio" name="tindakan" value="Pribadi">
                                            <span class="vs-radio vs-radio-lg">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Pribadi</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-xl">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-primary">
                                            <input <?= $pelanggan['tindakan'] == 'Pemberi Kuasa' ? 'checked' : '' ?>  type="radio" name="tindakan" value="Pemberi Kuasa">
                                            <span class="vs-radio vs-radio-lg">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Pemberi Kuasa</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-xl">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-primary">
                                            <input <?= $pelanggan['tindakan'] == 'Perusahaan' ? 'checked' : '' ?> type="radio" name="tindakan" value="Perusahaan">
                                            <span class="vs-radio vs-radio-lg">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Perusahaan</span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!-- <div class="row mt-2">
                                <div class="col-xl-4">
                                    <fieldset>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input  onclick="salindata(this.form)" name="salin_to" type="checkbox">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">Ceklis Jika data pelanggan sama</span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div> -->
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Nama</span>
                                        <input type="text" value="<?=$pelanggan['t_nama'] ?>" name="t_nama" class="form-control" placeholder="asep" >
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-4">
                                    <span>Nomor KTP</span>
                                    <input type="number" value="<?=$pelanggan['t_nomor_ktp'] ?>" name="t_nomor" class="form-control" placeholder="3175">
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>No NPWP</span>
                                        <input type="number" value="<?=$pelanggan['t_npwp'] ?>" name="t_npwp" class="form-control" placeholder="123" >
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Kontak Handphone / Telp</span>
                                    <input type="number" value="<?=$pelanggan['t_telp'] ?>" name="t_telp" class="form-control" placeholder="081111">
                                </div>
                                <div class="col-xl-4">
                                    <span>Email</span>
                                    <input type="email" value="<?=$pelanggan['t_email'] ?>"  name="t_email" class="form-control" placeholder="info@gmail.com">
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-xl">
                                    <div class="divider divider-left divider-primary">
                                        <div class="divider-text">
                                            <h4> Tanggal Registrasi </h4>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Tanggal Installasi</span>
                                    <input type="date" name="tanggal_installasi" class="form-control">
                                </div>
                            </div> -->
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= base_url('pelanggan/list') ?>" class="btn btn-warning">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
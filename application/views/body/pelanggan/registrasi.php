<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
        <?php if ($this->session->userdata('role') == 'Super Admin') {?> 
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registrasi Pelanggan <i class="feather icon-user primary"></i></h4>
                </div>
                <form method="POST" id="form_registrasi">
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
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Media layanan</span>
                                        <select required name="media" class="select2 form-control">
                                            <option disabled selected>Pilih Media Layanan</option>
                                            <option value="Wireless">Wireless</option>
                                            <option value="LAN">LAN</option>
                                            <option value="Fiber Optik">Fiber Optik</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Media Kecepatan</span>
                                        <select required name="speed" class="select2 form-control">
                                            <option disabled selected>Pilih Kecepatan</option>
                                        </select>
                                    </fieldset>
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
                                        <input type="text" required name="router" class="form-control" placeholder="Router Huawei">
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>CPE</span>
                                        <input type="text" required name="cpe" class="form-control" placeholder="Ubiqity">
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
                                        <input type="text" required name="nama" class="form-control" placeholder="asep" >
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-4">
                                    <span>Nomor KTP</span>
                                    <input type="number" required name="nomor" class="form-control" placeholder="3175">
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>No NPWP</span>
                                        <input type="number" required name="npwp" class="form-control" placeholder="123" >
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Group</span>
                                    <select name="group" id="" class="select2">
                                        <?php foreach ($mt_role as $x) {?> 
                                            <option value="<?= $x->group ?>"><?= $x->group ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-xl-4">
                                    <span>Alamat</span>
                                    <input type="text" class="form-control" name="alamat" placeholder="WP123">
                                </div>
                                <div class="col-xl-4">
                                    <span>Kontak Handphone / Telp</span>
                                    <input type="number" required name="telp" class="form-control" placeholder="081111">
                                </div>
                                
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                        <span>Email</span>
                                        <input type="email" name="email" class="form-control" placeholder="info@gmail.com">
                                    </div>
                                <div class="col-xl-4">
                                        <span>Teknisi</span>
                                        <input type="text" name="teknisi" class="form-control" placeholder="asep">
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
                                            <input type="radio" name="tindakan" value="Pribadi">
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
                                            <input type="radio" name="tindakan" value="Pemberi Kuasa">
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
                                            <input type="radio" name="tindakan" value="Perusahaan">
                                            <span class="vs-radio vs-radio-lg">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Perusahaan</span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
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
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Nama</span>
                                        <input type="text" required name="t_nama" class="form-control" placeholder="asep" >
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-4">
                                    <span>Nomor KTP</span>
                                    <input type="number" required name="t_nomor" class="form-control" placeholder="3175">
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>No NPWP</span>
                                        <input type="number" required name="t_npwp" class="form-control" placeholder="123" >
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Kontak Handphone / Telp</span>
                                    <input type="number" required name="t_telp" class="form-control" placeholder="081111">
                                </div>
                                <div class="col-xl-4">
                                    <span>Email</span>
                                    <input type="email" name="t_email" class="form-control" placeholder="info@gmail.com">
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
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Tanggal Installasi</span>
                                    <input type="date" name="tanggal_installasi" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="button" class="btn btn-primary" id="submit_registrasi">Submit</button>
                                    <a href="<?= base_url('pelangga/registrasi') ?>" class="btn btn-warning">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php }else{
            echo "Tidak di izinkan";
        } ?>
        </div>
</section>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
        <?php if ($this->session->userdata('role') == 'Super Admin' || $this->session->userdata('role') == 'Admin') {?> 
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
                                            <option value="Fiber Optik">Fiber Optik</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Media Kecepatan</span>
                                        <select required name="speed" class="select2 form-control">
                                            <option disabled selected>Pilih Kecepatan</option>
                                            <?php $paket = $this->db->get('mt_paket')->result();
                                                foreach ($paket as $x) { ?>
                                                <option value="<?= $x->id_paket ?>"><?= $x->mbps . "Mbps - Rp.". number_format($x->harga,0,'.','.') . ' - ' .$x->paket_internet ?></option>    
                                            <?php } ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <span>Kode Unik</span>
                                                <input type="text" name="kode_unik" required class="form-control">
                                </div>
                            </div>
                                         <div class="row mt-2">
                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Add On 1</span>
                                                        <select required name="addon1" class="select2 form-control">
                                                        <option disabled selected>Pilih Addon 1</option>
                                                        <?php $paket = $this->db->get('addon')->result();
                                                            foreach ($paket as $x) { ?>
                                                                <option value="<?= $x->id ?>">
                                                                    <?=  $x->nama . ' - ' . number_format($x->biaya,0,'.','.') ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </fieldset>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Add On 2</span>
                                                    <select required name="addon2" class="select2 form-control">
                                                    <option disabled selected>Pilih Addon 1</option>
                                                    <?php $paket = $this->db->get('addon')->result();
                                                            foreach ($paket as $x) { ?>
                                                                <option value="<?= $x->id ?>">
                                                                    <?= $x->nama . ' - ' . number_format($x->biaya, 0, '.', '.') ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                    <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                        <span>Add on 3</span>
                                                        <select required name="addon3" class="select2 form-control">
                                                        <option disabled selected>Pilih Addon 1</option>
                                                        <?php $paket = $this->db->get('addon')->result();
                                                                foreach ($paket as $x) { ?>
                                                                    <option value="<?= $x->id ?>">
                                                                        <?= $x->nama . ' - ' . number_format($x->biaya, 0, '.', '.') ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                    </div>
                                                    <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                        <span>Diskon</span>
                                                        <input type="text" name="diskon" class="form-control">
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
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Jatuh Tempo</span>
                                                    <input type="number" name="tempo" class="form-control">
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
                                    <input type="text" class="form-control" name="alamat" placeholder="Wahana Blok F">
                                </div>
                              
                                <div class="col-xl-4">
                                    <span>Kode Pelanggan</span>
                                    <input type="text" class="form-control" name="kode_pelanggan" placeholder="WP123">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                        <span>Email</span>
                                        <input type="email" name="email" class="form-control" placeholder="info@gmail.com">
                                    </div>
                                <div class="col-xl-4">
                                        <span>Teknisi</span>
                                        <select name="teknisi" id="" class="select2 form-control">
                                            <option value="Khaerul Anwar">Khaerul Anwar</option>
                                            <option value="Ipung Iskandar">Ipung Iskandar</option>
                                            <option value="Rizky Wahyu AlFajar">Rizky Wahyu AlFajar</option>
                                            <option value="Agus Hermawan">Agus Hermawan</option>
                                        </select>
                                        <!-- <input type="text" name="teknisi" class="form-control" placeholder="asep"> -->
                                    </div>
                                    <div class="col-xl-4">
                                    <span>Kontak Handphone / Telp</span>
                                    <input type="number" required name="telp" class="form-control" placeholder="081111">
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
                                    <input type="number" required name="t_nomor" minlength="16" class="form-control" placeholder="3175">
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
                                    <span>Tanggal Installasi / Aktif</span>
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
        <?php }else{ ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tidak di izinkan!',
                }).then((result) => {
                if (result.isConfirmed) {
                   // Simulate an HTTP redirect:
                    window.location.replace("https://billing.mediadata.id/dashboard");
                }
                })
            </script>
        <?php } ?>
        </div>
</section>
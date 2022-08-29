<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->userdata('role') == 'Super Admin' || $this->session->userdata('role') == 'Koordinator') {?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Pembayaran <i class="feather icon-user primary"></i></h4>
                    <p>Nomor Struk <span class="btn btn-warning round"><i class="feather icon-file-text"> </i>212131</span></p>
                </div>
                <form method="POST" action="<?= base_url('pelanggan/buat_pembayaran') ?>">
                    <div class="card-content">
                        <div class="card-body">
                <?= $this->session->userdata('msg') ?>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Nama Pelanggan</span>
                                        <select required name="p_client" class="select2 form-control">
                                            <option disabled selected>Pilih nama pelanggan</option>
                                            <?php 
                                            foreach ($client as $x) {?>
                                                <option value="<?= $x->alamat ?>"><?= $x->nama .' - '. $x->alamat ?></option>
                                            <?php } ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <input type="hidden" name="nama">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Paket Internet</span>
                                        <select name="p_paket" id="" class="select2 form-control">
                                            <option value="">Paket</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Tagihan</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            </div>
                                            <input type="text" name="p_tagihan" readonly class="form-control"
                                                placeholder="000.000" aria-describedby="basic-addon1">
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <span>Penerima Pembayaran</span>
                                    <input type="text" class="form-control" name="p_penerima"
                                        value="<?= $this->session->userdata('nama') ?>" readonly>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <span>Bulan</span>
                                    <select name="p_bulan" id="" class="select2 form-control">
                                        <option value="<?= tgl_indo(date('-m-')) ?>"><?= tgl_indo(date('-m-')) ?></option>
                                                <option disabled>Pilih Periode</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                    </select>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <span>Tahun</span>
                                    <select name="p_tahun" id="" class="select2 form-control">
                                        <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                        <option disabled>Pilih Tahun</option>
                                        <option value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
                                        <option value="<?= date('Y')+1 ?>"><?= date('Y')+1 ?></option>
                                        <option value="<?= date('Y')+2 ?>"><?= date('Y')+2 ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <span>Tanggal Pembayaran</span>
                                    <input type="text" readonly name="tgl_pembayaran" value="<?= date('Y-m-d H:i:s') ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
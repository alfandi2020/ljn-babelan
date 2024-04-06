<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Status Pembayaran Pelanggan</h4>
                </div>
                <div class="card-content">
                    <div class="container ml-1">
                        <form action="<?= base_url('pelanggan/sort/bulan') ?>" method="POST">
                            <div class="row">
                                <!-- <div class="col-xl-3 col-sm-5 mt-2">
                                    <h6>Tanggal Jatoh tempo</h6>
                                    <input type="number" required name="tgl_t" min="1" max="31" value="<?= $this->session->userdata('filterTgl_tempo') == false ? 10 : $this->session->userdata('filterTgl_tempo') ?>" onchange="this.form.submit()" class="form-control">
                                </div> -->
                                <div class="col-xl-3 col-sm-5 mt-2">
                                    <h6>Pilih Bulan</h6>
                                    <fieldset>
                                        <select onchange="this.form.submit()" name="bulan" id="" class="form-control">
                                            <option <?= $this->session->userdata('filterBulan') == 'Januari' ? 'selected' : '' ?> value="Januari">Januari</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Februari' ? 'selected' : '' ?> value="Februari">Februari</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Maret' ? 'selected' : '' ?> value="Maret">Maret</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'April' ? 'selected' : '' ?>  value="April">April</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Mei' ? 'selected' : '' ?>  value="Mei">Mei</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Juni' ? 'selected' : '' ?>  value="Juni">Juni</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Juli' ? 'selected' : '' ?>  value="Juli">Juli</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Agustus' ? 'selected' : '' ?>  value="Agustus">Agustus</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'September' ? 'selected' : '' ?>  value="September">September</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Oktober' ? 'selected' : '' ?>  value="Oktober">Oktober</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'November' ? 'selected' : '' ?>  value="November">November</option>
                                            <option <?= $this->session->userdata('filterBulan') == 'Desember' ? 'selected' : '' ?>  value="Desember">Desember</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-3 col-sm-5 mt-2">
                                    <h6>Pilih Tahun</h6>
                                    <fieldset>
                                        <select onchange="this.form.submit()" name="tahun_t" id="" class="form-control">
                                            <option <?= $this->session->userdata('filterTahun') == date('Y')-1 ? 'selected' : '' ?> value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
                                            <option <?= $this->session->userdata('filterTahun') == date('Y') ? 'selected' : '' ?> value="<?= date('Y')?>"><?= date('Y')?></option>
                                            <option <?= $this->session->userdata('filterTahun') == date('Y')+1 ? 'selected' : '' ?> value="<?= date('Y')+1?>"><?= date('Y')+1?></option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table" id="table-status">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="400">Nama</th>
                                        <th width="100">Alamat</th>
                                        <th width="150">Group</th>
                                        <th width="100">Tagihan</th>
                                        <th width="150">Status Pembayaran</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
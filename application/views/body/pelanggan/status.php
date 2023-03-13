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
                                <div class="col-xl-4 col-sm-5 mt-2">
                                    <h6>Pilih Bulan</h6>
                                    <fieldset>
                                        <select onchange="this.form.submit()" name="bulan" id="" class="form-control">
                                            <option <?= $this->session->userdata('filterBulan') == '01' ? 'selected' : '' ?> value="01">Januari</option>
                                            <option <?= $this->session->userdata('filterBulan') == '02' ? 'selected' : '' ?> value="02">Febuari</option>
                                            <option <?= $this->session->userdata('filterBulan') == '03' ? 'selected' : '' ?> value="03">Maret</option>
                                            <option <?= $this->session->userdata('filterBulan') == '04' ? 'selected' : '' ?>  value="04">April</option>
                                            <option <?= $this->session->userdata('filterBulan') == '05' ? 'selected' : '' ?>  value="05">Mei</option>
                                            <option <?= $this->session->userdata('filterBulan') == '06' ? 'selected' : '' ?>  value="06">Juni</option>
                                            <option <?= $this->session->userdata('filterBulan') == '07' ? 'selected' : '' ?>  value="07">Juli</option>
                                            <option <?= $this->session->userdata('filterBulan') == '08' ? 'selected' : '' ?>  value="08">Agustus</option>
                                            <option <?= $this->session->userdata('filterBulan') == '09' ? 'selected' : '' ?>  value="09">September</option>
                                            <option <?= $this->session->userdata('filterBulan') == '10' ? 'selected' : '' ?>  value="10">Oktober</option>
                                            <option <?= $this->session->userdata('filterBulan') == '11' ? 'selected' : '' ?>  value="11">November</option>
                                            <option <?= $this->session->userdata('filterBulan') == '12' ? 'selected' : '' ?>  value="12">Desember</option>
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
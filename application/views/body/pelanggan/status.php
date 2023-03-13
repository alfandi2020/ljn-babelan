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
                        <div class="row">
                            <div class="col-xl-4 col-sm-5">
                                <label>Bulan</label>
                                <fieldset>
                                    <select name="bulan" id="" class="form-control">
                                        <option value="<?= date('m') ?>">Januari</option>
                                        <option value="<?= date('m') ?>">Febuari</option>
                                        <option value="<?= date('m') ?>">Maret</option>
                                        <option value="<?= date('m') ?>">April</option>
                                        <option value="<?= date('m') ?>">Mei</option>
                                        <option value="<?= date('m') ?>">Juni</option>
                                        <option value="<?= date('m') ?>">Juli</option>
                                        <option value="<?= date('m') ?>">Agustus</option>
                                        <option value="<?= date('m') ?>">September</option>
                                        <option value="<?= date('m') ?>">Oktober</option>
                                        <option value="<?= date('m') ?>">November</option>
                                        <option value="<?= date('m') ?>">Desember</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
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
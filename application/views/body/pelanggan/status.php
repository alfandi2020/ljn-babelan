<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Pelanggan</h4>
                </div>
                <!-- <form action="" method="get">
                    <div class="container ml-1">
                        <div class="row">
                            <div class="col-xl-4">
                                <label>Status</label>
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" name="status" <?= $this->input->get('status') == 'Aktif' ? 'checked' : '' ?> value="Aktif" onchange="this.form.submit()">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">Aktif</span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </form> -->
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table" id="table-status">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="400">Nama</th>
                                        <th width="100">Alamat</th>
                                        <th width="150">Group</th>
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
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
                            <table class="table" id="table-pelanggan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="250">Nama</th>
                                        <th width="200">Email</th>
                                        <th width="100">Alamat</th>
                                        <th width="150">Telp</th>
                                        <th width="150">Group</th>
                                        <!-- <th width="150">Off</th> -->
                                        <th width="150">Status</th>
                                        <th width="150">Action</th>
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
<div class="modal fade text-left" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <form method="post" id="user_form" class="form-horizontal form-label-left">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mdl-userModal">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-primary" id="submit_upd_user">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ Zero configuration table -->
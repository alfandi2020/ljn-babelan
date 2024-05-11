<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table
                        <?= $title ?>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addpaket"><i
                                class="feather icon-plus-circle"></i> Tambah Paket</button>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($addon as $x) { ?>
                                        <tr>
                                            <td>
                                                <?= $no++; ?>
                                            </td>
                                            <td>
                                                <?= $x->nama ?>
                                            </td>
                                            <td>
                                                <?= 'Rp.' . number_format($x->biaya, 0, ".", ".") ?>
                                            </td>
                                                  <td>
                                                <?= $x->qty ?>
                                                </td>
                                            <td>
                                                <button id="<?= $x->id ?>" class="btn btn-primary update-addon"> <i
                                                        class="feather icon-edit"></i></button>&nbsp;&nbsp;
                                                <a href="<?= base_url('pelanggan/delete_addon/') . $x->id ?>"
                                                    class="btn btn-danger confirm-delete"> <i
                                                        class="feather icon-trash-2"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade text-left" id="addpaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form method="POST" action="<?= base_url('pelanggan/addon') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Tambah Add on</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl">
                            <span>Nama</span>
                            <fieldset>
                                <div class="input-group">
                                    <input type="text" name="nama"  class="form-control"
                                         aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl">
                            <span>Harga</span>
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" name="harga" id="rupiah" class="form-control"
                                        placeholder="200.000" aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl">
                            <span>Qty</span>
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Qty</span>
                                    </div>
                                    <input type="number" name="qty" class="form-control"
                                        placeholder="1" aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <!-- <div class="row mt-2">
                        <div class="col-xl">
                            <span>Deskripsi</span>
                            <input type="text" class="form-control" placeholder="Internet Up To 10 Mbps" required name="deskripsi">
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade text-left" id="addonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
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
                <div class="modal-body mdl-addonModal">
                    
                </div>
                <div class="modal-footer">
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-primary" id="submit_upd_addon">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
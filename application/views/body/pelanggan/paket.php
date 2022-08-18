<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table <?= $title ?></h4>
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
                                        <th>Kecepatan</th>
                                        <th>Harga</th>
                                        <th>Media</th>
                                        <th>Paket Internet</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($paket as $x) {?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->mbps ." Mbps" ?></td>
                                        <td><?= 'Rp.' . number_format($x->harga,0,".",".") ?></td>
                                        <td><?= $x->media ?></td>
                                        <td><?= $x->paket_internet ?></td>
                                        <td>
                                            <button id="<?= $x->id_paket ?>" class="btn btn-primary update-user"> <i
                                                    class="feather icon-edit"></i></button>&nbsp;&nbsp;
                                            <a href="<?= base_url('paket/delete/').$x->id_paket ?>"
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
        <form method="POST" action="<?= base_url('paket') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Tambah Paket Internet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                            <span>Media</span>
                            <select name="media" id="" class="select2">
                                <option selected disabled>Pilih Media</option>
                                <option value="Fiber Optik">Fiber Optik</option>
                                <option value="Wireless">Wireless</option>
                                <option value="LAN">LAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl">
                            <span>Kecepatan</span>
                            <fieldset>
                                <div class="input-group">
                                    <input type="text" name="kecepatan" class="form-control" placeholder="10"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Mbps</span>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl">
                            <span>Paket Internet</span>
                            <select required name="paket" id="" class="select2">
                                <option selected disabled>Pilih Paket internet</option>
                                <option value="Home">Home</option>
                                <option value="Soho">Soho</option>
                                <option value="Corporate">Corporate</option>
                            </select>
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
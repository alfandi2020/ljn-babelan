<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Group</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                    <?= $this->session->flashdata("msg") ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addalamat"><i
                                class="feather icon-plus-circle"></i> Tambah Group</button>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Deskripsi</th>
                                        <th>Kode Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($alamat as $x) {
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->alamat ?></td>
                                        <td><?= $x->group ?></td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editgroup<?= $x->id_alamat ?>"> <i
                                                    class="feather icon-edit"></i></button>&nbsp;&nbsp;
                                            <a href="<?= base_url('pelanggan/delete_group/').$x->id_alamat ?>"
                                                class="btn btn-danger confirm-delete"> <i
                                                    class="feather icon-trash-2"></i></a>

                                                    <div class="modal fade text-left" id="editgroup<?= $x->id_alamat ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <form method="POST" action="<?= base_url('pelanggan/alamat') ?>">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel1">Tambah Group</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <?php
                                                                            $this->db->where('id_alamat',$x->id_alamat);
                                                                            $get_alamat = $this->db->get('mt_alamat')->row_array();
                                                                    ?>
                                                                    <div class="modal-body">
                                                                        <form action="<?= base_url('pelanggan/alamat') ?>" method="POST">
                                                                        <input type="hidden" name="status" value="update">
                                                                        <input type="hidden" name="id_alamat" value="<?= $x->id_alamat ?>">
                                                                            <div class="row">
                                                                                <div class="col-xl">
                                                                                    <span>Kode GROUP</span>
                                                                                    <fieldset>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text" id="basic-addon1"> <i
                                                                                                        class="feather icon-map-pin"></i> </span>
                                                                                            </div>
                                                                                            <input type="text" name="kode_group" value="<?= $get_alamat['group'] ?>" class="form-control" placeholder="WP02"
                                                                                                aria-describedby="basic-addon1">
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-xl-6">
                                                                                    <span>Deskripsi</span>
                                                                                    <input type="text" class="form-control" value="<?= $get_alamat['alamat'] ?>" placeholder="abc" required name="kode_alamat">
                                                                                </div>

                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <!-- <div class="col-xl">
                                                                                    <span>User Koordinator</span>
                                                                                    <select name="user" id="" class="select2">
                                                                                        <option selected disabled>Pilih User</option>
                                                                                        <?php 
                                                                                        foreach ($alamat as $x) { 
                                                                                            ?>
                                                                                            <option value="<?= $x->id_alamat ?>"><?= $x->nama .' - ' .$x->role?></option>
                                                                                        <?php } ?>

                                                                                    </select>
                                                                                </div> -->
                                                                                <!-- <div class="col-xl">
                                                                                    <span>Alamat</span>
                                                                                    <input type="text" class="form-control" placeholder="Jl.Baru" required name="alamat">
                                                                                </div> -->
                                                                            </div>
                                                                        </form>
                                                                        </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
<div class="modal fade text-left" id="addalamat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form method="POST" action="<?= base_url('pelanggan/alamat') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Tambah Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl">
                            <span>Kode GROUP</span>
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"> <i
                                                class="feather icon-map-pin"></i> </span>
                                    </div>
                                    <input type="text" name="kode_group" class="form-control" placeholder="WP02"
                                        aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl-6">
                            <span>Deskripsi</span>
                            <input type="text" class="form-control" placeholder="abc" required name="kode_alamat">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <!-- <div class="col-xl">
                            <span>User Koordinator</span>
                            <select name="user" id="" class="select2">
                                <option selected disabled>Pilih User</option>
                                <?php 
                                foreach ($alamat as $x) { 
                                    ?>
                                    <option value="<?= $x->id_alamat ?>"><?= $x->nama .' - ' .$x->role?></option>
                                <?php } ?>

                            </select>
                        </div> -->
                        <!-- <div class="col-xl">
                            <span>Alamat</span>
                            <input type="text" class="form-control" placeholder="Jl.Baru" required name="alamat">
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
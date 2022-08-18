<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table <?= $title ?></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addalamat"><i
                                class="feather icon-plus-circle"></i> Tambah Alamat</button>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Alamat</th>
                                        <th>User Koordinator</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($alamat as $x) {
                                        if ($x->role == 2) {
                                            $role = 'Koordinator';
                                        }elseif ($x->role == 3 ) {
                                            $role = 'Sub Koordinator';
                                        }
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->kode_group ?></td>
                                        <td><?php 
                                            echo $x->role;
                                        ?></td>
                                        <td><?= $x->alamat ?></td>
                                        <td>
                                            <button id="<?= $x->id_alamat ?>" class="btn btn-primary update-user"> <i
                                                    class="feather icon-edit"></i></button>&nbsp;&nbsp;
                                            <a href="<?= base_url('paket/delete/').$x->id_alamat ?>"
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
<div class="modal fade text-left" id="addalamat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form method="POST" action="<?= base_url('pelanggan/alamat') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Tambah Alamat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl">
                            <span>Kode alamat</span>
                            <fieldset>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"> <i class="feather icon-map-pin"></i> </span>
                                    </div>
                                    <input type="text" name="kode_group" class="form-control"
                                        placeholder="WP01" aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl">
                            <span>User Koordinator</span>
                            <select name="user" id="" class="select2">
                                <option selected disabled>Pilih User</option>
                                <?php 
                                // $this->db->where('role !=',1);
                                // $db = $this->db->get('mt_alamat')->result();
                                foreach ($alamat as $x) { 
                                    // if ($x->role == '2') {
                                    //     $role = 'Koordinator';
                                    // }elseif ($x->role == 3 ) {
                                    //     $role = 'Sub Koordinator';
                                    // }else{
                                    //     $role = '';
                                    // }
                                    ?>
                                    <option value="<?= $x->id_alamat ?>"><?= $x->nama .' - ' .$x->role?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl">
                            <span>Alamat</span>
                            <input type="text" class="form-control" placeholder="Internet Up To 10 Mbps" required name="alamat">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
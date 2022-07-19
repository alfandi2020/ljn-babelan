<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table user</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th width="230">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($user as $x) {?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->nama ?></td>
                                        <td><?= $x->username ?></td>
                                        <td><?php
                                        if ($x->role == 2) {
                                            $role = 'Koordinator';
                                        }else if($x->role == 3){
                                            $role = 'Sub Koordinator';
                                        }else{
                                            $role = 'Admin';
                                        }
                                        echo $role; ?></td>
                                        <td>
                                            <button id="<?= $x->id ?>" class="btn btn-primary update-user"> <i class="feather icon-edit"></i> Edit</button>&nbsp;&nbsp;
                                            <?php if ($x->role != 1) { ?>
                                            <a href="<?= base_url('user/delete/').$x->id ?>" class="btn btn-danger confirm-delete"> <i class="feather icon-trash-2"></i> Delete</a>
                                            <?php } ?>
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
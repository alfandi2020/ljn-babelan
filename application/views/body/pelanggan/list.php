<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Pelanggan </h4>
                </div>
                    <div class="container ml-1">
                        <div class="row">
                            <div class="col-xl-3">
                                <form action="" method="get">

                                <label>Group <?php 
                                    if (!empty($_GET['group'])) {
                                        $this->session->set_userdata('sort_group',$_GET['group']);
                                    }else{
                                        $this->session->unset_userdata('sort_group');
                                    } ?></label>
                                <select name="group" id="" class="select2 form-control" onchange="this.form.submit()">
                                    <option value="">All Group</option>
                                    <?php 
                                    if ($this->session->userdata('role') != 'Super Admin' && $this->session->userdata('role') != 'Admin') {
                                        $this->db->where_in('group',explode(',',$this->session->userdata('kode_group')));
                                    }
                                    $this->db->group_by('group');
                                    $db = $this->db->get("dt_registrasi")->result();
                                    foreach ($db as $x) {
                                        if ($x->group != "") {
                                                $groupp = $this->session->userdata('sort_group') == '' ? '' : $this->session->userdata('sort_group');
                                        ?>
                                        <option <?= $x->group == $groupp ? 'selected' : '' ?> value="<?= $x->group == empty($this->session->userdata('sort_group')) ? $x->group : $x->group ?>"><?= $x->group == empty($this->session->userdata('sort_group')) ? $x->group : $x->group ?></option>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </select>
                                </form>
                            </div>
                            <div class="col-xl-3">
                                <form action="<?= base_url('pelanggan/sort') ?>" method="POST">

                                <label>Status <?= $this->session->userdata('sort_status') ?> <?php 
                                    // if (!empty($_GET['status'])) {
                                    //     $this->session->set_userdata('sort_status',$_GET['status']);
                                    // }else{
                                    //     $this->session->unset_userdata('sort_status');
                                    // } 
                                    $statuss = $this->session->userdata('sort_status') == false ? '' : $this->session->userdata('sort_status');
                                    ?></label>
                                <select name="status" id="" class="select2 form-control" onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                        <option <?= $statuss == 'Aktif' ? 'selected' : '' ?> value="Aktif">Aktif</option>
                                        <option <?= $statuss == 'Off' ||  $statuss == 'OFF'? 'selected' : '' ?> value="Off">Off</option>
                                        <option <?= $statuss == 'Free' ? 'selected' : '' ?> value="Free">Free</option>
                                </select>
                                </form>
                            </div>
                            <div class="col-xl-4 mt-2">
                                    <a href="<?= base_url('pelanggan/reset_url') ?>" class="btn btn-warning">Reset</a>
                            </div>
                        </div>
                    </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table" id="table-pelanggan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="250">Nama</th>
                                        <th width="250">Kode Pelanggan</th>
                                        <th width="250">Action</th>
                                        <th width="150">Status</th>
                                        <th width="200">Email</th>
                                        <th width="100">Alamat</th>
                                        <th width="150">Telp</th>
                                        <th width="150">Group</th>
                                        <!-- <th width="150">Off</th> -->
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
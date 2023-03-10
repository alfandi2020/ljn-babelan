<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table <?= $title ?></h4>
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
                                        <th>Role</th>
                                        <th width="200">Action</th>
                                        <th width="350">GROUP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $no=1; foreach ($alamat as $x) {
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $x->nama ?></td>
                                        <td><?= $x->username ?></td>
                                        <td><?= $x->role ?></td>
                                        <td>
                                            <form action="<?= base_url('pelanggan/change_role/'.$x->id .' ') ?>" method="POST">
                                            <?php if ($x->role != "Super Admin") { ?>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block mr-2">
                                                    <fieldset>
                                                        <div class="vs-radio-con">
                                                            <input type="radio" name="role[]" onchange="this.form.submit()" <?= $x->role == "Admin" ? 'checked' : '' ?> value="Admin">
                                                            <span class="vs-radio">
                                                                <span class="vs-radio--border"></span>
                                                                <span class="vs-radio--circle"></span>
                                                            </span>
                                                            <span class="">Admin</span>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2">
                                                    <fieldset>
                                                        <div class="vs-radio-con">
                                                            <input type="radio" name="role[]" onchange="this.form.submit()" <?= $x->role == "Koordinator" ? 'checked' : '' ?>  value="Koordinator">
                                                            <span class="vs-radio">
                                                                <span class="vs-radio--border"></span>
                                                                <span class="vs-radio--circle"></span>
                                                            </span>
                                                            <span class="">Koordinator</span>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2">
                                                    <fieldset>
                                                        <div class="vs-radio-con">
                                                            <input type="radio" name="role[]" onchange="this.form.submit()" <?= $x->role == "Sub Koordinator" ? 'checked' : '' ?>  value="Sub Koordinator">
                                                            <span class="vs-radio">
                                                                <span class="vs-radio--border"></span>
                                                                <span class="vs-radio--circle"></span>
                                                            </span>
                                                            <span class="">Sub Koordinator</span>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                            </ul>
                                            <?php } ?>
                                            </form>
                                        </td>
                                        <td>
                                            <?php if ($x->role != "Super Admin") { ?>
                                            <form action="<?= base_url('pelanggan/change_group/'.$x->id .' ') ?>" method="POST">
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <!-- <?= $x->group ?>  -->
                                                    <select name="group[]" multiple="multiple" id="" class="select2 form-control">
                                                       <?php 
                                                            $this->db->where('id',$x->id);
                                                            $user_x = $this->db->get('users')->row_array();

                                                            $group_x = explode(',',$user_x['group']);
                                                            foreach ($group as $e) {
                                                                if (strpos($x->group,$e->group) !== false) {
                                                            ?>
                                                            <option selected  value="<?= $e->group?>"><?= $e->group?></option>
                                                       <?php    }else{ ?>
                                                        <option value="<?= $e->group?>"><?= $e->group ?></option>

                                                     <?php  }
                                                            }
                                                        ?>
                                                     
                                                    </select>
                                                </div>
                                                <div class="col">
                                                <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i></button>
                                                </div>
                                            </div>
                                           
                                            </form>
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
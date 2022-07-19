<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat User </h4>
                </div>
                <form method="POST" id="form-user">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Username</span>
                                        <input type="text" name="username" class="form-control" placeholder="123" required>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Password</span>
                                        <input type="password" name="password" class="form-control" placeholder="***" required>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Password konfirmasi</span>
                                        <input type="password" name="password_conf" class="form-control" placeholder="***" required>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Nama</span>
                                        <input type="text" name="nama" class="form-control" placeholder="asep" required>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <fieldset class="form-group">
                                        <span>Level User</span>
                                        <select required name="role" class="select2 form-control">
                                            <option disabled selected>Pilih Level User</option>
                                            <option value="2">Koordinator</option>
                                            <option value="3">Sub Koordinator</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <span>Date Created</span>
                                        <input type="text" disabled value="<?= date('d-m-Y H:i:s') ?>" class="form-control"
                                            placeholder="***" required>
                                    </fieldset>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xl-4">
                                    <button type="button" id="submit_user" class="btn btn-primary">Submit</button>
                                    <a href="<?= base_url('pelangga/registrasi') ?>" class="btn btn-warning">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
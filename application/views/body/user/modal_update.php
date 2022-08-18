<div class="row">
    <div class="col-xl">
        <span>nama</span>
        <input type="text" required name="nama" value="<?= $user['nama'] ?>" class="form-control">
    </div>
    <div class="col-xl">
        <span>Username</span>
        <input type="text" required name="username" value="<?= $user['username'] ?>" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-xl">
        <span>Password</span>
        <input type="password" required name="password" class="form-control">
    </div>
    <div class="col-xl">
        <span>Password Konfirmasi</span>
        <input type="password" required name="password_konf" class="form-control">
    </div>
</div>
<?php if ($user['role'] != 1) {?>
<div class="row mt-2">
    <div class="col-xl">
        <span>Role</span>
        <select required name="role" class="select2 form-control">
            <option <?= $user['role'] == 'Super Admin' ? 'selected' : '' ?> value="Super Admin" >Super Admin</option>
            <option <?= $user['role'] == 'Admin' ? 'selected' : '' ?> value="Admin" >Admin</option>
            <option <?= $user['role'] == 'Koordinator' ? 'selected' : '' ?> value="Koordinator" >Koordinator</option>
            <option <?= $user['role'] == 'Sub Koordinator' ? 'selected' : '' ?> value="Sub Koordinator">Sub Koordinator</option>
        </select>
    </div>
   
</div>
<?php } ?>
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
            <option <?= $user['role'] == 2 ? 'selected' : '' ?> value="2" >Koordinator</option>
            <option <?= $user['role'] == 3 ? 'selected' : '' ?> value="3">Sub Koordinator</option>
        </select>
    </div>
   
</div>
<?php } ?>
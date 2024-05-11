<div class="row">
    <div class="col-xl">
        <span>Nama</span>
        <fieldset>
            <div class="input-group">
                <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control" aria-describedby="basic-addon1">
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
                <input type="text" name="harga" value="<?= $user['biaya'] ?>" id="rupiah" class="form-control" placeholder="200.000"
                    aria-describedby="basic-addon1">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>" id="id" class="form-control" placeholder="200.000"
                    aria-describedby="basic-addon1">
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
                                    <input type="number" value="<?= $user['qty'] ?>" name="qty" class="form-control"
                                        placeholder="1" aria-describedby="basic-addon1">
                                </div>
                            </fieldset>
                        </div>
</div>
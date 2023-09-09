<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="<?= base_url('pelanggan/list') ?>"> <i class="feather icon-arrow-left"></i></a>
                    <h3 class="card-title">Update Pelanggan</h3>
                </div>
                <?php
                    if ($this->session->flashdata('msg') == "update") { ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text:'Berhasil update client',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                    </script>
                <?php } ?>
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Edit Pelanggan</a>
                            </li>
                                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">History</a>
                            </li>
                        </ul>
                     <div class="tab-content pt-1">
                        <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
                            <form onSubmit="return confirm('Ingin Update Pelanggan <?= $pelanggan['nama'] ?> ? ') " method="POST" action="<?= base_url('pelanggan/update') ?>">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="divider divider-left divider-primary">
                                                    <div class="divider-text">
                                                        <h4> Layanan </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input name="id_update" type="hidden" value="<?= $this->uri->segment(3) ?>">
                                         <?php 
                                        //  $p = $pelanggan['aktif'] .'<br>'; $aktif = new DateTime($pelanggan['aktif']) ;
                                        //    $x = $aktif->diff(new DateTime(date('Y-m-d')));
                                            $p = strtotime($pelanggan['aktif']);
                                            $k = rangeMonths(date('Y',$p),date('n',$p),date('Y'),date('n'));
                                           echo "Pelanggan Aktif : <b>". $pelanggan['aktif'] .'</b>' . "<br>" ;
                                           echo "Lama berlangganan :  <b>". count($k) . ' Bulan </b>';
                                        ?> </b>
                                        <div class="row mt-2">
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Media layanan</span>
                                                    <select  name="media" class="select2 form-control">
                                                        <option <?= $pelanggan['layanan'] == 'Wireless' ? 'selected' : '' ?> value="Wireless">Wireless</option>
                                                        <option <?= $pelanggan['layanan'] == 'LAN' ? 'selected' : '' ?> value="LAN">LAN</option>
                                                        <option <?= $pelanggan['layanan'] == 'Fiber Optik' ? 'selected' : '' ?> value="Fiber Optik">Fiber Optik</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Media Kecepatan</span>
                                                    <select required name="speed_x" class="select2 form-control">
                                                        <option disabled selected>Pilih Kecepatan</option>
                                                        <?php $paket = $this->db->get('mt_paket')->result();
                                                            foreach ($paket as $x) { ?>
                                                            <option <?= $pelanggan['id_paket'] == $x->id_paket ? 'selected' : '' ?> value="<?= $x->id_paket ?>"><?= $x->mbps . "Mbps - Rp.". number_format($x->harga,0,'.','.') . ' - ' .$x->paket_internet ?></option>    
                                                        <?php } ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <span>Kode Unik</span>
                                                <input type="text" name="kode_unik" class="form-control" value="<?= $pelanggan['kode_unik'] ?>">
                                            </div>
                                            <div class="col-xl-4">
                                                <?php 
                                                $idd = $this->uri->segment(3);
                                                $cek =  $this->db->query("SELECT * FROM dt_registrasi as a left join mt_paket as b on(a.speed = b.id_paket) where id='$idd'")->row_array();
                                                    if ($cek['mbps'] == false) { ?>
                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script>
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Oops...',
                                                                text: 'Tidak ada paket internet!',
                                                            })
                                                        </script>
                                                        <!-- echo '<labe>Status Paket Internet</label> <br>';
                                                        echo '<p class="btn btn-danger">tidak ada paket internet</p>'; -->
                                                <?php  } 
                                                ?>
                                            </div>
                                        </div>
                                        <?php if ($pelanggan['status'] == "Off") { ?>

                                        <div class="row mt-2">
                                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <span>Status Pelanggan</span> <br>
                                                        <a href="<?= base_url('pelanggan/aktif/'.$pelanggan['id']) ?>" class="btn btn-success delete-confirm url">Aktifkan</a>
                                                    </fieldset>
                                                </div>
                                        </div>
                                        <?php } ?>

                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="divider divider-left divider-primary">
                                                    <div class="divider-text">
                                                        <h4> Inventory </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>Router</span>
                                                    <input type="text" value="<?=$pelanggan['router'] ?>"  name="router" class="form-control" placeholder="Router Huawei">
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <span>CPE</span>
                                                    <input type="text" value="<?=$pelanggan['cpe'] ?>"  name="cpe" class="form-control" placeholder="Ubiqity">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="divider divider-left divider-primary">
                                                    <div class="divider-text">
                                                        <h4> Data Pelanggan </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <span>Nama</span>
                                                    <input type="text" value="<?=$pelanggan['nama'] ?>" name="nama" class="form-control" placeholder="asep" >
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-xl-4">
                                                <span>Nomor KTP</span>
                                                <input type="number" value="<?=$pelanggan['ktp'] ?>" name="nomor" class="form-control" placeholder="3175">
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <span>No NPWP</span>
                                                    <input type="number" value="<?=$pelanggan['npwp'] ?>" name="npwp" class="form-control" placeholder="123" >
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <span>Group</span>
                                                <select name="group" id="" class="select2">
                                                    <?php if ($pelanggan['group'] != '') {?>
                                                    <!-- <option selected value="<?= $pelanggan['group'] ?>"><?= $pelanggan['group'] ?></option> -->
                                                    <?php } ?>
                                                    <?php foreach ($mt_role as $x) {?> 
                                                        <?php if (strpos($x->group,$pelanggan['group'])!= true) {?>
                                                        <option selected value="<?= $x->group ?>"><?= $x->group ?></option>
                                                        <?php }else{ ?>
                                                            <option selected value="<?= $x->group ?>"><?= $x->group ?></option>
                                                    <?php } 
                                                    }?>
                                                </select>
                                            </div>
                                            <div class="col-xl-4">
                                                <span>Alamat</span>
                                                <input type="text" class="form-control" value="<?= $pelanggan['alamat'] ?>" name="alamat" placeholder="Wahana Blok F">
                                            </div>
                                        
                                            <div class="col-xl-4">
                                                <span>Kode Pelanggan</span>
                                                <input type="text" class="form-control" name="kode_pelanggan" placeholder="WP123" value="<?= $pelanggan['kode_pelanggan'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                        <div class="col-xl-4">
                                                <span>Email</span>
                                                <input type="email" name="email" value="<?=$pelanggan['email'] ?>" class="form-control" placeholder="info@gmail.com">
                                            </div>
                                            <div class="col-xl-4">
                                                    <span>Teknisi</span>
                                                    <select name="teknisi" id="" class="select2 form-control">
                                                        <option <?= $pelanggan['teknisi'] == '' ? 'selected' : '' ?>>Belum Pilih Teknisi</option> -->
                                                        <?php $teknisi = $this->db->get('mt_teknisi')->result(); 
                                                        foreach ($teknisi as $x) { ?>
                                                        <!-- <option selected value="<?= $pelanggan['teknisi'] ?>"><?= $pelanggan['teknisi'] ?></option> -->
                                                            <option <?= $pelanggan['teknisi'] == $x->id_teknisi ? 'selected' : '' ?> value="<?= $x->id_teknisi ?>"><?= $x->nama ?></option>
                                                        <?php } ?>
                                                        <!-- <option value="Ipung Iskandar">Ipung Iskandar</option>
                                                        <option value="Rizky Wahyu AlFajar">Rizky Wahyu AlFajar</option>
                                                        <option value="Agus Hermawan">Agus Hermawan</option> -->
                                                    </select>
                                                    <!-- <input type="text" name="teknisi" value="<?=$pelanggan['teknisi'] ?>" class="form-control" placeholder="asep"> -->
                                                </div>
                                            <div class="col-xl-4">
                                                <span>Kontak Handphone / Telp</span>
                                                <input type="number"  name="telp" value="<?=$pelanggan['telp'] ?>" class="form-control" placeholder="081111">
                                            </div>
                                        </div>
                                        <br>
                                        
                                        <hr class="divider-primary">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <h4>Dalam hal ini bertindak untuk dan atas nama : </h4>
                                            </div>
                                            <div class="col-xl">
                                                <fieldset>
                                                    <div class="vs-radio-con vs-radio-primary">
                                                        <input <?= $pelanggan['tindakan'] == 'Pribadi' ? 'checked' : '' ?> type="radio" name="tindakan" value="Pribadi">
                                                        <span class="vs-radio vs-radio-lg">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="">Pribadi</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl">
                                                <fieldset>
                                                    <div class="vs-radio-con vs-radio-primary">
                                                        <input <?= $pelanggan['tindakan'] == 'Pemberi Kuasa' ? 'checked' : '' ?>  type="radio" name="tindakan" value="Pemberi Kuasa">
                                                        <span class="vs-radio vs-radio-lg">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="">Pemberi Kuasa</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl">
                                                <fieldset>
                                                    <div class="vs-radio-con vs-radio-primary">
                                                        <input <?= $pelanggan['tindakan'] == 'Perusahaan' ? 'checked' : '' ?> type="radio" name="tindakan" value="Perusahaan">
                                                        <span class="vs-radio vs-radio-lg">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="">Perusahaan</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <!-- <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input  onclick="salindata(this.form)" name="salin_to" type="checkbox">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">Ceklis Jika data pelanggan sama</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div> -->
                                        <div class="row mt-2">
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <span>Nama</span>
                                                    <input type="text" value="<?=$pelanggan['t_nama'] ?>" name="t_nama" class="form-control" placeholder="asep" >
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-xl-4">
                                                <span>Nomor KTP</span>
                                                <input type="number" value="<?=$pelanggan['t_nomor_ktp'] ?>" name="t_nomor" class="form-control" placeholder="3175">
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <span>No NPWP</span>
                                                    <input type="number" value="<?=$pelanggan['t_npwp'] ?>" name="t_npwp" class="form-control" placeholder="123" >
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <span>Kontak Handphone / Telp</span>
                                                <input type="number" value="<?=$pelanggan['t_telp'] ?>" name="t_telp" class="form-control" placeholder="081111">
                                            </div>
                                            <div class="col-xl-4">
                                                <span>Email</span>
                                                <input type="email" value="<?=$pelanggan['t_email'] ?>"  name="t_email" class="form-control" placeholder="info@gmail.com">
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-xl">
                                                <div class="divider divider-left divider-primary">
                                                    <div class="divider-text">
                                                        <h4> Tanggal Registrasi </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <span>Tanggal Installasi</span>
                                                <input type="date" name="tanggal_installasi" class="form-control">
                                            </div>
                                        </div> -->
                                        <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <!-- <a href="<?= base_url('pelanggan/list') ?>" class="btn btn-warning">Refresh</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="divider divider-left divider-primary">
                                                    <div class="divider-text">
                                                        <h4> History Non Aktif </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach($history as $x) { ?>
                                            <div class="row mt-2">
                                                <div class="col-xl-4">
                                                    <label for="">Nama</label>
                                                    <input type="text" readonly class="form-control" value="<?= $x->nama ?>">
                                                </div>
                                                <div class="col-xl-4">
                                                    <label for="">Alamat</label>
                                                    <input type="text" readonly class="form-control" value="<?= $x->alamat ?>">
                                                </div>
                                                <div class="col-xl-4">
                                                    <label for="">Tanggal Off</label>
                                                    <input type="text" readonly class="form-control" value="<?= $x->tanggal ?>">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row mt-2">
                                            <div class="col-xl-4">
                                                <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                                                <a href="<?= base_url('pelanggan/list') ?>" class="btn btn-warning">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
</section>
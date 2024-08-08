<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <?php if ($this->session->userdata('role') != 'Pelanggan') { ?>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?= $total['pelanggan'] ?></h2>
                        <p>Total Pelanggan Aktif</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?= $free['pelanggan'] ?></h2>
                        <p>Pelanggan Free</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">
                            <?php
                                $tagihan_masuk = 0;
                                foreach ($payment as $x) {
                                    $tagihan_masuk += $x->tagihan * 11 / 100 + $x->tagihan;
                                    // $tagihan += $x->tagihan;
                                }
                                $belum = 0;
                                foreach ($belum_bayar as $x) {
                                   
                                    $belum += $x->tagihan  ;
                                }
                            // var_dump($total['pelanggan']);
                                echo 'Rp.' . number_format($belum - $tagihan_masuk, 0, '.', '.');
                                ?>
                        </h2>
                        <p>Pembayaran Belum Masuk</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-x-circle text-danger font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
         <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?php
                            $total = 0;
                            $tagihan = 0;
                            foreach ($payment as $x) {
                                $total += $x->tagihan * 11 / 100 + $x->tagihan;
                                // $tagihan += $x->tagihan;
                            }
                            echo 'Rp.' . number_format($total, 0, '.', '.');
                            ?></h2>
                        <p>Pembayaran Sudah Masuk</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0"><?= $semua['pelanggan'] ?></h2>
                        <p>Total</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?= $tidak_aktif['pelanggan'] ?></h2>
                        <p>Pelanggan Tidak Akitf</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0"><?= count($belum_bayar) - count($payment) ?></h2>
                                <p>Pelanggan <b class="text-danger">Belum Bayar</b></p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-danger font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0"><?= count($payment) ?></h2>
                                <p>Pelanggan <b class="text-success">Sudah Bayar</b></p>
                            </div>
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-success font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">
                            <?php
                            
                            // var_dump($total['pelanggan']);
                            $v = json_decode($saldo_xendit);
                            echo 'Rp.' . number_format($v->balance, 0, '.', '.');
                            ?>
                        </h2>
                        <p>Saldo Xendit</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?php
                        // $total = 0;
                        // $tagihan = 0;
                        // foreach ($payment as $x) {
                        //     $total += $x->tagihan * 11 / 100 + $x->tagihan;
                        //     // $tagihan += $x->tagihan;
                        // }
                        echo 'Rp.' . number_format(0, 0, '.', '.');
                        ?></h2>
                        <p>Alfamart</p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card overlay-img-card text-white">
                <img src="<?= base_url() ?>assets/images/bg-lt.jpeg" class="card-img" alt="card-img-6">
                <div class="card-img-overlay overlay-black">
                    <br><br>
                    <h5 class="font-medium-5 text-white text-center mt-4">Date</h5>
                    <p class="text-white text-center"><?= hari_ini() . ', ' . indonesian_date(date('Y-m-d')) ?></p>
                    <div class="card-content">
                        <div class="d-flex justify-content-around mt-2">
                            <div class="icon">
                                <h4 class="text-white font-large-2" id="timestamp"></h4>
                            </div>

                        </div>
                        <!-- <div class="card-body">
                                                <div class="d-flex justify-content-between mt-4">
                                                    <div class="precipitation">
                                                        <span class="font-medium-3">Jakarta</span>
                                                    </div>
                                                    <div class="degree">
                                                        <span class="font-medium-3">48%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between my-2">
                                                    <div class="humidity">
                                                        <span class="font-medium-3">Humidity</span>
                                                    </div>
                                                    <div class="degree">
                                                        <span class="font-medium-3">60%</span>
                                                    </div>
                                                </div>
                                                
                                            </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Total Pemasukan <?= date('Y') ?></h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body pl-1">
                                <div class="height-200">
                                    <div id="line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?> <!-- khusus pelanggan -->
<div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <!-- <p class="text-bold-700 mb-0"><?= $this->session->userdata('nama') ?></p> -->
                    <p class="mt-1">Selamat Datang,<br> <b><?= $this->session->userdata('nama') ?> </b></p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-users text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <!-- <h2 class="text-bold-700 mb-0"><?= $free['pelanggan'] ?></h2> -->
                    <p class="mt-1">Tagihan bulan <br> <b><?=  substr(indonesian_date(date('Y-m-d')),3) ?></b></p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-users text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <!-- <h2 class="text-bold-700 mb-0"><?= $tidak_aktif['pelanggan'] ?></h2>
                    <p>Pelanggan Tidak Akitf</p> -->
                    <p class="mt-1">Status <br> <b>Lunas</b></p>

                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-users text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0"><?= $semua['pelanggan'] ?></h2>
                    <p>Total</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="feather icon-users text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
    <!-- <div class="row match-height">
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">
                                    <h4>Product Orders</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle p-0" type="button" id="dropdownItem2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem2">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="product-order-chart" class="mb-3"></div>
                                        <div class="chart-info d-flex justify-content-between mb-1">
                                            <div class="series-info d-flex align-items-center">
                                                <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                                <span class="text-bold-600 ml-50">Finished</span>
                                            </div>
                                            <div class="product-result">
                                                <span>23043</span>
                                            </div>
                                        </div>
                                        <div class="chart-info d-flex justify-content-between mb-1">
                                            <div class="series-info d-flex align-items-center">
                                                <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                                                <span class="text-bold-600 ml-50">Pending</span>
                                            </div>
                                            <div class="product-result">
                                                <span>14658</span>
                                            </div>
                                        </div>
                                        <div class="chart-info d-flex justify-content-between mb-75">
                                            <div class="series-info d-flex align-items-center">
                                                <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                                                <span class="text-bold-600 ml-50">Rejected</span>
                                            </div>
                                            <div class="product-result">
                                                <span>4758</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Sales Stats</h4>
                                        <p class="text-muted mt-25 mb-0">Last 6 months</p>
                                    </div>
                                    <p class="mb-0"><i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i></p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body px-0">
                                        <div id="sales-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Activity Timeline</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="activity-timeline timeline-left list-unstyled">
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-plus font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Client Meeting</p>
                                                    <span class="font-small-3">Bonbon macaroon jelly beans gummi bears jelly lollipop apple</span>
                                                </div>
                                                <small class="text-muted">25 mins ago</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-warning">
                                                    <i class="feather icon-alert-circle font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Email Newsletter</p>
                                                    <span class="font-small-3">Cupcake gummi bears soufflé caramels candy</span>
                                                </div>
                                                <small class="text-muted">15 days ago</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-danger">
                                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Plan Webinar</p>
                                                    <span class="font-small-3">Candy ice cream cake. Halvah gummi bears</span>
                                                </div>
                                                <small class="text-muted">20 days ago</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-success">
                                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Launch Website</p>
                                                    <span class="font-small-3">Candy ice cream cake. </span>
                                                </div>
                                                <small class="text-muted">25 days ago</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Marketing</p>
                                                    <span class="font-small-3">Candy ice cream. Halvah bears Cupcake gummi bears.</span>
                                                </div>
                                                <small class="text-muted">28 days ago</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
    <!-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Dispatched Orders</h4>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive mt-1">
                                        <table class="table table-hover-animation mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ORDER</th>
                                                    <th>STATUS</th>
                                                    <th>OPERATORS</th>
                                                    <th>LOCATION</th>
                                                    <th>DISTANCE</th>
                                                    <th>START DATE</th>
                                                    <th>EST DEL. DT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#879985</td>
                                                    <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Julee Rossignol" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-10.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Darcey Nooner" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>Anniston, Alabama</td>
                                                    <td>
                                                        <span>130 km</span>
                                                        <div class="progress progress-bar-success mt-1 mb-0">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>14:58 26/07/2018</td>
                                                    <td>28/07/2018</td>
                                                </tr>
                                                <tr>
                                                    <td>#156897</td>
                                                    <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i>Pending</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Trina Lynes" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Lilian Nenez" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-2.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Alberto Glotzbach" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-3.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>Cordova, Alaska</td>
                                                    <td>
                                                        <span>234 km</span>
                                                        <div class="progress progress-bar-warning mt-1 mb-0">
                                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>14:58 26/07/2018</td>
                                                    <td>28/07/2018</td>
                                                </tr>
                                                <tr>
                                                    <td>#568975</td>
                                                    <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Lai Lewandowski" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Darcey Nooner" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Julee Rossignol" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-10.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Jeffrey Gerondale" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>Florence, Alabama</td>
                                                    <td>
                                                        <span>168 km</span>
                                                        <div class="progress progress-bar-success mt-1 mb-0">
                                                            <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>14:58 26/07/2018</td>
                                                    <td>28/07/2018</td>
                                                </tr>
                                                <tr>
                                                    <td>#245689</td>
                                                    <td><i class="fa fa-circle font-small-3 text-danger mr-50"></i>Canceled</td>
                                                    <td class="p-1">
                                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">
                                                                <img class="media-object rounded-circle" src="<?= base_url() ?>assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="30" width="30">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>Clifton, Arizona</td>
                                                    <td>
                                                        <span>125 km</span>
                                                        <div class="progress progress-bar-danger mt-1 mb-0">
                                                            <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>14:58 26/07/2018</td>
                                                    <td>28/07/2018</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
</section>
<!-- Dashboard Analytics end -->
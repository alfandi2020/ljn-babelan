
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url() ?>assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= base_url() ?>assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/extensions/tether.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/vendors/js/extensions/shepherd.min.js"></script> -->
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="<?= base_url() ?>assets/js/core/app-menu.js"></script>
    <script src="<?= base_url() ?>assets/js/core/app.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url() ?>assets/js/scripts/pages/dashboard-analytics.js"></script>
    <!-- END: Page JS-->
    <script src="<?= base_url()?>assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?= base_url()?>assets/js/scripts/forms/select/form-select2.js"></script>

    <script src="<?= base_url() ?>assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts/extensions/sweet-alerts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>

    <script src="<?= base_url() ?>assets/js/scripts/charts/chart-apex.js"></script>

    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts/datatables/datatable.js"></script>
</body>
<!-- END: Body-->
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);
     $('select[name="media"]').change(function() {
        var id = $(this).val();
        $.ajax({
            url: '<?= base_url('pelanggan/paket')?>',//controller
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html='';
                var i;
                html += '<option disabled selected>Pilih Kecepatan</option>'
                for (i = 0; i < data.length; i++) {
                    html +=  '<option value='+ data[i].id_paket+'> '+ data[i].mbps+' Mbps - Rp.'+ formatRupiah(data[i].harga)+ ' - ' + data[i].paket_internet +'</option>';
                    // html2 += '<option>Invoice Kosong </option>';
                }
                $('select[name="speed"]').html(html)
               
            }
        });
    });
     $('select[name="p_client"]').change(function() {
        var id = $(this).val();
        $.ajax({
            url: '<?= base_url('pelanggan/getclient_pembayaran')?>',//controller
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html='';
                var html2='';
                var html3='';
                var i;
                for (i = 0; i < data.length; i++) {
                    html +=  '<option value='+ data[i].id_paket+'> '+ data[i].mbps+' Mbps - Rp.'+ formatRupiah(data[i].harga)+ ' - ' + data[i].paket_internet +'</option>';
                    html2 += data[i].harga;
                    html3 += data[i].nama;
                    // html2 += '<option>Invoice Kosong </option>';
                }
                $('select[name="p_paket"]').html(html)
                $('input[name="p_tagihan"]').val(html2)
                $('input[name="nama"]').val(html3)
               
            }
        });
    });
</script>
</html>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; FanTecno Design By<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a></span>
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
    <script src="<?= base_url() ?>assets/js/scripts/components-tooltips.js"></script>

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
    
    var base_url = '<?=base_url()?>';
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);
    $('select[name="speed"]').attr('disabled',true)

     $('select[name="media"]').change(function() {
        var id = $(this).val();
        $('select[name="speed"]').attr('disabled',false)

        // $.ajax({
        //     url: '<?= base_url('pelanggan/paket')?>',//controller
        //     method: "POST",
        //     data: {
        //         id: id
        //     },
        //     async: true,
        //     dataType: 'json',
        //     success: function(data) {
        //         var html='';
        //         var i;
        //         html += '<option disabled selected>Pilih Kecepatan</option>'
        //         for (i = 0; i < data.length; i++) {
        //             html +=  '<option value='+ data[i].id_paket+'> '+ data[i].mbps+' Mbps - Rp.'+ formatRupiah(data[i].harga)+ ' - ' + data[i].paket_internet +'</option>';
        //             // html2 += '<option>Invoice Kosong </option>';
        //         }
        //         $('select[name="speed"]').html(html)
               
        //     }
        // });
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
                var ppn ='';
                var i;
                for (i = 0; i < data.length; i++) {
                    html =  '<option value='+ data[i].id_paket+'> '+ data[i].mbps+' Mbps - Rp.'+ formatRupiah(data[i].harga)+ ' - ' + data[i].paket_internet +'</option>';
                    ppn = parseInt(data[i].harga * 11 / 100);
                    html2 = parseInt(data[i].harga) + parseInt(ppn);
                    html3 = data[i].nama;
                    // html2 += '<option>Invoice Kosong </option>';
                }
                $('select[name="p_paket"]').html(html).change()
                $('input[name="p_tagihan"]').val(formatRupiah2(html2.toString())).change()
                $('input[name="nama"]').val(html3)
                console.log(html3)
            }
        });
    });
	
    $(document).on('click', '.notif-confirm', function () {
        var linkURL = $(this).attr("href").split('#');
        var id = this.id;
        linkURL =  base_url +"pelanggan/send_notif/" + id;
        $.ajax({
            type :"POST",
            url : "get_pelanggan",
            dataType : 'json',
            data : {id:id},
            success : function(data){
            if (data.telp == "") {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Nomor WhatsApp harus di isi..!',
                  })
            }else{
            var ppn = parseInt(data.harga * 11 / 100);
            var harga = parseInt(data.harga) + parseInt(ppn);
            var	number_string = harga.toString(),
                sisa 	= number_string.length % 3,
                rupiahh 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiahh += separator + ribuan.join('.');
            }
             Swal.fire({
                    title: "Tagihan invoice!",
                    html: '<u><b>'+data.nama+' - Group: '+data.group+'</b></u><br>Jumlah Tagihan : <b><u>Rp.'+rupiahh+'</u></b> <br> Periode : <b><u>'+ "<?= $this->session->userdata('filterBulan') .' ' . $this->session->userdata('filterTahun') ?>" +' </u></b> <br>Apa yakin anda akan mengirim tagihan?',
                    type: "info",
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                    showCancelButton:true,
                    cancelButtonClass: 'btn btn-danger ml-1',
                  }).then(
                        function (isConfirm) {
                            if (isConfirm.value) {
                                Swal.fire(
                                    {
                                        type: "success",
                                        title: 'Berhasil!',
                                        text: 'Tagihan berhasil dikirim',
                                        confirmButtonClass: 'btn btn-success',
                                    })
                                setTimeout(() => {
                                    window.location.href = linkURL;
                                }, 1500);
                            } else {
                                history.replaceState(null, null, ' ');
                                event.preventDefault();
                                return false;
                            }
                        }
                    );
            }
            }
        })
        // Swal.fire({
        //     icon: 'warning',
        //     title: 'Tagihan invoice',
        //     text: "Apa yakin anda akan mengirim tagihan",
        //     showCancelButton: true,
        //     cancelButtonColor: '#d33',
        //     confirmButtonClass: 'btn btn-primary',
        //     cancelButtonClass: 'btn btn-danger ml-1',
        //     confirmButtonText: 'Yes'
        // }).then(
        //     function (isConfirm) {
        //         if (isConfirm.value) {
                    
        //             Swal.fire(
        //                 {
        //                     type: "success",
        //                     title: 'Deleted!',
        //                     text: 'Data berhasil didelete',
        //                     confirmButtonClass: 'btn btn-success',
        //                 })
        //             setTimeout(() => {
        //                 window.location.href = linkURL;
        //             }, 1500);
        //         } else {
        //             history.replaceState(null, null, ' ');
        //             event.preventDefault();
        //             return false;
        //         }
        //     }
        // );
    });
    $(document).on('click', '.notif-confirm2', function () {
        var linkURL = $(this).attr("href").split('#');
        var id = this.id;
        linkURL =  base_url +"pelanggan/send_notif_pdf/" + id;
        $.ajax({
            type :"POST",
            url : "get_pelanggan",
            dataType : 'json',
            data : {id:id},
            success : function(data){
            if (data.telp == "") {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Nomor WhatsApp harus di isi..!',
                  })
            }else{
                var ppn = parseInt(data.harga * 11 / 100);
                var harga = parseInt(data.harga) + parseInt(ppn);
                var	number_string = harga.toString(),
                    sisa 	= number_string.length % 3,
                    rupiahh 	= number_string.substr(0, sisa),
                    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiahh += separator + ribuan.join('.');
                }
             Swal.fire({
                    title: "Tagihan invoice dengan pdf!",
                    html: '<u><b>'+data.nama+' - Group: '+data.group+'</b></u><br>Jumlah Tagihan : <b><u>Rp.'+rupiahh+'</u></b> <br> Periode : <b><u>'+ "<?= $this->session->userdata('filterBulan') .' ' . $this->session->userdata('filterTahun') ?>" +' </u></b> <br>Apa yakin anda akan mengirim tagihan?',
                    type: "info",
                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: false,
                    showCancelButton:true,
                    cancelButtonClass: 'btn btn-danger ml-1',
                  }).then(
                        function (isConfirm) {
                            if (isConfirm.value) {
                                Swal.fire(
                                    {
                                        type: "success",
                                        title: 'Berhasil!',
                                        text: 'Tagihan berhasil dikirim',
                                        confirmButtonClass: 'btn btn-success',
                                    })
                                setTimeout(() => {
                                    window.location.href = linkURL;
                                }, 1500);
                            } else {
                                history.replaceState(null, null, ' ');
                                event.preventDefault();
                                return false;
                            }
                        }
                    );
            }
            }
        })
        // Swal.fire({
        //     icon: 'warning',
        //     title: 'Tagihan invoice',
        //     text: "Apa yakin anda akan mengirim tagihan",
        //     showCancelButton: true,
        //     cancelButtonColor: '#d33',
        //     confirmButtonClass: 'btn btn-primary',
        //     cancelButtonClass: 'btn btn-danger ml-1',
        //     confirmButtonText: 'Yes'
        // }).then(
        //     function (isConfirm) {
        //         if (isConfirm.value) {
                    
        //             Swal.fire(
        //                 {
        //                     type: "success",
        //                     title: 'Deleted!',
        //                     text: 'Data berhasil didelete',
        //                     confirmButtonClass: 'btn btn-success',
        //                 })
        //             setTimeout(() => {
        //                 window.location.href = linkURL;
        //             }, 1500);
        //         } else {
        //             history.replaceState(null, null, ' ');
        //             event.preventDefault();
        //             return false;
        //         }
        //     }
        // );
    });
</script>
</html>
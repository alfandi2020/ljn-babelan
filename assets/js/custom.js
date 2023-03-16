
$(function() {
    $('a').filter(function() {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')
})

// for sidebar menu entirely but not cover treeview
$('ul.navigation .nav-item a').filter(function() {
    return this.href == location.href
}).parent().addClass('active');

// for treeview
$('ul.nav-collapse li a').filter(function() {
    return this.href == location.href
}).parentsUntil(".nav > .nav.nav-collapse li a").addClass('active');

$('div.collapse li a').filter(function() {
    return this.href == location.href
}).parentsUntil(".nav > collapse li a").addClass('show');

$(document).ready(function(){
    // var total = $('#jumlah_user').val();
    // for (let i = total; i < total+1; i++) {
        
    //     $('input[name="role'+i+'"]').change(function() {
    //         var val = $(this)[0].value
    //         $.ajax({
    //             url: 'change_role',//controller
    //             method: "POST",
    //             data: {
    //                 role: val
    //             },
    //             async: true,
    //             dataType: 'json',
    //             success: function(data) {
    //               console.log(data)
                   
    //             }
    //         });
    //     });
    // }
 

    $('#submit_user').click(function(){
        var form = $('#form-user')
        var data  = form.serialize();
        $.ajax({
                type :"POST",
                url : "submit_user",
                dataType : 'json',
                data : data,
                success : function(data){
                if (data.response == "error") {
                    Swal.fire({
                        title: "Opss!",
                        text: data.message,
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                      });
                }else if (data.response == "double") {
                    Swal.fire({
                        title: "Opss!",
                        text: data.message,
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                      });
                }else if (data.response == "success") {
                    Swal.fire({
                        title: 'Berhasil',
                        html: data.message,
                        timer: 2000,
                        // confirmButtonClass: 'btn btn-primary',
                        // buttonsStyling: false,
                        
                        onBeforeOpen: function () {
                          Swal.showLoading()
                          timerInterval = setInterval(function () {
                            Swal.getContent().querySelector('strong')
                              .textContent = Swal.getTimerLeft()
                          }, 100)
                        },
                        onClose: function () {
                          clearInterval(timerInterval)
                        }
                      }).then(function (result) {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location = "";
                            }
                      })
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: data.message,
                    //     showConfirmButton: false,
                    //     timerProgressBar: true,
                    //     timer: 2000,
                    //     didOpen: () => {
                    //         Swal.showLoading()
                    //         const b = Swal.getHtmlContainer().querySelector('b')
                    //         timerInterval = setInterval(() => {
                    //         b.textContent = Swal.getTimerLeft()
                    //         }, 100)
                    //     },
                    //     willClose: () => {
                    //         clearInterval(timerInterval)
                    //     }
                    // }).then((result) => {
                    //     if (result.dismiss === Swal.DismissReason.timer) {
                    //     window.location = "";
                    //     }
                    // })
                }
            }
        })
    });
    $('#submit_pembayaran').click(function(){
        var form = $('#form_pembayaran')
        var data  = form.serialize();
        $.ajax({
                type :"POST",
                url : "buat_pembayaran",
                dataType : 'json',
                data : data,
                success : function(data){
                if (data.response == "error") {
                    Swal.fire({
                        title: "Opss!",
                        text: data.message,
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                      });
                }else if (data.response == "success") {
                    Swal.fire({
                        title: 'Berhasil',
                        html: data.message,
                        timer: 2000,
                        // confirmButtonClass: 'btn btn-primary',
                        // buttonsStyling: false,
                        
                        onBeforeOpen: function () {
                          Swal.showLoading()
                          timerInterval = setInterval(function () {
                            Swal.getContent().querySelector('strong')
                              .textContent = Swal.getTimerLeft()
                          }, 100)
                        },
                        onClose: function () {
                          clearInterval(timerInterval)
                        }
                      }).then(function (result) {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location = "";
                            }
                      })
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: data.message,
                    //     showConfirmButton: false,
                    //     timerProgressBar: true,
                    //     timer: 2000,
                    //     didOpen: () => {
                    //         Swal.showLoading()
                    //         const b = Swal.getHtmlContainer().querySelector('b')
                    //         timerInterval = setInterval(() => {
                    //         b.textContent = Swal.getTimerLeft()
                    //         }, 100)
                    //     },
                    //     willClose: () => {
                    //         clearInterval(timerInterval)
                    //     }
                    // }).then((result) => {
                    //     if (result.dismiss === Swal.DismissReason.timer) {
                    //     window.location = "";
                    //     }
                    // })
                }
            }
        })
    });
    $(document).on('click', '.update-user', function (e) {
        e.preventDefault();
        var id = this.id;
        $('#userModal').modal('show');
        $("#id").val(id);
        $.ajax({
            url: "user/get_user",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function (data) {
                $(".mdl-userModal").html(data).show();

                // if($("#ttd_lhu").val() !== ''){
                //     if(level_user === '1'){
                //         $("#submit_ttd_form").show();
                //     } else {
                //         $("#submit_ttd_form").hide();
                //     }
                // } else {
                //     $("#submit_ttd_form").show();
                // }
               
            }
        });
    });
    $(document).on('click', '#submit_upd_user', function (e) {
        e.preventDefault();
        var form = $('#user_form');
        var datas = form.serialize();
        if (form[0][1].value && form[0][2].value && form[0][3].value && form[0][4].value) {
            $.ajax({
                url: "user/update",
                type: "POST",
                data: datas,
                dataType: "text",
                success: function (data) {
                    // alert(data);

                    console.log(data);
                    if (data == 'Password harus sama') {
                        Swal.fire({
                            type: 'warning',
                            title: data
                        });
                    }else{
                        Swal.fire({
                            type: 'success',
                            title: 'Berhasil',
                            text: data
                        });
                        $('#userModal').modal('toggle');
                    }
                }
            });
        }else{
            Swal.fire({
                type: 'warning',
                title: 'Opss',
                text: 'Form harus di isi'
            });

        }
    });

    $('#submit_registrasi').click(function(){
        var form = $('#form_registrasi')
        var data  = form.serialize();
        var nik = $('input[name="nomor"]').val().length     
        var t_nik = $('input[name="t_nomor"]').val().length     
        if (nik >= 16 && t_nik >= 16) {
        $.ajax({
                type :"POST",
                url : "submit_registrasi",
                dataType : 'json',
                data : data,
                success : function(data){
                    
                    Swal.fire({
                        title: 'Berhasil',
                        html: data,
                        timer: 2000,
                        // confirmButtonClass: 'btn btn-primary',
                        // buttonsStyling: false,
                        
                        onBeforeOpen: function () {
                          Swal.showLoading()
                          timerInterval = setInterval(function () {
                            Swal.getContent().querySelector('strong')
                              .textContent = Swal.getTimerLeft()
                          }, 100)
                        },
                        onClose: function () {
                          clearInterval(timerInterval)
                        }
                      }).then(function (result) {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location = "";
                            }
                      })
                  
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: data.message,
                    //     showConfirmButton: false,
                    //     timerProgressBar: true,
                    //     timer: 2000,
                    //     didOpen: () => {
                    //         Swal.showLoading()
                    //         const b = Swal.getHtmlContainer().querySelector('b')
                    //         timerInterval = setInterval(() => {
                    //         b.textContent = Swal.getTimerLeft()
                    //         }, 100)
                    //     },
                    //     willClose: () => {
                    //         clearInterval(timerInterval)
                    //     }
                    // }).then((result) => {
                    //     if (result.dismiss === Swal.DismissReason.timer) {
                    //     window.location = "";
                    //     }
                    // })
                    console.log(data)
            }
        })
    }else{
        Swal.fire({
            title: 'Opss..',
            icon:'error',
            text: 'Nomor KTP minimal 16',
            timer: 2000,
        })
    }
    });
    // var status = document.getElementById("status").checked
    $('#table-pelanggan').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'order': [2,'desc'],
        'ajax': {
           'url':'getClient',
        //    'data' : {'status' : status}
        },
        'columns': [
            {data: 'no'},
           { data: 'nama' },
           { data: 'kode_pelanggan' },
           { data : 'action'},
           { data: 'status' },
           { data: 'email' },
           { data: 'alamat' },
           { data: 'telp' },
           { data: 'group' }
        //    { data: 'off' },
        //    {
        //       className: 'url',
        //       data: 'id',
        //       render: function(data, type, row) {
        //           if (type === 'display') {
        //               $('.delete-confirm').on('click', function (eventx) {
        //                       eventx.preventDefault();
        //                   //   var id = $(this).attr('val');
        //                   const url = $(this).attr('href');
        //                   swal.fire({
        //                     title: 'Yakin Hapus Pelanggan?',
        //                     text: "Data Akan di delete !",
        //                     icon: 'warning',
        //                     showCancelButton: true,
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonClass: 'btn btn-primary',
        //                     cancelButtonClass: 'btn btn-danger ml-1',
        //                     confirmButtonText: 'Ya, Hapus Data'
                      
        //                   }).then(function(result) {
        //                     if (result.value) {
        //                         Swal.fire(
        //                             {
        //                               type: "success",
        //                               title: 'Deleted!',
        //                               text: 'Data berhasil didelete',
        //                               confirmButtonClass: 'btn btn-success',
        //                             }
        //                           )
        //                         setTimeout(() => {
        //                             document.location.href = url;
        //                         }, 1500);
        //                         // console.log(href);
        //                     }else if (result.dismiss === Swal.DismissReason.cancel) {
        //                         Swal.fire({
        //                           title: 'Cencel',
        //                           text: 'Data cancel di delete',
        //                           type: 'error',
        //                           confirmButtonClass: 'btn btn-success',
        //                         })
        //                       }
        //                   });
        //               });
        //               return '<a target="_blank" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light " href="pdf/' + data + '"><i class="feather icon-eye"></i></a>'+ 
        //               '<a class="btn btn-icon btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light" href="update/' + data + '" class="url"><i class="feather icon-edit"></i></a>'+
        //               '<a href="delete/' + data + '" class="btn btn-icon btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light delete-confirm url"><i class="feather icon-trash-2"></i></a> ';
        //           }
  
        //           return data;
        //       }
        //    }
        ],
        
        "sScrollX": "100%",
        
    });
    
    $(document).on('click', '.del_client', function () {
        var linkURL = $(this).attr("href").split('#');
        var id = this.id;
        linkURL =  base_url +"pelanggan/delete/" + id;
        Swal.fire({
            title: 'Yakin Hapus Pelanggan?',
            text: "Data Akan di delete !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            confirmButtonText: 'Ya, Hapus Data'
        }).then(
            function (isConfirm) {
                if (isConfirm.value) {
                    
                    Swal.fire(
                        {
                            type: "success",
                            title: 'Deleted!',
                            text: 'Data berhasil didelete',
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
    });
    $(document).on('click', '.change_status', function () {
        var linkURL = $(this).attr("href").split('#');
        var id = this.id;
        linkURL =  base_url +"pelanggan/change_status/" + id;
        Swal.fire({
            title: 'Nonaktifkan Pelanggan?',
            text: "Data Akan di Nonaktifkan !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            confirmButtonText: 'Yes'
        }).then(
            function (isConfirm) {
                if (isConfirm.value) {
                    
                    Swal.fire(
                        {
                            type: "success",
                            title: 'Berhasil!',
                            text: 'Data client berhasil dinonaktifkan',
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
    });
    $(document).on('click', '.change_status_aktif', function () {
        var linkURL = $(this).attr("href").split('#');
        var id = this.id;
        linkURL =  base_url +"pelanggan/aktif/" + id;
        Swal.fire({
            title: 'Aktifkan Pelanggan?',
            text: "Data client Akan di aktifkan !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            confirmButtonText: 'Yes'
        }).then(
            function (isConfirm) {
                if (isConfirm.value) {
                    
                    Swal.fire(
                        {
                            type: "success",
                            title: 'Berhasil!',
                            text: 'Data client berhasil aktifkan',
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
             Swal.fire({
                    title: "Tagihan invoice!",
                    html: '<u><b>'+data.nama+' - Group: '+data.group+'</b></u> <br>Apa yakin anda akan mengirim tagihan?',
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
             Swal.fire({
                    title: "Tagihan invoice dengan pdf!",
                    html: '<u><b>'+data.nama+' - Group: '+data.group+'</b></u> <br>Apa yakin anda akan mengirim tagihan?',
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


    $('#table-status').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
           'url':'status_pembayaran',
        //    'data' : {'status' : status}
        },
        'columns': [
            {data: 'no'},
           { data: 'nama' },
           { data: 'alamat' },
           { data: 'group' },
           { data: 'tagihan' },
           { data: 'status' },
        //    {
        //       className: 'url',
        //       data: 'id',
        //       render: function(data, type, row) {
        //           if (type === 'display') {
        //               $('.delete-confirm').on('click', function (eventx) {
        //                       eventx.preventDefault();
        //                   //   var id = $(this).attr('val');
        //                   const url = $(this).attr('href');
        //                   swal.fire({
        //                     title: 'Yakin Hapus Pelanggan?',
        //                     text: "Data Akan di delete !",
        //                     icon: 'warning',
        //                     showCancelButton: true,
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonClass: 'btn btn-primary',
        //                     cancelButtonClass: 'btn btn-danger ml-1',
        //                     confirmButtonText: 'Ya, Hapus Data'
                      
        //                   }).then(function(result) {
        //                     if (result.value) {
        //                         Swal.fire(
        //                             {
        //                               type: "success",
        //                               title: 'Deleted!',
        //                               text: 'Data berhasil didelete',
        //                               confirmButtonClass: 'btn btn-success',
        //                             }
        //                           )
        //                         setTimeout(() => {
        //                             document.location.href = url;
        //                         }, 1500);
        //                         // console.log(href);
        //                     }else if (result.dismiss === Swal.DismissReason.cancel) {
        //                         Swal.fire({
        //                           title: 'Cencel',
        //                           text: 'Data cancel di delete',
        //                           type: 'error',
        //                           confirmButtonClass: 'btn btn-success',
        //                         })
        //                       }
        //                   });
        //               });
        //               return '<a target="_blank" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light " href="pdf/' + data + '"><i class="feather icon-eye"></i></a>'+ 
        //               '<a class="btn btn-icon btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light" href="update/' + data + '" class="url"><i class="feather icon-edit"></i></a>'+
        //               '<a href="delete/' + data + '" class="btn btn-icon btn-icon rounded-circle btn-danger mr-1 mb-1 waves-effect waves-light delete-confirm url"><i class="feather icon-trash-2"></i></a> ';
        //           }
  
        //           return data;
        //       }
        //    }
        ],
        
        // "sScrollX": "100%",
        "responsive": true
        
    });
});
$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    $("#timestamp").load('dashboard/jam');
    // setInterval(function() {
    //     $("#timestamp").load('dashboard/jam').fadeIn("slow");
    // }, 1000);
})
$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    
    const href = $(this).attr('href');
    Swal.fire({
    title: 'Yakin Hapus Data?',
    text: "Data Akan di delete !",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-danger ml-1',
    confirmButtonText: 'Ya, Hapus Data'
    }).then((result) => {
       
    if (result.value) {
        Swal.fire(
            {
              type: "success",
              title: 'Deleted!',
              text: 'Data berhasil didelete',
              confirmButtonClass: 'btn btn-success',
            }
          )
        setTimeout(() => {
            document.location.href = href;
        }, 2000);
    }else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cencel',
          text: 'Data cancel delete',
          type: 'error',
          confirmButtonClass: 'btn btn-success',
        })
      }
    })
});

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("fa-eye-slash");
            $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("fa-eye-slash");
            $('#show_hide_password i').addClass("fa-eye");
        }
    });
// $('input[name="identitas"]').change(function(f) {
//     let selectedValA = $(this).val();
//     let isAChecked = $(this).prop("checked");
//     console.log(selectedValA)
//     $(`.ktp_simChange[value=${selectedValA}]`).prop("checked", isAChecked);
// });
function salindata(f) {
    //kiri data clone
    if (f.salin_to.checked == true) {
        f.t_nama.value = f.nama.value;
        f.t_nomor.value = f.nomor.value;
        f.t_npwp.value = f.npwp.value;
        f.t_telp.value = f.telp.value;
        f.t_email.value = f.email.value;
    } else {
        f.t_nama.value = "";
        f.t_nomor.value = "";
        f.t_telp.value = "";
        f.t_npwp.value = "";
        f.t_email.value = "";
    }
}
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah2(this.value, 'Rp. ');
});

function formatRupiah2(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}




function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
}

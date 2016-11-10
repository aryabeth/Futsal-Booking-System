<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Transaksi Cash Pick Up - Paragon Futsal</title>
</head>
<body>
    <?php include "prenavbar.php"; ?>

    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div id="main_nav" class="right">
                        <ul>
                            <li><a href="home"><i class="fa fa-home">&nbsp;</i>Home</a></li>
                            <li>
                                <a href="" class="menu-top-active"><i class="fa fa-dollar">&nbsp;</i>Transaksi <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="tlapangan">Lapangan</a></li>
                                    <li><a href="tdeposit">Deposit</a></li>
                                    <li><a href="">F&amp;B dan Barang &nbsp;<i class="fa fa-angle-right"></i></a>
                                        <ul>
                                            <li><a href="barangpenjualan">Penjualan</a></li>
                                            <li><a href="barangpembelian">Pembelian</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="parkir">Parkir</a></li>
                                    <li><a href="sewatempat">Sewa Tempat</a></li>
                                    <li><a href="">Cash &nbsp;<i class="fa fa-angle-right" style="float: right;padding-top: 7px;"></i></a>
                                    <ul>
                                        <li><a href="tpickup">Cash Pick Up</a></li>
                                        <li><a href="tinject">Cash Inject</a></li>
                                        <li><a href="tdepositbank">Cash Deposit (Bank)</a></li>
                                    </ul>
                                    </li>
                                    <li><a href="#">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="#">Cashflow Kasir</a></li>
                                    <li><a href="laporancashflowpib">Cashflow Pickup/Inject/Bank</a></li>
                                    <li><a href="#">Lembur</a></li>
                                    <li><a href="#">Stok Barang</a></li>
                                    <li><a href="laporancustomer">Customers</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-database">&nbsp;</i>data <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="databarang">Data F&amp;B dan Barang</a></li>
                                    <li><a href="datauser">Data Account User</a></li>
                                    <li><a href="#">Database Management</a></li>
                                </ul>
                            </li>
                            <li><a href="login/logout"><i class="fa fa-sign-out">&nbsp;</i>LOGOUT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="isi">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Transaksi Cash Pick Up </h4>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" onclick="add_cash_pickup()">Add Cash Pick Up</button>
                        <button class="btn btn-info btn-xs" onclick="print_cash_pickup()" style="display:none;">Print Cash Pick Up</button>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="tabel-cash_pickup">
                        <thead>
                            <tr class="success">
                                <th>#</th>
                                <th>Tanggal / Waktu</th>
                                <th>Nota</th>
                                <th>Nama Pembawa Tunai</th>
                                <th>Jumlah (Rp)</th>
                                <th>Keterangan</th>
                                <th>Operator</th>
                                <th>Override</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>
    <script type="text/javascript">
        var save_method; //for save method string
        var table;

        $(document).ready(function() {

            // datatables
            // refs : https://datatables.net/reference/option/
            table = $('#tabel-cash_pickup').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('tpickup/ajax_list')?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                {
                    // "targets": [ 0,-1 ], //first & last column
                    // "orderable": false, //set not orderable
                }
                ],

                "language" : {
                    "processing" : ""
                }

            });

            //set input/textarea event when change value, remove class error and remove text help block
            $("input").change(function(){
                if (this.getAttribute("name") == "tgl_waktu_changed") {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().next().empty();
                }
                else if (this.getAttribute("name") == "jml" || this.getAttribute("name") == "override") {
                    $(this).parent().parent().parent().removeClass('has-error');
                    console.log($(this).parent().next());
                    $(this).parent().next().empty();
                }
                else {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                }
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });

            // original format
            $('.datepicker').datetimepicker({
                format: 'dd MM yyyy / HH:ii:ss',
                language:  'id',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });

            // format changed, from : dd MM yyyy / HH:ii:ss
            $('.datepicker_changed').change(function() {
                $('[name="id_nota"]').parent().parent().removeClass('has-error');
                $('[name="id_nota"]').next().empty();

                var tmp = $('.datepicker').val();
                tmp = tmp.substr(-15,4) + "-" + convertMonth() + "-" + tmp.substr(0,2) + tmp.substr(-9);

                // error handling
                if ($('.datepicker').val() != "") {
                    $('[name="tgl_waktu"]').val(tmp);
                    set_id_nota(tmp.substr(0,7));
                }
                else {
                    $('[name="tgl_waktu"]').val("");
                }

                function convertMonth() {
                    switch(tmp.slice(3,-16)) {
                        case 'Januari' : return "01";
                        case 'Februari' : return "02";
                        case 'Maret' : return "03";
                        case 'April' : return "04";
                        case 'Mei' : return "05";
                        case 'Juni' : return "06";
                        case 'Juli' : return "07";
                        case 'Agustus' : return "08";
                        case 'September' : return "09";
                        case 'Oktober' : return "10";
                        case 'November' : return "11";
                        case 'Desember' : return "12";
                        default : return "00";
                    }
                }
            });
        });


        function set_id_nota(date) {
            $.ajax({
                url : "<?php echo site_url('tpickup/get_id_nota')?>/" + date,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // console.log(data.result);
                    // if no result found, set id_nota as YYYYMM0001
                    if(data.result == date) {
                        $('[name="id_nota"]').val(date.slice(0,4) + "" + date.slice(-2) + "0001");
                    }
                    // if found, YYYYMMXXXX+1 (increment)
                    else {
                        // get current-picked date
                        var now = $('[name="tgl_waktu"]').val().substr(8,2);

                        // compare with retrieved date
                        if(now >= data.result.tgl_waktu.substr(8,2)) {
                          $('[name="id_nota"]').val(Number(data.result.id_nota)+1);
                        }
                        else {
                          var m = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                          var tmp = data.result.tgl_waktu;
                          var text = tmp.substr(8,2) + " " + m[Number(tmp.substr(5,2))-1] + " " + tmp.substr(0,4);

                          $('[name="id_nota"]').val('');
                          $('[name="tgl_waktu"]').parent().parent().addClass('has-error'); //select parent TWICE to select div form-group class and add has-error class
                          $('[name="tgl_waktu"]').next().text("can not select date before " + text); //select span help-block class set text error string
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function add_cash_pickup()
        {
            save_method = 'add';
            $('#main-form')[0].reset(); // reset form on modals
            $('#main-form .form-group').removeClass('has-error'); // clear error class
            $('#main-form .help-block').empty(); // clear error string

            var today = new Date();
            var date = today.getFullYear() + "-" + ("0" + (Number(today.getMonth()) + 1)).slice(-2);
            set_id_nota(date); // send this YYYY-MM date

            $('#modal-cashpickup').modal('show'); // show bootstrap modal
            $('#modal-cashpickup .modal-title').text('Add Cash Pick Up'); // Set Title to Bootstrap modal title
        }        

        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }

        function save()
        {
            $('#main-form .form-group').removeClass('has-error'); // clear error class
            $('#main-form .help-block').empty(); // clear error string

            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable
            var url;

            if(save_method == 'add') {
                url = "<?php echo site_url('tpickup/ajax_add')?>";
            } else {
                url = "<?php echo site_url('tpickup/ajax_update')?>";
            }

            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#main-form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal-cashpickup').modal('hide');
                        reload_table();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            if (data.inputerror[i] == "jml" || data.inputerror[i] == "override") {
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().parent().addClass('has-error'); //select parent THREE times to select div form-group class and add has-error class
                                $('[name="'+data.inputerror[i]+'"]').parent().next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                            else {
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent TWICE to select div form-group class and add has-error class
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                    }

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding data');
                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable

                }
            });
        }
        

        function reset() {
            $('#main-form')[0].reset();

            $('#main-form .form-group').removeClass('has-error'); // clear error class
            $('#main-form .help-block').empty(); // clear error string
        }



        // OVERRIDE PENGGUNA
        function reset_override() {
            $('#override-form')[0].reset();

            $('#override-form .form-group').removeClass('has-error'); // clear error class
            $('#override-form .help-block').empty(); // clear error string
        }

        function override_pengguna() {
            $('#override-form')[0].reset(); // reset form on modals
            $('#override-form .form-group').removeClass('has-error'); // clear error class
            $('#override-form .help-block').empty(); // clear error string

            $('#modal-override').modal('show'); // show bootstrap modal
            $('#modal-override .modal-title').text('Override Pengguna'); // Set Title to Bootstrap modal title
        }

        function save_override()
        {
            $('#btnSaveOverride').text('Saving...'); //change button text
            $('#btnSaveOverride').attr('disabled',true); //set button disable

            // ajax adding data to database
            $.ajax({
                url : "<?php echo site_url('tpickup/ajax_override_pengguna')?>",
                type: "POST",
                data: $('#override-form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and update input main-form
                    {
                        $('#modal-override').modal('hide');

                        // update input text in main-form
                        $('[name="override_view"]').val('ID: ' + data.user_id + ' (' + data.username + ')');
                        $('[name="override"]').val(data.user_id);

                        $('[name="override_view"]').parent().parent().parent().removeClass('has-error'); // clear error class
                        $('[name="override_view"]').parent().next().empty(); // clear error string                      
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {

                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent TWICE to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }

                    $('#btnSaveOverride').text('Save'); //change button text
                    $('#btnSaveOverride').attr('disabled',false); //set button enable


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error override data');
                    $('#btnSaveOverride').text('Save'); //change button text
                    $('#btnSaveOverride').attr('disabled',false); //set button enable

                }
            });
        }



        // PRINT CASH PICKUP
        function print_cash_pickup() {
            $('#printNote').text(''); // clear note


            // print-tahun
            $('#print-tahun .input').datetimepicker({
                format: 'yyyy', language:  'id_y', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 4, minView: 4
            });
            $('#print-tahun .input').change(function() {
                $('#print-tahun .start').val($('#print-tahun .input').val());
            });

            // print-bulan
            $('#print-bulan .input').datetimepicker({
                format: 'MM yyyy', language:  'id_m', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 3, minView: 3
            });
            $('#print-bulan .input').change(function() {
                var val = $('#print-bulan .input').val();
                var y = val.slice(-4);
                var m = val.slice(0,-5);
                $('#print-bulan .start').val(y + "" + ("0" + (months.indexOf(m) + 1)).slice(-2));
            });

            // print-tahunToTahun
            $('#print-tahunToTahun .input1').datetimepicker({
                format: 'yyyy', language:  'id_y', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 4, minView: 4
            });
            $('#print-tahunToTahun .input1').change(function() {
                $('#print-tahunToTahun .start').val($('#print-tahunToTahun .input1').val());
            });
            $('#print-tahunToTahun .input2').datetimepicker({
                format: 'yyyy', language:  'id_y', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 4, minView: 4
            });
            $('#print-tahunToTahun .input2').change(function() {
                $('#print-tahunToTahun .end').val($('#print-tahunToTahun .input2').val());
            });

            // print-bulanToBulan
            $('#print-bulanToBulan .input1').datetimepicker({
                format: 'MM yyyy', language:  'id_m', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 3, minView: 3
            });
            $('#print-bulanToBulan .input1').change(function() {
                var val = $('#print-bulanToBulan .input1').val();
                var y = val.slice(-4);
                var m = val.slice(0,-5);
                $('#print-bulanToBulan .start').val(y + "" + ("0" + (months.indexOf(m) + 1)).slice(-2));
            });
            $('#print-bulanToBulan .input2').datetimepicker({
                format: 'MM yyyy', language:  'id_m', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 3, minView: 3
            });
            $('#print-bulanToBulan .input2').change(function() {
                var val = $('#print-bulanToBulan .input2').val();
                var y = val.slice(-4);
                var m = val.slice(0,-5);
                $('#print-bulanToBulan .end').val(y + "" + ("0" + (months.indexOf(m) + 1)).slice(-2));
            });

            // print-tglToTgl
            $('#print-tglToTgl .input1').datetimepicker({
                format: 'dd MM yyyy', language:  'id', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 2, minView: 2
            });
            $('#print-tglToTgl .input1').change(function() {
                var val = $('#print-tglToTgl .input1').val();
                var y = val.slice(-4);
                var m = val.slice(3,-5);
                var d = val.slice(0,2);
                $('#print-tglToTgl .start').val(y + "" + ("0" + (months.indexOf(m) + 1)).slice(-2) + d);
            });
            $('#print-tglToTgl .input2').datetimepicker({
                format: 'dd MM yyyy', language:  'id', todayBtn:  1, autoclose: 1, todayHighlight: 1, startView: 2, minView: 2
            });
            $('#print-tglToTgl .input2').change(function() {
                var val = $('#print-tglToTgl .input2').val();
                var y = val.slice(-4);
                var m = val.slice(3,-5);
                var d = val.slice(0,2);
                $('#print-tglToTgl .end').val(y + "" + ("0" + (months.indexOf(m) + 1)).slice(-2) + d);
            });



            $('#modal-print').modal('show'); // show bootstrap modal
            $('#modal-print .print-title').text('Print Cash Pickup'); // Set Title to Bootstrap modal title


            // arr of months
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        }

        function print() {
            $('#btnPrint').text('Saving...'); //change button text
            $('#btnPrint').attr('disabled',true); //set button disable

            var radios = document.getElementsByName("optionsPrint");
            var value, start, end;
            for( i = 0; i < radios.length; i++ ) {
                if( radios[i].checked ) {
                    value = radios[i].value;

                    if(value === "semua") {
                        start = "semua";
                        end = "semua";
                    }
                    else if(value === "tahun") {
                        start = $("#print-tahun .start").val();
                        end = $("#print-tahun .start").val();
                    }
                    else if(value === "bulan") {
                        start = $("#print-bulan .start").val();
                        end = $("#print-bulan .start").val();
                    }
                    else if(value === "tahunToTahun") {
                        start = $("#print-tahunToTahun .start").val();
                        end = $("#print-tahunToTahun .end").val();
                    }
                    else if(value === "bulanToBulan") {
                        start = $("#print-bulanToBulan .start").val();
                        end = $("#print-bulanToBulan .end").val();
                    }
                    else if(value === "tglToTgl") {
                        start = $("#print-tglToTgl .start").val();
                        end = $("#print-tglToTgl .end").val();
                    }

                    break;
                }
            }

            if(start == "" || end == "") {
                start = 'none';
                end = 'none';
            }

            // ajax print
            $.ajax({
                url : "<?php echo site_url('tpickup/ajax_print')?>/" + start + "/" + end,
                type: "POST",
                data: $('#print-form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and update input main-form
                    {
                        $("#printNote").text(data.found + " data found.").css('color','green');
                        // $('#modal-print').modal('hide');

                        // print window
                        window.print();
                    }
                    else
                    {
                        $("#printNote").text(data.error_string).css('color','red');
                    }

                    $('#btnPrint').text('Print'); //change button text
                    $('#btnPrint').attr('disabled',false); //set button enable


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error print data');
                    $('#btnPrint').text('Print'); //change button text
                    $('#btnPrint').attr('disabled',false); //set button enable

                }
            });
        }
    </script>

    <!-- BOOTSTRAP MODAL -->
    <div class="modal fade" id="modal-cashpickup" tabindex="-1" role="dialog" aria-labelledby="modal-cashpickup" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Add Cash Pick Up</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="main-form" class="form-horizontal">
                        <input type="hidden" value="" name="id_pickup"/>

                        <div class="form-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Tanggal / Waktu</label>
                                    <div class="col-md-7">
                                        <input type="text" id="" class="form-control datepicker datepicker_changed" name="tgl_waktu_changed">
                                        <input type="" id="" class="form-control" name="tgl_waktu" style="display: none;">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nota</label>
                                    <div class="col-md-7">
                                        <input type="text" id="" class="form-control" name="id_nota" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nama Pembawa Tunai</label>
                                    <div class="col-md-7">
                                        <input type="text" id="" class="form-control" name="nama" value="<?php echo $this->session->userdata('user_data')['name']; ?>" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Jumlah</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp.</div>
                                            <input type="text" class="form-control" name="jml">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Keterangan</label>
                                    <div class="col-md-7">
                                        <textarea class="form-control" rows="4" name="keterangan" style="resize:none;"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Override Pengguna</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <div class="input-group-addon btn btn-info" onclick="override_pengguna()">
                                                <span class="glyphicon glyphicon-log-in"></span>
                                            </div>
                                            <input type="text" class="form-control" name="override_view" readonly>
                                            <input type="" class="form-control" name="override" style="display: none;">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" onclick="reset()">Reset</button>
                    <button type="button" class="btn btn-success" id="btnSave" onclick="save()">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="modal-override" tabindex="-1" role="dialog" aria-labelledby="modal-override" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Override Pengguna</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="override-form" class="form-horizontal">
                        <input type="hidden" value="" name="user_id"/>

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-2">Username</label>
                                <div class="col-md-10">
                                    <input type="text" id="" class="form-control" name="username" autofocus>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="" class="form-control" name="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" onclick="reset_override()">Reset</button>
                    <button type="button" class="btn btn-success" id="btnSaveOverride" onclick="save_override()">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="modal-print" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Print Cash Pickup</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="print-form" class="form-horizontal">
                        <div class="form-body">

                            <div class="col-md-6">
                                <div class="input-group" id="print-semua">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="semua" checked="">
                                    </span>
                                    <input type="text" class="form-control" placeholder="Semua" readonly>
                                </div><br><!-- /input-group -->
                                <div class="input-group" id="print-tahun">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="tahun">
                                    </span>
                                    <input type="text" class="form-control input" placeholder="Tahun">
                                    <input class="start" style="display: none;">
                                </div><br><!-- /input-group -->
                                <div class="input-group" id="print-bulan">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="bulan">
                                    </span>
                                    <input type="text" class="form-control input" placeholder="Bulan">
                                    <input class="start" style="display: none;">
                                </div><br><!-- /input-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" id="print-tahunToTahun">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="tahunToTahun">
                                    </span>
                                    <input type="text" class="form-control input1" placeholder="Tahun">
                                    <input class="start" style="display: none;">
                                    <span class="input-group-addon">-</span>
                                    <input type="text" class="form-control input2" placeholder="Tahun">
                                    <input class="end" style="display: none;">
                                </div><br><!-- /input-group -->
                                <div class="input-group" id="print-bulanToBulan">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="bulanToBulan">
                                    </span>
                                    <input type="text" class="form-control input1" placeholder="Bulan">
                                    <input class="start" style="display: none;">
                                    <span class="input-group-addon">-</span>
                                    <input type="text" class="form-control input2" placeholder="Bulan">
                                    <input class="end" style="display: none;">
                                </div><br><!-- /input-group -->
                                <div class="input-group" id="print-tglToTgl">
                                    <span class="input-group-addon">
                                        <input type="radio" name="optionsPrint" value="tglToTgl">
                                    </span>
                                    <input type="text" class="form-control input1" placeholder="Tanggal">
                                    <input class="start" style="display: none;">
                                    <span class="input-group-addon">-</span>
                                    <input type="text" class="form-control input2" placeholder="Tanggal">
                                    <input class="end" style="display: none;">
                                </div><!-- /input-group -->
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <span id="printNote">No data found</span>
                    <button type="button" class="btn btn-success" id="btnPrint" onclick="print()">Print</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END BOOTSTRAP MODAL -->
</body>
</html>

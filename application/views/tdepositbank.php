<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Transaksi Cash Deposit (Bank) - Paragon Futsal</title>
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
                    <h4 class="header-line">Transaksi Cash Deposit (Bank) </h4>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" onclick="add_cash_deposit_bank()">Add Cash Deposit (Bank)</button>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="tabel-cash_deposit_bank">
                        <thead>
                            <tr class="success">
                                <th>#</th>  
                                <th>Tanggal / Waktu</th>
                                <th>No. Transaksi</th>
                                <th>Nama Penyetor</th>
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
            table = $('#tabel-cash_deposit_bank').DataTable({
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('tdepositbank/ajax_list')?>",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                {
                    // "targets": [ 0,2,-1 ], //first & last column
                    // "orderable": false, //set not orderable
                }
                ],

                "language" : {
                    "processing" : ""
                },

                // "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
                //     return "Showing " + iStart + " to " + iEnd + " of " + iTotal + " entries";
                // }
        
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
                var tmp = $('.datepicker').val();
                tmp = tmp.substr(-15,4) + "-" + convertMonth() + "-" + tmp.substr(0,2) + tmp.substr(-9);

                // error handling
                if ($('.datepicker').val() != "") {
                    $('[name="tgl_waktu"]').val(tmp);
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

            // set options value
            $.ajax({
                url : "<?php echo site_url('tdepositbank/ajax_get_nama_bank')?>",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for(var i=0; i<data.length; i++) {
                        $('[name="nama_bank"]').append('<option id="opt' + i + '"></option>');
                        $('option#opt' + i).val(data[i]).text(data[i]);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        });
         
         
         
        function add_cash_deposit_bank()
        {
            save_method = 'add';
            $('#main-form')[0].reset(); // reset form on modals
            $('#main-form .form-group').removeClass('has-error'); // clear error class
            $('#main-form .help-block').empty(); // clear error string
            
            $('#modal-cash_deposit_bank').modal('show'); // show bootstrap modal
            $('#modal-cash_deposit_bank .modal-title').text('Add Cash Deposit (Bank)'); // Set Title to Bootstrap modal title
        }
         
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
         
        function save()
        {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable
            var url;
         
            if(save_method == 'add') {
                url = "<?php echo site_url('tdepositbank/ajax_add')?>";
            } else {
                url = "<?php echo site_url('tdepositbank/ajax_update')?>";
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
                        $('#modal-cash_deposit_bank').modal('hide');
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
                    alert('Error adding / update data');
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
                url : "<?php echo site_url('tdepositbank/ajax_override_pengguna')?>",
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
    </script>

    <!-- BOOTSTRAP MODAL -->
    <div class="modal fade" id="modal-cash_deposit_bank" tabindex="-1" role="dialog" aria-labelledby="modal-cash_deposit_bank" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Add Cash Deposit (Bank)</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="main-form" class="form-horizontal">
                        <input type="hidden" value="" name="id_deposit"/>

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
                                    <label class="control-label col-md-5">Nama Bank</label>
                                    <div class="col-md-7">
                                        <select name="nama_bank" id="" class="form-control">
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">No. Transaksi</label>
                                    <div class="col-md-7">
                                        <input type="text" id="" class="form-control" name="no_transaksi">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nama Penyetor</label>
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
    <!-- END BOOTSTRAP MODAL -->
</body>
</html>

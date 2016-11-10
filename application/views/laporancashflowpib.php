<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Laporan Cashflow Pickup / Inject / Deposit (Bank)</title>
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
                                <a href=""><i class="fa fa-dollar">&nbsp;</i>Transaksi <i class="fa fa-angle-down"></i></a>
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
                                <a href="" class="menu-top-active"><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
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
                    <h4 class="header-line">Laporan Cashflow Pickup / Inject / Deposit (Bank)</h4>
                    <div class="tengah form">
                        <div class="form-body">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <label class="control-label">BULAN / TAHUN</label>
                                <div class="form-group">
                                    <input type="text" id="" class="form-control monthyear monthyear_changed" placeholder="month/year">
                                    <input type="" id="" class="form-control" name="monthyear" style="display: none;">
                                    <span class="help-block"></span>
                                </div>    
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">USER</label>
                                <div class="form-group">
                                    <select name="user" id="" class="form-control">
                                            <option value="0">ALL</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>  
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="tabel-laporan_cashflow_pib">
                        <thead>
                            <tr class="success">
                                <th>Tanggal / Waktu</th>
                                <th>Transaksi</th>
                                <th>Keterangan</th>
                                <th>Kredit (Rp)</th>
                                <th>Debet (Rp)</th>
                                <th>Saldo (Rp)</th>
                            </tr>
                            <tr class="info">
                                <th colspan="5" style="text-align:right;">Total Saldo <span id='span-monthyear-before'></span> (Rp) : </th>
                                <th class="warning" style="text-align:center;" id='saldo-before'></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="success">
                                <th colspan="5" style="text-align:right;">Total Saldo <span id="span-monthyear"></span> (Rp) : </th>
                                <th class="danger" style="text-align:center;" id='saldo-now'></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
    
    <?php include "footer.php"; ?>
    <script type="text/javascript">
        $(document).ready(function() {            
            $('.monthyear').datetimepicker({
                format: "MM / yyyy",
                language:  'id_m',
                startView: 3, 
                todayBtn:  1,
                autoclose: 1,
                minView: 3
            });

            // format changed, from : MM yyyy
            $('.monthyear_changed').change(function() {
                var tmp = $('.monthyear').val();
                $('#span-monthyear').html(tmp.replace('\/ ', ''));
                tmp = tmp.substr(-4) + "-" + convertMonth();
                
                // error handling
                if ($('.monthyear').val() != "") {
                    $('[name="monthyear"]').val(tmp);
                }
                else {
                    $('[name="monthyear"]').val("");
                }            

                function convertMonth() {
                    switch(tmp.slice(0,-7)) {
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

            // initialize for the first time load
            var d = new Date();
            var month = new Array();
            month[0] = "Januari";
            month[1] = "Februari";
            month[2] = "Maret";
            month[3] = "April";
            month[4] = "Mei";
            month[5] = "Juni";
            month[6] = "Juli";
            month[7] = "Agustus";
            month[8] = "September";
            month[9] = "Oktober";
            month[10] = "November";
            month[11] = "Desember";
            $('.monthyear').val(month[d.getMonth()]+" / "+d.getFullYear());
            $('#span-monthyear').html($('.monthyear').val().replace('\/ ', ''));

            Date.prototype.yyyymmdd = function() {
                var yyyy = this.getFullYear().toString();
                var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
                var dd  = this.getDate().toString();
                return yyyy + "-" + (mm[1]?mm:"0"+mm[0]);// padding
            };
            $('[name="monthyear"]').val(d.yyyymmdd());




            var table;
            var monthyear = $('[name="monthyear"]').val();
            var user_id = $('[name="user"]').val();

            // datatables
            // refs : https://datatables.net/reference/option/
            table = $('#tabel-laporan_cashflow_pib').DataTable({
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "paging" : false, // disable pagination
                "searching" : false, // disable search feature
                "info": false, // disable info
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('laporancashflowpib/ajax_list/')?>/" + monthyear + "/" + user_id,
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                {
                    "targets": [ 0,1,2,3,4,5 ], //first & last column
                    "orderable": false, //set not orderable
                }
                ],

                "language" : {
                    "processing" : ""
                },    

                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[Rp.]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                  
                    // Total over all pages
                    total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                  
                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        total.formatMoney(0)
                    );
                }
            });



            Number.prototype.formatMoney = function(c, d, t) {
                var n = this, 
                    c = isNaN(c = Math.abs(c)) ? 2 : c, 
                    d = d == undefined ? "," : d, 
                    t = t == undefined ? "." : t, 
                    s = n < 0 ? "-" : "", 
                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
                    j = (j = i.length) > 3 ? j % 3 : 0;
                   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
             };

            $('.monthyear').change(function(){
                //reload datatable ajax
                monthyear = $('[name="monthyear"]').val();
                user_id = $('[name="user"]').val();
                getLastMonthSaldo(monthyear, user_id);
                table.ajax.url( "<?php echo site_url('laporancashflowpib/ajax_list/')?>/" + monthyear + "/" + user_id ).load();
            });

            $('[name="user"]').change(function(){
                //reload datatable ajax
                monthyear = $('[name="monthyear"]').val();
                user_id = $('[name="user"]').val();
                getLastMonthSaldo(monthyear, user_id);
                table.ajax.url( "<?php echo site_url('laporancashflowpib/ajax_list/')?>/" + monthyear + "/" + user_id ).load();
            });


            // set options value
            $.ajax({
                url : "<?php echo site_url('laporancashflowpib/ajax_get_user')?>",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for(var i=0; i<data.length; i++) {
                        $('[name="user"]').append('<option value="' + data[i][0] + '">' + data[i][1] + '</option>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

            // set saldo last month
            monthyear = $('[name="monthyear"]').val();
            user_id = $('[name="user"]').val();
            getLastMonthSaldo(monthyear, user_id);
        });

        function getLastMonthSaldo(my, ui) {
            // change to the last month
            var year    = my.slice(0, 4);
            var tmp     = '0' + (Number(my.slice(-2)) - 1);
            var month   = tmp.slice(-2);
            var last_my = month == 00 ? (year-1) + '-12' : year + '-' + month;

            var arr_month   = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            var text_month  = month == 00 ? arr_month[11] + ' ' + (year-1) : arr_month[Number(month)-1] + ' ' + year;

            $.ajax({
                url : "<?php echo site_url('laporancashflowpib/get_saldo')?>/" + last_my + "/" + ui,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#span-monthyear-before').text(text_month);
                    $('#saldo-before').text(data[0]);

                    var current_month   = $('#saldo-now').text();
                    current_month       = Number(current_month.split('.').join(''));
                    data[0]             = Number(data[0].split('.').join(''));
                    $('#saldo-now').text((current_month + data[0]).formatMoney(0));
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    </script>
</body>
</html>
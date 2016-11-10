<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Laporan Stok Barang - Paragon Futsal</title>
</head>
<body onload="loadLaporan()">
    <?php include "prenavbar.php"; ?>
    </div>
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
                                    <li><a href="">F&B dan Barang &nbsp;<i class="fa fa-angle-right"></i></a>
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
                                    
                                    <li><a href="">Koreksi &nbsp;<i class="fa fa-angle-right" style="float: right;padding-top: 7px;"></i></a>
                                    <ul>
                                        <li><a href="koreksicash">Koreksi Cash</a></li>
                                        <li><a href="koreksibarang">Koreksi Barang</a></li>
                                    </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" class="menu-top-active"><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="#">Cashflow Kasir</a></li>
                                    <li><a href="laporancashflowpib">Cashflow Pickup/Inject/Bank</a></li>
                                    <li><a href="#">Lembur</a></li>
                                    <li><a href="laporanStokBarang">Stok Barang</a></li>
                                    <li><a href="laporancustomer">Customers</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-database">&nbsp;</i>data <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="databarang">Data F&B dan Barang</a></li>
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
            <div class="row">
                <div class="col-md-12">
                    <h4 class="header-line">Laporan Stok Barang </h4>
                </div>
            </div>

            <div class="col-md-1"> <label>Filter : </label></div>

            <div class="col-md-2" style="padding-bottom:20px">
                <div class="input-group">
                    <input type="text" data-date-format="MM yyyy" class="form-control" name="filterbulan" id="filterbulan" data-date-min-view-mode="1" data-provide="datepicker" readonly style="background:white; cursor:pointer" value="<?php echo date("F Y");?>" />
                    <input type="hidden" class="form-control" name="bulan" id="bulan" value="<?php echo date("m");?>" />
                    
                    <div class="input-group-addon btn btn-info" id="btnover" onclick="searchLaporan()">
                        <span class="glyphicon glyphicon-search"></span>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">

                    <table class="table table-striped table-bordered table-hover" id="tabelLaporanBarang">
                        <thead>
                            <tr class="success">
                                <th>#</th>  
                                <th>Tanggal</th>
                                <th>No. Nota</th>
                                <th>Keterangan   </th>
                                <th>Kredit</th>
                                <th>Debet</th>
                                <th>Saldo</th>
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
</body>
</html>

<script type="text/javascript">
    
    function searchLaporan(){
        var tmp = $('#filterbulan').val();
        $('#bulan').val(convertMonth());
        var bulan = convertMonth();
        $('#tabelLaporanBarang tbody').empty();
                    
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>laporanStokBarang/get_laporan/"+bulan,
            success: function (data) {
                console.log(data);
                if (data.length > 0) {

                    var saldo = 0;
                    for (var i = 0; i < data.length; i++) {
                        var kredit = parseInt(data[i]['kredit']) ;
                        var debet = parseInt(data[i]['debet']);
                        saldo = saldo - debet;
                        saldo = saldo + kredit;
                        if (data[i]['debet'] == 0) {
                            $('#tabelLaporanBarang tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['tanggal']+'</td>'+
                                    '<td>'+data[i]['nota']+'</td>'+
                                    '<td>Pembelian ('+data[i]['keterangan']+')</td>'+
                                    '<td>Rp. '+data[i]['debet']+'</td>'+
                                    '<td>Rp. '+data[i]['kredit']+'</td>'+
                                    '<td>Rp. '+saldo+'</td>'+
                                '</tr>'
                            );
                        }else if(data[i]['kredit'] == 0){
                            $('#tabelLaporanBarang tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['tanggal']+'</td>'+
                                    '<td>'+data[i]['nota']+'</td>'+
                                    '<td>Penjualan ('+data[i]['keterangan']+')</td>'+
                                    '<td>Rp. '+data[i]['debet']+'</td>'+
                                    '<td>Rp. '+data[i]['kredit']+'</td>'+
                                    '<td>Rp. '+saldo+'</td>'+
                                '</tr>'
                            );
                        } 
                    };
                    
                }else{
                    $('#tabelLaporanBarang tbody').append(
                        '<tr>'+
                            '<td colspan="7">Tidak ada transaksi pada bulan ini.</td>'+
                        '</tr>'
                    );  
                };
            },
            error: function (data) {
                console.log(data);
            }
        })


        function convertMonth() {
            switch(tmp.substr(0,tmp.length-5)) {
                case 'January' : return "01";
                case 'February' : return "02";
                case 'March' : return "03";
                case 'April' : return "04";
                case 'May' : return "05";
                case 'June' : return "06";
                case 'July' : return "07";
                case 'August' : return "08";
                case 'September' : return "09";
                case 'October' : return "10";
                case 'November' : return "11";
                case 'December' : return "12";
                default : return "00";
            }
        }
    }

    function loadLaporan(){
        // var d = new Date();
        var bulan = $('#bulan').val();
        // if (bulan< 10) {bulan = '0' + bulan;}
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>laporanStokBarang/get_laporan/"+bulan,
            success: function (data) {
                console.log(data);
                if (data.length > 0) {

                    $('#tabelLaporanBarang tbody').empty();
                    var saldo = 0;
                    for (var i = 0; i < data.length; i++) {
                        var kredit = parseInt(data[i]['kredit']) ;
                        var debet = parseInt(data[i]['debet']);
                        saldo = saldo - debet;
                        saldo = saldo + kredit;
                        if (data[i]['debet'] == 0) {
                            $('#tabelLaporanBarang tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['tanggal']+'</td>'+
                                    '<td>'+data[i]['nota']+'</td>'+
                                    '<td>Pembelian ('+data[i]['keterangan']+')</td>'+
                                    '<td>Rp. '+data[i]['debet']+'</td>'+
                                    '<td>Rp. '+data[i]['kredit']+'</td>'+
                                    '<td>Rp. '+saldo+'</td>'+
                                '</tr>'
                            );
                        }else if(data[i]['kredit'] == 0){
                            $('#tabelLaporanBarang tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['tanggal']+'</td>'+
                                    '<td>'+data[i]['nota']+'</td>'+
                                    '<td>Penjualan ('+data[i]['keterangan']+')</td>'+
                                    '<td>Rp. '+data[i]['debet']+'</td>'+
                                    '<td>Rp. '+data[i]['kredit']+'</td>'+
                                    '<td>Rp. '+saldo+'</td>'+
                                '</tr>'
                            );
                        } 
                    };
                    
                };
            },
            error: function (data) {
                console.log(data);
            }
        })
    }

</script>
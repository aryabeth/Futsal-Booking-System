<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>F&B dan Barang Pembelian - Paragon Futsal</title>

</head>
<body>
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
                                <a href="" class="menu-top-active"><i class="fa fa-dollar">&nbsp;</i>Transaksi <i class="fa fa-angle-down"></i></a>
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
                                <a href=""><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
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
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Transaksi FnB : Pembelian </h4>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addpembelian">Add Pembelian FnB</button>
                    </div>

                </div>
            </div>
             
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">

                    <table class="table table-striped data-table table-bordered table-hover" id="tabelPembelian">
                        <thead>
                            <tr class="success">
                                <th>#</th>  
                                <th>Tanggal</th>
                                <th>Nota   </th>
                                <th>Total Jml Item</th>
                                <th>GrossTotal</th>
                                <th>Disc. Total </th>
                                <th>Retur Pembelian</th>
                                <th>Pembayaran</th>
                                <th>Sisa Hutang</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th width="90">Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $jml = 0;
                                $dsc = 0;
                                $tot = 0;
                                $retur = 0;
                                $totbayar = 0;
                                $tothutang =0;
                                $no = 0;
                                foreach($listnota as $barang){
                                    $query = $this->db->query('SELECT SUM(bayar) as pembayaran FROM pembelianbayarnota WHERE nota ='.$barang->nota);
                                    $pembayaran = $query->row_array();
                                    $hutang = $barang->tagihan - $pembayaran['pembayaran'];
                                    
                                    $jml += $barang->jmlitem;
                                    $dsc += $barang->discbelitotal;
                                    $tot += $barang->grosstotal;
                                    $totbayar += $pembayaran['pembayaran'];
                                    $tothutang += $hutang;
                                    $no += 1;
                                    if ($barang->status == 1) {
                                        $status = "Lunas";
                                    }else{
                                        $status = "Belum Lunas";
                                    }
                                    
                                    echo '
                                    <tr><td>'.$no.'</td>
                                    <td>'.convertDate($barang->tanggal).'</td>
                                    <td>'.$barang->nota.'</td>
                                    <td>'.$barang->jmlitem.' pcs</td>
                                    <td>Rp. '.$barang->grosstotal.'</td>
                                    <td>Rp. '.$barang->discbelitotal.'</td>
                                    <td>Rp. 0</td>
                                    <td>Rp. '.number_format($pembayaran['pembayaran']).'</td>
                                    <td>Rp. '.$hutang.'</td>
                                    <td>'.$barang->keterangan.'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <input type="hidden" class="id_nota_detail" value="'.$barang->nota.'">
                                        <button class="btn btn-primary btn-xs view_detail_nota" data-toggle="modal" data-target="#detailsnota"><i class="fa fa-list" data-toggle="tooltip" title="Details"></i></button>
                                        ';
                                        // <button class="btn btn-warning btn-xs view_retur" data-toggle="modal" data-target="#returnota"><i class="fa fa-retweet" data-toggle="tooltip" data-placement="top" title="Retur"></i></button>
                                    // if ($status == "Belum Lunas") {
                                    if (TRUE) {
                                        echo '&nbsp;<button class="btn btn-danger btn-xs bayar_hutang" data-toggle="modal" data-target="#bayarnota"><i class="fa fa-money" data-toggle="tooltip" data-placement="top" title="Bayar"></i></button></td></tr>';
                                    }else{
                                        echo "</td></tr>";
                                    }
                                        
                                }
                                
                                function convertDate($date) {
                                    $year = substr($date, 0, 4);
                                    $month = substr($date, 5, 2);
                                    $day = substr($date, 8, 2);
                                    $time = substr($date, -8);

                                    return $day." ".convertMonth($month)." ".$year." / ".$time;
                                }

                                function convertMonth($m) {
                                    switch($m) {
                                        case '01' : return "Januari";
                                        case '02' : return "Februari";
                                        case '03' : return "Maret";
                                        case '04' : return "April";
                                        case '05' : return "Mei";
                                        case '06' : return "Juni";
                                        case '07' : return "Juli";
                                        case '08' : return "Agustus";
                                        case '09' : return "September";
                                        case '10' : return "Oktober";
                                        case '11' : return "November";
                                        case '12' : return "Desember";
                                        default : return "00";
                                    }
                                }
                            ?> 

                        </tbody>
                        <tfoot>
                            <tr class="success">
                                <td colspan="3" style="text-align:right">TOTAL</td>
                                <td> <?php echo $jml; ?> Pcs</td>
                                <td> Rp. <?php echo number_format($tot); ?></td>
                                <td> Rp. <?php echo number_format($dsc); ?></td>
                                <td> Rp. <?php echo number_format($retur); ?></td>
                                <td> Rp. <?php echo number_format($totbayar); ?></td>
                                <td> Rp. <?php echo number_format($tothutang); ?></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php include "footer.php"; ?>

    <script type="text/javascript">
        // OVERRIDE PENGGUNA
        function cekdebet(){
            var id = $('#notabayar').val();
            var tagihan = $('.tagihan').text(); 
            var hutang = parseInt(tagihan.substr(3,10));
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>barangpembelian/get_hutang_nota/"+id,
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            hutang -= data[i]['bayar'];
                        };

                        if ($('#debet').val() > hutang ) {
                            // alert('Range pemayaran harus Rp > 0 dan Rp < '+hutang);
                            $('#debet').val(hutang);
                        }else if ($('#debet').val() < 0) {
                            $('#debet').val('');
                        }
                       
                    };
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }

        function deleteRow(row){
            var i=row.parentNode.parentNode.rowIndex;
            document.getElementById('tabeltemp').deleteRow(i);
        }

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
            // ajax adding data to database
            $.ajax({
                url : "<?php echo site_url('barangpembelian/ajax_override_pengguna')?>",
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
                        $('[name="override"]').val(data.username);
            
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent TWICE to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
         
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

    <!-- modal -->
    <div class="modal fade" id="addpembelian" tabindex="-1" role="dialog" aria-labelledby="addtrans" aria-hidden="true">
        <div class="modal-dialog" style="width:1000px;">
            <div class="modal-content">
                <form action="barangpembelian/submitpembelian" method="post" id="main-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title tengah">Add Nota Pembelian FnB</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label class="control-label col-md-5">Nota Pembelian</label>
                                <div class="col-md-5">
                                    <input type="hidden" id="operator" name="operator" value="<?php echo $this->session->userdata('user_data')['username'];?>">
                                    <input type="text" id="nota_pembelian" readonly class="form-control" name="nota_pembelian" required>
                                </div>
                                <input type="checkbox" id="tunai" name="tunai" checked>Tunai</input>
                                <input type="hidden" id="tunai-id" name="tunai-id" value="1">
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Keterangan</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="2"></textarea>
                                </div> 
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5" style="text-align:right;">Tanggal</label>
                                <div class="col-md-7">
                                    <!-- <input type="text" id="tanggal" class="form-control datepicker datepicker_changed" name="tgl_waktu_changed">
                                    <input type="" id="tgl_waktu" class="form-control" name="tgl_waktu" style="display: none;"> -->
                                    <input type="text" class="form-control" value="<?php echo date("d M Y / H:i:s"); ?>" readonly>
                                    <input type="hidden" id="" class="form-control" name="tgl_waktu" value="<?php echo date("Y-m-d H:i:s");?>">

                                </div>
                            </div><br>

                            <div class="form-group">
                                <label class="control-label col-md-5" style="text-align:right;">Override Pengguna</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-addon btn btn-info" id="btnover" onclick="override_pengguna()">
                                            <span class="glyphicon glyphicon-log-in"></span>
                                        </div>
                                        <input type="text" class="form-control" id="override_view" name="override_view" readonly>
                                        <input type="" class="form-control" id="override" name="override" required style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="tabeltemp" style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Jumlah</th>
                                        <th>Disc Beli</th>
                                        <th>Sub Total</th>
                                        <th>Act</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <tr>
                                            <td>
                                                <input type="hidden" id="operator_id" name="operator_id" value="<?php echo $this->session->userdata('user_data')['user_id'];?>">
                                                <input type="text" class="form-control" id="kode" name="kode" style="width: 80px;"></input>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="" name="namaBarang" id="namaBarang">
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 130px">
                                                    <div class="input-group-addon">Rp. </div>
                                                    <input type="number" class="form-control" name="harga" id="harga">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 120px">
                                                    <input type="number" class="form-control" name="jumlah" id="jumlah">
                                                    <div class="input-group-addon">Pcs</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 130px">
                                                    <div class="input-group-addon">Rp. </div>
                                                    <input type="number" class="form-control" id="disc" name="disc">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 130px">
                                                    <div class="input-group-addon">Rp. </div>
                                                    <input type="text" class="form-control" value="" readonly id="subTot" name="subTot">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-xs" id="addTemp" name="addTemp" type="button" data-toggle="tooltip" data-placement="top" title="Tambah"> <i class="fa fa-plus-square"></i></button> 
                                            </td>
                                        </tr>
                                    </form>
                                    <div>
                                        <?php
                                            $jml = 0;
                                            $dsc = 0;
                                            $tot = 0;
                                            foreach($listtemp as $barang){
                                                $jml += $barang->jumlah;
                                                $dsc += $barang->disc;
                                                $tot += $barang->subtotal;
                                                echo '
                                                <tr>
                                                    <td class="id_edit" style="display:none;">'.$barang->id.'</td>
                                                    <td>'.$barang->kode.'</td>
                                                    <td>'.$barang->nama.'</td>
                                                    <td>Rp. '.$barang->hargabeli.'</td>
                                                    <td>'.$barang->jumlah.'</td>
                                                    <td>Rp. '.$barang->disc.'</td>
                                                    <td>Rp. '.$barang->subtotal.'</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xs hapus"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></button>
                                                    </td>
                                                </tr>';
                                            }
                                        ?>    
                                    </div>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align:right">TOTAL</td>
                                        <td> <input type="text" class="form-control" readonly style="width:80px;" name="totJumlah" id="totJumlah" value="<?php echo $jml; ?>"> </td>
                                        <td><div class="input-group" style="width: 130px">
                                                <div class="input-group-addon">Rp. </div>
                                                <input type="text" readonly class="form-control" name="totDisc" id="totDisc" value="<?php echo $dsc; ?>">
                                            </div>
                                        </td>
                                        <td><div class="input-group" style="width: 130px">
                                                <div class="input-group-addon">Rp. </div>
                                                <input type="text" readonly class="form-control" style="width:80px;" name="subTotal" id="subTotal" value="<?php echo $tot; ?>">
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="resetTemp" name="resetTemp" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-success" id="sumbitPembelian" name="sumbitPembelian">Add Nota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsnota" tabindex="-1" role="dialog" aria-labelledby="addtrans" aria-hidden="true">
        <div class="modal-dialog" style="width:800px;">
            <div class="modal-content">
                <form action="#" id="main-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title tengah">Details Nota Pembelian FnB</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <span style="font-size:13pt;font-weight:bold">Nomor Nota Pembelian : <span class="nota_det"></span> </span><br>
                            <span style="font-size:11pt;">Operator : <span id="oper"></span></span>
                            <table class="table table-striped table-bordered table-hover" id="tabelDetNota" style="margin-top: 20px;">
                                <thead>
                                    <tr class="success">
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Jumlah</th>
                                        <th>Disc Beli</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bayarnota" tabindex="-1" role="dialog" aria-labelledby="addtrans" aria-hidden="true">
        <div class="modal-dialog" style="width:1200px;">
            <div class="modal-content">
                <form action="<?php echo site_url('barangpembelian/bayarhutang'); ?>" method="post" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title tengah">Pembayaran Nota Pembelian FnB</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div style="font-size:13pt;font-weight:bold" class="col-md-6">Nomor Nota Pembelian : <span class="nota_det"></span> </div>
                            <label class="control-label col-md-3" style="text-align:right;">Override Pengguna</label>
                            <div class="input-group col-md-3">
                                <div class="input-group-addon btn btn-info" id="btnover" onclick="override_pengguna()">
                                    <span class="glyphicon glyphicon-log-in"></span>
                                </div>
                                <input type="hidden" name="notabayar" id="notabayar" value="">
                                <input type="text" class="form-control" id="override_view" name="override_view" readonly>
                                <input type="hidden" class="form-control" id="override" name="override" required>
                                <input type="hidden" id="operator" name="operator" value="<?php echo $this->session->userdata('user_data')['username'];?>">
                                                
                            </div>
                            
                            <table class="table table-striped table-bordered table-hover" id="tabelBayar" style="margin-top: 20px;">
                                <thead>
                                    <tr class="success">
                                        <th>#</th>
                                        <th>Tanggal/Waktu</th>
                                        <th>Nota Pembayaran</th>
                                        <th>Kredit</th>
                                        <th>Debet</th>
                                        <th>Saldo Hutang</th>
                                        <th colspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td><span id="tgl_bayar"></span></td>
                                        <td>Tagihan Awal</td>
                                        <td><span class="tagihan"></span></td>
                                        <td>-</td>
                                        <td><span class="tagihan"></span></td>
                                        <td><span id="keter"></span></td>
                                    </tr>
                                </thead>
                                <tbody id="bayar">

                                </tbody>
                                <tfoot>
                                    <tr class="warning">
                                        <td>*</td>
                                        <td width="200">
                                            <input type="text" class="form-control" value="<?php echo date("d M Y / H:i:s"); ?>" readonly>
                                            <input type="hidden" id="tgl_waktu" class="form-control" name="tgl_waktu" value="<?php echo date("Y-m-d H:i:s");?>">
                                        </td>
                                        <td width="150"> BYR-<span class="nota_det"></span></td>
                                        <td width="150"></td>
                                        <td width="180"> 
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp. </div>
                                                <input type="number" name="debet" id="debet" class="form-control" placeholder="0" onkeyup="cekdebet()"> 
                                            </div>
                                        </td>
                                        <td></td>
                                        <td width="180"> <input type="text" id="ketbayar" name="ketbayar" class="form-control" placeholder="..."> </td>
                                        
                                    </tr>
                                </tfoot>
                                
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn" id="submitbayar" name="submitbayar">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="returnota" tabindex="-1" role="dialog" aria-labelledby="addtrans" aria-hidden="true">
        <div class="modal-dialog" style="width:900px;">
            <div class="modal-content">
                <form action="#" id="main-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title tengah">Retur Nota Pembelian FnB</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nota Retur </label>
                                    <div class="col-md-7">
                                        <input type="text" id="nota_retur" value="" class="form-control" readonly name="nota_retur">
                                    </div>
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Tanggal Retur </label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" value="<?php echo date("d M Y / H:i:s"); ?>" readonly>
                                        <input type="hidden" id="" class="form-control" name="tgl_waktu" value="<?php echo date("Y-m-d H:i:s");?>">
                                    </div>
                                </div><br>
                            </div>
                            <div class="col-md-6"> 
                                <label class="control-label col-md-6" style="text-align:right;">Override Pengguna</label>
                                <div class="input-group col-md-6">
                                    <div class="input-group-addon btn btn-info" id="btnover" onclick="override_pengguna()">
                                        <span class="glyphicon glyphicon-log-in"></span>
                                    </div>
                                    <input type="hidden" name="notabayar" id="notabayar" value="">
                                    <input type="text" class="form-control" id="override_view" name="override_view" readonly>
                                    <input type="hidden" class="form-control" id="override" name="override" required>
                                    <input type="hidden" id="operator" name="operator" value="<?php echo $this->session->userdata('user_data')['username'];?>">
                                                    
                                </div>
                                
                            </div>
                        </div><br>
                        <table class="table table-striped table-bordered table-hover" id="tabelRet" style="margin-top: 20px;">
                            <thead>
                                <tr class="success">
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-override" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="width: 400px;">
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
                                <label class="control-label col-md-4">Username</label>
                                <div class="col-md-6">
                                    <input type="text" id="un" class="form-control" name="username">
                                    <!-- </span class="help-block"></span> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Password</label>
                                <div class="col-md-6">
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

    <!-- open modal after submit temp -->
    <?php
        error_reporting(0);
        if($_GET['openmodal'] == 1){ ?>
            <script>
                $(function(){
                    $('#addpembelian').modal('show');
                });
            </script>
    <?php         
        }
    ?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        window.history.pushState(null, null, '<?php echo base_url()?>barangpembelian');

        var nota = '<?php echo $id_nota;?>';
        $("#nota_pembelian").val(nota);

        $('#jumlah').keyup(function(){
            var subtotal = $('#harga').val() * $('#jumlah').val();
            $("#subTot").val(subtotal);
        });

        $('#harga').keyup(function(){
            var subtotal = $('#harga').val() * $('#jumlah').val();
            $("#subTot").val(subtotal);
        });

        $('#disc').keyup(function(){
            var temp = $('#harga').val() * $('#jumlah').val();
            var subtotal = temp - $('#disc').val();
            $("#subTot").val(subtotal);
        });

        //view detail nota 
        $('#tabelPembelian tbody').on('click', 'tr td button.view_detail_nota',function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('td .id_nota_detail').val();
            $('.nota_det').text(id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>barangpembelian/get_nota_details/"+id,
                success: function (data) {
                    console.log(data);
                    $('#oper').text(data[0]['operator_id']);
                    if (data.length > 0) {

                        var jum = 0; 
                        var disc = 0;
                        var total = 0;
                        $('#tabelDetNota tbody').empty();
                        $('#tabelDetNota tfoot').empty();
                        for (var i = 0; i < data.length; i++) {
                            jum += parseInt(data[i]['jumlah']);
                            disc += parseInt(data[i]['disc']);
                            total += parseInt(data[i]['subtotal']);
                            $('#tabelDetNota tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['kode']+'</td>'+
                                    '<td>'+data[i]['nama']+'</td>'+
                                    '<td>'+currencyFormat(data[i]['hargabeli'])+'</td>'+
                                    '<td>'+data[i]['jumlah']+' pcs</td>'+
                                    '<td>'+currencyFormat(data[i]['disc'])+'</td>'+
                                    '<td>'+currencyFormat(data[i]['subtotal'])+'</td>'+
                                '</tr>'
                            );
                        };
                        $('#tabelDetNota tfoot').append(
                            '<tr class="success">'+
                                '<td colspan="4" style="text-align:right">TOTAL</td>'+
                                '<td>'+jum+' pcs</td>'+
                                '<td>'+currencyFormat(disc)+'</td>'+
                                '<td>'+currencyFormat(total)+'</td>'+
                            '</tr>'
                        );
                    };
                },
                error: function (data) {
                    console.log(data);
                }
            })
        })

        //view detail retur
        $('#tabelPembelian tbody').on('click', 'tr td button.view_retur',function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('td .id_nota_detail').val();
            $('.nota_det').text(id);
            $('#nota_retur').val("RTR-"+id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>barangpembelian/get_nota_details/"+id,
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        $('#tabelRet tbody').empty();
                        $('#tabelRet tfoot').empty();
                        for (var i = 0; i < data.length; i++) {
                            
                            $('#tabelRet tbody').append(
                                '<tr>'+
                                    '<td>'+(Number(i+1))+'</td>'+
                                    '<td>'+data[i]['kode']+'</td>'+
                                    '<td>'+data[i]['nama']+'</td>'+
                                    '<td><span id="harga'+i+'">'+data[i]['hargabeli']+'</span></td>'+
                                    '<td width="100"><input type="number" id="jumret'+i+'" placeholder="0" class="form-control" style="width:100%;"></td>'+
                                    '<td>Rp. <span id="totret'+i+'">0</span></td>'+
                                '</tr>'
                            );
                        };
                        $('#tabelRet tfoot').append(
                            '<tr class="success">'+
                                '<td colspan="4" style="text-align:right">TOTAL</td>'+
                                '<td><span id="totJumRet"></span> pcs</td>'+
                                '<td>Rp. <span id="totRet"></span></td>'+
                            '</tr>'
                        ); 
                    };
                },
                error: function (data) {
                    console.log(data);
                }
            })

        })    

        //modal bayar
        $('#tabelPembelian tbody').on('click', 'tr td button.bayar_hutang',function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('td .id_nota_detail').val();
            var tanggal = $(this).closest('tr').find('td').eq(1).text();
            var tagihan = $(this).closest('tr').find('td').eq(4).text();
            var keterangan = $(this).closest('tr').find('td').eq(9).text();
            var hutang = parseInt(tagihan.substr(3,10));
            var status = $(this).closest('tr').find('td').eq(10).text();
            $('.nota_det').text(id);
            $('#notabayar').val(id);
            $('#tgl_bayar').text(tanggal);
            $('.tagihan').text(tagihan);
            $('#keter').text(keterangan);
            if (status == 'Lunas') {
                document.getElementById("submitbayar").disabled = true;
                document.getElementById("debet").disabled = true;
                document.getElementById("ketbayar").disabled = true;
            }else{

                document.getElementById("submitbayar").disabled = false;
                document.getElementById("debet").disabled = false;
                document.getElementById("ketbayar").disabled = false;
            }
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>barangpembelian/get_hutang_nota/"+id,
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        $('#tabelBayar tbody').empty();
                        for (var i = 0; i < data.length; i++) {
                            var table = document.getElementById("bayar");
                            var row = table.insertRow(i);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            var cell4 = row.insertCell(3);
                            var cell5 = row.insertCell(4);
                            var cell6 = row.insertCell(5);
                            var cell7 = row.insertCell(6);
                            hutang -= data[i]['bayar'];
                            cell1.innerHTML = (Number(i+1));
                            cell2.innerHTML = data[i]['tanggal'];
                            cell3.innerHTML = data[i]['nota_bayar'];
                            cell4.innerHTML = " ";
                            cell5.innerHTML = currencyFormat(data[i]['bayar']) ;
                            cell6.innerHTML = currencyFormat(hutang);
                            cell7.innerHTML = data[i]['keterangan'];

                        };
                    };
                },
                error: function (data) {
                    console.log(data);
                }
            })
        })

        function currencyFormat (num) {
            return "Rp. " + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        // AUTO COMPLETE
        var kodenama = [];
        var kodebarang = [];
        var namabarang = [];
        var hargabeli = [];
        var barang = [];
        $('#kode').focus(function(){
            var $input = $('#kode');
            if(namabarang.length == 0){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>barangpembelian/get_master_barang',
                    success:function(data){
                        for(var i = 0; i<data.length; i++){
                            kodenama.push(data[i]['id_barang']+' - '+data[i]['nama_barang']);
                            kodebarang.push(data[i]['id_barang']);
                            namabarang.push(data[i]['nama_barang']);
                            hargabeli.push(data[i]['harga_beli']);
                            barang.push(data[i]);
                        }
                    }
                });
            }

            $input.typeahead({
                source:kodenama, 
            });          

            $input.change(function() {
                var current = $input.typeahead("getActive");
                var index = kodenama.indexOf(current);
                $('#kode').val(kodebarang[index]);
                $('#namaBarang').val(namabarang[index]);
                $('#harga').val(hargabeli[index]);    
                $('#jumlah').val(1);    
                $('#disc').val(0);
                $('#subTot').val(hargabeli[index]);
                $('#addTemp').focus();
            });

        });


        $('#namaBarang').focus(function(){
            var $input2 = $('#namaBarang');
            if(kodebarang.length == 0){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>barangpenjualan/get_master_barang',
                    success:function(data){
                        for(var i = 0; i<data.length; i++){
                            kodenama.push(data[i]['id_barang']+' - '+data[i]['nama_barang']);
                            kodebarang.push(data[i]['id_barang']);
                            namabarang.push(data[i]['nama_barang']);
                            hargabeli.push(data[i]['harga_beli']);
                            barang.push(data[i]);
                        }
                    }
                });
            }

            $input2.typeahead({
                source:kodenama, 
            }); 

            $input2.change(function() {
                var current = $input2.typeahead("getActive");
                var index = kodenama.indexOf(current);

                $('#namaBarang').val(namabarang[index]);
                $('#kode').val(kodebarang[index]);
                $('#harga').val(hargabeli[index]);    
                $('#jumlah').val(1);    
                $('#disc').val(0);
                $('#subTot').val(hargabeli[index]);
                $('#addTemp').focus();  
                
            });

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

        $("#tunai").change(function() {
            if(this.checked) {
                document.getElementById("tunai-id").value = "1";
                
            }else{
                document.getElementById("tunai-id").value = "0";

            }
        });

        //cek error
        $('#sumbitPembelian').on('click', function (e) {
            if ($('#override_view').val() == '') {
                alert('Override masih kosong!!');
                $('#modal-override').modal('show');
            } 
        });

        //submit bayar cek error
        $('#submitbayar').on('click', function (e) {
            if ($('#override_view').val() == '') {
                alert('Override masih kosong!!');
                $('#modal-override').modal('show');
                $('#un').focus();
                e.preventDefault();
            }else if ($('#debet').val() == '') {
                alert('Masukan jumlah yang akan dibayar!!');
                $('#debet').focus();
                e.preventDefault();
            }else{
                alert('Pembayaran berhasil');
            }
             
        });

        // tambah pembelian temp
        $('#addTemp').on('click', function (e) {
            e.preventDefault();
            var item = {};
            var number = 1;
            if ($('#kode').val() == '') {
                alert('Data masih kosong!!');
                $('#kode').focus();
            }else{
                item[number] = {};
                item[number]['operator_id'] = $('#operator_id').val();       
                item[number]['kode'] = $('#kode').val();       
                item[number]['nama'] = $('#namaBarang').val();
                item[number]['hargabeli'] = $('#harga').val();
                item[number]['jumlah'] = $('#jumlah').val();
                item[number]['disc'] = $('#disc').val();
                item[number]['status'] = 1;
                var subTot = (item[number]['hargabeli'] * item[number]['jumlah']) - item[number]['disc'];
                
                $.ajax({
                    type: "POST",
                    data : item,
                    url: "<?php echo base_url()?>barangpembelian/tambah_temp_pembelian",
                    success: function (data) {
                        console.log(data);
                        alert('Tambah item barang berhasil !');
                        window.location = window.location.href + "?openmodal=1";
                        // $('#tabeltemp > tbody tr:last').after('<tr><td class="id_edit">'+item[number]['kode']+'</td><td>'+item[number]['nama']+'</td><td>'+item[number]['hargabeli']+'</td><td>'+item[number]['jumlah']+'</td><td>'+item[number]['disc']+'</td><td>'+subTot+'</td><td><button class="btn btn-danger btn-xs hapus"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></button></td></tr>');
                        
                    },error:function(data){
                        console.log(data);
                    }
                });    
            }
             
        });

        $('#resetTemp').on('click',function (e) {
            e.preventDefault();
            var a = confirm('Yakin hapus semua barang?');
            if (a == true) {
                $.ajax({
                    url: 'barangpembelian/reset/',
                    success:function (data) {
                        console.log(data);
                        alert("Item berhasil dihapus !");
                        window.location = window.location.href + "?openmodal=1";
                    },error:function(data){
                        console.log(data);
                    }
                });
            }
        });

        $('.hapus').on('click',function (e) {
            e.preventDefault();
            // var satuan_id = $(this).closest('tr').find('td .id_edit').val();
            var id = $(this).closest('tr').find('td').eq(0).text();
            var a = confirm('Yakin hapus barang?');
            if (a == true) {
                $.ajax({
                    url: 'barangpembelian/hapus_temp/'+id,
                    success:function (data) {
                        console.log(data);
                        alert("Item berhasil dihapus !");
                        window.location = window.location.href + "?openmodal=1";
                    },error:function(data){
                        console.log(data);
                    }
                });
            }
        });
    });
</script>
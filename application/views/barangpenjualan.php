<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>F&B dan Barang Penjualan - Paragon Futsal</title>

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
                    <h4 class="header-line">Transaksi FnB : Penjualan </h4>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addtrans">Tambah Transaksi</button>
                    </div>
                </div>
            </div>
             
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">

                    <table class="table table-striped data-table table-bordered table-hover" id="tabelPenjualan">
                        <thead>
                            <tr class="success">
                                <th>#</th>  
                                <th>Tanggal</th>
                                <th>Nota   </th>
                                <th>Nama Barang</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>Disc. Total </th>
                                <th>Sub Total</th>
                                <th>Keterangan</th>
                                <!-- <th>Status</th>
                                <th>Act</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $jml = 0;
                                $dsc = 0;
                                $tot = 0;
                                foreach($listpenjualan as $data){
                                    if (substr($data->hj,0,1) != '-') {
                                       $tot += $data->subtotal;
                                    }
                                    $jml += $data->jml;
                                    $dsc += $data->disc;
                                    echo '
                                    <tr>
                                        <td class="tengah">'.$i++.'</td>
                                        <td>'.convertDate($data->tgl_jual).'</td>
                                        <td>'.$data->id_nota.'</td>
                                        <td>'.$data->nama.'</td>
                                        <td>Rp. '.number_format($data->harga_jual).'</td>
                                        <td>'.$data->jml.'</td>
                                        <td>Rp. '.number_format($data->disc).'</td>
                                        <td>Rp. '.number_format($data->subtotal).'</td>
                                        <td>'.$data->keterangan.'</td>
                                        
                                    </tr>';
                                }

                                // <td>'.$data->status.'</td>
                                //         <td class="tengah">
                                //             <button class="btn btn-danger btn-xs" onclick="override_pengguna('.$data->id_nota.')"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></button>
                                //         </td>
                                
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
                                <td colspan="5" style="text-align:right">TOTAL</td>
                                <td><?php echo $jml; ?></td>
                                <td>Rp. <?php echo number_format($dsc); ?></td>
                                <td>Rp. <?php echo number_format($tot); ?></td>
                                <td></td>
                                
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
        function reset_override() {
            $('#override-form')[0].reset();

            $('#override-form .form-group').removeClass('has-error'); // clear error class
            $('#override-form .help-block').empty(); // clear error string
        }

        function override_pengguna(id) {
            $('#override-form')[0].reset(); // reset form on modals
            $('#override-form .form-group').removeClass('has-error'); // clear error class
            $('#override-form .help-block').empty(); // clear error string
            
            $('#modal-override').modal('show'); // show bootstrap modal
            $('#nota').val(id); // show bootstrap modal
            $('#modal-override .modal-title').text('Override Pengguna'); // Set Title to Bootstrap modal title
        }

        function del_override(id){
            $.ajax({
                url : "<?php echo site_url('barangpenjualan/ajax_override_pengguna')?>",
                type: "POST",
                data: $('#override-form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
         
                    if(data.status) //if success close modal and update input main-form
                    {
                        
                        //update input text in main-form , hapus yang lama
                        var a = confirm('Yakin hapus '+id+' ?');
                        if (a == true) {
                            $.ajax({
                                url: 'barangpenjualan/hapus/'+id,
                                success:function (data) {
                                    console.log(data);
                                    alert(id+" berhasil dihapus !");
                                    window.location.replace("<?php echo base_url()?>barangpenjualan");
                                },error:function(data){
                                    console.log(data);
                                }
                            });
                        }
                        $('#modal-override').modal('hide');
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

    <!-- modal -->
    <div class="modal fade" id="addtrans" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="barangpenjualan/tambah" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title tengah">Transaksi Penjualan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Tanggal</label>
                                <div class="col-md-7">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('user_data')['user_id'];?>">
                                    <input type="text" class="form-control" value="<?php echo date("d M Y / H:i:s"); ?>" readonly>
                                    <input type="hidden" id="" class="form-control" name="tgl_waktu" value="<?php echo date("Y-m-d H:i:s");?>">

                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-5">No. Nota</label>
                                <div class="col-md-7">
                                    <input type="text" id="id_nota" class="form-control" name="id_nota" readonly>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-5">Nama Barang</label>
                                <div class="col-md-7">
                                    <input type="text" id="namaBarang" class="form-control" name="namaBarang" required >
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-5">Kode Barang</label>
                                <div class="col-md-7">
                                    <input type="text" id="kode" class="form-control" name="kode" required>
                                </div>
                            </div><br>
                            
                            <div class="form-group">
                                <label class="control-label col-md-5">Keterangan</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="ket" name="ket" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label class="control-label col-md-4">Harga Jual</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp. </div>
                                        <input type="number" readonly id="harga" name="harga" class="form-control" required style="background-color: white;">
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-4">Jumlah</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                                        <div class="input-group-addon">Pcs</div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-4">Disc Total</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp. </div>
                                        <input type="number" value="0" id="disc" name="disc" class="form-control" >
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub Total</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rp. </div>
                                        <input type="text" id="subTot" readonly name="subTot" class="form-control" style="background-color: white;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-success">Add</button>
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
                        <input type="hidden" id="nota" value="" name="nota"/>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">Username</label>
                                <div class="col-md-6">
                                    <input type="text" id="" class="form-control" name="username">
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
                    <button type="button" class="btn btn-success" id="btnSaveOverride" onclick="del_override($('#nota').val())">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
</html>


<script type="text/javascript">
    $(document).ready(function() {
        var nota = '<?php echo $id_nota;?>';
    
        $("#id_nota").val(nota);

        $('#jumlah').keyup(function(){
            var subtotal = $('#harga').val() * $('#jumlah').val();
            $("#subTot").val(subtotal);
        });

        $('#disc').keyup(function(){
            var temp = $('#harga').val() * $('#jumlah').val();
            var subtotal = temp - $('#disc').val();
            $("#subTot").val(subtotal);
        });

        var kodebarang = [];
        var namabarang = [];
        var hargajual = [];
        var kodenama = [];
        $('#namaBarang').focus(function(){
            var $input = $('#namaBarang');
            if(kodebarang.length == 0){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>barangpenjualan/get_master_barang',
                    success:function(data){
                        for(var i = 0; i<data.length; i++){
                            kodenama.push(data[i]['id_barang']+' - '+data[i]['nama_barang']);
                            kodebarang.push(data[i]['id_barang']);
                            namabarang.push(data[i]['nama_barang']);
                            hargajual.push(data[i]['harga_jual']);
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
                $('#harga').val(hargajual[index]);
                $('#jumlah').val(1);    
                $('#subTot').val(hargajual[index]);
                $('#jumlah').focus();    
                
            });

        });

        $('#kode').focus(function(){
            var $input2 = $('#kode');
            if(kodebarang.length == 0){
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>barangpenjualan/get_master_barang',
                    success:function(data){
                        for(var i = 0; i<data.length; i++){
                            kodenama.push(data[i]['id_barang']+' - '+data[i]['nama_barang']);
                            kodebarang.push(data[i]['id_barang']);
                            namabarang.push(data[i]['nama_barang']);
                            hargajual.push(data[i]['harga_jual']);
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

                $('#kode').val(kodebarang[index]);
                $('#namaBarang').val(namabarang[index]);
                $('#harga').val(hargajual[index]);
                $('#jumlah').val(1);    
                $('#subTot').val(hargajual[index]);
                $('#jumlah').focus();   
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
        
    });
    
</script>


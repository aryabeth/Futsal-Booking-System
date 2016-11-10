<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Data Barang - Paragon Futsal</title>

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
                                <a href="" class="menu-top-active"><i class="fa fa-database">&nbsp;</i>data <i class="fa fa-angle-down"></i></a>
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
                    <h4 class="header-line">Data FnB </h4>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addfnb">Add FnB</button>
                    </div>

                    <!-- modal tambah -->
                    <div class="modal fade" id="addfnb" tabindex="-1" role="dialog" aria-labelledby="addfnb" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="databarang/tambah" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title tengah">Add FnB</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Kode </label>
                                                <div class="col-md-7">
                                                    <input type="text" id="id_barang" class="form-control" name="id_barang">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Nama Barang </label>
                                                <div class="col-md-7">
                                                    <input type="text" id="nama_barang" class="form-control" name="nama_barang">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Harga Beli </label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control" name="hargabeli" readonly value="0">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Harga Jual </label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control" name="hargajual">
                                                    </div>
                                                </div>
                                            </div><br> 
                                        </div>
                                        

                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Stok </label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="number" id="stok" value="0" class="form-control" name="stok" readonly>
                                                        <div class="input-group-addon">Pcs </div>
                                                    </div>
                                                    
                                                </div>
                                            </div><br>   
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Keterangan</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control" rows="2" name="keterangan"></textarea>
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

                    <!-- modal edit -->
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" id="submitUbah">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title tengah">Edit FnB</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Kode </label>
                                                <div class="col-md-7">
                                                    <input type="text" id="id_barang_ed" class="form-control" readonly name="id_barang_ed">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Nama Barang </label>
                                                <div class="col-md-7">
                                                    <input type="text" id="nama_barang_ed" class="form-control" name="nama_barang_ed" readonly>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Harga Beli </label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" id="hargabeli_ed" class="form-control" name="hargabeli_ed" readonly>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Harga Jual </label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" id="hargajual_ed" class="form-control" name="hargajual_ed">
                                                    </div>
                                                </div>
                                            </div><br> 
                                        </div>
                                        

                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Stok </label>
                                                <div class="col-md-7">
                                                    <input type="number" readonly id="stok_ed" class="form-control" name="stok_ed">
                                                </div>
                                            </div><br>   
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Keterangan</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control" id="keterangan_ed" rows="2" name="keterangan_ed"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="batalUbah" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">

                    <table class="table table-striped data-table table-bordered table-hover" id="tabelPenjualan">
                        <thead>
                            <tr class="success">
                                <th>#</th>  
                                <th>Kode</th>
                                <th>Nama Barang   </th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Keterangan  </th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody id="tableBarang">
                            <?php
                                $i = 1;
                                foreach($listbarang as $barang){
                                    echo '
                                    <tr>
                                        <td class="tengah">'.$i++.'</td>
                                        <td class="id_edit">'.$barang->id_barang.'</td>
                                        <td>'.$barang->nama_barang.'</td>
                                        <td>Rp. '.$barang->harga_beli.'</td>
                                        <td>Rp. '.$barang->harga_jual.'</td>
                                        <td>'.$barang->stok.'</td>
                                        <td>'.$barang->keterangan.'</td>
                                        <td class="tengah">
                                            <a href="#edit" class="btn btn-primary btn-xs edUbah" data-toggle="modal"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> 
                                        </td>     
                                    </tr>';
                                }
                            ?>

                                   
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
    $(document).ready(function(){

        // var today = new Date();
        // var day = today.getDate();
        // var min = today.getMinutes();
        // var dtk = today.getSeconds();

        // var id_barang = (day+""+min+""+dtk);   

        // $("#id_barang").val(id_barang);


        $("#batalUbah").on('click', function (e) {
            e.preventDefault();
            $('#id_barang_ed').val('');
            $('#nama_barang_ed').val('');
            $('#hargabeli_ed').val('');
            $('#hargajual_ed').val('');
            $('#stok_ed').val('');
            $('#keterangan_ed').val('');
        }); 

        $("#tableBarang").on('click', 'tr td a.edUbah', function (e) {
            e.preventDefault();
            var satuan_id = $(this).closest('tr').find('td .id_edit').val();
            var id_barang = $(this).closest('tr').find('td').eq(1).text();
            var nama_barang = $(this).closest('tr').find('td').eq(2).text();
            var hargabeli = $(this).closest('tr').find('td').eq(3).text();
            var hargajual = $(this).closest('tr').find('td').eq(4).text();
            var stok = $(this).closest('tr').find('td').eq(5).text();
            var keterangan = $(this).closest('tr').find('td').eq(6).text();
            $('#id_barang_ed').val(id_barang);
            $('#nama_barang_ed').val(nama_barang);
            $('#hargabeli_ed').val(hargabeli.substr(4));
            $('#hargajual_ed').val(hargajual.substr(4));
            $('#stok_ed').val(stok);
            $('#keterangan_ed').val(keterangan);

        });

        $('#submitUbah').submit(function (e) {
            e.preventDefault();
            var item = {};
            var number = 1;
           
            item[number] = {};

            item[number]['id_barang'] = $('#id_barang_ed').val();       
            item[number]['nama_barang'] = $('#nama_barang_ed').val();
            item[number]['harga_beli'] = $('#hargabeli_ed').val();
            item[number]['harga_jual'] = $('#hargajual_ed').val();
            item[number]['stok'] = $('#stok_ed').val();
            item[number]['keterangan'] = $('#keterangan_ed').val();
            
            
            $.ajax({
                type: "POST",
                data : item,
                url: "<?php echo base_url()?>databarang/ubah",
                success: function (data) {
                    console.log(data);
                    alert('Data berhasil diubah !');
                    window.location.replace("<?php echo base_url()?>databarang");
                },error:function(data){
                    console.log(data);
                }
            });
        });

        $('.hapus').on('click',function (e) {
            e.preventDefault();
            var satuan_id = $(this).closest('tr').find('td .id_edit').val();
            var id = $(this).closest('tr').find('td').eq(1).text();
            var a = confirm('Yakin hapus barang?');
            if (a == true) {
                $.ajax({
                    url: 'databarang/hapus/'+id,
                    success:function (data) {
                        console.log(data);
                        alert("Data berhasil dihapus !");
                        window.location.replace("<?php echo base_url()?>databarang");
                    },error:function(data){
                        console.log(data);
                    }
                });
            }
        });

    });
</script>
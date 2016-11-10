<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Transaksi Deposit - Paragon Futsal</title>

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
                                        <li><a href="">Cash Inject</a></li>
                                        <li><a href="">Cash Deposit (Bank)</a></li>
                                    </ul>
                                    </li>
                                    <li><a href="#">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="#">Cashflow Kasir</a></li>
                                    <li><a href="#">Cashflow Pickup/Inject/Bank</a></li>
                                    <li><a href="#">Lembur</a></li>
                                    <li><a href="#">Stok Barang</a></li>
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
                    <h4 class="header-line">Transaksi Deposit </h4>
                    <div class="tengah">
                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#inputdeposit">Tambah Deposit</button>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="inputdeposit" tabindex="-1" role="dialog" aria-labelledby="inputdeposit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo base_url(); ?>tdeposit/simpan_transaksi" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title tengah">Input Data Deposit</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Override</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon btn btn-info override_pengguna">
                                                            <span class="glyphicon glyphicon-log-in"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="override_view" readonly>
                                                        <input type="" class="form-control" name="override" style="display: none;">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Tanggal</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="" class="form-control datepicker" value="<?php echo date("d-m-Y");?>" name="tgl_deposit">
                                                </div>
                                            </div><br>                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Nama</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="nama_customer" class="form-control" disabled>
                                                    <input type="password" id="new_password" class="form-control" style="display: none;" name="new_password">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Telp/HP/ID</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="kode" class="form-control" name="id_customer">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">E-mail</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="email_customer" class="form-control" name="e-mail" disabled>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Keterangan</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control submit" rows="2" name="keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Jumlah Deposit</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control" id="jml_deposit" name="jml_deposit">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Jumlah Bonus</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control override submit" id="jml_bonus" name="jml_bonus" disabled>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Saldo Awal</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="text" id="saldo_awal" class="form-control submit" name="saldo_awal" disabled>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Saldo Akhir</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control submit" id="saldo_akhir" name="saldo_akhir" disabled>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Total Deposit</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="number" class="form-control submit" id="total_deposit" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-warning" id="reset_input_deposit">Reset</button>
                                        <span class="btn btn-info" id="add_password" style="display: none;">Add Password</span>
                                        <span class="btn btn-info" id="change_password" style="display: none;">Change Password</span>                                      
                                        <button type="submit" class="btn btn-submit" id="add_deposit">Add</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <div class="row" style="margin-top: -20px;">
                <div class="col-md-12">
                    <table id="tabelpegawai" class="table table-responsive table-striped data-table table-bordered table-hover">
                        <thead>
                            <tr class="success" align="center">
                                <th style='vertical-align:middle'>#</th>
                                <th style='vertical-align:middle'>Tanggal</th>                                
                                <th style='vertical-align:middle'>Telp/Hp/ID</th>
                                <th style='vertical-align:middle'>Nama</th>
                                <th style='vertical-align:middle'>E-mail</th>
                                <th style='vertical-align:middle'>Jml. Deposit</th>
                                <th style='vertical-align:middle'>Jml. Bonus</th>
                                <th style='vertical-align:middle'>Saldo Awal</th>
                                <th style='vertical-align:middle'>Saldo Akhir</th>                                
                                <th style='vertical-align:middle'>Ket</th>
                                <th style='vertical-align:middle'>Status</th>
                                <th style='vertical-align:middle'>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($deposit)){
                                    foreach ($deposit as $key => $value) {
                                        $print = "<tr>                                            
                                            <td class='id' style='vertical-align:middle' align='center'>".$value['id_nota_deposit']."</td>
                                            <td style='vertical-align:middle'>".date('d-m-Y', strtotime($value['tgl_deposit']))."</td>
                                            <td style='vertical-align:middle'>".$value['id_customer']."</td>
                                            <td style='vertical-align:middle'>".$value['nama']."</td>
                                            <td style='vertical-align:middle'>".$value['email']."</td>
                                            <td style='vertical-align:middle'>".$value['jml_deposit']."</td>
                                            <td style='vertical-align:middle'>".$value['jml_bonus']."</td>
                                            <td style='vertical-align:middle'>".$value['saldo_awal']."</td>
                                            <td style='vertical-align:middle'>".$value['saldo_akhir']."</td>
                                            <td style='vertical-align:middle'>".$value['keterangan']."</td>
                                            <td style='vertical-align:middle'>".$value['status']."</td>
                                            <td style='vertical-align:middle'>";
                                            if($value['status'] != "BATAL")
                                                $print .= "<a href='".base_url()."tdeposit/batal_transaksi/".$value['id_nota_deposit']."/".$value['id_customer']."' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a>&nbsp";
                                            $print .= "<a href='#editDp' data-toggle='modal' data-target='#inputdeposit' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>
                                            <a href='' class='btn btn-info btn-xs'><i class='fa fa-print'></i></a></td>";
                                        $print .= "</tr>";
                                        echo $print;
                                    }
                                }
                            ?>
                        </tbody>
                        <!--<a href="" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a> 
                                    <a href="#editDp" data-toggle="modal" data-target="#inputdeposit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>-->
                        <tfoot>
                            <tr class="success" align="center">
                                <th style='text-align:center'>#</th>
                                <th style='text-align:center'>Tanggal</th>                                
                                <th style='text-align:center'>Telp/Hp/ID</th>
                                <th style='text-align:center'>Nama</th>
                                <th style='text-align:center'>E-mail</th>
                                <th style='text-align:center'>Jml. Deposit</th>
                                <th style='text-align:center'>Jml. Bonus</th>
                                <th style='text-align:center'>Saldo Awal</th>
                                <th style='text-align:center'>Saldo Akhir</th>                                
                                <th style='text-align:center'>Ket</th>
                                <th style='text-align:center'>Status</th>
                                <th style='text-align:center'>Act</th>                                                        
                            </tr>
                        </tfoot>
                    </table>           
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-override" tabindex="-1" role="dialog" aria-labelledby="modal-override" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="reset_override()" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Override Pengguna</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="override-form" class="form-horizontal">
                        <input type="hidden" value="" name="user_id"/>

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-2">Username</label>
                                <div class="col-md-10">
                                    <input type="text" id="" class="form-control" name="username">
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
                    <button type="button" class="btn btn-success" id="save_override">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="modal-password" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="reset" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Password Customer</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="password-form" class="form-horizontal">
                        <input type="hidden" value="" name="customer_id"/>

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-2">Password</label>
                                <div class="col-md-10">
                                   <input type="password" id="password" class="form-control" name="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Confirm Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="confirm_password" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" onclick="reset_password()" id="reset_password">Reset</button>
                    <button type="button" class="btn btn-success" id="save_password">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-changePassword" tabindex="-1" role="dialog" aria-labelledby="modal-changePassword" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="reset" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title tengah">Password Customer</h4>
                </div>
                <div class="modal-body form">
                    <form action="#" id="changePassword-form" class="form-horizontal">
                        <input type="hidden" value="" name="customer_id"/>

                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-2">Current Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="change_current" class="form-control" name="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="change_password" class="form-control" name="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Confirm Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="change_confirm" class="form-control" name="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" onclick="reset_password()" id="reset_password">Reset</button>
                    <button type="button" class="btn btn-success" id="save_new_password">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    
    <?php include "footer.php"; ?>
    <?php include "tdeposit-js.php"; ?>
</body>
</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Home - Paragon Futsal</title>

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
                            <li><a href="home" class="menu-top-active"><i class="fa fa-home">&nbsp;</i>Home</a></li>
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
                                    <li><a href="#">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-file-text">&nbsp;</i>laporan <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="laporancashflowkasir">Cashflow Kasir</a></li>
                                    <li><a href="laporancashflowpib">Cashflow Pickup/Inject/Bank</a></li>
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
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">HOMEPAGE </h4>
                </div>
            </div>
             
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-1">Lapangan</label>
                        <div class="col-md-2">
                            <select class="form-control" id="jadwal_lapangan" name="lapangan">
                                <?php foreach($enum_lapangan as $key => $value)
                                    echo "<option value='".($key+1)."'>$value</option>"; ?>
                            </select>
                        </div>
                        <label class="control-label col-md-1">Bulan</label>
                        <div class="col-md-2">
                            <select class="form-control" id="jadwal_bulan">
                                <?php                                    
                                    $months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                    for ($i=0; $i < 12; $i++) {
                                        if($i+1 == date('n'))
                                            $selected="selected";
                                        else
                                            $selected="";
                                        echo "<option ".$selected." value='".($i+1)."'>".$months[$i]."</option>";
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div id="daypilot"></div>

        <!-- MODALS MODALS -->
        <!-- MODAL INPUT TRANSAKSI -->
        <div class="modal fade" id="input_transaksi" tabindex="-1" role="dialog" aria-labelledby="inputlunas" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">             
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title tengah">Tambah Booking</h4>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" style="margin-bottom:20px;">
                                <li class="active"><a href="#dp" data-toggle="tab" id="tab-dp" class="modal-tab" name="_dp">DP</a></li>
                                <li><a href="#lunas" data-toggle="tab" id="tab-lunas" class="modal-tab" name="_lunas">LUNAS</a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content" style="width:100% !important;">
                                <!-- TAB DP -->
                                <div class="tab-pane active form-order" id="dp">
                                    <form method="post" id="transaksi_dp" action="<?php echo base_url(); ?>tlapangan/simpan_transaksi_dp" class="form-tambah form-submit">
                                        <div class="modal-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Override</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="input-group-addon btn btn-info override_pengguna" name="dp">
                                                                <span class="glyphicon glyphicon-log-in"></span>
                                                            </div>
                                                            <input type="text" class="form-control submit" name="override_view" readonly>
                                                            <input type="" class="form-control override_dp_lunas" name="override" style="display: none;">
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal DP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_dp" class="form-control datepicker" name="tgl_dp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Nama</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="nama_customer" class="form-control nama_customer" name="nama">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Telp/HP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="telp_customer" class="form-control kode" name="telp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Lapangan</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control submit" id="lapangan_dp" name="lapangan" disabled>
                                                            <?php foreach($enum_lapangan as $key => $value)
                                                                echo "<option value='".($key+1)."'>$value</option>"; ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Main</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_main_dp" class="form-control datepicker" name="tgl_main">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Jam Main</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">                                    
                                                            <input type="time" id="jam_mulai_dp" name="jam_mulai" class="form-control jam_main" maxlength="2">
                                                            <div class="input-group-addon">-</div>
                                                            <input type="time" id="jam_selesai_dp" name="jam_selesai" class="form-control jam_main" maxlength="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">TOTAL</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="total_bayar_dp" name="total_bayar" class="form-control submit total_bayar bayar" tag="dp" disabled>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bayar DP</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="bayar_dp" name="bayar_dp" class="form-control bayar_dp bayar" tag="dp">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Disc</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled="disabled" type="text" id="diskon_bayar_dp" name="diskon" class="form-control submit override_dp diskon_bayar_dp disc_bayar bayar" tag="dp">
                                                        </div>
                                                        <!--<div class="input-group">
                                                            <?php/*
                                                                $disabled = "disabled = 'disabled'";
                                                                if ($this->session->userdata('user_input')[0]['level'] < 2) {
                                                                    $disabled = "";
                                                                } elseif (null !== $this->session->userdata('override') && $this->session->userdata('override')[0]['level'] < 2 && $this->session->userdata('override')[0]['level'] != "") {
                                                                    $disabled = "";
                                                                }*/
                                                            ?>
                                                            <div class="input-group-addon">
                                                                <?php/*
                                                                    if ($disabled == ""){
                                                                        echo "Rp. ";
                                                                    } else {
                                                                        echo '<a data-toggle="modal" data-target="#modal_override_dp"><i class="fa fa-user"></i></a>';
                                                                    }*/
                                                                ?>                                                            
                                                            </div>                                                        
                                                        </div>-->
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Kurang</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled type="text" id="kurang_bayar_dp" name="kurang_bayar_dp" class="form-control krg_lunas">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bonus</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="bonus" name="bonus" class="form-control submit override_dp" disabled>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Keterangan</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="modal-footer hidden">
                                            <button type="reset" id="reset_dp" class="btn btn-warning">Reset</button>
                                            <button type="submit" id="submit_dp" class="btn btn-success">Add</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- TAB LUNAS -->
                                <div class="tab-pane form-order" id="lunas">
                                   <form action="<?php echo base_url(); ?>tlapangan/simpan_transaksi_lunas" method="post" id="transaksi_lunas" class="form-tambah form-submit">
                                        <div class="modal-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Override</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="input-group-addon btn btn-info override_pengguna" name="lunas">
                                                                <span class="glyphicon glyphicon-log-in"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="override_view" readonly>
                                                            <input type="" class="form-control override_dp_lunas" name="override" style="display: none;">
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div><br>                                            
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Lunas</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_lunas" class="form-control datepicker" name="tgl_lunas">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Nama</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="" class="form-control nama_customer" name="nama">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Telp/HP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="" class="form-control kode" name="telp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Lapangan</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control submit" id="lapangan_lunas" name="lapangan" disabled>
                                                            <?php foreach($enum_lapangan as $key => $value)
                                                                echo "<option value='".($key+1)."'>$value</option>"; ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Main</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_main_lunas" class="form-control datepicker" name="tgl_main">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Jam Main</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input type="time" class="form-control jam_main" id="jam_mulai_lunas" maxlength="2" name="jam_mulai">
                                                            <div class="input-group-addon">-</div>
                                                            <input type="time" class="form-control jam_main" id="jam_selesai_lunas" maxlength="2" name="jam_selesai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">TOTAL</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control submit total_bayar bayar" id="total_bayar_lunas" name="total_bayar" tag="lunas" disabled>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Disc</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control override_lunas disc_bayar bayar" id="diskon_bayar_lunas" tag="lunas" disabled="disabled">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Byr Lunas</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control krg_lunas bayar" tag="lunas" name="bayar_lunas">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bonus</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="" class="form-control override_lunas" disabled>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Keterangan</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" rows="2" name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer hidden">
                                            <button type="reset" id="reset_lunas" class="btn btn-warning">Reset</button>
                                            <button type="submit" id="submit_lunas" class="btn btn-success btn-submit">Add</button>
                                        </div>
                                    </form>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer" name="_lunas">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="button" class="btn btn-success btn-submit" id="tambah_jadwal">Add</button>
                        </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT TRANSAKSI -->
        <div class="modal fade" id="edit_transaksi" tabindex="-1" role="dialog" aria-labelledby="inputlunas" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">             
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title tengah">Edit Booking</h4>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" style="margin-bottom:20px;">
                                <li class="active"><a href="#pelunasan_dp" data-toggle="tab" id="tab-edit-pelunasan-dp" class="modal-tab" name="_pelunasan_dp">PELUNASAN DP</a></li>
                                <li><a href="#edit_dp" data-toggle="tab" id="tab-edit-dp" class="modal-tab" name="_edit_dp">EDIT DP</a></li>
                                <li><a href="#edit_lunas" data-toggle="tab" id="tab-edit-lunas" class="modal-tab" name="_edit_lunas">EDIT LUNAS</a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content" style="width:100% !important;">
                                <!-- TAB PELUNASAN -->
                                <div class="tab-pane active form-order" id="pelunasan_dp">
                                    <form method="post" id="transaksi_dp" action="<?php echo base_url(); ?>tlapangan/simpan_pelunasan_dp" class="form-edit form-submit">
                                        <div class="modal-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Override</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="input-group-addon btn btn-info override_pengguna" name="edit_dp">
                                                                <span class="glyphicon glyphicon-log-in"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="override_view_pelunasan_dp" readonly>
                                                            <input type="" class="form-control" id="override_pelunasan_dp" name="override" style="display: none;">
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div><br>
                                                <div class="hidden nform-group">
                                                        <input type="text" id="id_pelunasan_dp" class="form-control datepicker" name="id_nota_lapangan">
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal DP</label>
                                                    <div class="col-md-7">
                                                        <input disabled type="text" id="tgl_pelunasan_dp" class="form-control datepicker" name="tgl_dp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Lunas</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_lunas_pelunasan_dp" class="form-control datepicker" name="tgl_lunas">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Nama</label>
                                                    <div class="col-md-7">
                                                        <input disabled type="text" id="nama_pelunasan_dp" class="form-control nama_customer" name="nama">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Telp/HP</label>
                                                    <div class="col-md-7">
                                                        <input disabled type="text" id="telp_pelunasan_dp" class="form-control kode" name="telp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Lapangan</label>
                                                    <div class="col-md-7">
                                                        <select disabled class="form-control" id="lapangan_pelunasan_dp" name="lapangan">
                                                            <?php foreach($enum_lapangan as $key => $value)
                                                                echo "<option value='".($key+1)."'>$value</option>"; ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Main</label>
                                                    <div class="col-md-7">
                                                        <input disabled type="text" id="tgl_main_pelunasan_dp" class="form-control datepicker" name="tgl_main">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Jam Main</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input disabled type="time" id="jam_mulai_pelunasan_dp" name="jam_mulai" class="form-control jam_main" maxlength="2">
                                                            <div class="input-group-addon">-</div>
                                                            <input disabled type="time" id="jam_selesai_pelunasan_dp" name="jam_selesai" class="form-control jam_main" maxlength="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">TOTAL</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="total_bayar_pelunasan_dp" name="total_bayar" class="form-control submit total_bayar bayar" tag="pelunasan" disabled>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bayar DP</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled type="text" id="bayar_pelunasan_dp" name="bayar_dp" class="form-control bayar_dp bayar" tag="pelunasan">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Disc</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled="disabled" type="text" id="diskon_bayar_pelunasan_dp" name="diskon" class="form-control override_pelunasan_dp disc_bayar bayar" tag="pelunasan">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Byr Lunas</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="bayar_lunas_pelunasan_dp" name="bayar_lunas" class="form-control krg_lunas bayar" tag="pelunasan">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bonus</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="bonus_pelunasan_dp" name="bonus" class="form-control override_pelunasan_dp" disabled>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Keterangan</label>
                                                    <div class="col-md-8">
                                                        <textarea id="keterangan_pelunasan_dp" class="form-control" name="keterangan" rows="2"></textarea>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- TAB DP -->
                                <div class="tab-pane form-order" id="edit_dp">
                                    <form method="post" id="transaksi_dp" action="<?php echo base_url(); ?>tlapangan/simpan_edit_dp" class="form-edit form-submit">
                                        <div class="modal-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Override</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="input-group-addon btn btn-info override_pengguna" name="edit_dp">
                                                                <span class="glyphicon glyphicon-log-in"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="override_view_edit_dp" readonly>
                                                            <input type="" class="form-control" id="override_edit_dp" name="override" style="display: none;">
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div><br>
                                                <div class="hidden nform-group">
                                                        <input type="text" id="id_edit_dp" class="form-control datepicker" name="id_nota_lapangan">
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal DP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_edit_dp" class="form-control datepicker" name="tgl_dp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Nama</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="nama_edit_dp" class="form-control nama_customer" name="nama">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Telp/HP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="telp_edit_dp" class="form-control kode" name="telp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Lapangan</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" id="lapangan_edit_dp" name="lapangan">
                                                            <?php foreach($enum_lapangan as $key => $value)
                                                                echo "<option value='".($key+1)."'>$value</option>"; ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Main</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_main_edit_dp" class="form-control datepicker" name="tgl_main">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Jam Main</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input style="display: none;" type="time" id="jam_mulai_old" name="jam_mulai_old" class="form-control" maxlength="2">                
                                                            <input style="display: none;" type="time" id="jam_selesai_old" name="jam_selesai_old" class="form-control" maxlength="2">
                                                            <input type="time" id="jam_mulai_edit_dp" name="jam_mulai" class="form-control jam_main" maxlength="2">
                                                            <div class="input-group-addon">-</div>
                                                            <input type="time" id="jam_selesai_edit_dp" name="jam_selesai" class="form-control jam_main" maxlength="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">TOTAL</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="total_bayar_edit_dp" name="total_bayar" class="form-control submit total_bayar bayar" tag="dp" disabled>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bayar DP</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" id="bayar_edit_dp" name="bayar_dp" class="form-control bayar_dp bayar" tag="dp">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Disc</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled="disabled" type="text" id="diskon_bayar_edit_dp" name="diskon" class="form-control override_edit_dp disc_bayar bayar" tag="dp">
                                                        </div>
                                                        <!--<div class="input-group">
                                                            <?php/*
                                                                $disabled = "disabled = 'disabled'";
                                                                if ($this->session->userdata('user_input')[0]['level'] < 2) {
                                                                    $disabled = "";
                                                                } elseif (null !== $this->session->userdata('override') && $this->session->userdata('override')[0]['level'] < 2 && $this->session->userdata('override')[0]['level'] != "") {
                                                                    $disabled = "";
                                                                }*/
                                                            ?>
                                                            <div class="input-group-addon">
                                                                <?php/*
                                                                    if ($disabled == ""){
                                                                        echo "Rp. ";
                                                                    } else {
                                                                        echo '<a data-toggle="modal" data-target="#modal_override_dp"><i class="fa fa-user"></i></a>';
                                                                    }*/
                                                                ?>                                                            
                                                            </div>                                                        
                                                        </div>-->
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Kurang Byr</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input disabled type="text" id="kurang_bayar_edit_dp" name="kurang_bayar" class="form-control krg_lunas bayar" tag="dp">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bonus</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="bonus_edit_dp" name="bonus" class="form-control override_edit_dp" disabled>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Keterangan</label>
                                                    <div class="col-md-8">
                                                        <textarea id="keterangan_edit_dp" class="form-control" name="keterangan" rows="2"></textarea>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- TAB LUNAS -->
                                <div class="tab-pane form-order" id="edit_lunas">
                                   <form action="<?php echo base_url(); ?>tlapangan/simpan_transaksi_lunas" method="post" id="transaksi_lunas" class="form-edit form-submit">
                                        <div class="modal-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Override</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="input-group-addon btn btn-info override_pengguna" name="edit_lunas">
                                                                <span class="glyphicon glyphicon-log-in"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="override_view_edit_lunas" readonly>
                                                            <input type="" class="form-control" id="override_edit_lunas" name="override" style="display: none;">
                                                        </div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div><br>
                                                <div class="hidden nform-group">
                                                        <input type="text" id="id_edit_lunas" class="form-control datepicker" name="id_nota_lapangan">
                                                </div><br>                                            
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Lunas</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_lunas_edit_lunas" class="form-control datepicker" name="tgl_lunas">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Nama</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="nama_edit_lunas" class="form-control nama_customer" name="nama">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Telp/HP</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="telp_edit_lunas" class="form-control kode" name="telp">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Lapangan</label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" id="lapangan_edit_lunas" name="lapangan">
                                                            <?php foreach($enum_lapangan as $key => $value)
                                                                echo "<option value='".($key+1)."'>$value</option>"; ?>
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Tanggal Main</label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="tgl_main_edit_lunas" class="form-control datepicker" name="tgl_main_lunas">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Jam Main</label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input type="time" class="form-control jam_main" id="jam_mulai_edit_lunas" maxlength="2" name="jam_mulai">
                                                            <div class="input-group-addon">-</div>
                                                            <input type="time" class="form-control jam_main" id="jam_selesai_edit_lunas" maxlength="2" name="jam_selesai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">TOTAL</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control submit total_bayar bayar" id="total_bayar_edit_lunas" name="total_bayar" disabled>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Disc</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control override_edit_lunas disc_bayar bayar" id="diskon_bayar_edit_lunas" disabled="disabled">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Byr Lunas</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Rp. </div>
                                                            <input type="text" class="form-control bayar" name="bayar_lunas" id="bayar_lunas_edit_lunas">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Bonus</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="bonus_edit_lunas" class="form-control override_edit_lunas" disabled name="">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Keterangan</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" rows="2" name="keterangan" id="keterangan_edit_lunas"></textarea>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>                        
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="remove" class="btn btn-warning">Batal Main</button>
                            <button type="button" class="btn btn-success" id="edit_jadwal">Save</button>
                        </div>
                </div>
            </div>
        </div>

        <!-- MODAL OVERRIDE -->
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
    </div>
    
    <?php include "footer.php"; ?>
    <?php include "home-js.php"; ?>
</body>
</html>

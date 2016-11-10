<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    <title>Data User - Paragon Futsal</title>

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
                    <h4 class="header-line">Data Account User </h4>
                    <?php if ($this->session->userdata('user_data')['level'] == '0') { ?>
                    <div class="tengah">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#adduser">Add User</button>
                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#listuser">List User</button>
                    </div>
                    <?php } ?>
                    <!-- modal -->
                    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduser" aria-hidden="true">
                        <div class="modal-dialog" style="width: 400px;">
                            <div class="modal-content">
                                <form action="datauser/tambah_user" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title tengah">Add User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama </label>
                                            <div class="col-md-6">
                                                <input type="text" id="name" class="form-control" name="name">
                                            </div>
                                        </div><br>   
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Username</label>
                                            <div class="col-md-6">
                                                <input type="text" id="username" class="form-control" name="username">
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Password </label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" class="form-control" name="password">
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

                    <div class="modal fade" id="listuser" tabindex="-1" role="dialog" aria-labelledby="listuser" aria-hidden="true">
                        <div class="modal-dialog" style="width: 600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title tengah">List User</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-bordered table-hover" style="width: 560px;">
                                        <thead>
                                            <tr class="success">
                                                <th>#</th>  
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach($listuser as $data){
                                                    if ($data->level == 0) {
                                                        $level = 'ROOT';
                                                    }else if($data->level == 1){
                                                        $level = 'MANAGER';
                                                    }else if($data->level == 2){
                                                        $level = 'SUPERVISOR';
                                                    }else if($data->level == 3){
                                                        $level = 'KASIR';
                                                    }
                                                    echo '
                                                    <tr>
                                                        <td class="tengah">'.$i++.'</td>
                                                        <td class="id_edit">'.$data->name.'</td>
                                                        <td>'.$data->username.'</td>
                                                        <td>'.$level.'</td> 
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                     
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Keluar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <center>
                    <div style="width: 400px;">
                        <div class="alert alert-success back-widget-set text-center">
                            <div class="form-group">
                                <label class="control-label col-md-4">Nama </label>
                                <div class="col-md-7">
                                    <input type="text" id="nama" class="form-control" name="nama" readonly  value="<?php echo $this->session->userdata('user_data')['name']; ?>">
                                </div>
                            </div><br>   
                            <div class="form-group">
                                <label class="control-label col-md-4">Username</label>
                                <div class="col-md-7">
                                    <input type="text" id="idlogin" class="form-control" name="idlogin" readonly  value="<?php echo $this->session->userdata('user_data')['username']; ?>">
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-4">Password</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" value="**********************" readonly>
                                    <input type="hidden" id="cocokin" value="<?php echo $this->session->userdata('user_data')['password']; ?>">
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label col-md-4">Level</label>
                                <?php 
                                    if ($this->session->userdata('user_data')['level'] == '0') {
                                        $lv = 'ROOT';
                                    }else if($this->session->userdata('user_data')['level'] == '1'){
                                        $lv = 'MANAGER';
                                    }else if($this->session->userdata('user_data')['level'] == '3'){
                                        $lv = 'SUPERVISOR';
                                    }else if($this->session->userdata('user_data')['level'] == '3'){
                                        $lv = 'KASIR';
                                    }
                                ?>
                                <div class="col-md-7">
                                    <input type="text" id="level" class="form-control" value="<?php echo $lv;?>" name="level" readonly>
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('user_data')['user_id'];?>">
                                    <input type="hidden" id="lvl" name="lvl" value="<?php echo $this->session->userdata('user_data')['level'];?>">
                                </div>
                            </div><br>
                            <hr>

                            <p class="alert alert-warning">Ganti Password? Isikan password baru anda di bawah ini jika ingin mengganti password</p>
                            <form id="ubahPass" method="post">
                                <div class="form-group">
                                    <label class="control-label col-md-4">New Pass</label>
                                    <div class="col-md-7">
                                        <input type="password" id="newpassword" class="form-control" name="newpassword">
                                    </div>
                                </div><br>
                                <div class="form-group" style="margin-top: 15px;">
                                    <label class="control-label col-md-4">Old Pass</label>
                                    <div class="col-md-7">
                                        <input type="password" id="oldpassword" class="form-control" name="oldpassword">
                                    </div>
                                </div><br><br>
                                <button type="submit" class="btn btn-primary" >UPDATE</button>
                            </form>
                        </div>
                    </div>
                </center>
            </div> 

        </div>
    </div>
    
    <?php include "footer.php"; ?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ubahPass').submit(function (e) {
            e.preventDefault();
            
            var oldpass = md5($('#oldpassword').val());
            var cocokin = $('#cocokin').val();
            if (oldpass != cocokin) {
                alert("Inputan Old password salah!");
            }else{
                var item = {};
                var number = 1;
               
                item[number] = {};

                item[number]['user_id'] = $('#user_id').val();       
                item[number]['name'] = $('#nama').val();
                item[number]['username'] = $('#idlogin').val();
                item[number]['password'] = md5($('#newpassword').val());
                item[number]['level'] = $('#lvl').val();
                item[number]['status'] = 0;
                
                
                $.ajax({
                    type: "POST",
                    data : item,
                    url: "<?php echo base_url()?>datauser/ubah_password",
                    success: function (data) {
                        console.log(data);
                        alert('Password berhasil diubah !');
                        window.location.replace("<?php echo base_url()?>datauser");
                    },error:function(data){
                        console.log(data);
                    }
                });
            }
        });
    });
</script>

<!-- modal -->
					<div class="tengah">
                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#inputdp">Input DP</button>
                       
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="inputdp" tabindex="-1" role="dialog" aria-labelledby="inputdp" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title tengah">Input DP</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">DP</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" readonly maxlength="3" style="width: 60px">
                                                        <div class="input-group-addon">-</div>
                                                        <input type="text" class="form-control" readonly maxlength="5">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Tanggal DP</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="" class="form-control datepicker" name="">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Nama</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="" class="form-control" name="">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Telp/HP</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="" class="form-control" name="">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Lapangan</label>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="" name="">
                                                        <option>Rumput 1</option>
                                                        <option>Rumput 2</option>
                                                        <option>Ava Court</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Tanggal Main</label>
                                                <div class="col-md-7">
                                                    <input type="text" id="" class="form-control datepicker" name="">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Jam Main</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" maxlength="2">
                                                        <div class="input-group-addon">-</div>
                                                        <input type="text" class="form-control" maxlength="2">
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
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Bayar DP</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Disc</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Kurang</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Rp. </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Bonus</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="" class="form-control" disabled name="">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Keterangan</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="button" class="btn btn-success">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


 <!-- act -->
 <a href="" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a> 



 <!--tabel -->
 					<div class="table-responsive">
                        <table class="table table-striped data-table table-bordered table-hover" id="tabelDitawarkan">
                            <thead>
                                <tr class="success">
                                    <th>#</th>
                                    <th>DP</th>
                                    <th>Jumlah DP</th>
                                    <th>Tgl. DP</th>
                                    <th>Lunas</th>
                                    <th>Jumlah Lunas</th>
                                    <th>Tgl. Lunas</th>
                                    <th>Disc</th>
                                    <th>Nama</th>
                                    <th>Telp</th>
                                    <th>Lap</th>
                                    <th>Tgl. Main</th>
                                    <th>Jam Main</th>
                                    <th>Ket</th>
                                    <th>Status</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>016-00004</td>
                                    <td>Rp. 0</td>
                                    <td>12-12-2012</td>
                                    <td>Rp. 0</td>
                                    <td>Rp. 0</td>
                                    <td>12-12-2012</td>
                                    <td>Rp. 0</td>
                                    <td>Abadi</td>
                                    <td>0831 3112 3122</td>
                                    <td>1</td>
                                    <td>12-12-2012</td>
                                    <td>02.00</td>
                                    <td>ini keterangan</td>
                                    <td><a href="#editDp" data-toggle="modal" data-target="#editDp">DP</a> </td>
                                    <td><a href="" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a> 
                                        <a href="#editDp" data-toggle="modal" data-target="#editDp" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a> 
                                        <a href="" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a> </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
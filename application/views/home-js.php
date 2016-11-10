<script type="text/javascript"> 
    var main;
    var bayar;
    var override_id;
    var mode_temp = "";
    var mode_id = ""; //_edit, _lunas, _edit_dp, _edit_lunas

    var idcustomer = [];
    var nama = [];
    var email = [];
    var saldo = [];
    $('.kode').focus(function(event){
        var $input = $(event.target);           
        if(idcustomer.length === 0){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>tlapangan/get_master_customer',
                success:function(data){
                    for(var i = 0; i<data.length; i++){
                        idcustomer.push(data[i]['id_customer']);
                        nama.push(data[i]['nama']);
                        email.push(data[i]['email']);                           
                    }
                }
            });
        }

        $input.typeahead({source:idcustomer, 
        autoSelect: true}); 

        $input.change(function() {          
            var current = $input.typeahead("getActive");
            var index = idcustomer.indexOf(current);

            $(event.target).closest('form').find('input.nama_customer').val(nama[index]);
            //$('#email_customer').val(email[index]);               
        });

    });

    //SECTION HITUNG
    //Calculate total play cost
    function calculate_total(){
        if($("#jam_mulai"+mode_id).val() != "" && $('#jam_selesai'+mode_id).val() != ""){
            check_jadwal_main();
            var mulai =  $("#jam_mulai"+mode_id).val();
            mulai = mulai.split(":");
            mulai = parseInt(mulai[0])+(parseInt(mulai[1])/60);
            var selesai =  $("#jam_selesai"+mode_id).val();
            selesai = selesai.split(":");
            selesai = parseInt(selesai[0])+(parseInt(selesai[1])/60);
            var total = parseFloat(selesai) - parseFloat(mulai);
            
            total = total * 50000;
            $('#total_bayar'+mode_id).val(total);
            $('#total_bayar'+mode_id).closest('form').find('input.krg_lunas').val(total);
            /*if($('#bayar'+mode_id).val() != ""){
                $("#kurang_bayar"+mode_id).val(parseInt($('#total_bayar'+mode_id).val())-parseInt($('#bayar'+mode_id).val()));
                $('#bayar_lunas').val()
            }*/
              
        }
    }

    $('.bayar').change(function(event){        
        calculate_total();
        var total = parseInt($(event.target).closest('form').find('input.total_bayar').val());
        var disc = 0;
        if($(event.target).closest('form').find('input.disc_bayar').val() != "")
            disc = parseInt($(event.target).closest('form').find('input.disc_bayar').val());        
        //Kurang buat dp, lunas buat bayar lunas
        var krg_lunas = $(event.target).closest('form').find('input.krg_lunas');
        //alert(total+" "+disc+" "+krg_lunas);
        if($(event.target).attr('tag') === "dp" || $(event.target).attr('tag') === "pelunasan"){
            alert("dp");
            var dp = parseInt($(event.target).closest('form').find('input.bayar_dp').val());            
            krg_lunas.val(total - dp - disc);            
        } else if($(event.target).attr('tag') === "lunas"){            
            alert("lunas");
            krg_lunas.val(total - disc);
        }        
    })

    //Hitung Kurang Bayar dari Bayaran DP
    /*$('.bayar_dp').change(function (){
        //alert("#kurang_bayar"+mode_id);
        $("#kurang_bayar"+mode_id).val(parseInt($('#total_bayar'+mode_id).val())-parseInt($('#bayar'+mode_id).val()));
    })

    $('.diskon_bayar_dp').change(function (){
        if($('[name="override'+mode_id+'"]').val() != ""){
            $('#kurang_bayar'+mode_id).val(parseInt($('#kurang_bayar'+mode_id).val())-parseInt($('#diskon_bayar'+mode_id).val()));
            $('#total_bayar'+mode_id).val(parseInt($('#total_bayar'+mode_id).val())-parseInt($('#diskon_bayar'+mode_id).val()));
        } else{
            $('#diskon_bayar'+mode_id).val("");
            $('#diskon_bayar'+mode_id).attr("disabled", "disabled");
        }
    })

    //Hitung Kurang Bayar dari Jumlah diskon
    $('#diskon_bayar_lunas').change(function (){
        if($('[name="override"]').val() != ""){
            $('#total_bayar_lunas').val(parseInt($('#total_bayar_lunas').val())-parseInt($('#diskon_bayar_lunas').val()));
        } else{
            $('#diskon_bayar_lunas').val("");
            $('#diskon_bayar_lunas').attr("disabled", "disabled");
        }
    })*/
    //SECTION HITUNG END
        

        /* DAY PILOT EVENT CALENDAR */
        var now = new Date();
        var dp = new DayPilot.Calendar("daypilot");        
        dp.viewType = "Days";
        dp.days = new Date(now.getFullYear(), now.getMonth()+1, 0).getDate(),
        dp.headerDateFormat = "dd/MM";
        dp.theme = "calendar_green";
        dp.startDate = new Date(now.getFullYear(), now.getMonth(), 1).toString("yyyy-MM-dd");
        dp.heightSpec = "Full";
        dp.ShowToolTip = true;        
       
        //creating event (click on empty space in the calendar)
        dp.onTimeRangeSelected = function (args) {
            mulai = new Date(args.start);
            selesai = new Date(args.end);
            //Set Jam Main & Tgl Main di modal
            $('#jam_mulai_dp').val(("0" + mulai.getUTCHours()).slice(-2) + ":" + ("0" + mulai.getUTCMinutes()).slice(-2));
            $('#jam_mulai_lunas').val(("0" + mulai.getUTCHours()).slice(-2) + ":" + ("0" + mulai.getUTCMinutes()).slice(-2));
            $('#jam_selesai_dp').val(("0" + selesai.getUTCHours()).slice(-2) + ":" + ("0" + selesai.getUTCMinutes()).slice(-2));
            $('#jam_selesai_lunas').val(("0" + selesai.getUTCHours()).slice(-2) + ":" + ("0" + selesai.getUTCMinutes()).slice(-2));
            $('#tgl_main_dp').val(("0" + mulai.getDate()).slice(-2) + "-" + ("0" + (mulai.getMonth() + 1)).slice(-2) + "-" + mulai.getFullYear());
            $('#tgl_main_lunas').val(("0" + mulai.getDate()).slice(-2) + "-" + ("0" + (mulai.getMonth() + 1)).slice(-2) + "-" + mulai.getFullYear());
            
            //Set Tanggal Bayar (Hari Ini) di modal
            bayar = new Date();
            $('#tgl_dp').val(("0" + bayar.getDate()).slice(-2) + "-" + ("0" + (bayar.getMonth() + 1)).slice(-2) + "-" + bayar.getFullYear());
            $('#tgl_lunas').val(("0" + bayar.getDate()).slice(-2) + "-" + ("0" + (bayar.getMonth() + 1)).slice(-2) + "-" + bayar.getFullYear());
            $('#input_transaksi').modal('show');
            $('#tab-dp').click();
            //calculate_total();

            /*var name = prompt("New event name:", "Event");
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(), //Customable
                resource: args.resource,
                text: name
            });
            dp.events.add(e);*/

            /*$.post("backend_create.php", 
                    {
                        start: args.start.toString(),
                        end: args.end.toString(),
                        name: name
                    }, 
                    function() {
                        console.log("Created.");
                    });*/
            dp.clearSelection();
        };

        dp.onEventClick = function(args) {            
            if(args.e.data.tag.status === "LUNAS" || args.e.data.tag.status === "PELUNASAN DP") {
                $('#tab-edit-lunas').click();
                $('#tab-edit-dp').removeAttr("data-toggle");
                $('#tab-edit-dp').css("cursor", "not-allowed");
                //set_value_event_click(args, "_edit_lunas");
            } else if(args.e.data.tag.status === "DP"){
                $('#tab-edit-pelunasan-dp').click();
                $('#tab-edit-lunas').removeAttr("data-toggle");
                $('#tab-edit-lunas').css("cursor", "not-allowed");
                set_value_event_click(args, "_edit_dp");
            }
            set_value_event_click(args, mode_id);
        };

        dp.init();


    //On Jadwal_bulan change
    $(document).on('change', '#jadwal_bulan', function(event){
        var startD = new Date(now.getFullYear(), $(event.target).val()-1, 1).toString("yyyy-MM-dd");
        var endD = new Date(now.getFullYear(), $(event.target).val(), 0).toString("yyyy-MM-dd");
        dp.days = new Date(now.getFullYear(), $(event.target).val(), 0).getDate();
        //-1 coz it looks like the months are started from 0 instead of 1
        dp.startDate = startD;        
        dp.init();
        get_data_transaksi($('#jadwal_lapangan').val(), startD, endD);
    })

    //calendar
    $(document).on('click', '.fc-widget-content', function(event){
        alert($(event.target).closest('div.fc-time-grid').find('td.fc-day').attr('data-date'));
    })

    //check whether there are any overlapping schedules in the database or not
    function check_schedule_overlap(data){
        $.ajax({
            url: "<?php echo site_url('home/check_data_transaksi/')?>",
            type: "post",
            success: function(data){
                        
            }
        })    
    }

    //load transactions data into fullcalendar
    function arrange_schedule(data){
        //console.log(data);
        dp.events.list = [];
        dp.update();
        for (var i = Object.keys(data).length - 1; i >= 0; i--) {
            var e = new DayPilot.Event(data[i]);
            dp.events.add(e);
        }
    }

    //ajax getting transactions data from database
    function get_data_transaksi(lapangan, start, end){
        $.ajax({
            url: "<?php echo site_url('home/get_data_transaksi')?>"+"/"+lapangan+"/"+start+"/"+end,
            type: "post",
            success: function(data){
                arrange_schedule(data);
            }
        })
    }

    //Check field's schedule from database, for conflicts or overlaps
    function check_jadwal_main(){
        if(mode_id != "_pelunasan_dp"){
            if(mode_id === "_edit_dp" || mode_id === "_edit_lunas"){
                var dataObject =  {
                    tgl_main: $('#tgl_main'+mode_id).val(),
                    jam_mulai: $('#jam_mulai'+mode_id).val(),
                    jam_selesai: $('#jam_selesai'+mode_id).val(),
                    lapangan:  $('#lapangan'+mode_id).val(),
                    id_nota_lapangan: $('#id'+mode_id).val()
                };
            } else{
                var dataObject =  {
                    tgl_main: $('#tgl_main'+mode_id).val(),
                    jam_mulai: $('#jam_mulai'+mode_id).val(),
                    jam_selesai: $('#jam_selesai'+mode_id).val(),
                    lapangan:  $('#lapangan'+mode_id).val()
                };    
            }
            //console.log(dataObject);
            $.ajax({
                url: "<?php echo site_url('home/check_data_transaksi')?>",
                type: "POST",
                data: dataObject,
                cache: false,
                success: function(response){
                    //console.log(response);
                    if(response[0]['status'] != "CLEAR"){
                        alert("Lapangan "+response[0]['lapangan']+" sudah terpakai! \nPada tanggal "+response[0]['tgl_main']+" antara pukul "+(response[0]['jam_mulai']).substr(0,5)+" s/d "+(response[0]['jam_selesai']).substr(0,5)+". \nSilahkan ganti lapangan/jam/hari lain.");
                        $('#jam_mulai'+mode_id).val("");
                        $('#jam_selesai'+mode_id).val("");
                        $('#jam_mulai'+mode_id).focus();
                    }
                }
            });
        }        
    }

    //Get schedule from selected court
    $('#jadwal_lapangan').change(function(event){
        $('#lapangan_dp').val($(event.target).val());
        $('#lapangan_lunas').val($(event.target).val());
        get_data_transaksi($(event.target).val());
    })

    //Hitung jumlah bayar berdasar jam
    $(".jam_main").change(function (){
        calculate_total();
    })

    // OVERRIDE PENGGUNA
    $(document).on('click', '.override_pengguna', function override_pengguna(event) {
        //alert($(event.target).attr("name"));
        $('#override-form')[0].reset(); // reset form on modals
        $('#override-form .form-group').removeClass('has-error'); // clear error class
        $('#override-form .help-block').empty(); // clear error string
        
        $('#modal-override').modal('show'); // show bootstrap modal
        $('#modal-override .modal-title').text('Override Pengguna'); // Set Title to Bootstrap modal title
    });

    $(document).on('click', '#reset_override', function reset_override() {
        $('#override-form')[0].reset();

        $('#override-form .form-group').removeClass('has-error'); // clear error class
        $('#override-form .help-block').empty(); // clear error string
    })

    $(document).on('click', '#save_override', function save_override(event)
    {
        $('#btnSaveOverride').text('Saving...'); //change button text
        $('#btnSaveOverride').attr('disabled',true); //set button disable
     
        // ajax adding data to database
        $.ajax({
            url : "<?php echo site_url('login/ajax_override_pengguna')?>",
            type: "POST",
            data: $('#override-form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
     
                if(data.status) //if success close modal and update input main-form
                {
                    $('#modal-override').modal('hide');
                    
                    // update input text in main-form
                    if(mode_id === "_dp" || mode_id === "_lunas"){
                        $('[name="override_view"]').val('ID: ' + data.user_id + ' (' + data.username + ')');
                        $('.override_dp_lunas').val(data.user_id);
                    }else{
                        $('[name="override_view'+mode_id+'"]').val('ID: ' + data.user_id + ' (' + data.username + ')');
                        $('#override'+mode_id).val(data.user_id);   
                    }
                    
                    $('.override'+mode_id).removeAttr('disabled');
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
    })

    $(document).on('click', '#tambah_jadwal', function(){
        $('.active form.form-tambah').submit();
    })

    $(document).on('click', '#edit_jadwal', function(){
        $('.active form.form-edit').submit();
    })

    $('.form-submit').submit(function(event){
        $(".submit").removeAttr("disabled");
    })

    //CHANGE TAB/MODE ID
    $(document).on('click', '.modal-tab', function(event){
        if(mode_id)
            mode_temp = mode_id;
        
        mode_id = $(event.target).attr('name');
        //alert(mode_id);
        $('.bayar').val("");
        
        if(mode_temp){            
            $("#jam_mulai"+mode_id).val($("#jam_mulai"+mode_temp).val());
            $('#jam_selesai'+mode_id).val($('#jam_selesai'+mode_temp).val());
        }        
        calculate_total();
        //alert(mode_id);
    })

    $(document).ready(function() {
        get_data_transaksi(1, new Date(now.getFullYear(), now.getMonth(), 1).toString("yyyy-MM-dd"), new Date(now.getFullYear(), now.getMonth()+1, 0).toString("yyyy-MM-dd"));
        $('#daypilot').append($('#daypilot div:first-child').html());
    });

    function set_value_event_click(args, mode){        
        $('#id'+mode).val(args.e.data.id);
        $('#tgl'+mode).val(args.e.data.tag.tgl_dp);
        $('#tgl_lunas'+mode).datetimepicker('setDate', new Date());
        $('#nama'+mode).val(args.e.data.text);
        $('#telp'+mode).val(args.e.data.tag.telp);
        $('#lapangan'+mode).val($('#jadwal_lapangan').val());
        $('#tgl_main'+mode).val(args.e.data.tag.tgl_main);
        $('#jam_mulai_old').val(args.e.data.tag.jam_mulai);
        $('#jam_selesai_old').val(args.e.data.tag.jam_selesai);
        $('#jam_mulai'+mode).val(args.e.data.tag.jam_mulai);
        $('#jam_selesai'+mode).val(args.e.data.tag.jam_selesai);
        $('#total_bayar'+mode).val(args.e.data.tag.total_bayar);
        $('#bayar'+mode).val(args.e.data.tag.bayar_dp);
        $('#diskon_bayar'+mode).val(args.e.data.tag.diskon);
        $('#kurang_bayar'+mode).val(parseInt(args.e.data.tag.total_bayar) - parseInt(args.e.data.tag.bayar_dp) - parseInt(args.e.data.tag.diskon));
        $('#bayar_lunas'+mode).val(parseInt(args.e.data.tag.total_bayar) - parseInt(args.e.data.tag.bayar_dp) - parseInt(args.e.data.tag.diskon));
        $('#bonus'+mode).val(args.e.data.tag.bonus);
        $('#keterangan'+mode).val(args.e.data.tag.keterangan);
        $('#edit_transaksi').modal('show');
    }

    function get_datenow(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

        return yyyy+'-'+mm+'-'+dd;
    }
</script>
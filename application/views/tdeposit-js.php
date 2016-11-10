<script src='<?=base_url()?>assets/js/typeahead.bundle.js'></script>
<script type="text/javascript">
    $status_customer="ada";    

	$(document).on('click', '.override_pengguna', function override_pengguna(event) {                
        $('#override-form')[0].reset(); // reset form on modals
        $('#override-form .form-group').removeClass('has-error'); // clear error class
        $('#override-form .help-block').empty(); // clear error string
        
        $('#modal-override').modal('show'); // show bootstrap modal
        $('#modal-override .modal-title').text('Override Pengguna'); // Set Title to Bootstrap modal title
    });

    $(document).on('click', '#add_password', function add_password(event){               
        $('#password-form')[0].reset(); // reset form on modals        
        $('#password-form .form-group').removeClass('has-error'); // clear error class
        $('#password-form .help-block').empty(); // clear error string
        
        $('#modal-password').modal('show'); // show bootstrap modal
        $('#modal-password .modal-title').text('Tambahkan Password'); // Set Title to Bootstrap modal title
    });

    $(document).on('click', '#change_password', function change_password(event){                       
        $('#changePassword-form')[0].reset(); // reset form on modals
        $('#changePassword-form .form-group').removeClass('has-error'); // clear error class
        $('#changePassword-form .help-block').empty(); // clear error string
        
        $('#modal-changePassword').modal('show'); // show bootstrap modal
        $('#modal-changePassword .modal-title').text('Ganti Password'); // Set Title to Bootstrap modal title
    });

    $('#inputdeposit').on('hidden.bs.modal', function(){
        $('#reset_input_deposit').click();
    })

    $(document).on('click', '#reset_override', function reset_override() {
        $('#override-form')[0].reset();

        $('#override-form .form-group').removeClass('has-error'); // clear error class
        $('#override-form .help-block').empty(); // clear error string
    })

    $(document).on('click', '#reset_password', function reset_password() {
        $('#password-form')[0].reset();

        $('#password-form .form-group').removeClass('has-error'); // clear error class
        $('#password-form .help-block').empty(); // clear error string
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
                    $('[name="override_view"]').val('ID: ' + data.user_id + ' (' + data.username + ')');
                    $('[name="override"]').val(data.user_id);
                    $('.override').removeAttr('disabled');
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

    //Add customer password
    $('#save_password').click(function(){        
        var url = "<?php echo base_url() ?>tdeposit/save_password_customer/"+$('#kode').val()+"/"+$('#password').val();        
        if($('#save_password').attr('tag')==="old"){ //customer exist, add new password to current customer
            if($('#password').val() === $('#confirm_password').val()){            
                $.ajax({
                    url: url,
                    type: "POST",
                    success: function(data){                    
                        $('#modal-password').modal('hide');
                        $('#add_password').attr('style', 'display: none;');
                        $('#add_deposit').removeAttr('style');
                        $('#change_password').removeAttr('style');
                    }
                })
            }else{
                $('.help-block').val("periksa ulang password anda");
                $('#password-form')[0].reset();
            }
        }else{ //customer didn't exist, save password in main deposit form
            if($('#password').val() === $('#confirm_password').val()){            
                $('#new_password').val($('#password').val())
            }else{
                $('.help-block').val("periksa ulang password anda");
                $('#password-form')[0].reset();
            }
        }
        
    });

    //Change customer password
    $('#save_new_password').click(function(){
        var cek;
        //Check current password to system
        if($('#change_current').val()!=""){
            var url = "<?php echo base_url() ?>tdeposit/cek_password_customer/"+$('#kode').val()+"/"+$('#change_current').val();        
            $.ajax({
                url: url,
                type: "POST",
                success: function(data){
                    cek = data;                    
                }
            })
        }        

        if(cek === "true" || cek === true){
            //confirm and password already the same
            if($('#change_password').val() === $('#change_confirm').val()){
                $('#new_password').val($('#change_password').val());
                $('#modal-changePassword').modal('hide');
            }else{
                $('.help-block').val("periksa ulang password anda");
                $('#changePassword-form')[0].reset();
            }
        }            
    });

    var idcustomer = [];
    var nama = [];
    var email = [];
    var saldo = [];
    var pass = [];
    $('#kode').focus(function(){
        //alert("aaaa");
        var $input = $('#kode');
        if(idcustomer.length === 0){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>tdeposit/get_master_customer',
                success:function(data){
                    console.log(data);
                    for(var i = 0; i<data.length; i++){
                        idcustomer.push(data[i]['id_customer']);
                        nama.push(data[i]['nama']);
                        email.push(data[i]['email']);
                        saldo.push(data[i]['saldo']);
                        pass.push(data[i]['password']);
                    }
                }
            });
        }

        $input.typeahead({source:idcustomer, 
        autoSelect: true}); 

        $input.change(function() {        	                        
            var current = $input.typeahead("getActive");
            var index = idcustomer.indexOf(current);
            $('#nama_customer').val("");
            $('#nama_customer').attr('disabled', 'disabled');
            $('#email_customer').val("");
            $('#email_customer').attr('disabled', 'disabled');
            $('.submit').val("");
            //alert($input.val()+"a a"+current);

            if($input.val() === current){
                $('#nama_customer').val(nama[index]);
                $('#email_customer').val(email[index]);
                if(saldo[index] === null) 
                	$('#saldo_awal').val(0);
                else
                	$('#saldo_awal').val(saldo[index]);

                if($('#total_deposit').val() != ""){
                	$('#saldo_akhir').val(($('#total_deposit').val()/1)+(saldo[index]/1));
                }
                //customer's password still empty
                if(pass[index] === "no"){
                    $('#add_deposit').attr('style', 'display: none;');
                    $('#change_password').attr('style', 'display: none;');
                    $('#add_password').removeAttr('style');
                    $('#save_password').attr('tag','old');
                }else{//change customer password
                    $('#add_password').attr('style', 'display: none;');
                    $('#add_deposit').removeAttr('style');
                    $('#change_password').removeAttr('style');
                }
            }else{//customer didn't exist (new customer)
                $('#nama_customer').removeAttr('disabled');
                $('#email_customer').removeAttr('disabled');
                $('#add_deposit').attr('style', 'display: none;');
                $('#change_password').attr('style', 'display: none;');
                $('#add_password').removeAttr('style');
                $('#save_password').attr('tag','new');                
            }
        });

    });

    function hitungDeposit(){
    	var totalDeposit = ($('#jml_deposit').val()/1) + ($('#jml_bonus').val()/1);
    	$('#total_deposit').val(totalDeposit);
    	$('#saldo_akhir').val(($('#saldo_awal').val()/1) + totalDeposit);
    }

    $(document).on('change', '#jml_deposit', function(){
    	$('#jml_bonus').val($('#jml_deposit').val()/10);
    	hitungDeposit();
    });

    $(document).on('change', '#jml_bonus', function(){    	
    	hitungDeposit();
    });

    $(document).on('click', '#add_deposit', function(){
    	$('.submit').removeAttr('disabled');
    });
</script>
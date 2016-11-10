<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.js"></script>


<script type="text/javascript">
	$(document).ready(function (){
		var override_id;
		var form;


		//SECTION AUTO COMPLETE
		var idcustomer = [];
	    var nama = [];
	    var email = [];
	    var saldo = [];
	    $('.kode').focus(function(event){
	        var $input = $(event.target);	        
	        if(idcustomer.length == 0){
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
		//Hitung Total Bayar dari Jam Main
		$(".jam_main").change(function (){
			if($("#jam_mulai_dp").val() != "" && $('#jam_selesai_dp').val() != ""){
				var mulai =  $("#jam_mulai_dp").val();
				var selesai = $('#jam_selesai_dp').val();
				var total = parseInt(selesai) - parseInt(mulai);
				total = total * 50000;
				$('#total_bayar_dp').val(total);
			} else if($("#jam_mulai_lunas").val() != "" && $('#jam_selesai_lunas').val() != ""){
				var mulai =  $("#jam_mulai_lunas").val();
				var selesai = $('#jam_selesai_lunas').val();
				var total = parseInt(selesai) - parseInt(mulai);
				total = total * 50000;
				$('#total_bayar_lunas').val(total);
				$('#bayar_lunas').val(total);
			}
		})

		//Hitung Kurang Bayar dari Jumlah diskon || NOT DONE YET
		$('#diskon_bayar_dp').change(function (){			
			/*
			CHECK SESSION LAMA
			check_session("check", function(data){
				if(data == "true"){
					$('#kurang_bayar').val(parseInt($('#kurang_bayar').val())-parseInt($('#diskon_bayar_dp').val()));
					$('#total_bayar').val(parseInt($('#total_bayar').val())-parseInt($('#diskon_bayar_dp').val()));
				} else{
					$('#diskon_bayar_dp').val("");
					$('#diskon_bayar_dp').attr("disabled", "disabled");
				}
			});*/

			if($('[name="override"]').val() != ""){
				$('#kurang_bayar_dp').val(parseInt($('#kurang_bayar_dp').val())-parseInt($('#diskon_bayar_dp').val()));
				$('#total_bayar_dp').val(parseInt($('#total_bayar_dp').val())-parseInt($('#diskon_bayar_dp').val()));
			} else{
				$('#diskon_bayar_dp').val("");
				$('#diskon_bayar_dp').attr("disabled", "disabled");
			}
		})

		//Hitung Kurang Bayar dari Jumlah diskon
		$('#diskon_bayar_pelunasan_dp').change(function (){			
			if($('[name="override"]').val() != ""){
				//$('#total_bayar_pelunasan_dp').val(parseInt($('#total_bayar_pelunasan_dp').val())-parseInt($('#diskon_bayar_pelunasan_dp').val()));
				//$('#bayar_lunas_pelunasan_dp').val(parseInt($('#bayar_lunas_pelunasan_dp').val())-parseInt($('#diskon_bayar_pelunasan_dp').val()))
				hitung_pelunasan();
			} else{
				$('#diskon_bayar_pelunasan_dp').val("");
				$('#diskon_bayar_pelunasan_dp').attr("disabled", "disabled");
			}
		})

		function hitung_pelunasan(){
			var mulai =  $("#jam_mulai_pelunasan_dp").val();
			var selesai = $('#jam_selesai_pelunasan_dp').val();
			var total = parseInt(selesai) - parseInt(mulai);
			total = total * 50000;
			$('#total_bayar_pelunasan_dp').val(total-parseInt($('#diskon_bayar_pelunasan_dp').val()));
			$('#bayar_lunas_pelunasan_dp').val($('#total_bayar_pelunasan_dp').val() - $('#bayar_pelunasan_dp').val());
		}
		//SECTION HITUNG END



		$('.btn-submit').click(function (){
			$('.submit').removeAttr("disabled");
		})

		//Hitung Kurang Bayar dari Bayaran DP
		$('#bayar_dp').change(function (){
			$("#kurang_bayar").val(parseInt($('#total_bayar').val())-parseInt($('#bayar_dp').val()));
		})

		$(document).on('click', '.pelunasan_dp', function(event){
			$('#tab-edit-pelunasan-dp').click();		
			set_value_event_click(event, "_pelunasan_dp");
			set_value_event_click(event, "_edit_dp");
		})

		//to tell the submit button which tab is active. Save the value to form global variable
		$(document).on('click', '.modal-tab', function(event){
			form = $(event.target).attr("name");
			form = form.substring(1);			
		})

		//#edit_jadwal is an save button for multiple tabs, when it clicked, it will submit the active one
		$(document).on('click', '#edit_jadwal', function(event){			
			$('.submit').removeAttr("disabled");
			$('#form_'+form).submit();
		})

		//what to do when form is just submitted
		$(document).on('submit', '.form-edit', function(){			
			alert("aaaa");
		})

		//when batal_transaksi button clicked
		$(document).on('click', '.batal_transaksi', function(event){
			e.preventDefault();
				
			var d = confirm('Hapus user?');
			if (d == true){				
				var id = $(event.target).closest('tr').children('td.id_nota_lapangan').text();
				$.ajax({
					url: "<?php echo base_url() ?>tlapangan/batal_transaksi/"+id,
	                type: "POST",
	                success: function(data){

	                },
					error: function  (data) {
						alert('terjadi kesalahan, gagal');
						return false;
					}	
				})		
			}else{
				return false;
			}
			$(this).closest('tr').fadeOut(function () {
				$(this).remove();
			})							
		})

		function set_value_event_click(args, mode){			
	        $('#id'+mode).val($(args.target).closest('tr').children('td.id_nota_lapangan').text());
	        $('#tgl'+mode).val($(args.target).closest('tr').children('td.tgl_dp').text());
	        $('#tgl_lunas'+mode).datetimepicker('setDate', new Date());
	        $('#nama'+mode).val($(args.target).closest('tr').children('td.nama').text());
	        $('#telp'+mode).val($(args.target).closest('tr').children('td.telp').text());
	        $('#lapangan'+mode).val($(args.target).closest('tr').children('td.lapangan').text());
	        $('#tgl_main'+mode).val($(args.target).closest('tr').children('td.tgl_main').text());
	        $('#jam_mulai_old').val($(args.target).closest('tr').children('td.jam_mulai').text());
	        $('#jam_selesai_old').val($(args.target).closest('tr').children('td.jam_selesai').text());
	        $('#jam_mulai'+mode).val($(args.target).closest('tr').children('td.jam_mulai').text());
	        $('#jam_selesai'+mode).val($(args.target).closest('tr').children('td.jam_selesai').text());
	        $('#total_bayar'+mode).val($(args.target).closest('tr').children('td.total_bayar').text());
	        $('#bayar'+mode).val($(args.target).closest('tr').children('td.bayar_dp').text());
	        $('#diskon_bayar'+mode).val($(args.target).closest('tr').children('td.diskon').text());
	        $('#kurang_bayar'+mode).val(parseInt($('#total_bayar'+mode).val()) - parseInt($('#bayar'+mode).val()) - parseInt($('#diskon_bayar'+mode).val()));
	        $('#bayar_lunas'+mode).val(parseInt($('#total_bayar'+mode).val()) - parseInt($('#bayar'+mode).val()) - parseInt($('#diskon_bayar'+mode).val()));
	        $('#bonus'+mode).val($(args.target).closest('tr').children('td.bonus').text());
	        $('#keterangan'+mode).val($(args.target).closest('tr').children('td.keterangan').text());
	        $('#edit_transaksi').modal('show');
	        alert()
	    }		
		
        // OVERRIDE PENGGUNA        
        $(document).on('click', '.override_pengguna', function override_pengguna(event) {
        	//alert($(event.target).attr("name"));
        	override_id = $(event.target).attr("name");
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
                        $('[name="override_view_'+form+'"]').val('ID: ' + data.user_id + ' (' + data.username + ')');
                        $('[name="override"]').val(data.user_id);
                        $('#diskon_bayar_'+override_id).removeAttr('disabled');
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


		/*
		$(document).on('submit', '#override_dp', function(event){
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			override(formData, function(data){
				if(data == "true"){
					$('#diskon_bayar_dp').removeAttr("disabled");
					$('#modal_override_dp').modal('toggle');
				} else{
					$('#override_dp_notfound').removeClass("hidden");
				}
			});
		})

		$(document).on('submit', '#transaksi_dp', function(event){
			$('#diskon_bayar_ovr').attr("id", "diskon_bayar_dp");
		})

		function override(formData, callback){
			$.ajax({
				type:"POST",
				data:formData,
				async:true,
				url:"<?php echo base_url() ?>login/override_validation/",
				success: function(data){
					//callback check data, karena ajax gabisa check data krn asynchronous
					if(data && callback){
						callback(data);
					}
				},
		        cache: false,
		        contentType: false,
		        processData: false
			});
		}

		function check_session(action, callback){
			$.ajax({
				type:"POST",
				data: {action: action},
				async: true,
				url:"<?php echo base_url() ?>login/check_session/",
				success: function(data){
					if(data && callback){
						callback(data);
					}
				}
			});
		}

	


		$('#nama_customer').change(function(){
			var nama = $('#nama_customer').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>tlapangan/search_nama_customer/"+nama,
				success: function (data){

				}
			})
		})

		$('#telp_customer').change(function(){

		})
		/*
		$('#btn-override').click(function(e){
			e.preventDefault();
			var data;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>login/override_validation/"+data,
				success: function (data) {
					$('#t_body_pelamar').empty();
					for (var i = data.length - 1; i >= 0; i--) {
						$('#t_body_pelamar').append(
							'<tr>'+
								'<td>'+data[i]["np"]+'</td>'+
								'<td>'+data[i]["nama"]+'</td>'+
								'<td><input type="radio" class="select_pelamar" id="'+data[i]['np']+'" name="select_pelamar" value="'+data[i]['np']+'"/></td>'+
							'</tr>'
						);

					};
				},
				error: function (data) {
					console.log(data);
					alert('gagal');
				}
			})
		})*/
	})
</script>
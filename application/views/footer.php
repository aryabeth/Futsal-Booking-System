<section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; 2016 | Technubie
                </div>

            </div>
        </div>
    </section>

    <script src="assets/js/jquery-2.1.3.js"></script>
    <script src="assets/js/bootstrap3-typeahead.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="assets/js/md5.js"></script>

    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>

    <link href='<?=base_url()?>assets/js/fullcalendar.css' rel='stylesheet' />
    <link href='<?=base_url()?>assets/js/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='<?=base_url()?>assets/js/lib/moment.min.js'></script>
    
    <!-- <script src='<?=base_url()?>assets/js/fullcalendar.min.js'></script> -->
    <script src='<?=base_url()?>assets/js/date.js'></script>

    <script src='<?=base_url()?>assets/js/fullcalendar.min.js'></script>
    <script src="<?=base_url()?>assets/js/daypilot-all.min.js"></script>


    <script type="text/javascript">

    $('.datepicker').datetimepicker({
        format: 'dd-mm-yyyy',
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    $('#datepick').datetimepicker({
        format: 'dd-mm-yyyy',
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

    $(document).ready(function() {

        $('#datepick').on("changeDate", function() {
            $('#my_hidden_input').val(
                $('#datepick').datetimepicker('getDate')
            );

            console.log($('#datepick').datetimepicker('getDate').getDate());
            var dd = $('#datepick').datetimepicker('getDate').getDate(),
            mm = $('#datepick').datetimepicker('getDate').getMonth()+1,
            yy = $('#datepick').datetimepicker('getDate').getFullYear(),
            date = yy+'-'+mm+'-'+dd;

            console.log(date);

            var m = moment(date);
            $('#calendar').fullCalendar('gotoDate', m);
        });
        
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            defaultDate: get_datenow(),
            defaultView: 'agendaDay',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: {
                url: '',
                error: function() {
                    $('#script-warning').show();
                }
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            }
        });
        
    });

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

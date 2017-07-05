@extends('layouts.app')
@include('appointment.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/fullcalendar-print.css')}}" media="print">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Calendar</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                <h3 class="module-title">Calendar</h3>
                                <ul class="actions list-inline">

                                    <li><a class="collapse-module" data-toggle="collapse" href="#content-1" aria-expanded="false" aria-controls="content-1"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                                    <li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>
                                </ul>
                            </div>
                            <div class="module-content collapse in" id="content-1">
                                <div class="module-content-inner">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- Modal for creating customer -->
    <div class="modal appointmentModal" id="appointment-modal" role="dialog" aria-labelledby="appointment-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-appointment-label">Add New Appointment</h4>
                </div>
                <div class="modal-body">
                    @yield('appointment-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection

@section('after-footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script type="text/javascript">

        var min_date = moment();
        var max_date = moment();
           /* "use strict";
            $("#calendar").fullCalendar({
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "month,basicWeek,basicDay"
                },
                defaultDate: moment(),
                editable: !0,
                eventLimit: !0,
                eventSources: [
                    "{{route('ajax-get-events')}}",
                ],
                eventClick: function(event) {



                    console.log(event);




                    $('#appointment-modal').modal('show');
                },


            })*/





            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

                events: "{{route('ajax-get-events')}}",

                selectable: true,
                selectHelper: true,

                eventClick: function(event) {

                    console.log(event);
                    jQuery("#aptCustomerId").select2({
                        placeholder: "Select a Customer",
                        allowClear:true,
                        ajax: {
                            url: "{{route('get-customer-options')}}",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                };
                            },
                            processResults : function (data){
                                //console.log(data);
                                return {
                                    results: data.customers
                                }
                            },

                            cache: true
                        }

                    });
                    jQuery('.modal').on('shown.bs.modal', function () {


                        $('#startTime').datetimepicker({});
                        $('#endTime').datetimepicker({ useCurrent: false});



                        updateDates();


                    });

                    $("#startTime").on("dp.change", function (e) {
                        min_date=e.date;
                    });
                    $("#endTime").on("dp.change", function (e) {
                        max_date=e.date;
                    });


                    function updateDates(){
                        $('#startTime').data("DateTimePicker").date(min_date);
                        $('#startTime').data("DateTimePicker").minDate(moment());
//                $('#startTime').data("DateTimePicker").maxDate(max_date);
                        $('#endTime').data("DateTimePicker").date(max_date);
                        $('#endTime').data("DateTimePicker").minDate(min_date);
                    }

                    $('#appointment_modal_button').val('Update Appointment');
                    $('#modal-new-appointment-label').text('Edit Appointment');
                    $('#startTime').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#endTime').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#aptCustomerId').html("<option selected value='"+event.customer_id+"'>"+event.customer.first_name+', '+ event.customer.last_name+'@'+event.customer.company.name+"</option>");
                    jQuery('#appointment_id').val(event.id);
                    jQuery('#appointmentTitle').val(event.title);
                    jQuery('#appointmentDescription').val(event.description);
                    jQuery('#appointmentStatus').val(event.status);
                    $('#appointment-modal').modal('show');

                    min_date = moment(data.appointment.start_time);
                    max_date = moment(data.appointment.end_time);

                    updateDates();
                },


            });

           $('#appointment_modal_button').click(function(e){
               e.preventDefault();
               var _token = $('input[name="_token"]').val();
               var appointment = {
                   appointmentId : $('#appointment_id').val(),
                   aptCustomerId : $('#aptCustomerId').val(),
                   appointmentTitle : $('#appointmentTitle').val(),
                   appointmentDescription : $('#appointmentDescription').val(),
                   appointmentStatus : $('#appointmentStatus').val(),
                   startTime : $('#startTime').val(),
                   endTime : $('#endTime').val()
               };
               var data = {
                   _token : _token,
                   appointment: appointment
               };
               var request = jQuery.ajax({
                   url: "{{ route('update.appointment') }}",
                   data: data,
                   method: "POST",
                   dataType: "json"
               });

               request.done(function (response) {
                   if(response.result == 'Saved'){
                       $('#appointmentForm')[0].reset();
                       $('#appointment_id').val('');
                       $('#appointment-modal').modal('hide');
                       $('#calendar').fullCalendar( 'refetchEvents' );
                       jQuery.notify(response.message, "success");
                   }
                   else{
                       jQuery.notify(response.message, "error");
                   }
               })

               request.fail(function (jqXHT, textStatus) {
                   $.notify(textStatus, "error");
               });
           });





    </script>
@endsection
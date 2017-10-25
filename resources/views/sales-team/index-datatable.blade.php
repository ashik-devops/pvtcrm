@extends('layouts.app')
@include('sales-team.create-form')
@include('task.task-view')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">

    <style type="text/css">
        .datetimepicker{
            z-index: 999 !important;
        }
        .select2-search__field{
            width: auto !important;
        }
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Sales Teams</h2>

                <div class="actions">
                    <button id="new-task-btn" class="btn btn-success" data-toggle="modal" data-target="#sales-team-modal"><i class="fa fa-plus"></i> New Sales Team</button>
                </div>

            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">Tasks</h3>--}}

                            </div>

                            <div class="module-content collapse in" id="customers">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="table-responsive">
                                        <table id="customers-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>User</th>
                                                <th>Manager</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
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
    <div class="modal customerModal" id="sales-team-modal" role="dialog" aria-labelledby="sales-team-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-sales-team-label">Add New Sales Team</h4>
                </div>
                <div class="modal-body">
                    @yield('sales-team-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection



@section('after-footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script type="text/javascript">

        var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            ajax: '{!! route('sales-team-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name'},
                { data: 'user', name: 'user'},
                { data: 'note', name: 'note'},
                { data: 'action', name: 'action', orderable: false, searchable: false},


            ]
        });

        var sales_member_select=jQuery("#userId").select2({
            placeholder: "Sales Team Member",
            ajax: {
                url: "{{route('list-users')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults : function (data){

                    return {
                        results: JSON.parse(JSON.stringify(data.items).replace(new RegExp("\"name\":", 'g'), "\"text\":"))
                    }
                },
                cache: true
            }
        });

        $('#salesTeamForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            var salesTeam = {
                salesTeamId : $('#salesTeam_id').val(),
                userId : $('#userId').val(),
                salesTeamName : $('#salesTeamName').val(),
                salesTeamNote : $('#salesTeamNote').val(),
            };

            var data = {
                _token : _token,
                salesTeam: salesTeam
            };

            console.log(salesTeam);

            if(salesTeam.salesTeamId < 1){
                //customer creating.....


                var request = jQuery.ajax({
                    url: "{{ route('create.sales.team') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {

                    if(response.result){
                        if(response.result == 'Saved') {
                            $('#salesTeamForm')[0].reset();
                            jQuery("#salesTeamId").html("");
                            $('#sales-team-modal').modal('hide');
                            get_all_sales_team_data();
                            $.notify(response.message, "success");

                        }
                        else{
                            jQuery.notify(response.message, "error");

                        }
                    }

                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");

                });

            }
            else{
                //updating sales team.....

                var request = jQuery.ajax({
                    url: "{{ route('update.sales.team.data') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        $('#salesTeamForm')[0].reset();
                        jQuery("#salesTeamId").html("");
                        $('#sales-team-modal').modal('hide');
                        get_all_sales_team_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })

                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }
        });

        function editSalesTeam(id){
            $('#modal_button').val('Update Sales Team');
            $('#modal-new-sales-team-label').text('Edit Sales Team');

            $.get("{{ route('edit.sales.team.data') }}", { id: id} ,function(data){
                console.log(data.salesTeam);
                if(data){
                    $('#salesTeam_id').val(data.salesTeam.id);
                    $('#userId').html("<option selected value='"+data.user.id+"'>"+ data.user.name+ "</option>");
                    $('#salesTeamName').val(data.salesTeam.name);
                    $('#salesTeamNote').val(data.salesTeam.note);


                }

            });

            $('#sales-team-modal').modal('show');
        }

        function deleteSalesTeam(id){
            var _token = $('input[name="_token"]').val();
            var data = {
                _token : _token,
                id: id
            };
            swal({
                    title: "Are you sure?",
                    text: "This Information will be trashed!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {

                        //deletion process is going on....


                        $.post("{{ route('delete.sales.team') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Sales Team has been deleted.", "success");
                                get_all_sales_team_data();
                                $.notify('Sales Team deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the company", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Sales Team is safe :)", "error");
                    }
                });
        }
        function get_all_sales_team_data(){
            datatable.ajax.reload(null, false);
        }

    </script>

    @yield('sales-team-form-scripts')

@endsection
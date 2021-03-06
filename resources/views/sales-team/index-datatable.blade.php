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
@can('create', \App\SalesTeam::class)
                <div class="actions">
                    <button id="new-task-btn" class="btn btn-success" data-toggle="modal" data-target="#sales-team-modal"><i class="fa fa-plus"></i> New Sales Team</button>
                </div>
@endcan
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
                                                <th>User Count</th>
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
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript">

        var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            paging:true,
            ajax: '{!! route('sales-teams-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name'},
                { data: 'user_count', name: 'user_count'},
                { data: 'manager_name', name: 'manager_name'},
                { data: 'action', name: 'action', orderable: false, searchable: false},


            ]
        });






        function editSalesTeam(id){
            var request =  jQuery.ajax({
                method: "GET",
                url: "{{route('sales-team-data')}}",
                data: {salesTeamId: id},
                dataType:'json',

            });

            request.done(function(response){
                jQuery("#"+inputMap.salesTeamId).val(response.salesTeam.id);
                jQuery("#"+inputMap.salesTeamName).val(response.salesTeam.name);
                jQuery("#sales-team-modal #modal-new-sales-team-label.modal-title").html("Edit Sales Team: "+response.salesTeam.name);
                jQuery("#sales-team-modal #sales_team_form_submit").html("Update");
                jQuery("#sales-team-modal").modal('show');

                var members = response.salesTeam.members.map(function(obj){
                    return new Option(obj.name, obj.id, true, true);
                });

                var manager = response.salesTeam.managers.map(function(obj){
                    return new Option(obj.name, obj.id, true, true);
                });

                member_select.val(null).trigger('change.select2');
                manager_select.val(null).trigger('change.select2');
                member_select.append(members).trigger('change.select2');
                manager_select.append(manager[0]).trigger('change.select2');
            });
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });


        }



        function deleteSalesTeam(id){
            var _token = $('input[name="_token"]').val();
            var data = {
                _token : _token,
                salesTeamId: id
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

        jQuery("#sales-team-modal").on('hidden.bs.modal', function(){
            reset_form(jQuery("#sales-teamForm")[0]);
        });
        function reset_form(el) {
            el.reset();
            member_select.val(null).trigger('change.select2');
            manager_select.val(null).trigger('change.select2');
            jQuery("#"+inputMap.salesTeamId).val('');
            console.log("cleared");

        }


    </script>

    @yield('sales-team-form-scripts')


@endsection
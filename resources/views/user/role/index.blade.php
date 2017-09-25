@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Roles</h2>
            <div class="actions">
                <a class="btn btn-success" href="{{route('create-role-form')}}"><i class="fa fa-plus"></i>New Role</a>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                            </div>

                            <div class="module-content collapse in" id="customers">
                                {{ csrf_field() }}
                                @if(Session::has('message'))

                                    <div class="alert {{ Session::get('message_class') }} alert-theme alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        {{ Session::get('message') }}
                                    </div>

                                @endif

                                <div class="module-content-inner no-padding-bottom">
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <table id="roles-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>User Count</th>
                                                <th>Actions</th>
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

@section('after-footer-script')

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>

    <script type="text/javascript">
        var token = jQuery('input[name="_token"]').val();
        var roles_datatable = jQuery('#roles-table').DataTable({
            serverSide: true,
            paging:true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('roles-list-data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'count', name: 'count'},
                { data: 'action', name: 'action', orderable: false, searchable: false},

            ],
        });

        function deleteRole(id) {
            swal({
                    title: "Are you sure?",
                    text: "This Information will be deleted!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        //deletion process is going on....
                        var request = $.ajax({
                            url: "{{route('delete-role')}}",
                            data: {"id": id, '_token': token},
                            type: 'DELETE',
                            dataType: 'json'
                        });
                        request.success(function (response){
                            if (response.result == 'Success') {
                                swal("Deleted!", response.message, "success");
                                reload_roles_datatable();
                            }
                            else {
                                swal("Failed", response.message, "error");
                            }
                        });

                    }
                    else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }

        function reload_roles_datatable(){
            roles_datatable.ajax.reload(null, false);
        }


    </script>
@endsection
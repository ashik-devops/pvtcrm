@extends('layouts.app')
@include('user-group.create-form')
@include('user-group.user-group-view')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">
@endsection


@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">User Groups</h2>

            <div class="actions">
                <button id="new-apt-btn" class="btn btn-success" data-toggle="modal" data-target="#usergroup-modal"><i class="fa fa-plus"></i>New Group</button>
            </div>
        </div>
    </div>

            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                {{--<h3 class="module-title">User Group</h3>--}}

                            </div>

                            <div class="module-content collapse in" id="groups">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="table-responsive">
                                        <table id="customers-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
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
                <div class="modal usergroupModal" id="usergroup-modal" role="dialog" aria-labelledby="usergroup-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-new-usergroup-label">Add New User Group</h4>
                            </div>
                            <div class="modal-body">
                                @yield('usergroup-create-form')
                            </div>
                        </div>
                    </div>
                </div><!--/modal-->

            <div class="modal usergroupModal" id="usergroup-modal-view" role="dialog" aria-labelledby="usergroup-modal-view">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modal-view-usergroup-label"> User Group View</h4>
                        </div>
                        <div class="modal-body">
                            @yield('usergroup-view')
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
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            ajax: '{!! route('usergroup-data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},


            ]
        });

    </script>
@endsection
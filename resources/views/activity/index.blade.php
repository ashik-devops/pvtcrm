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

                                <div class="module-content-inner no-padding-bottom">
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <table id="activity-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>User</th>
                                                <th>Summary</th>
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
    {{--<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>

    <script>
        $('#activity-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('activities.all.data')}}",
            columns: [
                {data: 'created_at', name: 'created_at'},
                {data: 'user', name: 'user'},
                {data: 'summary', name: 'summary'}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement('input');
                    $(input).appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? val : '', true, false).draw();
                        });
                });
            }
        });
    </script>
@endsection
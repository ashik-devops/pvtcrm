@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">

    <style>
        #filters-contaier{margin-bottom: 15px;}
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Activities</h2>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                            </div>

                            <div class="module-content collapse in" id="customers">
                                {{ csrf_field() }}

                                <div class="module-content-inner no-padding-top">
                                    <div class="clearfix"></div>

                                    <div class="module-content collapse in" id="tasks">
                                        <div class="module-content-inner no-padding-middle">
                                            <div class="row" id="filters-contaier">
                                                <form action="#" id="filterForm">
                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="input-group date form-group" id="filterFromDateContainer">
                                                            <input id="filterFromDate" value="{{$from}}" type="text" name="from-date" class="form-control" placeholder="Started Date" >

                                                            <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                                                        </div>

                                                        <div class="input-group form-group date" id="filterToDateContainer">
                                                            <input id="filterToDate" value="{{$to}}" type="text" name="to-date" class="form-control" placeholder="Ended Date">

                                                            <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="form-group">
                                                            <select id="userSelect" name="user" class="form-control select2" style="min-width: 200px;">
                                                                <option value="" selected>All Users</option>
                                                                <option value="-1">System</option>
                                                            @foreach(\Illuminate\Support\Facades\Auth::user()->getSubordinates() as $user)
                                                                    {{$user=\App\User::find($user)}}
                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <select id="typeSelect" name="type" class="form-control select2" style="min-width: 200px;">
                                                                <option value="" selected>All Types</option>
                                                                @foreach(\Spatie\Activitylog\Models\Activity::distinct()->get(['description']) as $type)
                                                                    <option value="{{$type->description}}">{{mb_convert_case($type->description, MB_CASE_TITLE)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-4">
                                                        <button type="submit" id="filter-submit" class="btn btn-success">Filter</button>
                                                    </div>

                                                </form>

                                            </div>
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
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>

    <script>
        var activityTable= $('#activity-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('activities.all.data')}}",
                data: function (data) {
                    data.from = jQuery("#filterFromDate").val();
                    data.to = jQuery("#filterToDate").val();
                    data.user = jQuery("#userSelect").val();
                    data.type = jQuery("#typeSelect").val();
                }
            },
            columns: [
                {data: 'created_at', name: 'created_at'},
                {data: 'user', name: 'user'},
                {data: 'summary', name: 'summary'}
            ],

            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

        jQuery("#filterForm").submit(function(e){
            e.preventDefault();
            activityTable.draw();

        });


        $('#filterFromDateContainer').datetimepicker();
        $('#filterToDateContainer').datetimepicker();
        $(".select2").select2();

    </script>
@endsection
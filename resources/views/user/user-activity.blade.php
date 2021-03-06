@section('user-activity-index')
                                            <div class="row" id="filters-container">
                                                <form id="filterForm">
                                                    <div class="col-xs-4 col-md-4">
                                                        <div class="input-group date form-group" id="filterFromDateContainer">
                                                            <input id="filterFromDate" value="{{\Carbon\Carbon::today()->firstOfMonth()->startOfDay()->format('m/d/Y H:i A')}}" type="text" name="from-date" class="form-control" placeholder="Started Date" >

                                                            <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                                                        </div>

                                                        <div class="input-group form-group date" id="filterToDateContainer">
                                                            <input id="filterToDate" value="{{\Carbon\Carbon::today()->endOfDay()->format('m/d/Y H:i A')}}" type="text" name="to-date" class="form-control" placeholder="Ended Date">

                                                            <span class="input-group-addon"><i class="fa fa-calendar cursor-pointer"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-4 col-md-4">
                                                        <div class="form-group">
                                                            <select id="typeSelect" name="type" class="form-control select2" style="min-width: 200px;">
                                                                <option value="" selected>All Types</option>
                                                                @foreach(\Spatie\Activitylog\Models\Activity::distinct()->get(['type']) as $type)
                                                                    <option value="{{$type->type}}">{{mb_convert_case($type->type, MB_CASE_TITLE)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4">
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

                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

@endsection

@section('view-user-activity-scripts')

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
            order: [[0, 'desc']],
            ajax: {
                url: "{{route('activities.all.data')}}",
                data: function (data) {
                    data.from = jQuery("#filterFromDate").val();
                    data.to = jQuery("#filterToDate").val();
                    data.user = "{{$user->id}}";
                    data.type = jQuery("#typeSelect").val();
                }
            },
            columns: [
                {data: 'created_at', name: 'created_at'},

                {data: 'description', name: 'description'}
            ],

        });

        jQuery("#filterForm").submit(function(e){
            e.preventDefault();
            activityTable.draw();

        });


        $('#filterFromDateContainer').datetimepicker();
        $('#filterToDateContainer').datetimepicker();
        $(".select2").select2({
            width: '200px'
        });

    </script>
@endsection
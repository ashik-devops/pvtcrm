@extends('layouts.app')
@include('customer-company.create-form')

@section('after-head-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.2/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Customer Companies</h2>
            <div class="actions">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-new-member"><i class="fa fa-plus"></i> New Company</button>
            </div>
            <div id="masonry" class="row">
                <div class="module-wrapper masonry-item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-heading">
                                <h3 class="module-title">Customer Companies</h3>
                                <ul class="actions list-inline">
                                    <li><a class="collapse-module" data-toggle="collapse" href="#content-1" aria-expanded="false" aria-controls="content-1"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                                    <li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>
                                </ul>

                            </div>

                            <div class="module-content collapse in" id="customers">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="table-responsive">
                                        <table id="customers-table" class="table table-bordered display" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Website</th>
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

@section('modal')
    <!-- Modal (New Member) -->
    <div class="modal" id="modal-new-member" tabindex="-1" role="dialog" aria-labelledby="modal-new-member">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-ticket-label">Add New User</h4>
                </div>
                <div class="modal-body">
                    @yield('customer-create-from')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection




@section('after-footer-script')
    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
    {{--Build the datatables--}}
    <script type="text/javascript">
        jQuery('document').ready(function() {
            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('company-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name'},
                    { data: 'email', name: 'email' },
                    { data: 'phone_no', name: 'phone_no' },
                    { data: 'website', name: 'website' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });

        });


    </script>

    {{--Handle create form submission--}}
   <!-- <script type="text/javascript">
        jQuery('document').ready(function() {
            jQuery('form.ajax-from').submit(function (e) {

                //clear errors
                jQuery('span.help-block').remove();
                jQuery('.has-error').removeClass('has-error');

                var url = jQuery(this).attr('action'); // the script where you handle the form input.
                var data= jQuery(this).serialize();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data, // serializes the form's elements.
                    success: function(data)
                    {
//                        alert(data); // show response from the php script.
                    },
                    error : function (data ) {
                        var errors = data.responseJSON;
                        console.log(errors);
                        for(var key in errors)
                        {
                            var el = jQuery('#'+key);

                            el.addClass('has-error');
                            el.append("<span class='help-block'><strong>"+errors[key][0]+"</strong></span>");


                        }
                    }

                });

                e.preventDefault();

            });
        });


    </script>-->
@endsection

@extends('layouts.app')
@include('tag.create-form')
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
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Tags</h2>

            <div class="actions">
                <button id="new-task-btn" class="btn btn-success" data-toggle="modal" data-target="#tag-modal"><i class="fa fa-plus"></i> New Tag</button>
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
                                                    <th>Tag</th>
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
    <div class="modal customerModal" id="tag-modal" role="dialog" aria-labelledby="tag-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-tag-label">Add New Task</h4>
                </div>
                <div class="modal-body">
                    @yield('tag-create-form')
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
        var inputMap={
            taskId : 'task_id',
            taskCustomerId : 'taskCustomerId',
            taskTitle : 'taskTitle',
            taskDescription : 'taskDescription',
            taskDueDate : 'taskDueDate',
            taskStatus : 'taskStatus',
            taskPriority : 'taskPriority',
        };


            var datatable = jQuery('#customers-table').DataTable({
//                responsive: false,
                select: true,
                processing: true,
                serverSide: true,
                paging:true,
                ajax: '{!! route('tag-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'tag', name: 'tag'},
                    { data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });

           var customer_select= jQuery("#tagCustomerId").select2({
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
                        return {
                            results: data.customers
                        }
                    },

                    cache: true
                }
            });


        function reset_form(form_el) {
            form_el.reset();

            customer_select.val('').trigger('change');

        }




        //creating tag
        $('#tag_modal_button').val('Add Tag');
        $('#modal-new-tag-label').text('Add A Tag');
        $('#tagForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            //console.log('hello');
            var tag = {
                tagId : $('#tag_id').val(),
                tagName : $('#tagName').val(),
                tagCustomerId : $('#tagCustomerId').val(),


            };

            var data = {
                _token : _token,
                tag: tag
            };

            if(tag.tagId === '') {
                //tag creating.....
                console.log(tag);
                var request = jQuery.ajax({
                    url: "{{ route('create.tag') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if (response.result == 'Saved') {
                        reset_form($('#tagForm')[0]);
                        $('#tag-modal').modal('hide');
                        get_all_tag_data();
                        $.notify(response.message, "success");
                    }
                    else {
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function (xhr) {
                    handle_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }else{

                console.log(tag);
                //tag updating.....

                var request = jQuery.ajax({
                    url: "{{ route('update.tag') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_form($('#tagForm')[0]);
                        $('#tag_id').val('');
                        $('#tag-modal').modal('hide');
                        get_all_tag_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })
                request.error(function(xhr){
                    handle_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            }

        });

        function editTag(id){

             $('#tag_modal_button').val('Update Tag');
            $('#modal-new-tag-label').text('Edit Tag');

            $.get("{{ route('edit.tag') }}", { id: id} ,function(data){
                console.log(data.tag);
                if(data){
                    $('#tag_id').val(data.tag.id);
                    $('#tagCustomerId').html("<option selected value='"+data.customer.id+"'>"+data.customer.first_name+', '+ data.customer.last_name+'@'+data.customer.company.name+"</option>");
                    $('#tagName').val(data.tag.tagname);

                }
            });

            $('#tag-modal').modal('show');
        }


        function deleteTag(id){
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


                        $.post("{{ route('delete.tag') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Tag has been deleted.", "success");
                                get_all_tag_data();
                                $.notify('Task deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the company", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Tag is safe :)", "error");
                    }
                });
        }




        function handle_error(xhr) {

            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showParselyError(key, data[0]);
                });
            }

        }
        function showParselyError(field, msg){
            var el = jQuery("#"+inputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function get_all_tag_data(){
            datatable.ajax.reload(null, false);
        }

    </script>
@endsection
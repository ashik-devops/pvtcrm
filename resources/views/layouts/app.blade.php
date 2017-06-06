@include('layouts.header')
@include('layouts.main-navigation')
@include('layouts.copyright')
@include('layouts.side-panel')

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('before-head-style')
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/elegant-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons-helper.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/tether-shepherd.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jstree-default.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/select2.min.css')}}">
    @yield('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/styles.css')}}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		  <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https:/oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @yield('before-head-script')
    @yield('after-head-script')
    <!-- Styles -->

</head>
<body class="preload nav-toggled">

        @yield('header')
        @yield('main-nav')

        @yield('content')

        <footer>
            @yield('copyright')
        </footer>
        @yield('modal')
        @yield('side-panel')

        @yield('before-footer-script')
        <script src="{{asset('storage/assets/js/jquery.js')}}"></script>
        <script src="{{asset('storage/assets/js/bootstrap.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
       <script src="{{asset('storage/assets/js/metisMenu.js')}}"></script>
       <script src="{{asset('storage/assets/js/notify.js')}}"></script>
        <script src="{{asset('storage/assets/js/imagesloaded.js')}}"></script>
        <script src="{{asset('storage/assets/js/masonry.js')}}"></script>
        <script src="{{asset('storage/assets/js/pace.js')}}"></script>
        <script src="{{asset('storage/assets/js/tether.js')}}"></script>
        <script src="{{asset('storage/assets/js/tether-shepherd.js')}}"></script>
        <script src="{{asset('storage/assets/js/select2.full.min.js')}}"></script>
        <script src="{{asset('storage/assets/js/main.js')}}"></script>
        @yield('after-footer-script')

        <script>
            $(document).ready(function(){
                //For creating Company....
                $('#companyForm').on('submit',function(){
                    event.preventDefault();
                    var _token = $('input[name="_token"]').val();

                    var company = {
                        companyId : $('#company_id').val(),
                        companyName : $('#companyName').val(),
                        companyEmail : $('#companyEmail').val(),
                        companyPhone : $('#companyPhone').val(),
                        companyWebsite : $('#companyWebsite').val(),
                        streetAddress_1 : $('#streetAddress_1').val(),
                        streetAddress_2 : $('#streetAddress_2').val(),
                        city : $('#city_id').val(),
                        state : $('#state_id').val(),
                        country : $('#country_id').val(),
                        zip : $('#zip_id').val()
                    };

                    var data = {
                        _token : _token,
                        company: company
                    };

                    if(company.companyId === ''){
                        //company creating.....
                        $.post("{{ route('create.company') }}", data, function(result){
                            $('#companyForm')[0].reset();
                            $('#modal-new-member').modal('hide');
                            get_all_company_data();
                            $.notify(result, "success");
                        });
                    }else{
                        //company editing.....
                        $.post("{{ route('update.company') }}", data, function(result){
                            $('#companyForm')[0].reset();
                            $('#company_id').val('');

                            $('#modal-new-member').modal('hide');
                            get_all_company_data();
                            $.notify(result, "success");
                            $('#modal_button').val('Add Company');
                        });
                    }
                });
            });

            function editCompany(id){
                $.get("{{ route('edit.modal.data') }}", { id: id} ,function(data){
                    if(data){
                        $('#modal_button').val('Update Company');
                        $('#company_id').val(data.company.id);
                        $('#companyName').val(data.company.name);
                        $('#companyEmail').val(data.company.email);
                        $('#companyPhone').val(data.company.phone_no);
                        $('#companyWebsite').val(data.company.website);

                        if(data.company_address.length > 0){
                            $('#streetAddress_1').val(data.company_address[0].street_address_1);
                            $('#streetAddress_2').val(data.company_address[0].street_address_2);
                            $('#city_id').val(data.company_address[0].city);
                            $('#state_id').val(data.company_address[0].state);
                            $('#country_id').val(data.company_address[0].country);
                            $('#zip_id').val(data.company_address[0].zip);
                        }
                    }
                });
                $('#modal-new-member').modal('show');
            }


            function deleteCompany(id){
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
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {

                            //deletion process is going on....
                            swal("Deleted!", "Company has been deleted.", "success");

                            $.post("{{ route('delete.company') }}", data, function(result){

                                //console.log(result);
                                get_all_company_data();
                                $.notify(result, "danger");
                            });
                        } else {
                            swal("Cancelled", "Company is safe :)", "error");
                        }
                    });
            }

            function get_all_company_data(){
                //$('#customers-table').html('');
                $("#customers-table").dataTable().fnDestroy();
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
            }
        </script>

</body>
</html>

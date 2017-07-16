@extends('layouts.app')
@include('appointment.create-form')
@include('task.create-form')
@section('after-head-style')
    <link rel="stylesheet" href="{{asset('storage/assets/css/dashboard-projects.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view projects-view">
        <div class="container-fluid">
            <h2 class="view-title">Dashboard </h2>
            <div class="row">
                <div class="col-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="module-wrapper">
                        <section class="module module-projects-activities">
                            <div class="module-inner">
                                <div class="module-heading">
                                    <h3 class="module-title">Pending Activities</h3>
                                    <ul class="actions list-inline">

                                        <li><a class="collapse-module" data-toggle="collapse" href="#content-activities" aria-expanded="false" aria-controls="content-activities"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                                        <li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>
                                    </ul>

                                </div>

                                <div class="module-content collapse in" id="content-activities">
                                    <div class="module-content-inner">
                                        <div role="tabpanel" class="tab-wrapper">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs nav-tabs-theme-1" role="tablist">
                                                <!--<li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">All</a></li>
                                                <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Projects</a></li>
                                                <li role="presentation"><a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">Tickets</a></li>
                                                <li role="presentation"><a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">Discussions</a></li>
                                                <li role="presentation"><a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab">Files</a></li>-->

                                                <li class="active" role="presentation"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Tasks</a></li>
                                                <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Appointments</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content" >
                                                <div role="tabpanel" class="tab-pane active" id="tab-1">
                                                        <div class="table-responsive">
                                                            <table id="tasks-table" class="table table-bordered display" style="width: 100%;">
                                                                <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Title</th>
                                                                    <th>Customer</th>
                                                                    <th>Description</th>
                                                                    <th>Status</th>
                                                                    <th>Priority</th>
                                                                    <th>Due Date</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>

                                                </div>

                                                <div role="tabpanel" class="tab-pane" id="tab-2">

                                                        <div class="table-responsive">
                                                            <table id="appointments-table" class="table table-bordered display" style="width: 100%;">
                                                                <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Title</th>
                                                                    <th>Customer</th>
                                                                    <th>Description</th>
                                                                    <th>Start Time</th>
                                                                    <th>End Time</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>




                                                </div>



                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </section>

                    </div>
                    <!--<div class="module-wrapper">
                        <section class="module module-has-footer module-projects-overview">
                            <div class="module-inner">
                                <div class="module-heading">
                                    <h3 class="module-title">Overview</h3>
                                    <ul class="actions list-inline">
                                        <li class="more-link">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <span class="arrow"></span>
                                                    <a href="#">Action 1</a>
                                                </li>
                                                <li><a href="#">Action 2</a></li>
                                                <li><a href="#">Action 3</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="collapse-module" data-toggle="collapse" href="#content-overview" aria-expanded="false" aria-controls="content-overview"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>
                                        <li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>
                                    </ul>

                                </div>



                               <div class="module-content collapse in" id="content-overview">
                                    <div class="module-content-inner">
                                        <ul class="data-list row text-center">
                                            <li class="item item-1 col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="projects.html">
                                                    <span aria-hidden="true" class="icon icon_toolbox_alt"></span>
                                                    <span class="data">16</span>
                                                    <span class="desc">Open <br>Projects</span>
                                                </a>
                                            </li>
                                            <li class="item item-2 col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="tickets.html">
                                                    <span aria-hidden="true" class="icon icon_box-checked"></span>
                                                    <span class="data">769</span>
                                                    <span class="desc">Open <br>Tickets</span>
                                                </a>
                                            </li>
                                            <li class="item item-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="discussions.html">
                                                    <span aria-hidden="true" class="icon icon_chat_alt"></span>
                                                    <span class="data">23</span>
                                                    <span class="desc">New <br>Discussions</span>
                                                </a>
                                            </li>
                                            <li class="item item-4 col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="invoice.html">
                                                    <span aria-hidden="true" class="icon icon_documents_alt"></span>
                                                    <span class="data">$8,625</span>
                                                    <span class="desc">Invoiced<br>Amount</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="time-overview col-md-6 col-sm-12 col-xs-12">
                                                <div class="inner">
                                                    <h4 class="title"><span aria-hidden="true" class="icon icon_clock_alt"></span>Time Logged</h4>
                                                    <div class="chart-container">
                                                        <div id="time-chart" class="flot-chart" style="height: 160px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="type-overview col-md-6 col-sm-12 col-xs-12">
                                                <div class="inner">
                                                    <h4 class="title"><span aria-hidden="true" class="icon icon_datareport"></span>Project Types</h4>
                                                    <div class="chart-container">
                                                        <div id="type-chart" class="flot-chart" style="height: 140px;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>-->

                            </div>

                            {{--<div class="module-footer text-center">--}}
                                {{--<p class="meta">Time Period: 2 weeks (June 01 - June 14, 2016)</p>--}}
                            {{--</div>--}}

                        </section>

                    </div>


                    {{--<div class="row">--}}
                        {{--<div class="module-wrapper col-lg-6 col-md-12 col-sm-12 col-xs-12">--}}
                            {{--<section class="module module-has-footer module-projects-list">--}}
                                {{--<div class="module-inner">--}}
                                    {{--<div class="module-heading">--}}
                                        {{--<h3 class="module-title">Latest Projects</h3>--}}
                                        {{--<ul class="actions list-inline">--}}
                                            {{--<li class="more-link">--}}
                                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>--}}
                                                {{--<ul class="dropdown-menu">--}}
                                                    {{--<li>--}}
                                                        {{--<span class="arrow"></span>--}}
                                                        {{--<a href="#">Action 1</a>--}}
                                                    {{--</li>--}}
                                                    {{--<li><a href="#">Action 2</a></li>--}}
                                                    {{--<li><a href="#">Action 3</a></li>--}}
                                                    {{--<li role="separator" class="divider"></li>--}}
                                                    {{--<li><a href="#">Separated link</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
                                            {{--<li><a class="collapse-module" data-toggle="collapse" href="#content-projects" aria-expanded="false" aria-controls="content-projects"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>--}}
                                            {{--<li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>--}}
                                        {{--</ul>--}}

                                    {{--</div>--}}

                                    {{--<div class="module-content collapse in" id="content-projects">--}}
                                        {{--<div class="module-content-inner">--}}
                                            {{--<div class="table-responsive">--}}
                                                {{--<table class="table table-simple">--}}
                                                    {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th class="truncate">Project Name</th>--}}
                                                        {{--<th>Budget</th>--}}
                                                    {{--</tr>--}}
                                                    {{--</thead>--}}
                                                    {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td class="truncate"><a href="project.html">Project lorem ipsum</a></td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="progress-container">--}}
															{{--<span class="progress progress-sm">--}}
																	{{--<span class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%">--}}

																	{{--</span>--}}
															{{--</span>--}}

                                                                {{--<span class="progress-pc hidden-xs">55%</span>--}}
                                                            {{--</div>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td class="truncate"><a href="project.html">Mobile app for egestas vehicula</a></td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="progress-container">--}}
															{{--<span class="progress progress-sm">--}}
																	{{--<span class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="110" aria-valuemin="0" aria-valuemax="100" style="width: 110%">--}}

																	{{--</span>--}}
															{{--</span>--}}

                                                                {{--<span class="progress-pc hidden-xs">110%</span>--}}
                                                            {{--</div>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td class="truncate"><a href="project.html">Campaign for vivamus elementum fringilla mauris amet adipiscing</a></td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="progress-container">--}}
															{{--<span class="progress progress-sm">--}}
																	{{--<span class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">--}}

																	{{--</span>--}}
															{{--</span>--}}

                                                                {{--<span class="progress-pc hidden-xs">25%</span>--}}
                                                            {{--</div>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td class="truncate"><a href="project.html">Campaign for Etiam Sit amet</a></td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="progress-container">--}}
															{{--<span class="progress progress-sm">--}}
																	{{--<span class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 95%">--}}

																	{{--</span>--}}
															{{--</span>--}}

                                                                {{--<span class="progress-pc hidden-xs">75%</span>--}}
                                                            {{--</div>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td class="truncate"><a href="project.html">Webapp for Pede Justo</a></td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="progress-container">--}}
															{{--<span class="progress progress-sm">--}}
																	{{--<span class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">--}}

																	{{--</span>--}}
															{{--</span>--}}

                                                                {{--<span class="progress-pc hidden-xs">95%</span>--}}
                                                            {{--</div>--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--</tbody>--}}
                                                {{--</table>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                {{--</div>--}}

                                {{--<div class="module-footer text-center">--}}
                                    {{--<ul class="shortcuts list-inline">--}}
                                        {{--<li class="first"><a href="projects.html">View all projects (56)</a></li>--}}
                                        {{--<li><a href="projects.html">My projects (2)</a></li>--}}
                                        {{--<li><a href="#">Add Project</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</section>--}}

                        {{--</div>--}}


                        {{--<div class="module-wrapper col-lg-6 col-md-12 col-sm-12 col-xs-12">--}}
                            {{--<section class="module module-has-footer module-tickets">--}}
                                {{--<div class="module-inner">--}}
                                    {{--<div class="module-heading">--}}
                                        {{--<h3 class="module-title">New Tickets</h3>--}}
                                        {{--<ul class="actions list-inline">--}}
                                            {{--<li class="more-link">--}}
                                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>--}}
                                                {{--<ul class="dropdown-menu">--}}
                                                    {{--<li>--}}
                                                        {{--<span class="arrow"></span>--}}
                                                        {{--<a href="#">Action 1</a>--}}
                                                    {{--</li>--}}
                                                    {{--<li><a href="#">Action 2</a></li>--}}
                                                    {{--<li><a href="#">Action 3</a></li>--}}
                                                    {{--<li role="separator" class="divider"></li>--}}
                                                    {{--<li><a href="#">Separated link</a></li>--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
                                            {{--<li><a class="collapse-module" data-toggle="collapse" href="#content-tickets" aria-expanded="false" aria-controls="content-tickets"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>--}}
                                            {{--<li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>--}}
                                        {{--</ul>--}}

                                    {{--</div>--}}

                                    {{--<div class="module-content collapse in" id="content-tickets">--}}
                                        {{--<div class="module-content-inner">--}}
                                            {{--<div class="table-responsive">--}}
                                                {{--<table class="table table-simple">--}}
                                                    {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th class="number">NO.</th>--}}
                                                        {{--<th class="truncate">Ticket Name</th>--}}
                                                        {{--<th>Priority</th>--}}
                                                    {{--</tr>--}}
                                                    {{--</thead>--}}
                                                    {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><span class="label label-number">#37</span></td>--}}
                                                        {{--<td class="truncate"><a href="#">Ticket lorem ipsum sodales sagittis</a></td>--}}
                                                        {{--<td><span class="label label-normal">Normal</span></td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><span class="label label-number">#212</span></td>--}}
                                                        {{--<td class="truncate"><a href="#">Refactor fringilla mauris code</a></td>--}}
                                                        {{--<td><span class="label label-low">Low</span></td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><span class="label label-number">#36</span></td>--}}
                                                        {{--<td class="truncate"><a href="#">UX workshop for sodales sagittis</a></td>--}}
                                                        {{--<td><span class="label label-high">High</span></td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><span class="label label-number">#16</span></td>--}}
                                                        {{--<td class="truncate"><a href="#">Build form modules</a></td>--}}
                                                        {{--<td><span class="label label-critical">Critical</span></td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><span class="label label-number">#23</span></td>--}}
                                                        {{--<td class="truncate"><a href="#">Lorem ipsum dolor sit amet adipiscing elit</a></td>--}}
                                                        {{--<td><span class="label label-success">In Progress</span></td>--}}
                                                    {{--</tr>--}}
                                                    {{--</tbody>--}}
                                                {{--</table>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                {{--</div>--}}

                                {{--<div class="module-footer text-center">--}}
                                    {{--<ul class="shortcuts list-inline">--}}
                                        {{--<li class="first"><a href="tickets.html">View all tickets (639)</a></li>--}}
                                        {{--<li><a href="tickets.html">My tickets (18)</a></li>--}}
                                        {{--<li><a href="#">Add Ticket</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</section>--}}

                        {{--</div>--}}

                    {{--</div>--}}


                    {{--<div class="module-wrapper">--}}
                        {{--<section class="module module-projects-invoices">--}}
                            {{--<div class="module-inner">--}}
                                {{--<div class="module-heading">--}}
                                    {{--<h3 class="module-title">New Invoices</h3>--}}
                                    {{--<ul class="actions list-inline">--}}
                                        {{--<li class="more-link">--}}
                                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>--}}
                                            {{--<ul class="dropdown-menu">--}}
                                                {{--<li>--}}
                                                    {{--<span class="arrow"></span>--}}
                                                    {{--<a href="#">Action 1</a>--}}
                                                {{--</li>--}}
                                                {{--<li><a href="#">Action 2</a></li>--}}
                                                {{--<li><a href="#">Action 3</a></li>--}}
                                                {{--<li role="separator" class="divider"></li>--}}
                                                {{--<li><a href="#">Separated link</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</li>--}}
                                        {{--<li><a class="collapse-module" data-toggle="collapse" href="#content-invoices" aria-expanded="false" aria-controls="content-invoices"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>--}}
                                        {{--<li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>--}}
                                    {{--</ul>--}}

                                {{--</div>--}}

                                {{--<div class="module-content collapse in" id="content-invoices">--}}
                                    {{--<div class="module-content-inner">--}}
                                        {{--<div class="table-responsive">--}}
                                            {{--<table class="table table-simple table-striped">--}}
                                                {{--<thead>--}}
                                                {{--<tr>--}}
                                                    {{--<th class="number">Invoice No.</th>--}}
                                                    {{--<th>Due Date</th>--}}
                                                    {{--<th>Total</th>--}}
                                                {{--</tr>--}}
                                                {{--</thead>--}}
                                                {{--<tbody>--}}
                                                {{--<tr>--}}
                                                    {{--<td><a href="invoice.html" class="label label-number-alt">IVN0653</a></td>--}}
                                                    {{--<td class="date truncate"><a href="invoice.html">Sep 23, 2015</a></td>--}}
                                                    {{--<td class="total"><span class="currency hidden-xs">USD</span> <a href="invoice.html">$32,000</a></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td><a href="invoice.html" class="label label-number-alt">IVN0653</a></td>--}}
                                                    {{--<td class="date truncate"><a href="invoice.html">Jun 18, 2015</a></td>--}}
                                                    {{--<td class="total"><span class="currency hidden-xs">EUR</span> <a href="invoice.html">€16,000</a></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td><a href="invoice.html" class="label label-number-alt">IVN0653</a></td>--}}
                                                    {{--<td class="date truncate"><a href="invoice.html">May 14, 2015</a></td>--}}
                                                    {{--<td class="total"><span class="currency hidden-xs">USD</span> <a href="invoice.html">$5,500</a></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td><a href="invoice.html" class="label label-number-alt">IVN0653</a></td>--}}
                                                    {{--<td class="date truncate"><a href="#">Apr 07, 2015</a></td>--}}
                                                    {{--<td class="total"><span class="currency hidden-xs">GBP</span> <a href="invoice.html">£18,400</a></td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                    {{--<td><a href="invoice.html" class="label label-number-alt">IVN0653</a></td>--}}
                                                    {{--<td class="date truncate"><a href="invoice.html">Mar 23, 2015</a></td>--}}
                                                    {{--<td class="total"><span class="currency hidden-xs">USD</span> <a href="invoice.html">$14,200</a></td>--}}
                                                {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                            {{--</div>--}}

                        {{--</section>--}}

                    {{--</div>--}}

                    {{--<div class="module-wrapper">--}}
                        {{--<section class="module module-map">--}}
                            {{--<div class="module-inner">--}}
                                {{--<div class="module-heading">--}}
                                    {{--<h3 class="module-title">Client Locations</h3>--}}
                                    {{--<ul class="actions list-inline">--}}
                                        {{--<li class="more-link">--}}
                                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>--}}
                                            {{--<ul class="dropdown-menu">--}}
                                                {{--<li>--}}
                                                    {{--<span class="arrow"></span>--}}
                                                    {{--<a href="#">Action 1</a>--}}
                                                {{--</li>--}}
                                                {{--<li><a href="#">Action 2</a></li>--}}
                                                {{--<li><a href="#">Action 3</a></li>--}}
                                                {{--<li role="separator" class="divider"></li>--}}
                                                {{--<li><a href="#">Separated link</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</li>--}}
                                        {{--<li><a class="collapse-module" data-toggle="collapse" href="#content-map" aria-expanded="false" aria-controls="content-map"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>--}}
                                        {{--<li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>--}}
                                    {{--</ul>--}}

                                {{--</div>--}}

                                {{--<div class="module-content collapse in" id="content-map">--}}
                                    {{--<div class="module-content-inner">--}}
                                        {{--<div id="world-map" class="world-map"></div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                            {{--</div>--}}

                        {{--</section>--}}

                    {{--</div>--}}

                {{--</div>--}}

                {{--<div class="col-wrapper col-lg-4 col-md-5 col-sm-12 col-xs-12">--}}
                    {{--<div class="module-wrapper">--}}
                        {{--<section class="module module-projects-sales">--}}
                            {{--<div class="module-inner">--}}
                                {{--<div class="module-heading">--}}
                                    {{--<h3 class="module-title">Sales</h3>--}}
                                    {{--<ul class="actions list-inline">--}}
                                        {{--<li class="more-link">--}}
                                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>--}}
                                            {{--<ul class="dropdown-menu">--}}
                                                {{--<li>--}}
                                                    {{--<span class="arrow"></span>--}}
                                                    {{--<a href="#">Action 1</a>--}}
                                                {{--</li>--}}
                                                {{--<li><a href="#">Action 2</a></li>--}}
                                                {{--<li><a href="#">Action 3</a></li>--}}
                                                {{--<li role="separator" class="divider"></li>--}}
                                                {{--<li><a href="#">Separated link</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</li>--}}
                                        {{--<li><a class="collapse-module" data-toggle="collapse" href="#content-sales" aria-expanded="false" aria-controls="content-sales"><span aria-hidden="true" class="icon arrow_carrot-up"></span></a></li>--}}
                                        {{--<li><a class="close-module" href="#"><span aria-hidden="true" class="icon icon_close"></span></a></li>--}}
                                    {{--</ul>--}}

                                {{--</div>--}}

                                {{--<div class="module-content collapse in" id="content-sales">--}}
                                    {{--<div class="module-content-inner">--}}
                                        {{--<div class="sales-info">--}}
                                            {{--<h3 class="figure-total text-highlight">$64,456<span class="meta">(Current Month)</span></h3>--}}
                                            {{--<ul class="list-unstyled list-currency">--}}
                                                {{--<li class="dollars">--}}
                                                    {{--<img class="flag" src="{{asset('storage/assets/images/flags/US.png')}}" alt="" />--}}
                                                    {{--<span class="progress-container">--}}
														{{--<span class="progress-pc">82%</span>--}}
												{{--<span class="progress">--}}
															{{--<span class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 82%">--}}

															{{--</span>--}}
												{{--</span>--}}

												{{--</span>--}}

                                                    {{--<span class="figure-sub">$52,854</span>--}}
                                                {{--</li>--}}
                                                {{--<li class="pounds">--}}
                                                    {{--<img class="flag" src="{{asset('storage/assets/images/flags/UK.png')}}" alt="" />--}}
                                                    {{--<span class="progress-container">--}}
														{{--<span class="progress-pc">6%</span>--}}
												{{--<span class="progress">--}}
															{{--<span class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: 6%">--}}

															{{--</span>--}}
												{{--</span>--}}

												{{--</span>--}}

                                                    {{--<span class="figure-sub">£2,320</span>--}}
                                                {{--</li>--}}
                                                {{--<li class="euros">--}}
                                                    {{--<img class="flag" src="{{asset('storage/assets/images/flags/EU.png')}}" alt="" />--}}
                                                    {{--<span class="progress-container">--}}
														{{--<span class="progress-pc">12%</span>--}}
												{{--<span class="progress">--}}
															{{--<span class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 12%">--}}

															{{--</span>--}}
												{{--</span>--}}

												{{--</span>--}}

                                                    {{--<span class="figure-sub">€4,321</span>--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}

                                            {{--<div class="chart-container">--}}
                                                {{--<div id="sales-chart" class="flot-chart"></div>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}

                        {{--</section>--}}

                    {{--</div>--}}




                </div>

            </div>

        </div>

    </div>
@endsection

@section('modal')
    <!-- Modal for creating customer -->
    <div class="modal appointmentModal" id="appointment-modal" role="dialog" aria-labelledby="appointment-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-appointment-label">Add New Appointment</h4>
                </div>
                <div class="modal-body">
                    @yield('appointment-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
    <div class="modal customerModal" id="task-modal" role="dialog" aria-labelledby="task-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-new-task-label">Add New Task</h4>
                </div>
                <div class="modal-body">
                    @yield('task-create-form')
                </div>
            </div>
        </div>
    </div><!--/modal-->
@endsection



@section('after-footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('storage/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('storage/assets/js/bootstrap-datetimepicker.js')}}"></script>

    <script src="{{asset('storage/assets/js/parsley.js')}}"></script>
    <script src="{{asset('storage/assets/js/jquery-data-tables-bs3.js')}}"></script>
{{--    <script src="{{asset('storage/assets/js/dashboard-projects.js')}}"></script>--}}

    <script>
        task_date=moment();

        var task_datatable = jQuery('#tasks-table').DataTable({
//                responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('task-data-with-due') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
                {data: 'customer_name', name: 'customer_name'},
                { data: 'description', name: 'description'},
                { data: 'status', name: 'status'},
                { data: 'priority', name: 'priority'},
                { data: 'due_date', name: 'due_date' },
                {data: 'action', name: 'action', orderable: false, searchable: false},


            ]
        });

        $("#startTime").on("dp.change", function (e) {
            min_date=e.date;
            updateAppointmentDates();
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
            updateAppointmentDates();
        });

        var appointment_datatable = jQuery('#appointments-table').DataTable({
//                responsive: false,
            select: true,
            processing: true,
            serverSide: true,
            ajax: '{!! route('appointment-data-current-date') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'description', name: 'description'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},


            ]
        });

        jQuery("#aptCustomerId").select2({
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
                    //console.log(data);
                    return {
                        results: data.customers
                    }
                },

                cache: true
            }
        });


        var min_date = moment();
        var max_date = moment();

        var aptinputMap={
            appointmentId : 'appointment_id',
            aptCustomerId : 'aptCustomerId',
            appointmentTitle : 'appointmentTitle',
            appointmentDescription : 'appointmentDescription',
            appointmentStatus : 'appointmentStatus',
            startTime : 'startTime',
            endTime : 'endTime'
        };

        jQuery('.modal').on('shown.bs.modal', function () {


            $('#startTime').datetimepicker({});
            $('#endTime').datetimepicker({ useCurrent: false});

            updateAppointmentDates();

            $('#taskDueDateTimePicker').datetimepicker();
            updateTaskDate();
        });

        $("#startTime").on("dp.change", function (e) {
            min_date=e.date;
            updateAppointmentDates();
        });
        $("#endTime").on("dp.change", function (e) {
            max_date=e.date;
            updateAppointmentDates();
        });

        function updateAppointmentDates(){
            $('#startTime').data("DateTimePicker").date(min_date);
            $('#startTime').data("DateTimePicker").minDate(moment());
//                $('#startTime').data("DateTimePicker").maxDate(max_date);
            $('#endTime').data("DateTimePicker").date(max_date);
            $('#endTime').data("DateTimePicker").minDate(min_date);
        }


        function updateTaskDate(){
            $('#taskDueDateTimePicker').data("DateTimePicker").date(task_date);
        }


        $('#appointmentForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('#appointmentForm input[name="_token"]').val();


            var appointment = {
                appointmentId : $('#'+aptinputMap.appointmentId).val(),
                aptCustomerId : $('#'+aptinputMap.aptCustomerId).val(),
                appointmentTitle : $('#'+aptinputMap.appointmentTitle).val(),
                appointmentDescription : $('#'+aptinputMap.appointmentDescription).val(),
                appointmentStatus : $('#'+aptinputMap.appointmentStatus).val(),
                startTime : $('#'+aptinputMap.startTime).val(),
                endTime : $('#'+aptinputMap.endTime).val()
            };



            var data = {
                _token : _token,
                appointment: appointment
            };


                var request = jQuery.ajax({
                    url: "{{ route('update.appointment') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){

                        reset_appointment_form($('#appointmentForm')[0]);
                        $('#appointment_id').val('');
                        $('#appointment-modal').modal('hide');
                        get_all_appointment_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })
                request.error(function(xhr){
                    jQuery.map(jQuery.parseJSON(xhr.responseText),function (data, key){
                        handle_appointment_error(xhr);
                    });



                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });



        });

        function reset_appointment_form(form_el) {
            form_el.reset();
            min_date = moment();
            max_date = moment();
            $('#'+aptinputMap.appointmentId).val('');
            $('#'+aptinputMap.aptCustomerId).val('').trigger('change');


        }
        function showAptParselyError(field, msg){
            var el = jQuery("#"+aptinputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }


        function editAppointment(id){

            $('#appointment_modal_button').val('Update Appointment');
            $('#modal-new-appointment-label').text('Edit Appointment');

            $.get("{{ route('edit.appointment') }}", { id: id} ,function(data){
                console.log(data.appointment);
                if(data){
                    jQuery('#appointment_id').val(data.appointment.id);
                    jQuery('#appointmentTitle').val(data.appointment.title);
                    jQuery('#appointmentDescription').val(data.appointment.description);
                    jQuery('#appointmentStatus').val(data.appointment.status);
                    //$('#aptCustomerId').val(data.appointment.customer_id);
                    $('#aptCustomerId').html("<option selected value='"+data.appointment.customer.id+"'>"+data.appointment.customer.first_name+', '+ data.appointment.customer.last_name+'@'+data.appointment.customer.company.name+"</option>");

                    min_date = moment(data.appointment.start_time);
                    max_date = moment(data.appointment.end_time);

                    updateAppointmentDates();

                }

            });

            $('#appointment-modal').modal('show');
        }


        function deleteAppointment(id){
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


                        $.post("{{ route('delete.appointment') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Appointment has been deleted.", "success");
                                get_all_appointment_data();
                                $.notify('Appointment deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the Appointment", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Appointment is safe :)", "error");
                    }
                });
        }


        function get_all_appointment_data(){

            appointment_datatable.ajax.reload(null, false);
        }



//For editing task and deleting task

        var taskInputMap={
            taskId : 'task_id',
            taskCustomerId : 'taskCustomerId',
            taskTitle : 'taskTitle',
            taskDescription : 'taskDescription',
            taskDueDate : 'taskDueDate',
            taskStatus : 'taskStatus',
            taskPriority : 'taskPriority',
        };

        var task_date=moment();

        var customer_select= jQuery("#taskCustomerId").select2({
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

        function reset_task_form(form_el) {
            form_el.reset();
            task_date=moment();
            $('#'+taskInputMap.taskId).val('');
            customer_select.val('').trigger('change');

        }

        //creating task
        $('#task_modal_button').val('Add Task');
        $('#modal-new-task-label').text('Add A Task');
        $('#taskForm').on('submit',function(e){
            e.preventDefault();
            var _token = $('#taskForm input[name="_token"]').val();
            //console.log('hello');
            var task = {
                taskId : $('#'+taskInputMap.taskId).val(),
                taskCustomerId : $('#'+taskInputMap.taskCustomerId).val(),
                taskTitle : $('#'+taskInputMap.taskTitle).val(),
                taskDescription : $('#'+taskInputMap.taskDescription).val(),
                taskDueDate : $('#'+taskInputMap.taskDueDate).val(),
                taskStatus : $('#'+taskInputMap.taskStatus).val(),
                taskPriority : $('#'+taskInputMap.taskPriority).val(),

            };
            var data = {
                _token : _token,
                task: task
            };

            if(task.taskId === ''){
                //task creating.....

                var request = jQuery.ajax({
                    url: "{{ route('create.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_task_form($('#taskForm')[0]);
                        $('#task-modal').modal('hide');
                        get_all_task_data();
                        $.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                });
                request.error(function(xhr){
                    handle_task_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });
            } else{
                //task editing.....

                var request = jQuery.ajax({
                    url: "{{ route('update.task') }}",
                    data: data,
                    method: "POST",
                    dataType: "json"
                });
                request.done(function (response) {
                    if(response.result == 'Saved'){
                        reset_task_form($('#taskForm')[0]);
                        $('#task_id').val('');
                        $('#task-modal').modal('hide');
                        get_all_task_data();
                        jQuery.notify(response.message, "success");
                    }
                    else{
                        jQuery.notify(response.message, "error");
                    }
                })
                request.error(function(xhr){
                    handle_task_error(xhr);
                });
                request.fail(function (jqXHT, textStatus) {
                    $.notify(textStatus, "error");
                });

            }
        });
        function handle_task_error(xhr) {

            if(xhr.status==422){
                jQuery.map(jQuery.parseJSON(xhr.responseText), function (data, key) {
                    showTaskParselyError(key, data[0]);
                });
            }

        }
        function showTaskParselyError(field, msg){
            var el = jQuery("#"+taskInputMap[field]).parsley();
            el.removeError('fieldError');
            el.addError('fieldError', {message: msg, updateClass: true});
        }

        function editTask(id){
            $('#task_modal_button').val('Update Task');
            $('#modal-new-task-label').text('Edit Task');

            $.get("{{ route('edit.task.data') }}", { id: id} ,function(data){
                console.log(data.task);
                if(data){
                    $('#task_id').val(data.task.id);
                    $('#taskCustomerId').val(data.task.customer_id);
                    $('#taskCustomerId').html("<option selected value='"+data.task.customer.id+"'>"+data.task.customer.first_name+', '+ data.task.customer.last_name+'@'+data.task.customer.company.name+"</option>");
                    $('#taskTitle').val(data.task.title);
                    $('#taskDescription').val(data.task.description);
                    task_date = moment(data.task.due_date);
                    $('#taskPriority').val(data.task.priority);
                    $('#taskStatus').val(data.task.status);
                    updateTaskDate();
                }

            });

            $('#task-modal').modal('show');
        }


        function deleteTask(id){
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


                        $.post("{{ route('delete.task') }}", data, function(result){

                            if(result.result == 'Success'){
                                swal("Deleted!", "Company has been deleted.", "success");
                                get_all_task_data();
                                $.notify('Task deleted successfully', "danger");
                            }
                            else{
                                swal("Failed", "Failed to delete the company", "error");
                            }

                        });
                    } else {
                        swal("Cancelled", "Company is safe :)", "error");
                    }
                });
        }

        function get_all_task_data(){
            task_datatable.ajax.reload(null, false);
        }

    </script>


@endsection

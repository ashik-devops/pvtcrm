@extends('layouts.app')
@section('after-head-style')

    <link rel="stylesheet" href="{{asset('storage/assets/css/dashboard-projects.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jquery-data-tables-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/elegant-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/pe-7-icons-helper.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/tether-shepherd.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/jstree-default.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('storage/assets/css/timeline.css')}}">

@endsection

<head><title>Timeline</title></head>


@section('content')
    <div id="content-wrapper" class="content-wrapper view">
        <div class="container-fluid">
            <h2 class="view-title">Timeline</h2>
            <div class="row">
                <div class="module-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <section class="module module-headings">
                        <div class="module-inner">
                            <div class="module-content">
                                <div class="module-content-inner">
                                    <h2 class="title text-center margin-bottom-lg">Project Timeline</h2>
                                    <div class="timeline-control">
                                    </div>

                                    <div class="timeline-wrapper">
                                        <div class="timeline-block">
                                            <div class="timeline-stop text-center">
                                                <div class="date">Mar 24</div>
                                                <div class="date-sub">Monday</div>
                                            </div>

                                            <div class="timeline-content-wrapper">
                                                <div class="timeline-item">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Design</h3>
                                                            <span class="time-meta">09:30am</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-2">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-2.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Rachel W</span> <span class="action">uploaded 10 files</span> under <a href="#">"UX mocks for Nike"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"I’m sharing this folder ahead of the team meeting. Let me know if orem sed massa bibendum maximus quis sit amet diam..."</p>
                                                                            <div class="resource">
                                                                                <ul class="resource-files list list-unstyled">
                                                                                    <li><i class="fa fa-file-image-o"></i> <a class="resource-link" href="#">UX-mocks-for-Nike-1.png</a></li>
                                                                                    <li><i class="fa fa-file-image-o"></i> <a class="resource-link" href="#">UX-mocks-for-Nike-2.png</a></li>
                                                                                    <li><i class="fa fa-file-pdf-o"></i> <a class="resource-link" href="#">UX-mocks-for-Nike-3.png</a></li>
                                                                                </ul>
                                                                                <a href="#">7 more files</a>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item opposite">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Design</h3>
                                                            <span class="time-meta">10:30am</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-2">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-13.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Philip T</span> <span class="action">commented on</span> <a href="#">"UX mocks for Nike"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"Can you send me orem sed massa? Bibendum maximus quis sit amet diam..."</p>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Development</h3>
                                                            <span class="time-meta">02:25pm</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-1">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-12.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Carl B</span> <span class="action">created a ticket</span> <a href="#">"#134 Revamp front-end code"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"We need to orem sed massa bibendum maximus quis sit amet diam..."</p>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item opposite">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Development</h3>
                                                            <span class="time-meta">04:16pm</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-1">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-18.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Henry O</span> <span class="action">Started a discussion</span> <a href="#">"Mobile first"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"Hi there quisque non augue a erat consequat tempor eget vitae erat. Praesent tortor ante, fermentum ac mi vitae, faucibus tincidunt tellus. Maecenas hendrerit magna quis turpis scelerisque, in convallis leo tristique... "</p>
                                                                            <div class="resource">
                                                                                <ul class="resource-list list list-unstyled">
                                                                                    <li><span class="fs1 icon" aria-hidden="true" data-icon="&#xe016;"></span> <a class="resource-link" href="#">examples-1.zip</a></li>
                                                                                    <li><span class="fs1 icon" aria-hidden="true" data-icon="&#xe016;"></span> <a class="resource-link" href="#">examples-2.zip</a></li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="timeline-block">
                                            <div class="timeline-stop text-center">
                                                <div class="date">Mar 25</div>
                                                <div class="date-sub">Tuesday</div>
                                            </div>

                                            <div class="timeline-content-wrapper">
                                                <div class="timeline-item">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Design</h3>
                                                            <span class="time-meta">10:15am</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-2">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-3.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Rebecca S</span> <span class="action">uploaded 2 files</span> under <a href="#">"UX mocks for Nike"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"Ut iaculis pellentesque purus, nec pretium lectus fermentum posuere. Quisque non augue a erat consequat..."</p>
                                                                            <div class="resource">
                                                                                <ul class="resource-files list list-unstyled">
                                                                                    <li><i class="fa fa-file-pdf-o"></i> <a class="resource-link" href="#">User-flow-for-Nike-final-1.pdf</a></li>
                                                                                    <li><i class="fa fa-file-pdf-o"></i> <a class="resource-link" href="#">User-flow-for-Nike-final-2.pdf</a></li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item opposite">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Project Management</h3>
                                                            <span class="time-meta">11:23am</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-3">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-8.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">William Hunter</span> <span class="action">assigned 2 tickets</span> to <span class="name">Rachel L</span>
                                                                        </div>
                                                                        <div class="resource">
                                                                            <ul class="resource-list list list-unstyled">
                                                                                <li><span class="label label-number">#256</span> <a href="#"> Donec lobortis nunc ut lorem cursus</a></li>
                                                                                <li><span class="label label-number">#257</span> <a href="#">Consequat tempor eget vitae erat</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Development</h3>
                                                            <span class="time-meta">01:25pm</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-1">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-5.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Ann R</span> <span class="action">created a ticket</span>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"We need to orem sed massa bibendum maximus quis sit amet diam..."</p>
                                                                        </div>
                                                                        <ul class="resource-list list list-unstyled">
                                                                            <li><span class="label label-number">#312</span> <a href="#"> 312 Revamp front-end code"</a></li>
                                                                        </ul>
                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="timeline-item opposite">
                                                    <div class="timeline-item-inner">
                                                        <div class="item-heading">
                                                            <h3 class="item-title">Testing</h3>
                                                            <span class="time-meta">03:27pm</span>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-content-inner cat-4">
                                                                <div class="media">
                                                                    <div class="media-left profile">
                                                                        <img src="assets/images/profiles/profile-9.png" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <div class="summary">
                                                                            <span class="name">Henry O</span> <span class="action">updated a ticket</span> <a href="#">"Test mobile site"</a>
                                                                        </div>
                                                                        <div class="excerpt">
                                                                            <p>"Quisque non augue a erat consequat tempor eget vitae erat. Praesent tortor ante, fermentum ac mi vitae, faucibus tincidunt tellus. Maecenas hendrerit magna quis turpis scelerisque... "</p>
                                                                        </div>
                                                                        <div class="resource">
                                                                            <ul class="resource-files list list-unstyled">
                                                                                <li><i class="fa fa-picture-o"></i> <a class="resource-link" href="#">screenshot-Chrome.jpeg</a></li>
                                                                                <li><i class="fa fa-picture-o"></i> <a class="resource-link" href="#">screenshot-Firefox.jpeg</a></li>
                                                                            </ul>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <span class="arrow"></span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="timeline-load-more text-center">
                                            <a class="btn btn-success btn-lg" href="#">Load more...</a>
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
    <footer id="footer" class="site-footer" style="display:none">
        <div class="copyright">Copyright &copy; 2016 - <a href="#">Bootstrap Admin Theme</a></div>
    </footer>		<div id="side-panel" class="side-panel" >
        <div class="side-panel-inner">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
            <h4 class="title text-center"><i class="fa fa-signal"></i>Activities</h4>
            <div class="items-wrapper">
                <div class="item">
                    <div class="symbol-holder">
                        <button class="icon-container btn btn-warning btn-circle">
                            <i class="icon fa fa-flag"></i>
                        </button>
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <strong>We have increased your storage to 10GB for Free!</strong>
                        </div>
                        <div class="excerpt">
                            System notification
                        </div>
                        <div class="time-stamp">5 days ago</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <img class="user-profile" src="assets/images/profiles/profile-20.png" alt="" />
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="member.html">David Thomson</a> followed you.
                        </div>
                        <divagrant v class="excerpt">
                            <div class="role">Full-Stack Developer</div>
                            <div class="folowers"><span>12 Projects</span> | <span class="folowers">43 Followers</span></div>
                        </divagrantv>
                        <div class="time-stamp">3 mins ago</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <button class="icon-container btn btn-danger btn-circle">
                            <i class="icon fa fa-heart"></i>
                        </button>
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="#">Julie Wu</a> favourited your post.
                        </div>
                        <div class="excerpt">
                            <div class="quote-text"><em>"Love your new design! Keep up the great work..."</em></div>
                        </div>
                        <div class="time-stamp">1 week ago</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <img class="user-profile" src="assets/images/profiles/profile-15.png" alt="" />
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="#">Julie Wu</a> followed you.
                        </div>
                        <div class="excerpt">
                            <div class="role">Product Designer</div>
                            <div class="folowers"><span>3 Projects</span> | <span class="folowers">8 Followers</span></div>
                        </div>
                        <div class="time-stamp">2 weeks ago</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <button class="icon-container btn btn-info btn-circle">
                            <i class="icon fa fa-at"></i>
                        </button>
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="#">James Lee</a> mentioned you on <a href="#">Project Lorem</a>.
                        </div>
                        <div class="excerpt">
                            <div class="quote-text"><em>"Looks cool @Rebecca White"</em></div>
                        </div>
                        <div class="time-stamp">2 weeks ago</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <button class="icon-container btn btn-success btn-circle">
                            <i class="icon fa fa-commenting"></i>
                        </button>
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="#">Chris Adams</a> commented on <a href="#">Discussion Lorem</a>.
                        </div>
                        <div class="excerpt">
                            <div class="quote-text"><em>"Can we improve the review process? At the moment consectetuer adipiscing elit..."</em></div>
                        </div>
                        <div class="time-stamp">Jan 10, 2016</div>
                    </div>
                </div>
                <div class="item">
                    <div class="symbol-holder">
                        <button class="icon-container btn btn-pink btn-circle">
                            <i class="icon fa fa-thumbs-up"></i>
                        </button>
                    </div>
                    <div class="content-holder">
                        <div class="subject-line">
                            <a class="name" href="#">Kat Schultz</a> liked your discussion <a href="#">Discussion Lorem</a>.
                        </div>
                        <div class="time-stamp">Jan 8, 2016</div>
                    </div>
                </div>
            </div>
        </div>
    </div>		<!-- *****DEMO THEME CONFIG****** -->
    <div id="config-panel" class="config-panel hidden-xs">
        <div class="panel-inner">
            <a id="config-trigger" class="config-trigger config-panel-hide" href="#"><i class="fa fa-cog"></i></a>
            <div class="panel-section margin-bottom-md">
                <h5 class="panel-title">Choose Colour</h5>
                <ul id="color-options" class="list-unstyled list-unstyled">
                    <li class="theme-1 active" ><a data-style="theme-1"></a></li>
                    <li class="theme-2"><a data-style="theme-2" ></a></li>
                    <li class="theme-3"><a data-style="theme-3" ></a></li>
                    <li class="theme-4"><a data-style="theme-4" ></a></li>
                </ul>
            </div>
            <div class="panel-section">
                <h5 class="panel-title">Toggles</h5>
                <div class="checkbox">
                    <label>
                        <input id="demo-topalert-toggle" type="checkbox"> Top Alert
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input id="demo-footer-toggle" type="checkbox"> Footer
                    </label>
                </div>
            </div>
            <a id="config-close" class="close" href="#"><span aria-hidden="true" class="icon icon_close"></span></a>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/metisMenu.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/masonry.js"></script>
    <script src="assets/js/pace.js"></script>
    <script src="assets/js/tether.js"></script>
    <script src="assets/js/tether-shepherd.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/tour.js"></script>
    <script src="assets/js/demo.js"></script>
    </body>
    </html>
@endsection

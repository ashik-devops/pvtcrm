@extends('layouts.app')
@section('after-head-style')
    <link rel="stylesheet" href="assets/css/members.css">
@endsection

@section('content')
    <div id="content-wrapper" class="content-wrapper view members-view">
        <div class="container-fluid">
            <div class="projects-heading">
                <h2 class="view-title">Members</h2>
                <div class="actions">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-new-member"><i class="fa fa-plus"></i> New Member</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="module-wrapper col-md-12 col-sm-12 col-xs-12">
                    <section class="module members-module module-no-heading">
                        <div class="module-inner">
                            <div class="module-content">
                                <div class="module-content-inner no-padding-bottom">
                                    <div class="members-list">
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-7.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Julie Adams</a></li>
                                                        <li class="role">Project Manager</li>
                                                        <li class="team"><a href="#">julie.adams@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">5</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">231</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">0</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-6.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Christopher Anderson</a></li>
                                                        <li class="role">Front-end Developer</li>
                                                        <li class="team"><a href="#">chris.anderson@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">8</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">68</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">564</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-16.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Jim Ahuja</a></li>
                                                        <li class="role">Back-end Developer</li>
                                                        <li class="team"><a href="#">jim.ahuja@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">3</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">34</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">461</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-15.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Jennifer Boyd</a></li>
                                                        <li class="role">UX Designer</li>
                                                        <li class="team"><a href="#">jennifer.boyd@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">12</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">82</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">0</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-20.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Jack Davison</a></li>
                                                        <li class="role">iOS Developer</li>
                                                        <li class="team"><a href="#">jack.davison@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">2</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">18</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">72</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-13.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Mark Dean</a></li>
                                                        <li class="role">Security Engineer</li>
                                                        <li class="team"><a href="#">mark.dean@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">3</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">18</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">72</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-11.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Joseph Freeman</a></li>
                                                        <li class="role">Security Engineer</li>
                                                        <li class="team"><a href="#">joseph.freeman@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">11</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">18</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">72</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-9.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Joe Foster</a></li>
                                                        <li class="role">Security Engineer</li>
                                                        <li class="team"><a href="#">joe.foster@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">5</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">18</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">72</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-5.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">Amy Myers</a></li>
                                                        <li class="role">Product Designer</li>
                                                        <li class="team"><a href="#">amy.myer@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">6</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">45</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">12</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="profile col-md-3 col-sm-3 col-xs-12">
                                                    <a class="profile-img" href="#"><img src="assets/images/profiles/profile-18.png" alt="" /></a>
                                                    <ul class="info list-unstyled">
                                                        <li class="name"><a href="#">John Patel</a></li>
                                                        <li class="role">Back-end Developer</li>
                                                        <li class="team"><a href="#">john.patel@website.com</a></li>
                                                    </ul>
                                                </div>
                                                <div class="contact col-md-6 col-sm-6 col-xs-12">
                                                    <ul class="list-inline">

                                                        <li class="chat"><a href="#"><span class="pe-icon pe-7s-chat icon"></span></a></li>
                                                        <li class="call"><a href="#"><span class="pe-icon pe-7s-call icon"></span></a></li>
                                                        <li class="message"><a href="#"><span class="pe-icon pe-7s-mail icon"></span></a></li>
                                                        <li class="location"><a href="#"><span class="pe-icon pe-7s-map-marker icon"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="data col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-inline text-center">
                                                        <li class="projects"><span class="figure">9</span><span>projects</span></li>
                                                        <li class="discussions"><span class="figure">38</span><span>discussions</span></li>
                                                        <li class="commits"><span class="figure">112</span><span>commits</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <nav class="text-center pagination-wrapper">
                                            <p class="pagination-info">Displaying members 1-10 of 356</p>
                                            <ul class="pagination pagination-sm">
                                                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                                            </ul>
                                        </nav>
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
    <script src="assets/js/forms-chosen.js"></script>
@endsection

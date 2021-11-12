@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Dashboard 2</h3>
            </div>
            <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                <ol class="breadcrumb mb-0 p-0 bg-transparent float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard 2</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Start Row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="mr-3 align-self-center"><span class="lstick d-inline-block align-middle"></span><img
                                    src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/income.png"
                                    alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted mt-2 mb-0">Active checklists</h6>
                                <h2 class="info">5</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="mr-3 align-self-center"><span class="lstick d-inline-block align-middle"></span><img
                                    src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/expense.png"
                                    alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted mt-2 mb-0">Pending items</h6>
                                <h2 class="warning">15</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="mr-3 align-self-center"><span class="lstick d-inline-block align-middle"></span><img
                                    src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/icon/assets.png"
                                    alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted mt-2 mb-0">Active cases</h6>
                                <h2 class="success">3</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Row -->
        <!-- Start row -->
        <div class="row">
            <div class="col-lg-9">
                @include('features.datatable')
            </div>
            <!-- ============================================================== -->
            <!-- visit charts-->
            <!-- ============================================================== -->
            <div class="col-lg-3">
                @include('features.commboard')
                {{-- <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>Visit Separation</h4>
                                <div id="visitor" style="height:290px; width:100%;"></div>
                                <table class="table vm font-14">
                                    <tr>
                                        <td class="b-0">Mobile</td>
                                        <td class="text-right font-medium b-0">38.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Tablet</td>
                                        <td class="text-right font-medium">30.8%</td>
                                    </tr>
                                    <tr>
                                        <td>Desktop</td>
                                        <td class="text-right font-medium">7.7%</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td class="text-right font-medium">23.1%</td>
                                    </tr>
                                </table>
                            </div>
                        </div> --}}
            </div>
        </div>
        <!-- End Row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>Recent
                            Comments</h4>
                    </div>
                    <div class="comment-widgets scrollable mb-2 common-widget" style="height: 450px;">
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row border-bottom p-3">
                            <div class="p-2"><span
                                    class="round text-white d-inline-block text-center rounded-circle bg-info"><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/1.jpg"
                                        class="rounded-circle" alt="user" width="50"></span></div>
                            <div class="comment-text w-100 p-3">
                                <h5>James Anderson</h5>
                                <p class="mb-1 overflow-hidden">Lorem Ipsum is simply dummy text of the
                                    printing
                                    and type etting industry</p>
                                <div class="comment-footer"> <span class="text-muted pull-right">April 14,
                                        2016</span> <span class="badge badge-info rounded-pill">Pending</span>
                                    <span class="action-icons">
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-check"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row border-bottom active p-3">
                            <div class="p-2"><span
                                    class="round text-white d-inline-block text-center rounded-circle bg-info"><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/2.jpg"
                                        class="rounded-circle" alt="user" width="50"></span></div>
                            <div class="comment-text active w-100 p-3">
                                <h5>Michael Jorden</h5>
                                <p class="mb-1 overflow-hidden">Lorem Ipsum is simply dummy text of the
                                    printing
                                    and type setting industry.</p>
                                <div class="comment-footer "> <span class="text-muted pull-right">April 14,
                                        2016</span> <span class="badge badge-success rounded-pill">Approved</span>
                                    <span class="action-icons active">
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="icon-close"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-heart text-danger"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row border-bottom p-3">
                            <div class="p-2"><span
                                    class="round text-white d-inline-block text-center rounded-circle bg-info"><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/3.jpg"
                                        class="rounded-circle" alt="user" width="50"></span></div>
                            <div class="comment-text w-100 p-3">
                                <h5>Johnathan Doeting</h5>
                                <p class="mb-1 overflow-hidden">Lorem Ipsum is simply dummy text of the
                                    printing
                                    and type setting industry. </p>
                                <div class="comment-footer"> <span class="text-muted pull-right">April 14,
                                        2016</span> <span class="badge badge-danger rounded-pill">Rejected</span> <span
                                        class="action-icons">
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-check"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-heart"></i></a>
                                    </span> </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row p-3">
                            <div class="p-2"><span
                                    class="round text-white d-inline-block text-center rounded-circle bg-info"><img
                                        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/4.jpg"
                                        class="rounded-circle" alt="user" width="50"></span></div>
                            <div class="comment-text w-100 p-3">
                                <h5>James Anderson</h5>
                                <p class="mb-1 overflow-hidden">Lorem Ipsum is simply dummy text of the
                                    printing
                                    and type setting industry.</p>
                                <div class="comment-footer"> <span class="text-muted pull-right">April 14,
                                        2016</span> <span class="badge badge-info rounded-pill">Pending</span>
                                    <span class="action-icons">
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-check"></i></a>
                                        <a href="javascript:void(0)" class="pl-3"><i
                                                class="ti-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick d-inline-block align-middle"></span>Recent
                            Chats</h4>
                        <div class="chat-box scrollable" style="height: 357px;">
                            <!--chat Row -->
                            <ul class="chat-list m-0 p-0">
                                <!--chat Row -->
                                <li class="mt-4">
                                    <div class="chat-img d-inline-block align-top"><img
                                            src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/1.jpg"
                                            alt="user" class="rounded-circle" /></div>
                                    <div class="chat-content pl-3 d-inline-block">
                                        <h5 class="text-muted">James Anderson</h5>
                                        <div class="p-2 rounded bg-light-info d-inline-block mb-2 text-dark">
                                            Lorem Ipsum
                                            is simply dummy text of the printing & type setting industry.</div>
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:56 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="mt-4">
                                    <div class="chat-img d-inline-block align-top"><img
                                            src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/2.jpg"
                                            alt="user" class="rounded-circle" /></div>
                                    <div class="chat-content pl-3 d-inline-block">
                                        <h5 class="text-muted">Bianca Doe</h5>
                                        <div class="p-2 rounded bg-light-success d-inline-block mb-2 text-dark">
                                            It’s
                                            Great opportunity to work.</div>
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:57 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="odd mt-4">
                                    <div class="chat-content pl-3 d-inline-block text-right">
                                        <div class="p-2 rounded bg-light-inverse d-inline-block mb-2 text-dark">
                                            I would
                                            love to join the team.</div>
                                        <br />
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:58 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="odd mt-4">
                                    <div class="chat-content pl-3 d-inline-block text-right">
                                        <div class="p-2 rounded bg-light-inverse d-inline-block mb-2 text-dark">
                                            Whats
                                            budget of the new project.</div>
                                        <br />
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:59 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="mt-4">
                                    <div class="chat-img d-inline-block align-top"><img
                                            src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/3.jpg"
                                            alt="user" class="rounded-circle" /></div>
                                    <div class="chat-content pl-3 d-inline-block">
                                        <h5 class="text-muted">Angelina Rhodes</h5>
                                        <div class="p-2 rounded bg-light-primary d-inline-block mb-2 text-dark">
                                            Well we
                                            have good budget for the project</div>
                                    </div>
                                    <div class="chat-time d-inline-block text-right">11:00 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="mt-4">
                                    <div class="chat-img d-inline-block align-top"><img
                                            src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/1.jpg"
                                            alt="user" class="rounded-circle" /></div>
                                    <div class="chat-content pl-3 d-inline-block">
                                        <h5 class="text-muted">James Anderson</h5>
                                        <div class="p-2 rounded bg-light-info d-inline-block mb-2 text-dark">
                                            Lorem Ipsum
                                            is simply dummy text of the printing &
                                            type setting industry.</div>
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:56 am</div>
                                </li>
                                <!--chat Row -->
                                <li class="odd mt-4">
                                    <div class="chat-content pl-3 d-inline-block text-right">
                                        <div class="p-2 rounded bg-light-inverse d-inline-block mb-2 text-dark">
                                            Whats
                                            budget of the new project.</div>
                                        <br />
                                    </div>
                                    <div class="chat-time d-inline-block text-right">10:59 am</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-8">
                                <textarea placeholder="Type your message here" class="form-control border-0"></textarea>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-info btn-circle btn-lg"><i
                                        class="far fa-paper-plane"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>


@endsection

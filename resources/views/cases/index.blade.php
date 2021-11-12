@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">My cases</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Start row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My active cases</h4>
                        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                        <table class="table table-striped table-bordered" id="editable-datatable">
                            <thead>
                                <tr>
                                    <th>Case title</th>
                                    <th>Case type</th>
                                    <th>Status</th>
                                    <th>options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="1" class="gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0 </td>
                                    <td>Win 95+</td>
                                    <td>
                                       <a href="#" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="2" class="gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td>
                                       <a href="#" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="3" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                </tr>
                                <tr id="4" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                    <td>
                                       <a href="#" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="5" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                </tr>
                                <tr id="6" class="gradeA">
                                    <td>Trident</td>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                </tr>
                                <tr id="7" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="8" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="9" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="10" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                </tr>
                                <tr id="11" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Camino 1.0</td>
                                    <td>OSX.2+</td>
                                </tr>
                                <tr id="12" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Camino 1.5</td>
                                    <td>OSX.3+</td>
                                </tr>
                                <tr id="13" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Netscape 7.2</td>
                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Case title</th>
                                    <th>Case type</th>
                                    <th>Status</th>
                                    <th>options</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My completed cases</h4>
                        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                        <table class="table table-striped table-bordered" id="editable-datatable">
                            <thead>
                                <tr>
                                    <th>Case title</th>
                                    <th>Case type</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="1" class="gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0 </td>
                                    <td>Win 95+</td>
                                    <td>
                                        <a href="#" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="2" class="gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td>
                                       <a href="{{route('show_case')}}" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="3" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.5</td>
                                    <td>Win 95+</td>
                                    <td>
                                       <a href="#" type="button" class="btn btn-outline-success btn-rounded">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="4" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 6</td>
                                    <td>Win 98+</td>
                                </tr>
                                <tr id="5" class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                </tr>
                                <tr id="6" class="gradeA">
                                    <td>Trident</td>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                </tr>
                                <tr id="7" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="8" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="9" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                </tr>
                                <tr id="10" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                </tr>
                                <tr id="11" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Camino 1.0</td>
                                    <td>OSX.2+</td>
                                </tr>
                                <tr id="12" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Camino 1.5</td>
                                    <td>OSX.3+</td>
                                </tr>
                                <tr id="13" class="gradeA">
                                    <td>Gecko</td>
                                    <td>Netscape 7.2</td>
                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Case title</th>
                                    <th>Case type</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

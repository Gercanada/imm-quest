@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title mb-3">Tabs Bordered</h4>

            <ul class="nav nav-tabs nav-bordered mb-3 customtab">
                <li class="nav-item">
                    <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                        <span class="d-none d-lg-block">Checklist 3</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="home-b1">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Case XXX 01</h4>
                            <h6 class="card-subtitle">Some info abouth this case as read only</h6>
                            <h6 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Pending items</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Electronic forms</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i>Submited items</h6>
                        <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">First</th>
                                                                <th scope="col">Last</th>
                                                                <th scope="col">Handle</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Jacob</td>
                                                                <td>Thornton</td>
                                                                <td>@fat</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Larry</td>
                                                                <td>the Bird</td>
                                                                <td>@twitter</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                    </div>
                </div>
                <div class="tab-pane show active" id="profile-b1">
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim
                        justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                        eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum
                        semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor
                        eu, consequat vitae, eleifend ac, enim.</p>
                    <p class="mb-0">Leggings occaecat dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus
                        et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                        ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                        quis enim.</p>
                </div>
                <div class="tab-pane" id="settings-b1">
                    <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean
                        commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et
                        magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                        ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                        quis enim.</p>
                    <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                        arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                        dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                        elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                        porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>
            </div>

        </div> <!-- end card-body-->
    </div> <!-- end card-->
@endsection

@extends('layouts.app')

@section('title')
    Checklist xxx01
@endsection


@section('content')
    <div class="card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Checklist <b>XXX 01</b></h2>
                <h6 class="card-subtitle">Some case and checklist details <i>ok</i> </h6>
                <h3 class="card-title mt-5"><i class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Pending items
                </h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CL Item Name</th>
                                <th scope="col">Required by</th>
                                <th scope="col">Upload</th>
                                <th scope="col">Help link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>
                                    <a href="{{route('checklist_item')}}" type="button" class="btn btn-outline-success btn-rounded">
                                         <i class="fas fa-eye"></i>
                                     </a>
                                 </td>
                            </tr>
                            <tr>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>
                                    <a href="{{route('checklist_item')}}" type="button" class="btn btn-outline-success btn-rounded">
                                         <i class="fas fa-eye"></i>
                                     </a>
                                 </td>
                            </tr>
                            <tr>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                                <td>
                                    <a href="{{route('checklist_item')}}" type="button" class="btn btn-outline-success btn-rounded">
                                         <i class="fas fa-eye"></i>
                                     </a>
                                 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i> Electronic
                    forms</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Required by</th>
                            <th scope="col">Help link</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="{{route('checklist_item_ef')}}" type="button" class="btn btn-outline-success btn-rounded">
                                     <i class="fas fa-eye"></i>
                                 </a>
                             </td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>
                                <a href="{{route('checklist_item_ef')}}" type="button" class="btn btn-outline-success btn-rounded">
                                     <i class="fas fa-eye"></i>
                                 </a>
                             </td>
                        </tr>
                        <tr>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td>
                                <a href="{{route('checklist_item_ef')}}" type="button" class="btn btn-outline-success btn-rounded">
                                     <i class="fas fa-eye"></i>
                                 </a>
                             </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3 class="card-title"><i class="mr-1 font-18 mdi mdi-numeric-2-box-multiple-outline"></i>Submited items
            </h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">CL Item Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">File name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

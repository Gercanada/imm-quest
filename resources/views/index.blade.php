@extends('layout')
@section('title')
    Questionary
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0"><span class="lstick d-inline-block align-middle"></span>My Invoices</h3>
        </div>
    </div>
    <humancaps-component></humancaps-component>
    {{-- <div class="row">

        <div class="col-12">
            <form class="form-horizontal r-separator">
                <div class="card shadow-lg p-1">
                    <div class="card-body">
                        <h4 class="card-title">Event Registration</h4>
                        <h6 class="card-subtitle">To use add <code>.r-separator</code> class in the form with
                            form styling.</h6>
                    </div>
                    <hr class="mt-0">

                    <div class="card-body">
                        <div class="form-group row align-items-center mb-0">
                            <label for="inputEmail3" class="col-md-3 text-center control-label col-form-label">Full
                                Name</label>
                            <div class="col-md-9 border-left pb-2 pt-2">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Full Name Here">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="inputEmail3" class="col-md-3 text-center control-label col-form-label">Maritial
                                status</label>
                            <div class="col-md-9 border-left pb-2 pt-2">
                                <input name="radio-stacked" type="radio" id="customControlValidation2"
                                    class="radio-col-indigo material-inputs">
                                <label for="customControlValidation2" class="mb-0 mt-2">Married</label>
                                <input name="radio-stacked" type="radio" id="customControlValidation3"
                                    class="radio-col-indigo material-inputs">
                                <label for="customControlValidation3" class="mb-0 mt-2">Single</label>
                                <input name="radio-stacked" type="radio" id="customControlValidation4"
                                    class="radio-col-indigo material-inputs">
                                <label for="customControlValidation4" class="mb-0 mt-2">other</label>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 pt-1">
                    <div class="card-body">

                        <h4 class="card-title mb-3">Default Tabs</h4>

                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">Factor 1
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">Factor 2
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">Factor 3</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#maritials" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-maritials-outline d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">Factor 4</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="home">
                                <div class="page-titles">
                                    <div class="col-md-5 col-12 align-self-center">
                                        <h3 class="text-themecolor mb-0"><span
                                                class="lstick d-inline-block align-middle"></span>Factores centrales del
                                            Capital Humano</h3>
                                    </div>
                                </div>
                                <humancaps-component></humancaps-component>
                            </div>
                            <div class="tab-pane show active" id="profile">
                                <div class="page-titles">
                                    <div class="col-md-5 col-12 align-self-center">
                                        <h3 class="text-themecolor mb-0"><span
                                                class="lstick d-inline-block align-middle"></span>Transferibilidad de
                                            habilidades
                                        </h3>
                                    </div>
                                </div>
                                <habilities-component></habilities-component>
                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="page-titles">
                                    <div class="col-md-5 col-12 align-self-center">
                                        <h3 class="text-themecolor mb-0"><span
                                                class="lstick d-inline-block align-middle"></span>Puntos Adicionales

                                        </h3>
                                    </div>
                                </div>
                                <additionalpoints-component></additionalpoints-component>
                            </div>
                            <div class="tab-pane" id="maritials">
                                <div class="page-titles">
                                    <div class="col-md-5 col-12 align-self-center">
                                        <h3 class="text-themecolor mb-0"><span
                                                class="lstick d-inline-block align-middle"></span>Atributos de la pareja (en
                                            caso de que aplique)
                                        </h3>
                                    </div>
                                </div>
                                <mateattributes-component></mateattributes-component>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 pt-1">

                    <div class="card-body bg-light">
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                        </div>
                    </div>



                </div>
            </form>
        </div>
    </div> --}}
@endsection

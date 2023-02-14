@extends('layouts.app')
@section('title')
    Home
@endsection

@section('styles')
    <link
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/landingpage/assets/owl.carousel/owl.carousel.min.css"
        rel="stylesheet">
    <link
        href="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/landingpage/assets/owl.carousel/owl.theme.default.css"
        rel="stylesheet">

    <style>
        .popover {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            border-radius: 0.25rem !important;
        }

        .popover a {
            border-bottom: 1px;
        }

        .popover .popover-header {
            border-bottom: none
        }

        .left .arrow::after {
            right: 0px;
            border-left-color: transparent;
        }

        .carousel-control-prev {
            /* background-color: gray; */
            border-radius: 0 150px 150px 0;
            opacity: 35%:
        }

        .carousel-control-next {
            /* background-color: gray; */
            border-radius: 150px 0 0 150px;
            opacity: 35%:
        }

        .carousel-caption {
            /* opacity: 25%; */
            background-color: green;
            border-radius: 0 50px 0 50px;
            max-height: 180px;

            padding-left: 10%;
            padding-right: 10%;
            margin-left: 10%;
            margin-right: 10%;
        }

        .text-white {
            /* opacity: 100%; */

        }
    </style>
    @if (Auth::user() && Auth::user()->themme_layout === 0)
        {{-- dark --}}
        <style>
            .bs-popover-auto[x-placement^=left]>.arrow::after,
            .bs-popover-left>.arrow::after {
                right: 1px;
                border-width: 0.5rem 0 0.5rem 0.5rem;
                border-left-color: #0a0a0a;
            }

            .popover {
                background-color: black;
            }

            .popover .popover-header {
                background-color: black;
            }

            .popover .popover-body {
                background-color: rgb(41, 41, 41);
            }
        </style>
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
        {{-- ligth --}}
        <style>
            .bs-popover-auto[x-placement^=left]>.arrow::after,
            .bs-popover-left>.arrow::after {
                right: 1px;
                border-width: 0.5rem 0 0.5rem 0.5rem;
                border-left-color: rgb(236, 236, 236);
                ;
            }

            .popover {
                background-color: white;
            }

            .popover .popover-header {
                background-color: rgb(236, 236, 236);
                border-bottom: none
            }

            .popover .popover-body {
                background-color: white;
                border-top: none
            }
        </style>
    @else
    @endif
@endsection

@section('scripts')
    <script>
        $("[data-toggle=popover]").popover({
            html: true
        });

        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        // tag.src = "https://www.youtube.com/iframe_api";//!Mayo clinic
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: 'S_CMGVbM1ns',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }

        function stopVideo() {
            player.stopVideo();
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid"
        style="background:url(/{{ env('ASSET_URL') }}images/fondocanada.jpg) no-repeat center center fixed; background-size: cover;">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="card-title text-center">{{ session()->get('applocate') == 'es' ? 'Bienvenido' : 'Welcome' }}
                </h1>
                <h3 class="card-subtitle text-center">
                    {{ session()->get('applocate') == 'es' ? 'Calcula tus puntos Express entry' : 'Calculate your Express entry points' }}
                </h3>
                <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="1" class=""></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="2" class=""></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="3" class=""></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="4" class=""></li>
                    </ol>
                    <div class="carousel-inner pt-4" role="listbox">
                        <div class="carousel-item active text-center">
                            <img class="img-fluid" src="/{{ env('ASSET_URL') }}images/slide-guide/Register.png"
                                alt="First slide">
                            <div class="carousel-caption">
                                <h3 class="text-white">
                                    {{ session()->get('applocate') == 'es' ? 'Registrate' : 'Sign Up' }}
                                </h3>
                                <p> {{ session()->get('applocate') == 'es'
                                    ? 'Crea un usuario para poder calcular y guardar tus resultados'
                                    : 'Create a user to be able to calculate and save your results' }}
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item text-center">
                            <img class="img-fluid" src="/{{ env('ASSET_URL') }}images/slide-guide/ActualSituacion.png"
                                alt="Second slide">
                            <div class="carousel-caption">
                                <h3 class="text-white">
                                    {{ session()->get('applocate') == 'es' ? 'Calcula tu estado actual' : 'Calculate your current status' }}
                                </h3>
                                <p> {{ session()->get('applocate') == 'es'
                                    ? 'Calcula el puntaje que obtendrias en tu situacion actual para poder migrar'
                                    : 'Calculate the score you would get in your current situation to be able to migrate' }}
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item text-center ">
                            <img class="img-fluid" src="/{{ env('ASSET_URL') }}images/slide-guide/CopyActual.png"
                                alt="Third slide">
                            <div class="carousel-caption">
                                <h3 class="text-white">
                                    {{ session()->get('applocate') == 'es' ? 'Simula otros posibles escenarios' : 'Simulate other possible scenarios' }}
                                </h3>
                                <p>{{ session()->get('applocate') == 'es'
                                    ? '  Copia tu escenario y calcula el puntaje que obtendrias para migrar en una situacion diferente'
                                    : 'Copy your scenario and calculate the score you would get to migrate in a different situation' }}

                                </p>
                            </div>
                        </div>
                        <div class="carousel-item text-center ">
                            <img class="img-fluid" src="/{{ env('ASSET_URL') }}images/slide-guide/Summary.png"
                                alt="Forth slide">
                            <div class="carousel-caption">
                                <h3 class="text-white">
                                    {{ session()->get('applocate') == 'es' ? 'Mostrar resultados' : 'show results' }}
                                </h3>
                                <p> {{ session()->get('applocate') == 'es'
                                    ? 'Muestra los puntos obtenidos en los distintos escntarios del usuario '
                                    : 'Shows the points obtained in the different user scenarios' }}
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item text-center ">
                            <img class="img-fluid" src="/{{ env('ASSET_URL') }}images/slide-guide/Document.png"
                                alt="Forth slide">
                            <div class="carousel-caption">
                                <h3 class="text-white">
                                    {{ session()->get('applocate') == 'es' ? 'Imprime tus resultados' : 'print your results' }}
                                </h3>
                                <p>{{ session()->get('applocate') == 'es'
                                    ? 'Genera e imprime un documento que contenga los resustados de tu situacion y los escenarios simulados'
                                    : 'Generate and print a document containing the results of your situation and the simulated scenarios' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center ">
                <div id="player" class="shadow-sm mt-4 p2 rounded col-sm-12 col-md-6"></div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-12 text-center shadow-lg p-4 m-4 btn-list">
                {{-- <a href="/register" class="btn btn-lg btn-success pm4 mt-4" type="button">
                    {{ session()->get('applocate') == 'es' ? 'Registrate' : 'Sign Up' }} </a> --}}
                {{-- <li class="nav-item "> --}}
                <div class="btn-list">
                    <a class="btn btn-lg btn-warning " href="/login" aria-haspopup="true">
                        <span class="text-info d-inline-block text-center btn btn-outline-success">
                            <i class="fas fa-key">
                                {{ session()->get('applocate') == 'en' ? 'Login' : 'Ingresar' }}
                            </i>
                        </span>
                    </a>

                    <a class="btn btn-lg btn-danger" href="/register" aria-haspopup="true">
                        <span class=" text-success d-inline-block text-center btn btn-outline-info ">
                            <i class="fas fa-user-plus">
                                {{ session()->get('applocate') == 'en' ? 'Register' : 'Registrarme' }} </i>
                        </span>
                    </a>
                </div>
                {{-- </li>
                <li class="nav-item ml-4"> --}}
                {{-- </li> --}}
            </div>
        </div>

    </div>


    {{-- <content-component /> --}}
    {{-- <main-component /> --}}
@endsection

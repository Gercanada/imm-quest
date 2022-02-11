@extends('layouts.app')

@section('title')
    Survey
@endsection

@section('styles')
    <style>
        .row {
            height: 1000px;
            max-height: 2000px;
        }

    </style>
    @if (Auth::user() && Auth::user()->themme_layout === 0)
        <style>
            .new-frame {
                opacity: 50%;
                background-color: blue;
                color: red;
            }

            .new-frame .navbar-default {
                opacity: 100%;
                background-color: green;
                color: red;
            }

            .new-frame body {
                border: 1px;
                background-color: black;
                color: red;
                position: absolute;
            }

            .navbar-form {
                background-color: #4f5467;
            }

        </style>
    @elseif (Auth::user() && Auth::user()->themme_layout === 1)
    @else
    @endif
@endsection



@section('content')
    <div class="row">
        <iframe src="{{ $cl_item->cf_1212 }}" id="myIframe" width="100% " onload="myFunction()">
        </iframe>
    </div>
@endsection

@section('scripts')
    <script>
        function myFunction() {
            setTimeout(() => {
                console.log("1 Segundo esperado")
                document.getElementById('myIframe').className = 'new-frame';
                var myframe = document.getElementById("myIframe");
                var item2 = document.getElementById("beginScripts");
                //var item3 = document.getElementById("row");
                var item4 = document.getElementsByClassName("container-fluid");

                console.log(myframe.classList);
                console.log(item2.classList);
                /*   console.log(item2.classList);
                  console.log(item3.classList); */
                // /myframe.classList.remove(" navbar navbar-default navbar-fixed-top");
                /*  myframe.classList.remove("navbar-default");
                 myframe.classList.remove("navbar-fixed-top");
                 myframe.classList.remove("navbar");
                 myframe.classList.remove("script-container");
                 myframe.classList.remove("brand-logo"); */
                //document.getElementById('beginScripts').className = 'new-frame';
                //alert("Page is loaded");
            }, 2000);

        }
    </script>
@endsection

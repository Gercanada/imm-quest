@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid pt-3">

            <div class="row">
               {{--  @foreach ($list as $file)
                    <a href="">{{ $file }}</a>
                @endforeach --}}
            </div>
            <!-- /.row -->
        </div>
    </section>

    <!-- jQuery -->
    <script src="admin-lte/plugins/jquery/jquery.min.js"></script>
    <script src="admin-lte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="admin-lte/plugins/raphael/raphael.min.js"></script>
    <script src="admin-lte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="admin-lte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script>
        $('.world-map-markers').mapael({
            map: {
                name: "usa_states",
                width: 800
            }
        })
    </script>
@endsection

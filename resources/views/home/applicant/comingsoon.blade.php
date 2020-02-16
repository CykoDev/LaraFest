@extends('layouts.app')

@section('content')

<div class="container-fluid">



    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <div class="text-center p-3">
                <img height="200" src="{{ asset('img/public/undraw_welcome_cats_thqn.svg') }}" alt="welcome!">
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coming Soon!</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="{{ asset('img/public/undraw_landscape_mode_53ej.svg') }}" alt="">
                    </div>
                    <p>
                        Stay tuned for when our teams finalize and release the events for NLF 2020. Be ready to get started!
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection



@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    {{-- <!-- Content Row -->
    <div class="row">

        <!-- Card Example -->
        @include('layouts.components.card',['textclass'=>'primary', 'title'=>'some heading', 'data' => '$1000'])

        <!-- Card Example -->
        @include('layouts.components.card',['textclass'=>'warning', 'title'=>'some heading', 'data' => '$1000'])

        <!-- Card Example -->
        @include('layouts.components.card',['textclass'=>'info', 'title'=>'some heading', 'data' => '$1000'])

        <!-- Card Example -->
        @include('layouts.components.card',['textclass'=>'success', 'title'=>'some heading', 'data' => '$1000'])

    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        @include('layouts.components.areachart')

        <!-- Pie Chart -->
        @include('layouts.components.piechart')
    </div> --}}

</div>

@endsection



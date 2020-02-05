@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @include('layouts.components.applicants.profilecomplete-'. $stage)

    {{-- @if(!isset($_SESSION['stage']))
        @include('layouts.components.applicants.profilecomplete-1')
    @else
        @include('layouts.components.applicants.profilecomplete-'.$_SESSION['stage'])
    @endif --}}
</div>

@endsection



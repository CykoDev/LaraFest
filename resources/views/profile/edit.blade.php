@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hi Applicant!</h1>

    </div>
    @include('users.applicants.profile-' . $stage)

</div>

@endsection



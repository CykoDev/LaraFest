@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Event Information</h1>
        <a href="{{ route('events.discounts.create', $event->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Create Discount
        </a>
    </div>

    <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'Enrolled Users',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $event->users->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'event Price',
            'faIcon' => '<i class="fas fa-dollar-sign fa-2x mr-2"></i>',
            'data' => $event->currencySymbol . ' ' . $event->price
        ])
    </div>

    <div class="card shadow mb-4 mr-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($event->name) }}</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid rounded px-3 px-sm-4 mt-3 mb-4" style="width: 40rem; height: 10rem; object-fit: cover;"
                    src="{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}" alt="">
            </div>
            <p class="text-muted small">Created On: {{ $event->created_at->isoFormat('D MMMM, Y') }}</p>
            <p class="text-muted small">Updated On: {{ $event->updated_at->isoFormat('D MMMM, Y') }}</p>
            <section class="my-5">
                <h5 class="text-primary">Active Discount</h5>
                @if($event->discount)
                    <table>
                        <tr> 
                            <td class="text-dark font-weight-bold pr-5">Discount Name</td>
                            <td>{{ ucwords($event->discount->name) }}</td>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold pr-5">Discount Percentage</td>
                            <td>{{ ucwords($event->discount->amount) }}%</td>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold pr-5">Discount Expiry</td>
                            <td>{{ ucwords($event->discount->expiry_at->isoFormat('D MMMM, Y')) }}</td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['EventController@destroyDiscount', $event->discount->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td></td>
                        </tr>
                    </table>
                @else
                    <p>N/A</p>
                @endif
            </section>
            <section class="my-5">
                <h5 class="text-primary">Event Details</h5>
                <p class="px-4">{{ $event->details }}</p>
            </section>
        </div>
    </div>

    @if($event->data)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">event Data</h6>
            </div>
            <div class="card-body">
                @foreach($event->data as $key=>$value)
                    <div class="form-row py-1">
                        <div class="col-3">
                            <span class="text-dark font-weight-bold">
                                {{ ucwords(str_replace('_',' ',str_replace('_id', '', $key))) }}
                            </span>
                        </div>
                        <div class="col-7">
                            @if(strpos($key, 'photo_id'))
                                <a href="{{ $event->photo(str_replace('_id','',$key))->path }}" target="_blank">View</a>
                            @else
                                <span>{{ ucwords($value) }}</span>
                            @endif
                        </div>
                        <div class="col-2"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @component('layouts.components.datatable')
    @slot('title')
        {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportEventApplicants', $event->id]]) !!}
        <span class="mr-3">Enrolled Users</span>
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> <small>Generate Excel</small>',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    @endslot
    @slot('headings')
        <tr>
            <th><small class="font-weight-bold">Photo</small></th>
            <th><small class="font-weight-bold">Name</small></th>
            <th><small class="font-weight-bold">Email</small></th>
            <th><small class="font-weight-bold">Contact</small></th>
        </tr>
    @endslot
    @slot('body')
        @if($event->users)
            @foreach($event->users as $user)
            <tr>
                <td><img src='{{ is_null($user->photo) ? $user->defaultImage : $user->photo->path }}' class="rounded-circle" width=30 height=30></td>
                <td>
                    <small>
                        <a href="{{ route('users.show', $user->slug) }}">{{ $user->name }}</a>
                    </small>
                </td>
                <td>
                    <a href="mailto:{{ $user->email }}">
                        <small>{{ $user->email }}</small>
                    </a>
                </td>
                <td><small>{{ $user->data['mobile_no'] ? $user->data['mobile_no'] : 'N/A' }}</small></td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection

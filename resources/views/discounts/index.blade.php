@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Discounts</h1>
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Discounts
    @endslot
    @slot('headings')
        <tr>
        <th>ID</th>
        {{-- <th>Photo</th> --}}
        <th>Name</th>
        <th>Amount</th>
        <th>Discount Type</th>
        <th>Created At</th>
        <th>Expiry At</th>
        </tr>
    @endslot
    @slot('body')
        @if($discounts)
            @foreach($discounts as $discount)
            <tr>
                <td>{{ $discount->id }}</td>
                {{-- <td><img src='{{ is_null($event->photo) ? $event->defaultImage : $event->photo->path }}' class="rounded-circle" width=40 height=40></td> --}}
                <td><a href="{{ route('discounts.edit', $discount->slug) }}">{{ $discount->name }}</a></td>
                <td>{{ $discount->amount }}</td>
                <td>{{ $discount->discountable_type }}</td>
                <td>{{ $discount->created_at->diffForHumans() }}</td>
                <td>{{ $discount->expiry_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">All Your Expenses</h1>
        {!! Form::open(['method'=>'POST', 'action'=>'FinanceController@generateInvoice']) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Challan',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm p-2']) !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'Sum Total',
            'faIcon' => '<i class="fas fa-2x fa-hand-holding-usd"></i>',
            'data' => 'Rs. ' . $expenses->sum('price'),
        ])
    </div>

    @component('layouts.components.datatable')
    @slot('title')
        All Expenses
    @endslot
    @slot('headings')
        <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Made At</th>
        </tr>
    @endslot
    @slot('body')
        @if($expenses)
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->name }}</td>
                <td>Rs. {{ $expense->price }}</td>
                <td>{{ $expense->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection



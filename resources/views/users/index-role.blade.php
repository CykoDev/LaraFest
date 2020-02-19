@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(Session::has('status'))
        <p class="text-{{ session('status')['class'] }}">{{ session('status')['message'] }}</p>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ ucwords($role->name) }}s</h1>
        {!! Form::open(['method'=>'POST', 'action'=>['ExportController@exportRoleUsers', $role->name]]) !!}
        {!! Form::button('<i class="fas fa-download fa-sm text-white-50"></i> Generate Excel',
            ['type'=>'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) !!}
        {!! Form::close() !!}
    </div>

    @if(Auth::user()->isAdmin())
        <div class="row">
            @include('layouts.components.card', [
                'textclass' => 'primary',
                'title' => 'View All Users',
                'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
                'data' => '',
                'link' => route('users.index'),
            ])
        </div>
    @endif

    @if (Auth::user()->role->name=='admin' ||  Auth::user()->role->name=='moderator')

        {!! Form::open(['method'=>'POST', 'action'=>'FinanceController@verifyUsersPayment']) !!}

    @endif

    @component('layouts.components.datatable')
    @slot('title')
        {{ ucwords($role->name) }} Users

        @if (Auth::user()->role->name=='admin' ||  Auth::user()->role->name=='moderator')

            {!! Form::button('<i class="fas fa-dollar-sign mr-2"></i> <small>Verify Payment of Multiple Users</small>',
                ['type' => 'submit', 'class'=>'d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-5']) !!}

        @endif
    @endslot
    @slot('headings')
        <tr>
            <th>{!! Form::checkbox('options', null, null, ['class'=>'checkAll']) !!}</th>
            <th><small class="font-weight-bold">Photo</small></th>
            <th><small class="font-weight-bold">Name</small></th>
            <th><small class="font-weight-bold">Email</small></th>
            <th><small class="font-weight-bold">Contact</small></th>
            <th><small class="font-weight-bold">Payment Status</small></th>
            <th><small class="font-weight-bold">Invoice ID</small></th>
            <th><small class="font-weight-bold">Registered At</small></th>
            @if (Auth::user()->role->name=='admin' ||  Auth::user()->role->name=='moderator')
                <th><small class="font-weight-bold">Actions</small></th>
            @endif
        </tr>
    @endslot
    @slot('body')
        @if($users)
            @foreach($users as $user)
            <tr>
                <td>
                    {!! Form::checkbox('users[]', $user->id, null,  ['class'=>'checkBoxes']) !!}
                </td>
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
                <td><small>{{ isset($user->data['mobile_no']) ? $user->data['mobile_no'] : 'N/A' }}</small></td>
                <td>
                    @if($user->payment_status == 'unpaid')
                        <small class="text-danger font-weight-bold">{{ $user->payment_status }}</small>
                    @elseif($user->payment_status == 'unverified')
                        <small class="text-warning font-weight-bold">{{ $user->payment_status }}</small>
                    @elseif($user->payment_status == 'paid')
                        <small class="text-success font-weight-bold">{{ $user->payment_status }}</small>
                    @endif
                </td>
                <td><small>{{ substr(bin2hex($user->id.$user->name),0,10) }}</small></td>
                <td><small>{{ $user->created_at->isoFormat('D MMMM, Y') }}</small></td>
                @if (Auth::user()->role->name=='admin' ||  Auth::user()->role->name=='moderator')
                    <td>
                        @if($user->payment_status == 'paid')
                            <a href="{{ route('unverify.payment', $user->id) }}" class="btn btn-default p-0 text-warning">
                                <small class="font-weight-bold">unverify payment</small>
                            </a>
                        @elseif($user->payment_status == 'unverified')
                            <a href="{{ route('verify.payment', $user->id) }}" class="btn btn-default p-0 text-primary">
                                <small class="font-weight-bold">verify payment</small>
                            </a>
                        @elseif($user->payment_status == 'unpaid')
                            <small class="font-weight-bold">proof not uploaded</small>
                        @endif
                    </td>
                @endif
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.checkAll').on('click', function(){
            if(this.checked){
                $('.checkBoxes').each(function(){
                    this.checked = true;
                });
            }
            else {
                $('.checkBoxes').each(function(){
                this.checked = false;
                });
            }
        });
    });
</script>
@endpush

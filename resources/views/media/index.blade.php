@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Media</h1>
    </div>


    {!! Form::open(['method'=>'POST', 'action'=>'MediaController@manageMany']) !!}

    @component('layouts.components.datatable')
    @slot('title')
        All Images

        {!! Form::button('<i class="far fa-trash-alt"></i>',
            ['type' => 'submit', 'value'=>'deleteMany', 'name'=>'deleteMany', 'class'=>'btn btn-danger py-0 px-2 ml-5 mr-2']) !!}
        {!! Form::button('<i class="fas fa-file-archive"></i> + <i class="fas fa-download"></i>',
            ['type' => 'submit', 'value'=>'downloadZipMany', 'name'=>'downloadZipMany', 'class'=>'btn btn-primary py-0 px-2 mr-2']) !!}
    @endslot
    @slot('headings')
        <tr>
        <th>{!! Form::checkbox('options', null, null, ['class'=>'checkAll']) !!}</th>
        <th>ID</th>
        <th>Thumbnail</th>
        <th>Type</th>
        <th>Size</th>
        <th>Purpose</th>
        <th>Uploaded By</th>
        <th>Uploaded At</th>
        <th>Updated At</th>
        <th>Actions</th>
        </tr>
    @endslot
    @slot('body')
        @if($photos)
            @foreach($photos as $photo)
            <tr>
                <td>{!! Form::checkbox('checkBoxArray[]', $photo->id, null,  ['class'=>'checkBoxes']) !!}</td>
                <td><small>{{ $photo->id }}</small></td>
                <td>
                    <a href="{{ $photo->path }}" target="_blank">
                        <img src='{{ $photo->path }}' class="rounded" width=50 height=40>
                    </a>
                </td>
                <td><small>{{ File::mimeType(public_path().$photo->path) }}</small></td>
                <td><small>{{ $photo->getSize() }}</small></td>
                <td><small>{{ str_replace('_', ' ', $photo->type) }}</small></td>
                <td><small><a href="{{ route('users.edit', $photo->user->slug) }}">{{ $photo->user->name }}</a></small></td>
                <td><small>{{ $photo->created_at->diffForHumans() }}</small></td>
                <td><small>{{ $photo->updated_at->diffForHumans() }}</small></td>
                <td>
                    <a href="{{ route('download', bin2hex($photo->path)) }}">
                        <i class="fas fa-download text-primary mr-3"></i>
                    </a>
                    <a href="{{ route('delete', bin2hex($photo->id)) }}">
                        <i class="far fa-trash-alt text-danger"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        @endif
    @endslot
    @endcomponent

    {!! Form::close() !!}

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



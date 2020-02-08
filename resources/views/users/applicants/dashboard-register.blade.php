<div>
    <p>Are you signing up as a NUSTian?</p>
    {{-- {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!} --}}
    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@edit', 'files'=>false]) !!}
    <div class="form-group">
        {!! Form::button('Yes', ['type'=>'submit', 'name'=>'submit', 'value'=>'yes', 'class'=>'btn btn-primary']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::button('No', ['type'=>'submit', 'name'=>'submit', 'value'=>'no', 'class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

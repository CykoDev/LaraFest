<div>
    <p>How would you like to proceed?</p>
    {{-- {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!} --}}
    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@edit', 'files'=>false]) !!}
    <div class="form-group">
        {!! Form::button('Choose Package items', ['type'=>'submit', 'name'=>'submit', 'value'=>'package', 'class'=>'btn btn-primary']) !!}
    </div>
    @if ($userType == 'nustian')
    <br>
    <div class="form-group">
        {!! Form::button('Add-on individual events', ['type'=>'submit', 'name'=>'submit', 'value'=>'individual', 'class'=>'btn btn-primary']) !!}
    </div>
    @endif
    {!! Form::close() !!}
</div>

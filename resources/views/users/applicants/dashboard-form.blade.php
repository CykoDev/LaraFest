<div>
    <p>How would you like to proceed?</p>
    {{-- {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!} --}}
    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@store', 'files'=>false]) !!}
    <div class="form-group">
        {!! Form::button('Continue where I left off', ['type'=>'submit', 'name'=>'submit', 'value'=>'continue', 'class'=>'btn btn-primary']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::button('Start process anew', ['type'=>'submit', 'name'=>'submit', 'value'=>'reset', 'class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

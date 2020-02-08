<div>
    <p>Are you a student or a professional?</p>
    {{-- {!! Form::open(['method'=>'POST', 'action'=>'HomeController@postApplicant', 'files'=>false]) !!} --}}
    {!! Form::open(['method'=>'POST', 'action'=>'ProfileController@store', 'files'=>false]) !!}
    <div class="form-group">
        {!! Form::button('Student', ['type'=>'submit', 'name'=>'submit', 'value'=>'student', 'class'=>'btn btn-primary']) !!}
    </div>
    <br>
    <div class="form-group">
        {!! Form::button('Professional', ['type'=>'submit', 'name'=>'submit', 'value'=>'pro', 'class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

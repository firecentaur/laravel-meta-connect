<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('userid', 'Userid:') !!}
    {!! Form::number('userid', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar_name', 'Avatar Name:') !!}
    {!! Form::text('avatar_name', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Course Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course', 'Course:') !!}
    {!! Form::number('course', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Intro Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('intro', 'Intro:') !!}
    {!! Form::textarea('intro', null, ['class' => 'form-control']) !!}
</div>

<!-- Timeopen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('timeopen', 'Timeopen:') !!}
    {!! Form::text('timeopen', null, ['class' => 'form-control','id'=>'timeopen']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#timeopen').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Timeclose Field -->
<div class="form-group col-sm-6">
    {!! Form::label('timeclose', 'Timeclose:') !!}
    {!! Form::text('timeclose', null, ['class' => 'form-control','id'=>'timeclose']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#timeclose').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Timelimit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('timelimit', 'Timelimit:') !!}
    {!! Form::number('timelimit', null, ['class' => 'form-control']) !!}
</div>

<!-- Canredoquestions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('canredoquestions', 'Canredoquestions:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('canredoquestions', 0) !!}
        {!! Form::checkbox('canredoquestions', '1', null) !!}
    </label>
</div>


<!-- Attempts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attempts', 'Attempts:') !!}
    {!! Form::number('attempts', null, ['class' => 'form-control']) !!}
</div>

<!-- Questionsperpage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('questionsperpage', 'Questionsperpage:') !!}
    {!! Form::number('questionsperpage', null, ['class' => 'form-control']) !!}
</div>

<!-- Shuffleanswers Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shuffleanswers', 'Shuffleanswers:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('shuffleanswers', 0) !!}
        {!! Form::checkbox('shuffleanswers', '1', null) !!}
    </label>
</div>


<!-- Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grade', 'Grade:') !!}
    {!! Form::number('grade', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
</div>

<!-- Course Field -->
<div class="form-group">
    {!! Form::label('course', 'Course:') !!}
    <p>{{ $quiz->course }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $quiz->name }}</p>
</div>

<!-- Intro Field -->
<div class="form-group">
    {!! Form::label('intro', 'Intro:') !!}
    <p>{{ $quiz->intro }}</p>
</div>

<!-- Timeopen Field -->
<div class="form-group">
    {!! Form::label('timeopen', 'Timeopen:') !!}
    <p>{{ $quiz->timeopen }}</p>
</div>

<!-- Timeclose Field -->
<div class="form-group">
    {!! Form::label('timeclose', 'Timeclose:') !!}
    <p>{{ $quiz->timeclose }}</p>
</div>

<!-- Timelimit Field -->
<div class="form-group">
    {!! Form::label('timelimit', 'Timelimit:') !!}
    <p>{{ $quiz->timelimit }}</p>
</div>

<!-- Canredoquestions Field -->
<div class="form-group">
    {!! Form::label('canredoquestions', 'Canredoquestions:') !!}
    <p>{{ $quiz->canredoquestions }}</p>
</div>

<!-- Attempts Field -->
<div class="form-group">
    {!! Form::label('attempts', 'Attempts:') !!}
    <p>{{ $quiz->attempts }}</p>
</div>

<!-- Questionsperpage Field -->
<div class="form-group">
    {!! Form::label('questionsperpage', 'Questionsperpage:') !!}
    <p>{{ $quiz->questionsperpage }}</p>
</div>

<!-- Shuffleanswers Field -->
<div class="form-group">
    {!! Form::label('shuffleanswers', 'Shuffleanswers:') !!}
    <p>{{ $quiz->shuffleanswers }}</p>
</div>

<!-- Grade Field -->
<div class="form-group">
    {!! Form::label('grade', 'Grade:') !!}
    <p>{{ $quiz->grade }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $quiz->password }}</p>
</div>


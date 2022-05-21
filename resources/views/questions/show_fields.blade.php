<!-- Parent Field -->
<div class="form-group">
    {!! Form::label('parent', 'Parent:') !!}
    <p>{{ $question->parent }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $question->name }}</p>
</div>

<!-- Questiontext Field -->
<div class="form-group">
    {!! Form::label('questiontext', 'Questiontext:') !!}
    <p>{{ $question->questiontext }}</p>
</div>

<!-- Questiontextformat Field -->
<div class="form-group">
    {!! Form::label('questiontextformat', 'Questiontextformat:') !!}
    <p>{{ $question->questiontextformat }}</p>
</div>

<!-- Generalfeedback Field -->
<div class="form-group">
    {!! Form::label('generalfeedback', 'Generalfeedback:') !!}
    <p>{{ $question->generalfeedback }}</p>
</div>

<!-- Generalfeedbackformat Field -->
<div class="form-group">
    {!! Form::label('generalfeedbackformat', 'Generalfeedbackformat:') !!}
    <p>{{ $question->generalfeedbackformat }}</p>
</div>

<!-- Defaultmark Field -->
<div class="form-group">
    {!! Form::label('defaultmark', 'Defaultmark:') !!}
    <p>{{ $question->defaultmark }}</p>
</div>

<!-- Penalty Field -->
<div class="form-group">
    {!! Form::label('penalty', 'Penalty:') !!}
    <p>{{ $question->penalty }}</p>
</div>

<!-- Qtype Field -->
<div class="form-group">
    {!! Form::label('qtype', 'Qtype:') !!}
    <p>{{ $question->qtype }}</p>
</div>

<!-- Length Field -->
<div class="form-group">
    {!! Form::label('length', 'Length:') !!}
    <p>{{ $question->length }}</p>
</div>

<!-- Stamp Field -->
<div class="form-group">
    {!! Form::label('stamp', 'Stamp:') !!}
    <p>{{ $question->stamp }}</p>
</div>

<!-- Createdby Field -->
<div class="form-group">
    {!! Form::label('createdby', 'Createdby:') !!}
    <p>{{ $question->createdby }}</p>
</div>

<!-- Modifiedby Field -->
<div class="form-group">
    {!! Form::label('modifiedby', 'Modifiedby:') !!}
    <p>{{ $question->modifiedby }}</p>
</div>

